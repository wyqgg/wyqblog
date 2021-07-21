<?php
/**
 * Created by PhpStorm.
 * User: wyq
 * Date: 2021/7/19
 * Time: 16:32
 */

class UserController extends AppController
{
    public $components = array('Session','publicFunction');
    public $helpers =array('Html', 'Form');

    /*
     * 文章列表
     * 获取文章全部信息
     * 渲染页面
     */
    public function index(){

        $page = $_GET['page'] ? $_GET['page'] : 1;
        $limit = 10;
        $count = $this->User->count();
        $pageCount = ceil($count/$limit);
        $params = $this->User->findUser($page,$limit);
        $this->set(array('params'=>$params,'page'=>$page,'pageCount'=>$pageCount));
    }
    /*
     * 新增、修改文章
     *
     */
    public function dell(){
        $params = $_POST;
        //当id有值时才是修改操作
        $res = $this->User->save($params);
        if ($res){
            $this->publicFunction->success($res);
        }else{
            $this->publicFunction->fail();
        }
    }

}