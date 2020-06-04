<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/3 10:22
 * @User: admin
 * @Current File : ProductCategory.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\validate\category;


use think\Validate;

/**
 * Class ProductCategory
 * @package app\admin\validate\category
 */
class ProductCategory extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'name' => 'require|max:20',
        'title' => 'require|max:255',
        'keywords' => 'require|max:120',
        'description' => 'require|max:255',
    ];
    protected $message = [
        'id.require' => 'ID为必填项',
        'id.number' => 'ID不合法',
        'name.require' => '分类名称不能为空',
        'name.max' => '分类名称不能超过有效范围（20个字符）',
        'title.require' => '网站标题不能为空',
        'title.max' => '网站标题不能超过设置的范围（120个字符）',
        'keywords.require' => '关键词不能为空',
        'keywords.max' => '关键词不能超过控制范围（120个字符）',
        'description.require' => '描述不能为空',
        'description.max' => '描述不能超过控制范围（120个字符）',
    ];
    protected $scene = [
        'add' => ['name', 'title', 'keywords', 'description'],
        'edit' => ['id', 'name', 'title', 'keywords', 'description']
    ];
}