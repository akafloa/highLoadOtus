<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function mysql() {
        $start = microtime(true);
        
        $sql = 'SELECT sex, age, count(*) cnt
                FROM `users`
                group by age,sex order by sex, age';
        
        $res = DB::select($sql);
        
        $time = microtime(true) - $start;
        
        //echo $time;
        //6.5
        //dump($res);
        
        return view('reports')->with('data', $res)->with('time', round($time, 2));
    }
    
    public function clickhouse() {
        $client = new \ClickHouse\Client('http://127.0.0.1', 8123, 'default', '3901547');
        
        $start = microtime(true);
        $sql = 'SELECT * FROM users limit 2';
        $sql = 'SELECT sex, avg(age) FROM `users` group by sex';
        
        $sql = 'SELECT sex, age, count(*) cnt
                FROM `mysql_users_4`
                group by age,sex order by sex, age';
        
        
        $result  = $client->select($sql);
        
        $time = microtime(true) - $start;
        
        //echo $time;
        
        //dump($result->fetchAll());
        return view('reports')->with('data', $result->fetchAll())->with('time', round($time, 2));
    }
}
