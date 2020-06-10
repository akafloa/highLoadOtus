<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use DB;
use Auth;

class MessageController extends Controller
{
    public function index($toUserId = null){
        
        //dump($chatId);
        $messages = [];
        $toUser = [];
        $userId = Auth::user()->id;
        
        $fierdsSql = 'SELECT follow_id, u.name, u.fname, u.avatar
                        FROM `friends` as f
                        inner join users as u 
                        on u.id = f.follow_id
                        where user_id = ?';
        $friends = DB::select($fierdsSql, [$userId]);
        
        if($toUserId){
            $toUser = DB::select('select * FROM users where id = ?', [$toUserId]);
            
            if($toUser){
                $toUser = $toUser[0];
                $chatId = $this->getChatId($userId, $toUserId);
                $messages = $this->getMessages($chatId);
            }
            
            //dump($messages);
        }
        
        return view('user.message')
                ->with('friends', $friends)
                ->with('messages', $messages)
                ->with('toUser', $toUser)
                ->with('userId', $userId);
    }
    
    public function getMessages($chatId){
        
        $tbl = $this->getTbl($chatId);
        
        $chatSql = 'SELECT * FROM '
                . '(SELECT msg.`id`, msg.`chat_id`, msg.`from`, msg.`to`, msg.`message`, '
                . 'msg.`is_read`, cast(msg.`created_at` as time) as created_time, '
                . 'u2.name as from_name, u2.id as from_id, '
                . 'u2.avatar as from_avatar  '
                . 'FROM '.$tbl.' msg '
                . 'INNER JOIN users as u1 ON u1.id = msg.`to` '
                . 'INNER JOIN users as u2 ON u2.id = msg.`from` '
                . 'WHERE msg.chat_id = ? ORDER BY msg.id DESC LIMIT 100) as t'
                . ' ORDER BY t.id ASC';
        //echo $chatSql;
        return  DB::select($chatSql, [$chatId]);
        
    }
    
    public function getChatId($userId,$toUserId){
        return $userId < $toUserId ? $userId.$toUserId : $toUserId.$userId;
    }
    
    public function getTbl($chatId){
        return ($chatId % 2 == 0) ? 'message_2s' : 'message_1s';
    }
    
    
    public function send(Request $request){
        //dump($request->input());
        
        $chatId = $this->getChatId($request->input('from'), $request->input('to'));
        
        $tbl = $this->getTbl($chatId);
        
        $inserSql = 'INSERT INTO '.$tbl.' (`chat_id`, `from`, `to`, `message`, `created_at`, `updated_at`) '
                . 'VALUES (?, ?, ?, ?, NOW(), NOW())';
        DB::insert($inserSql, [$chatId, $request->input('from'), $request->input('to'), $request->input('message')]);
                
        return redirect()->back();
    }
    
}
