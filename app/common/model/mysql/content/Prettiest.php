<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/7 15:28
 * @User: admin
 * @Current File : Prettiest.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\common\model\mysql\content;


use app\common\model\mysql\BaseModel;
use think\db\exception\DbException;
use think\Paginator;

/**
 * Class Prettiest
 * @package app\common\model\mysql\content
 */
class Prettiest extends BaseModel
{
    protected $table = 'tb_prettiest';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * @param int $type
     * @param int $language
     * @return Paginator
     * @throws DbException
     */
    public static function getDataByType(int $type, int $language)
    {
        return self::where(['type' => $type, 'language_id' => $language])->order(['id' => 'desc', 'listorder' => 'desc'])->paginate(5);

    }

    /**
     * @param int $language
     * @param int $type
     */
    public static function getPretties(int $language,int $type){
        return self::where(['type']);
    }
}