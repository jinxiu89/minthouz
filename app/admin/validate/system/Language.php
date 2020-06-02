<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/1 13:52
 * @User: admin
 * @Current File : Languagee.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\validate\system;


use think\Validate;

/**
 * Class Language
 * @package app\admin\validate\system
 */
class Language extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'name' => 'require|max:25',
        'code' => 'require|max:8',
    ];
    protected $message = [
        'id.require' => 'ID为必填项',
        'id.number' => 'ID不合法',
        'name.require' => '语言名称不能为空',
        'name.max' => '语言名称不能超过设置的范围（25个字符）'
    ];
    protected $scene = [
        'add' => ['name', 'code'],
        'edit' => ['id', 'name', 'code']
    ];
}