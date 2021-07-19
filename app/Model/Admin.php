<?php
/**
 * Created by PhpStorm.
 * User: wyq
 * Date: 2021/7/8
 * Time: 10:09
 */

class Admin extends AppModel
{
    /*
     * 通过角色id获取管理员用户名的信息
     */
    public function findAdminName($id){
        $this->setSource('admins');
        $res =$this->find('all',array(
            'conditions' => array('role_id' => $id),
            'fields' => 'Admin.username',
        ));
        //简化数组
        $res1 = array();
        foreach ($res as $v){
           $res1[] = $v['Admin']['username'];
        }
        //是数组且数组长度大于二时将数组分解成字符串
        if (is_array($res1) && sizeof($res1)>=2){
            $res2 = implode(',',$res1);
        }else{
            $res2 = $res1[0];
        }
        //返回管理员用户名的信息
        return $res2;
    }

    /*
     * 获取全部管理员信息
     */
    public function getAdmin(){
        $this->setSource('admins');
        $data =$this->find('all',array(
            'fields' => array('id','username','role_id','email','as.role_name','as.id'),
            'joins' => array(
                array(
                    'table' => 'role',
                    'alias'=> 'as',
                    'type' => 'left',
                    'conditions'=> array('Admin.role_id = as.id')
                )
            )
        ));
        return $data;
    }

    /*
     * 新增、修改管理员
     */
    public function dellAdmin($post){
        $this->setSource('admins');
        $data = $this->save($post);
        return $data;
    }

    /*
     * 删除管理员操作
     */
    public function delAdmin($id){
        $this->setSource('admins');
        $data = $this->delete($id);
        return $data;
    }
}