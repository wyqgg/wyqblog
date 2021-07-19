<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/8
 * Time: 21:23
 */


class Role extends AppModel
{
    public $uses = array ('Admin','Auth');

    /*
     * 通过用户的角色获取用户的权限组
     */
    public function find_auth($id){
        $this->setSource('role');
        $auths =  $this->find('first',array(
            'conditions' => array('id' => $id),
            'fields'     => 'auth_ids'
        ));
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

    /*
     * 获取全部菜单
     */
    public function get_all_menu(){
        $this->setSource('auth');
        $data = $this->find('all',array(
            'conditions'=>array('is_menu'=>1)
        ));
        foreach ($data as $v){
            $res[] = $v['Role'];
        }
        return $res;
    }

    /*
     * 通过用户的权限组获取用户所有权限
     */
    public function get_auth($auth,$type = 1){
        //执行原生sql
        $sql = "SELECT `id`, `auth_name`, `is_menu`, `pid`, `path` FROM `auth` WHERE `id` in (".$auth.")";
        $data = $this->query($sql);
        foreach ($data as $v){
            if ($v['auth']['path']!=""){
                $res[] = $v['auth']['path'];
            }
        }
        if ($type == 1){
            return $res;
        }else{
            return $data;
        }

    }

    /*
     * 获取所有角色
     */
    public function getAll(){
        $this->setSource('role');
        $res = $this->find('all');
        //获取角色的管理员信息
        foreach ($res as &$v){
            $role = ClassRegistry::init('Admin');
            $v['Role']['name'] = $role->findAdminName($v['Role']['id']);
            $auth= ClassRegistry::init('Auth');
            $data[]= $auth->getAuth();
            foreach ($data[0] as $v1){
                $result[] = $v1['Auth'];
            }
            $v['auth'] = $result;
        }
        //使用该角色的全部用户
        return $res;
    }

    /*
     * 新增、修改角色信息
     */
    public function dellRole($data){
        $this->setSource('role');
        $res = $this->save($data);
        return $res;
    }

    /*
     * 删除角色信息
     */
    public function delRole($id){
        $this->setSource('role');
        $data = $this->delete($id);
        return $data;
    }
}