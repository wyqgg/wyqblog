<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/9
 * Time: 21:41
 */

App::uses('CakeSession', 'Model/Datasource');

class RoleController extends AppController
{
    public $uses = array('Admin');
    /*
     * 展示全部角色的信息
     */
    public function index()
    {
        //获取全部信息
        $res = $this->Role->getAll();

        foreach ($res[0]['auth'] as $v){
            $res1[] = $v;
        }
        $this->set(array('params'=>$res,'auth'=>$res1));
    }

    /*
     * 通过角色寻找权限
     */

    public function roleFindRole(){
        //获取当前用户信息
        $role_id =$_POST['role_id'];
        $auth = $this->Role->find_auth($role_id);
        $auth = explode(',',$auth);
        exit(json_encode($auth));
    }

    /*
     * 新增、修改角色信息
     */
    public function dellRole(){
        $post = $_POST;
        //修改操作
        if ($post['id']){
            if (in_array('',$post)){
                $res = array('code'=>400,'msg'=>'update error');
                exit(json_encode($res));
            }else{
                $data = $this->Role->dellRole($post);
                if ($data){
                    $res = array('code'=>200,'msg'=>'update success');
                    exit(json_encode($res));
                }else{
                    $res = array('code'=>400,'msg'=>'update error');
                    exit(json_encode($res));
                }
            }
        }else{
           //新增操作
                if ($post['role_name'] == ''){
                    $res = array('code'=>400,'msg'=>'insert error');
                    exit(json_encode($res));
                }else{
                    $data = $this->Role->dellRole($post);
                    if ($data){
                        $res = array('code'=>200,'msg'=>'insert success');
                        exit(json_encode($res));
                    }else{
                        $res = array('code'=>400,'msg'=>'insert error');
                        exit(json_encode($res));
                    }
                }
        }
    }

    /*
     * 删除用户信息
     */
    public function delRole(){
        $id = $_POST['role_id'];
        $data = $this->Role->delRole($id);
        if ($data){
            $res = array('code'=>200,'msg'=>'success');
        }else{
            $res = array('code'=>400,'msg'=>'error');
        }
        exit(json_encode($res));
    }
}

