<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/8
 * Time: 21:23
 */

class Role extends AppModel
{
    /*
     * 通过用户的角色获取用户的权限
     */
    public function find_auth($id){
        $this->setSource('role');
        $auths =  $this->find('first',array(
            'conditions' => array('id' => $id),
            'fields'     => 'auth_ids'
        ));
//        $auths_str = $auths['Role']['auth_ids'];
//        $res = explode(',',$auths_str);
        return  $auths['Role']['auth_ids'];
    }
    /*
     * 通过用户的权限获取用户展示菜单
     */
    public function get_menu($auth){
        //执行原生sql
        $sql = "SELECT `id`, `auth_name`, `is_menu`, `pid`, `path` FROM `auth` WHERE `id` in (".$auth.") and is_menu =1";
        $data = $this->query($sql);
         foreach ($data as $v){
             $res[] = $v['auth'];
         }

        return $res;
    }
}