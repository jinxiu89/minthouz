<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/2 9:44
 * @User: admin
 * @Current File : Setting.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\common\model\mysql\system;


use app\common\model\mysql\BaseModel;

/**
 * Class Setting
 * @package app\common\model\mysql\system
 */
class Setting extends BaseModel
{
    protected $table='tb_setting';

    /**
     * @param int $language
     * @return array|\think\Model
     */
    public static function getDtaByLanguage(int $language){
        return self::where(['language_id'=>$language])->findOrEmpty();
    }
}