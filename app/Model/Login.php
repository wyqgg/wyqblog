<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/9
 * Time: 10:49
 */

class Login extends AppModel
{
//    public $validate  = array(
//        'username' => array(
//            'rule'  => 'alphaNumeric',
//            'required' => true,
//            'allowEmpty' => false,
//            'message' => 'username error！'
//        ),
//        'phone' => array(
//            'rule' => array('phone',"/^(13[0-9]|14[01456879]|15[0-35-9]|16[2567]|17[0-8]|18[0-9]|19[0-35-9])\d{8}$/"),
//            'message' => 'phone error!'
//        ),
//        'email' => array(
//            'rule' => 'email',
//            'message' => 'email error!'
//        )
//    );
    public function find_admin($username)
    {
        $this->setSource('admins');
        $res = $this->find("first", array(
            'conditions' => array('username' => $username),
        ));
        return $res;
    }
}