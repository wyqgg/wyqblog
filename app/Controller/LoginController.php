<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/8
 * Time: 22:13
 */

App::uses('CakeSession', 'Model/Datasource');

class LoginController extends AppController
{
    public $helpers =array('Html', 'Form');
    /*
     * 渲染用户登录界面
     */
    public function login()
    {
        $this->layout = false;
    }

    /*
     *用户登录逻辑
     */
    public function doLogin()
    {
        //接受参数
        $post = $_POST;
        $data = $this->Login->find_admin($post['username']);
        if ($data) {
            if ($this->encrypt($post['password']) == $data['Login']['password']) {
                //将登录用户信息存在session中
                CakeSession::write('admin_info', $data['Login']);
                $res = array('code' => 200, 'msg' => 'login success!');
                exit(json_encode($res));
            } else {
                $res = array('code' => 400, 'msg' => 'password error!');
                exit(json_encode($res));
            }
        } else {
            $res = array('code' => 400, 'msg' => 'no user!');
            exit(json_encode($res));
        }
    }

    /*
     *  渲染注册页面
     */
    public function regist()
    {
        $this->layout = false;
    }

    /*
     * 用户注册逻辑
     */
    public function doRegist()
    {
        $post = $_POST;
        //查找手机号码是否存在
        $countPhone = $this->Admin->find('count', array('conditions' => array('Admin.phone' => $post['phone'])));
        if ($countPhone) {
            $msg = array('code' => 404, 'data' => '手机号码已注册！');
            exit(json_encode($msg));
        }
        $countEmail = $this->Admin->find('count', array('conditions' => array('Admin.email' => $post['email'])));
        if ($countEmail) {
            $msg = array('code' => 404, 'data' => '邮箱已注册！');
            exit(json_encode($msg));
        }
        $post['password'] = $this->encrypt($post['password']);
        $this->Admin->set($post);
        if ($this->Admin->validates()) {
            $data = $this->Admin->save($post);
            if ($data) {
                $msg = array('code' => 200, 'data' => $data);
            } else {
                $msg = array('code' => 404, 'data' => '注册失败');
            }
        } else {
            $errors = $this->Admin->validationErrors;
            $msg = array('code' => 404, 'data' => '注册失败，参数验证失败');
        }
        exit(json_encode($msg));
    }

    public function encrypt($data)
    {
        $salt = "123123asdasdasd";
        $psw = md5($salt . md5($data));
        return $psw;
    }
}