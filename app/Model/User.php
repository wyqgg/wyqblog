<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/7
 * Time: 16:30
 */

class User extends AppModel
{
        /*
         * 查询user表总数
         */
        public function count(){
            $this->setSource('users');
            $count = $this->find('count');
            return $count;
        }

        /*
         * 分页查询
         */
        public function findUser($page,$limit){
            $this->setSource('users');
            $data = $this->find('all',array(
                'limit' => $limit,
                'page' => $page,
            ));
            return $data;
        }
}