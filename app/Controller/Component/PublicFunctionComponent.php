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

    /*
     * 通用响应
     * @params int code 响应码
     * @params string $msg 响应描述
     * @params string $data 响应数据
     */
    function response($code = 200, $msg = "success", $data = array())
    {
        $res = array('code' => $code, 'msg' => $msg, 'data' => $data);
        echo json_encode($res);
        die;
    }

    /*
     * 成功响应
     * @params string $msg 响应描述
     * @params string $data 响应数据
     */
    function success($data = array(), $msg = "success", $code = 200)
    {
        $this->response($code, $msg, $data);
    }

    /*
     * 失败响应
     * @params string $msg 响应描述
     * @params string $data 响应数据
     */
    function fail($code = 500, $msg = "fail")
    {
        $this->response($code, $msg);
    }
}