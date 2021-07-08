<?php
/**
 * Created by PhpStorm.
 * User: wyq
 * Date: 2021/7/7
 * Time: 16:32
 */

class UserController extends AppController
{
    public $helpers =array('Html', 'Form');
    /*
     * 文章列表
     * 获取文章全部信息
     * 渲染页面
     */
    public function index(){
        $params = $this->User->find('all');
        $this->set('params',$params);
    }
    /*
     * 新增、修改文章
     *
     */
    public function dell(){
        $params = $_POST;
        //当id有值时才是修改操作
        $params = $this->User->save($params);
    }

}