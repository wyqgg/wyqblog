<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('CakeSession', 'Model/Datasource');
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $components = array('Session', 'email','PublicFunction');
    public $uses = array ('Admin','Role');
    public function beforeFilter()
    {
        parent::beforeFilter();
        //获取当前访问的地址 如：/login/login : 截取之后得到:$url = [0=>'',1=>'login',2=>'login']
        //这里是访问地址
        $url1 = trim($_SERVER['REQUEST_URI']);
        $url = explode('/',trim($_SERVER['REQUEST_URI']));
        //获取控制器名。这里我是将不需要权限检测的功能放在一个控制器里。
        $module = $url[1];
        //login控制器不需要进行权限检测
        $NoAuth = array('login','api');

        if (!in_array($module,$NoAuth)){
            $admin_info = CakeSession::read('admin_info');
            if (!$admin_info) {
                $this->redirect('/login/login');
            }
            //获取用户菜单
            $this->getMenu();
            //权限检测
            $auth = $this->authCheck();
            //鉴权失败,超级管理员拥有全部权限
            if (!in_array($url1,$auth) && $admin_info['role_id'] != 1){
                $res = array('code'=>400,'msg'=>'您没有权限操作！');
                exit(json_encode($res));
            }
        }
    }



    /*
   * 获取当前用户权限菜单
   */

    public function getMenu()
    {
        //从session中获取当前登录用户的角色
        $admin_info = CakeSession::read('admin_info');

        $role_id = $admin_info['role_id'];
        //获取当前用户的权限
        $auth = $this->Role->find_auth($role_id);
        //获取用户的全部菜单
        if ($role_id == 1){
            $menu = $this->Role->get_all_menu($auth);
        }else{
            $menu = $this->Role->get_menu($auth);
        }
        //这里因为菜单有顶级菜单和次级菜单，故这里可以做处理，这样可以返回父子级树状结构
        $menu1 =  $this->get_tree_list($menu);
        $this->set(array('menu'=> $menu1,'admin_info'=>$admin_info));
    }

    /*
     * 权限检测防止越权操作
     */
    public function authCheck(){
        $admin_info = CakeSession::read('admin_info');
        $role_id = $admin_info['role_id'];
        //获取当前用户的权限
        $auth = $this->Role->find_auth($role_id);
        //获取权限的信息
        $auth_info = $this->Role->get_auth($auth);
        return $auth_info;
    }

    /*
     * 获取父子级树状结构
     */
    public function get_tree_list($list){
        //将每条数据中的id值作为其下标
        $temp = array();
        foreach ($list as $v) {
            $v['son'] = array();
            $temp[$v['id']] = $v;
        }
        //获取分类树
        foreach ($temp as $k => $v) {
            //第一的数据示例$temp[0]['son'][] = $temp[1];$temp[1]['son'][] = $temp[2];$temp[1]['son'][] = $temp[3];$temp[2]['son'][] = $temp['4']
            $temp[$v['pid']]['son'][] = &$temp[$v['id']];
        }
        return isset($temp[0]['son']) ? $temp[0]['son'] : array();
    }


}
