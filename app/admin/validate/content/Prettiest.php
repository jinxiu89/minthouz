<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/7 15:04
 * @User: admin
 * @Current File : Prettiest.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\validate\content;


use think\Validate;

/**
 * Class Prettiest
 * @package app\admin\validate\content
 * 过滤
 *
 */
class Prettiest extends Validate
{
    protected $rule=[
        'id' => 'require|number',
        'language_id' => 'require|number',
        'listorder' => 'require|number',
        'type' => 'require|number',
        'image' => 'require|max:255',
        'title' => 'max:255',
        'description' => 'max:255',
        'button'=>'max:20',
        'path'=>'max:255'
    ];
    protected $message=[
        'id.require'=>'ID为必填项',
        'id.number'=>'ID不合法',
        'language_id.require'=>'分类ID为必填项',
        'language_id.number'=>'分类ID不合法',
        'listorder.require'=>'排序为必填项',
        'listorder.number'=>'排序不合法',
        'type.require'=>'类型为必选项',
        'type.max'=>'类型长度超过控制范围',
        'title.max'=>'产品标题长度超过有效范围',
        'description.max'=>'描述长度超过有效范围（255个字符以下）',
        'button'=>'按钮文案长度不能超过有效范围（20字符）',
        'path'=>'指向路径长度不能超过有效范围(255字符)'

    ];
    protected $scene=[
        'add'=>['language_id','type','listorder','image'],
        'edit'=>['id','language_id','type','listorder','image']
    ];
}