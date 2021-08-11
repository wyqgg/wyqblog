<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/8
 * Time: 22:13
 */
require_once('../webroot/clicaptcha/clicaptcha.class.php');
App::uses('CakeSession', 'Model/Datasource');

class LoginController extends AppController
{
    public $components = array('Session','email','publicFunction');
    public $uses = array('Admin');
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
        $login = ClassRegistry::init('Login');
        $data = $login->find_admin($post['username']);

//        $clicaptcha = new clicaptcha();
//        $s = $clicaptcha->check($_POST['clicaptcha-submit-info']);
//        if ($s == 0){
//            $res = array('code' => 400, 'msg' => 'captcha error!');
//            exit(json_encode($res));
//        }

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
        $this->Login->set($post);
        if ($this->Login->validates()) {
            $data = $this->Login->save($post);
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

    /*
     * 密码加密
     */
    public function encrypt($data)
    {
        $salt = "123123asdasdasd";
        $psw = md5($salt . md5($data));
        return $psw;
    }

    /*
     * 退出登录
     */
    public function logout(){
        $res = CakeSession::delete('admin_info');
        if ($res){
            exit(json_encode($res));
        }
    }

    /*
     * 展示忘记密码页面
     */
    public function forget(){
        $this->layout = false;
    }

    /*
     * 点击忘记密码生成验证码
     */
    public function findPsw(){
        $email = $_POST['email'];
        $username = $_POST['username'];
        $login = ClassRegistry::init('Login');
        $data = $login->find_admin($username);
        if ($data && $data['Login']['email'] == $email){
            $code = rand(1000,9999);
            //存储cookie保存过期时间为60秒之后。
            $name = 'emailCode'.$username;
            setcookie($name,$code,time()+60);
            $content ="<h1>您的验证码为：".$code."</h1>";
            $res = $this->email->sendmail($email,$content);
            if ($res == 1){
                exit(json_encode(200));
            }else{
                exit(json_encode(400));
            }
        }
        exit(json_encode(401));
    }

    /*
     * 验证验证码与邮箱
     */
    public function submitPsw(){
        $post = $_POST;
        $name = 'emailCode'.$post['username'];
        $code = $_COOKIE[$name];
        $login = ClassRegistry::init('Login');
        $data = $login->find_admin($post['username']);
        if ($data['Login']['email'] == $post['email'] && $data['Login']['username'] == $post['username'] && $code = $post['code']){
            $password = substr($post['email'],'0','6');
            $password = $this->publicFunction->encrypt($password);
            $data['Login']['password'] = $password;
            $admin = ClassRegistry::init('Admin');
            $data = $admin->dellAdmin($data['Login']);
            exit(json_encode(200));
        }else{
            exit(json_encode(400));
        }
    }


}