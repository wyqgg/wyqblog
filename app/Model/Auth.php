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
     * 获取权限总数
     */
    public function count(){
        $this->setSource('auth');
        $count = $this->find('count');
        return $count;
    }

    /*
    * 获取权限列表
    */
    public function getAuth($page="",$limit="",$conditions = ""){
        $this->setSource('auth');
        $data = $this->find('all',array(
            'conditions' => $conditions,
            'order'=> 'id desc',
            'page' => $page,
            'limit' => $limit,
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
