<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Base extends Controller
{
    public function __construct(Request $request)
    {
        //实现父类的构造函数
        parent::__construct($request);
        //登录检测
        if(!session('?user_info')){
            //没登录
            $this->redirect('admin/login/login');
        }
    }
}
