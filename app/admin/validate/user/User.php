<?php
declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/28 16:01
 * @User: admin
 * @Current File : User.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\validate\user;


use think\Validate;

class User extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'username' => 'require|max:25',
        'rnd' => 'require|max:8',
        'email' => 'require|email'
    ];
    protected $message = [
        'id.require' => 'ID不能为空',
        'id.number' => 'ID不合法',
        'username.require' => '用户名不能为空',
        'username.max' => '用户名不能超过25个字符',
        'rnd.require' => '安全码不能为空',
        'rnd.max' => '安全码不能超过8个字符',
        'email.require' => '邮箱不能为空',
        'email.email' => '邮箱格式不合法',
    ];
    protected $scene = [
        'login' => ['username', 'password']
    ];
}