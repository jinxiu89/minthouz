<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/2 15:15
 * @User: admin
 * @Current File : Product.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\validate\content;


use think\Validate;

/**
 * Class Product
 * @package app\admin\validate\content
 *
 */
class Product extends Validate
{
    protected $rule=[
        'id' => 'require|number',
        'category_id' => 'require|number',
        'listorder' => 'require|number',
        'model' => 'require|max:20',
        'title' => 'require|max:255',
        'keywords' => 'require|max:120',
        'description' => 'require|max:255',
    ];
    protected $message=[
        'id.require'=>'ID为必填项',
        'id.number'=>'ID不合法',
        'category_id.require'=>'分类ID为必填项',
        'category_id.number'=>'分类ID不合法',
        'listorder.require'=>'排序为必填项',
        'listorder.number'=>'排序不合法',
        'model.require'=>'型号（model）为必填项',
        'model.max'=>'型号（model）字符长度超过控制范围',
        'title.require'=>'产品标题为必填项',
        'title.max'=>'产品标题长度超过有效范围',
        'keywords.max'=>'产品标题长度超过有效范围',
        'keywords.require'=>'产品标题为必填项',
        'description.require'=>'描述为必填项',
        'description.max'=>'描述长度超过有效范围（255个字符以下）',

    ];
    protected $scene=[
        'product_add'=>['category_id','listorder','model','title','keywords','description'],
        'product_edit'=>['id','category_id','listorder','model','title','keywords','description']
    ];

}