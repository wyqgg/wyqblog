<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/9
 * Time: 10:49
 */

class Login extends AppModel
{
    public function find_admin($username){
        $this->setSource('admins');
        $res = $this->find("first",array(
            'conditions' => array('username'=>$username),
        ));
        return $res;
    }
}