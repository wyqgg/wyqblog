<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/8/10
 * Time: 17:06
 */

class Link extends AppModel
{

    public function count()
    {
        $this->setSource('link');
        $count = $this->find('count');
        return $count;
    }

    public function All($page, $limit)
    {
        $this->setSource('link');
        $data = $this->find('all', array(
            'limit' => $limit,
            'page' => $page,
        ));
        return $data;
    }

    public function dell($data)
    {
        $this->setSource('link');
        $res = $this->save($data);
        return $res;
    }

    public function del($id)
    {
        $this->setSource('link');
        $res = $this->delete($id);
        return $res;
    }
}