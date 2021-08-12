<?php
/**
 * Created by PhpStorm.
 * User: wyq
 * Date: 2021/7/8
 * Time: 10:12
 */
App::uses('CakeSession', 'Model/Datasource');

class AdminController extends AppController
{
    public $components = array('Session', 'email', 'publicFunction');

    //管理员列表
    public function index()
    {
        $role = ClassRegistry::init('Role');
        $data = $this->Admin->getAdmin();

        $role = $role->getAll();
        foreach ($role as $v) {
            $res[] = $v['Role'];
        }
        $this->set(array('params' => $data, 'role' => $res));
    }

    /*
     * 管理员新增、修改操作
     */
    public function dellAdmin()
    {
        $post = $_POST;
        if ($post['id']) {
            if (in_array('', $post)) {
                $res = array('code' => 400, 'msg' => 'update error');
                exit(json_encode($res));
            } else {
                $data = $this->Admin->dellAdmin($post);
                if ($data) {
                    $res = array('code' => 200, 'msg' => 'update success');
                    exit(json_encode($res));
                } else {
                    $res = array('code' => 400, 'msg' => 'update error');
                    exit(json_encode($res));
                }
            }
        } else {
            //新增操作
            if ($post['username'] == '' || $post['role_id'] == '' || $post['email'] == '') {
                $res = array('code' => 400, 'msg' => 'insert error');
                exit(json_encode($res));
            } else {
                $data = $this->Admin->dellAdmin($post);
                if ($data) {
                    $res = array('code' => 200, 'msg' => 'insert success');
                    exit(json_encode($res));
                } else {
                    $res = array('code' => 400, 'msg' => 'insert error');
                    exit(json_encode($res));
                }
            }
        }
    }

    /*
     * 管理员删除操作
     */
    public function delAdmin()
    {
        $id = $_POST['id'];
        $data = $this->Admin->delAdmin($id);
        if ($data) {
            $res = array('code' => 200, 'msg' => 'success');
        } else {
            $res = array('code' => 400, 'msg' => 'error');
        }
        exit(json_encode($res));
    }


    /*
     * 管理员信息展示
     */
    public function showInfo()
    {
        $admin_info = CakeSession::read('admin_info');
        $this->set('admin_info', $admin_info);
    }

    /*
     * 管理员基本信息修改
     */
    public function alertAdmin()
    {
        $post = $_POST;
        $post['img'] = $_FILES['img'];
        $file_name = $post['img']['name'];
        $name = explode('.', $file_name);
        $name[0] = rand(0, 1000) . time();
        $name = implode('.', $name);
        $name = "img/" . $name;
        $res = move_uploaded_file($post['img']['tmp_name'], $name);
        if ($post['img']) {
            $post['image'] = $name;
        }
        if ($post) {
            $data = $this->Admin->dellAdmin($post);
            if ($data) {
                $login = ClassRegistry::init('Login');
                $res1 = $login->find_admin($post['username']);
                CakeSession::delete('admin_info');
                CakeSession::write('admin_info', $res1['Login']);
                exit(json_encode(200));
            } else {
                exit(json_encode(400));
            }
        } else {
            exit(json_encode(400));
        }
    }

    /*
     * 管理员修改密码页面展示
     */
    public function alertPassword()
    {
        $admin_info = CakeSession::read('admin_info');
        $this->set('admin_info', $admin_info);
    }

    /*
     * 管理员修改密码
     */
    public function dellPassword()
    {
        $params = $_POST;
        //参数验证
        if (in_array('', $params)) {
            $this->publicFunction->fail(501);
        }
        if ($params['password1'] != $params['password2']) {
            $this->publicFunction->fail(502);
        }
        $password = $this->Admin->findPassword($params['id']);
        $params['password'] = $this->publicFunction->encrypt($params['password']);
        if ($password != $params['password']) {
            $this->publicFunction->fail(503);
        }
        $password1 = $this->publicFunction->encrypt($params['password1']);

        $data = array('id' => $params['id'], 'password' => $password1);
        $res = $this->Admin->dellAdmin($data);
        if (!$res) {
            $this->publicFunction->fail(504);
        }
        $this->publicFunction->success();
    }
}