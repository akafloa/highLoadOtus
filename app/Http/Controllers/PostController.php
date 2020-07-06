<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;
use Auth;

class PostController extends Controller
{
    public function index(){
        
        $sql = 'SELECT p.id as post_id,p.description, p.title, u.id, u.name, u.fname, u.nickname, u.avatar '
                . 'FROM posts p '
                . 'LEFT JOIN users u ON u.id = p.user_id '
                . 'order by p.id desc LIMIT 10000';
        
        $posts = DB::select($sql);
        
        return view('posts')->with('posts', $posts);
    }
    
    
    /*
     * вставляю новую запись и в цикле рассылаю уведомление всем своим друзьям
     * если кто то не в онлайне ему ничего отсылаться не будет так как он не подписан на компонент worker
     *
     */
    function insert(Request $request){
        
        $title = rand(5, 500).'rand test title';
        $description = rand(5, 500).'Lorem Ipsum1111 - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.';
        
        $post = new Post();
        $post->user_id = 4;
        $post->title = $title;
        $post->description = $description;
        $post->save();
        
        $this->sendToFeed($title, $description);
    }
    
    function sendToFeed($title, $description){
        //echo '1';
        $localsocket = 'tcp://127.0.0.1:1234';
        $friends = Auth::user()->followers;
        //$message = 'test'; //тут сам пост
        //dd($friend->user_id);
        // соединяемся с локальным tcp-сервером
        $instance = stream_socket_client($localsocket);
        //dump($instance);
        // отправляем сообщение
        foreach($friends as $friend){
            fwrite($instance, json_encode(['user' => $friend->user_id, 'message' => ['title'=>$title, 'description'=>$description]])  . "\n");
        }
        //fwrite($instance, json_encode(['user' => 5, 'message' => 'test'])  . "\n");
        
    }
}
