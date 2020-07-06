<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Cache;
use App\Message_1;
use App\Message_2;
//use App\Jobs;


class UserController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/
    
    public function profile($nickname){
        $user = DB::select('select * from users where nickname = "'.$nickname.'"');
        
        if(isset($user[0])){
           $user = $user[0]; 
        }else{
            abort(404);
        }
        
        
        
        return view('user.profile')
                ->with('user', $user);
    }
    
    public function search(Request $request){
        $users = [];
        $search = false;
        if($request->input('name')){
            
            $search = true;
            $name = explode(' ', $request->input('name'));
        
            //dump($name);
            $fname = '';
            if(sizeof($name) > 1){
                $fname = ' and fname like "'.$name[1].'%"';
            }

            $sql = 'select SQL_NO_CACHE * from users where name like "'.$name[0].'%"'.$fname;
            //echo $sql;
            //wrk -t10 -c50 -d30s --timeout 3s http://165.22.29.236/user/search?name=ab+b
            //$users = DB::select($sql);
            $users = DB::connection('slave')->select($sql);
            //echo 1;
        }
        //dump($users, $search);
        return view('user.search')->with('users', count($users))->with('search', $search);
    }
    
    public function feed(){
        
        $userId = Auth::user()->id;
        
        //Cache::flush();
        //dd(1);
        
        $posts = cache($userId . '.feed');
        
        if(!$posts){
            $posts = $this->getFeed($userId);
        }
        
        
        
        return view('user.feed')->with('posts', $posts);
    }
    
    public function createFeed($userId){
        $sql = 'SELECT p.id as post_id,p.*, u.* from posts p '
                . 'LEFT JOIN users u ON u.id = p.user_id '
                . 'WHERE '
                . 'p.user_id IN (SELECT follow_id FROM friends WHERE user_id = ?) '
                . 'OR p.user_id = ? '
                . 'order by p.id desc LIMIT 1000';
        return DB::select($sql, [$userId, $userId]);
    }
    
    
    function getFeed($userId){
        \App\Jobs\CreateFeed::dispatch($userId);
        return cache($userId . '.feed');
    }
    
    
    function test(){
        $friends = Auth::user()->followers;
        foreach ($friends as $friend){
            echo $friend->user_id."\n";
        }
        dump($friends);
    }
}
