<?php

declare(strict_types=1);
/**
 * @Create by vscode,
 * @author:jinxiu89@163.com
 * @Create Date:2020年07月21日 11:59:56 Tuesday
 * @User: admin
 * @Current File : About.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\validate\system;

use think\Validate;

class About extends Validate
{
    protected $rule = [
        'id' => 'require|number',
        'title' => 'require|max:64',
        'keywords' => 'require|max:120',
        'description' => 'require|max:255',
        'desktop' => 'require|min:120',
        'mobile' => 'require|min:120',
        'status' => 'intger',
    ];
    protected $message = [
        'id.require' => 'ID为必填项',
        'id.number' => 'ID不合法',
        'title.require' => '语言名称不能为空',
        'title.max' => '语言名称不能超过设置的范围（25个字符）',
        'description.require' => '描述不能为空',
        'description.max' => '描述不能超过有效范围（1-255个字符）',
        'desktop.require' => 'pc版正文不能为空',
        'desktop.min' => 'pc版正文不在有效范围内（120个字符以上）',
        'mobile.require' => 'mobile版正文不在有效范围内（120个字符以上）',
        'mobile.min' => 'mobile版正文不在有效范围内（120个字符以上）',
        'status' => '状态值不合法',
    ];
    protected $scene = [
        'add' => ['title', 'keywords', 'description', 'desktop', 'mobile'],
        'edit' => ['id', 'title', 'keywords', 'description', 'desktop', 'mobile'],
    ];
}