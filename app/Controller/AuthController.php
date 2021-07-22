<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/9
 * Time: 22:04
 */

class AuthController extends AppController
{
    /*
    * 显示权限列表
    */
    public function index(){
        //获取数据
        $page = $_GET['page'] ? $_GET['page'] : 1;
        $limit = 10;
        $count = $this->Auth->count();
        $pageCount = ceil($count/$limit);
        $params = $this->Auth->getAuth($page,$limit);
        $rootMenu = $this->Auth->getAuth('','',array('pid'=>0));
        $this->set(array('params'=>$params,'page'=>$page,'pageCount'=>$pageCount,'rootMenu'=>$rootMenu));
    }

    /*
     * 新增权限
     */
    public function addAuth(){
        //接受参数
        $post = $_POST;
        //参数验证
        if (!in_array('',$post)){
            $data = $this->Auth->dellAuth($post);
            $return = 200;
        }else{
            $return = 400;
        }
        //返回数据
        exit(json_encode($return));
    }

    /*
     * 修改权限
     */
    public function editAuth(){
        //接受参数
        $post = $_POST;
        //参数验证
        if (!in_array('',$post)){
            //数据操作
            $this->Auth->dellAuth($post);
            exit(json_encode(200));
        }else{
            exit(json_encode(400));
        }

        //参数返回
    }

    /*
     * 删除权限
     */
    public function delAuth(){
        $id = $_POST['id'];
        if (empty($id)){
            exit(json_encode(400));
        }
        $res = $this->Auth->del($id);
        if ($res){
            exit(json_encode(200));
        }else{
            exit(json_encode(400));
        }
    }
}