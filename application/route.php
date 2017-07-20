<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'group' => '\w+',
    ],

    ':group'  =>  'index', ##用户注册
    'get_new_message' => 'index/get_new_message',
    /*'[user]'     => [
        ':'   => ['index/index/detail',['method' => 'get']]
    ],
*/
];
