<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/21
 * Time: 10:18
 */

class Article extends AppModel
{

    /*
     * 显示全部文章数量
     */
    public function count()
    {
        $this->setSource('article');
        $count = $this->find('count');
        return $count;
    }

    /*
     * 查询全部文章的信息
     */
    public function findAll($page = '', $limit = '')
    {
        $this->setSource('article');
        $data = $this->find('all', array(
            'fields' => array('id', 'user_id', 'title', 'content', 'create_time', 'update_time', 'u.id', 'u.username'),
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'u',
                    'type' => 'left',
                    'conditions' => array('user_id = u.id')
                )
            ),
            'limit' => $limit,
            'page' => $page,
        ));
        return $data;
    }

    /*
     * 查询一篇文章的信息
     */
    public function findOne($id)
    {
        $this->setSource('article');
        $data = $this->find('first', array(
            'conditions' => array('id' => $id)
        ));
        return $data;
    }


    /*
     * 文章处理
     */
    public function dell($data)
    {
        $this->setSource('article');
        $res = $this->save($data);
        return $res;
    }

    /*
     * 文章删除
     */
    public function del($id)
    {
        $this->setSource('article');
        $data = $this->delete($id);
        return $data;
    }
}