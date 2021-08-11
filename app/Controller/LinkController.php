<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/8/10
 * Time: 16:53
 */

class LinkController extends AppController
{
    public $components = array('publicFunction');
    public $uses = array('Link');
    public $helpers = array('Form', 'Html');

    /*
     * 友情链接页面展示
     */
    public function index()
    {
        $count = $this->Link->count();
        $page = $_GET['page'] ? $_GET['page'] : 1;
        $limit = 10;
        $pageCount = ceil($count / $limit);
        $data = $this->Link->All($page, $limit);
        if ($data) {
            $this->set(array('params' => $data, 'page' => $page, 'pageCount' => $pageCount));
        }
    }

    /*
     * 友情链接新增
     */
    public function add()
    {
        $post = $_POST;
        if ($post['id']) {
            $post['update_time'] = time();
        } else {
            $post['create_time'] = time();
            $post['update_time'] = time();
        }
        $data = $this->Link->dell($post);
        $this->publicFunction->success($data);
    }

    /*
     * 友情链接删除
     */
    public function del()
    {
        $id = $_POST['id'];
        $res = $this->Link->del($id);
        if ($res) {
            $this->publicFunction->success($id);
        }
    }
}