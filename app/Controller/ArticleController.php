<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/21
 * Time: 10:17
 */

class ArticleController extends AppController
{
    public $components = array('publicFunction');

    /*
     * 显示文章列表
     */
    public function index()
    {
        $page = $_GET['page'] ? $_GET['page'] : 1;
        $limit = 10;
        $count = $this->Article->count();
        $pageCount = ceil($count / $limit);
        $data = $this->Article->findAll($page, $limit);
        if ($data) {
            $this->set(array('params' => $data, 'page' => $page, 'pageCount' => $pageCount));
        }
    }

    /*
     * 显示文章修改页面
     */
    public function showDell()
    {
        $id = $_GET['id'];
        $data = $this->Article->findOne($id);
        $this->set('params', $data);
    }

    /*
     * 处理文章信息
     */
    public function dell()
    {
        $post = $_POST;
        $post['content'] = $post['markdown-doc'];
        $post['update_time'] = time();
        $data = $this->Article->dell($post);
        if ($data) {
            $this->redirect('/article/index');
        }
    }

    /*
     * 删除文章信息
     */
    public function del()
    {
        $id = $_POST['id'];
        $data = $this->Article->del($id);
        if ($data) {
            $this->publicFunction->success();
        }
        $this->publicFunction->fail();
    }
}