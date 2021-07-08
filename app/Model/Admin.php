<?php
/**
 * Created by PhpStorm.
 * User: 快定
 * Date: 2021/7/8
 * Time: 10:09
 */

class Admin extends AppModel
{
    public $validate  = array(
        'username' => array(
            'rule'  => 'alphaNumeric',
            'required' => true,
            'allowEmpty' => false,
            'message' => 'username error！'
        ),
        'phone' => array(
            'rule' => array('phone',"/^(13[0-9]|14[01456879]|15[0-35-9]|16[2567]|17[0-8]|18[0-9]|19[0-35-9])\d{8}$/"),
            'message' => 'phone error!'
        ),
        'email' => array(
            'rule' => 'email',
            'message' => 'email error!'
        )
    );
}