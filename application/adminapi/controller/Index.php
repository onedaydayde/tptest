<?php
namespace app\adminapi\controller;

use think\Db;
use tools\jwt\Token;

class Index extends BaseApi
{
    public function index()
    {
        //测试数据库配置
//        $goods=Db::table('pyg_goods')->find();
//        dump($goods);die();

        //测试响应信息
//        $this->response(200,'success提示信息',['action'=>'index']);
//        $this->ok(['action'=>'index']);

        //测试Token
        //生成Token
//        $token=Token::getToken(100);
//        dump($token);
        //从token获取id
//        $userid=Token::getUserId($token);
//        dump($userid);die();

        //初始用户密码
        $password = '123456';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        dump($hash);
        //检测用户密码是否匹配正确
        if (password_verify($password,'$2y$10$H5kx5ALpivWvg5B8pgF8lODzw5fHgCAKbRcaH8m1jscX2xXOJUbqG')) {
            echo "密码正确";
        } else {
            echo "密码错误";
        }
        die();
    }
}
