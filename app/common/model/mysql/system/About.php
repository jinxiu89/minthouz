<?php

declare(strict_types=1);

namespace app\common\model\mysql\system;

use app\common\model\mysql\BaseModel;

/**
 * @Create by vscode,
 * @author:jinxiu89@163.com
 * @Create Date:2020年07月20日 17:22:21 Monday
 * @User: admin
 * @Current File : About.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/
class About extends BaseModel
{
    protected $table = 'tb_about';
    /**
     * 根据语言获取列表
     *
     * @Author: kevin qiu
     * @DateTime: 2020-07-21
     * @param integer $language
     * @return void
     */
    public static function getObj(int $language)
    {
        return self::where(['language_id' => $language])->order(['id' => 'desc'])->field('id,title,keywords,description,status,update_time')->paginate();
    }
    public static function getDataByUrl(string $url, int $language)
    {
        return self::where(['url' => $url, 'language_id' => $language])->find();
    }
}