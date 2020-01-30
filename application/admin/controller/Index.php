<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;
use tools\jwt\Token;

class Index extends Controller
{
    public function index()
    {
        return view();
    }

    public function _empty()
    {
        $method = request()->action();
        if($method == 'login'){
        }
        return view($method);
    }
}
