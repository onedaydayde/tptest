<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class Login extends Controller
{
    public function login()
    {
//        $password = '123456';
//        dump($password);
//        $hash = password_hash($password, PASSWORD_DEFAULT);
//        dump($hash);
//        //检测用户密码是否匹配正确
//        if (password_verify($password,'$2y$10$H5kx5ALpivWvg5B8pgF8lODzw5fHgCAKbRcaH8m1jscX2xXOJUbqG')) {
//            echo "密码正确";
//        } else {
//            echo "密码错误";
//        }


        if(request()->isPost()){
            //post请求  表单提交
            //接收参数  username  password  code
            $params = input();
            //参数检测 （表单验证）
            $rule = [
                'username|用户名' => 'require',
                'password|密码' => 'require|length:1,10',
                'code|验证码' => 'require|captcha'
            ];
            $msg = [
                'username.require' => '用户名不能为空',
                'password.require' => '密码不能为空',
                'password.length' => '密码长度在1-10个字符之间',

            ];
            $res = $this->validate($rule, $msg);
            if($res !== true){
                $this->error($res);
            }
            //验证码手动校验
            if(!captcha_check($params['code'],'login')){
                $this->error('验证码错误');
            }
            //查询管理员用户表
            $password = password_hash($params['password'], PASSWORD_DEFAULT);
            $manager=Db::table('pyg_admin')->where('username',$params['username'])->find();
            if(password_verify($params['password'],$password)){
                //登录成功
                //设置登录标识到session
                session('user_info', $manager);
                //页面跳转
                $this->success('登录成功', 'admin/index/index');
            }else{
                //用户名或密码错误
                $this->error('用户名或密码错误');
            }
        }else{
            //get请求  页面展示
            //临时关闭全局模板布局
            $this->view->engine->layout(false);
            return view();
        }
    }


    public function logout()
    {
        //情况session
        session(null);
        $this->redirect('/admin/login/login');
    }







    public function test()
    {
        session('person',['name'=>'张三','sex'=>'男']);
        $per=session('person');
        dump($per);
        dump($per['name']);
        dump(session('person.name'));
        dump(session(''));
        session(null);
        dump(session(''));

        cookie('username','李四',60);
        dump(cookie('username'));
        dump(cookie(''));
        cookie('username',null);
        dump('ddd');
        cookie(null,'think_');
        dump(cookie(''));
    }



}
