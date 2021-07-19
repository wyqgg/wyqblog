<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/9
 * Time: 22:02
 */

class Auth extends AppModel
{
    /*
    * 获取权限列表
    */
    public function getAuth(){
        $this->setSource('auth');
        $data = $this->find('all',array(
            'order'=> 'id desc'
        ));
        return $data;
    }

    /*
     * 新增权限
     */
    public function dellAuth($data){
       $this->setSource('auth');
       $this->save($data);
        return $data;
    }


    /*
     * 删除权限
     */
    public function del($id){
        $this->setSource('auth');
        $res = $this->delete($id);
        return $res;
    }
}
