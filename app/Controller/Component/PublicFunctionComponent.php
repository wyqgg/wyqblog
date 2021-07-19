<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/15
 * Time: 13:50
 */

App::uses('Component', 'Controller');
class PublicFunctionComponent extends Component
{

    /*
     * 密码加密函数
     */
    function encrypt($data)
    {
        $salt = "123123asdasdasd";
        $psw = md5($salt . md5($data));
        return $psw;
    }
}