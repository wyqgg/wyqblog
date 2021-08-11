<?php
/**
 * Created by PhpStorm.
 * User: wyq
 * Date: 2021/8/3
 * Time: 10:41
 */

class ApiController extends AppController
{
    public $uses = array('Article');
    public $components = array('publicFunction');


    public function __construct(CakeRequest $request = null, CakeResponse $response = null)
    {
        parent::__construct($request, $response);
        //允许的源域名
        header("Access-Control-Allow-Origin: *");
        //允许的请求头信息
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        //允许的请求类型
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS, PATCH');
    }

    /*
     * 展示信息 get请求
     */
    public function index()
    {
        $data = $this->Article->findAll();
        foreach ($data as $k => $v) {
            $res[$k]['id'] = $v['Article']['id'];
            $res[$k]['title'] = $v['Article']['title'];
        }
        $this->publicFunction->success($res);
    }

    /*
     * 展示一条信息 get请求
     */
    public function view($id)
    {
        $data = $this->Article->findOne($id);
        $res = $data['Article'];
        $this->publicFunction->success($res);
    }

    /*
     * 新增一条信息 Post请求
     */
    public function add()
    {
        $post = file_get_contents('php://input');
        $data = json_decode($post, true);
        $res = $this->Article->dell($data);
        $this->publicFunction->success($res['Article']);
    }

    /*
     * 修改页面展示 Put请求
     */
    public function edit($id)
    {
        $post = file_get_contents('php://input');
        $data = json_decode($post, true);
        if ($data) {
            $data['id'] = $id;
            $data = $this->Article->dell($data);
            $res = $data['Article'];
            $this->publicFunction->success($res);
        } else {
            $data = $this->Article->findOne($id);
            $res = $data['Article'];
            $this->publicFunction->success($res);
        }
    }

    /*
     * 删除页面处理 delete请求
     */
    public function delete($id)
    {
        $data = $this->Article->del($id);
        if ($data) {
            $this->publicFunction->success();
        } else {
            $this->publicFunction->error();
        }
    }
}