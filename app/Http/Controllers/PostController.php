<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
}
