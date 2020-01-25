<?php

namespace app\admin\controller;

use think\Db;
use think\Controller;
use think\Request;
use think\Session;

class Login extends Controller
{
    /**
     * 登陆
     *
     * @return \think\Response
     */
    public function login()
    {
        //一个方法 处理两个业务逻辑：页面展示  表单提交
        if (request()->isPost()) {
            //接受全部参数
            $params = input();
//            dump($params);
            //参数检测 （表单验证）
            $rule = [
                'username|用户名' => 'require',
                'password|密码' => 'require',
                //'code|验证码' => 'require|captcha'
            ];
            $res = $this->validate($params, $rule);
            if ($res !== true) {
                $this->error($res);
            }
            //验证码手动校验
//            if (!captcha_check($params['code'])) {
//                $this->error('验证码错误');
//            }
            //查询管理员用户表
            $password = $params['password'];
            //数据库查询当前用户名的哈希密码
            $manager=Db::table('tpshop_manager')->where('username',$params['username'])->find();
            //库中密码与提交密码解密匹配是否为true
            if (password_verify($password,$manager['password'])) {
                //登录成功
                //设置登录标识到session
                Session::set('name',$manager['username']);
                Session::set('password',$manager['password']);
                //页面跳转
                $this->success('登录成功', 'admin/index/index');
            } else {
                //用户名或密码错误
                $this->error('用户名或密码错误');
            }
        } else {
            //get请求  页面展示
            //临时关闭全局模板布局
            $this->view->engine->layout(false);
            return view();
        }
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //临时关闭模板布局
//        $this->view->engine->layout(false);
//        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param \think\Request $request
     * @param int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
