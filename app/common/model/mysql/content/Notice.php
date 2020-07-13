<?php
declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/10 17:42
 * @User: admin
 * @Current File : Notice.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\common\model\mysql\content;


use app\common\model\mysql\BaseModel;

/**
 * Class Notice
 * @package app\common\model\mysql\content
 *
 */
class Notice extends BaseModel
{
    protected $table = 'tb_notice';

    /**
     * @param int $language
     * @param int $status
     * @return array|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getNoticeByLanguage(int $language, int $status=1){
        return self::where(['language_id'=>$language,'status'=>$status])->find();
    }
}