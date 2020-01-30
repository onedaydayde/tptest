<?php

namespace app\adminapi\controller;

use think\Collection;
use think\Controller;
use think\Request;
use app\common\model\Auth;

class Auth extends Controller
{
    /**
     * 分类列表显示
     *
     * @return \think\Response
     */
    public function index()
    {
        //接收参数
        $params = input();
        $where = [];
        if (!empty($params['keyword'])){
            $where['auth_name']=['like',"%{$params['keyword']}"];
        }
        //查询数据
        $list = \app\common\model\Auth::where($where)->select();
        //转化为二维数组
        $list = (new Collection($list))->toArray();
        if (!empty($params['type']) && $params['type'] == 'true'){
            //父子树状列表
            $list = get_tree_list($list);
        } else {
            //无限极分类列表
            $list = get_cate_list($list);
        }
        //返回数据
        $this->ok($list);
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
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 权限详情
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //查询数据
        $auth = \app\common\model\Auth::field('id,auth_name,pid,pid_path,auth_c,auth_a,is_nav,level')->find($id);
        //返回数据
        $this->ok($auth);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
