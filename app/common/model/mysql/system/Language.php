<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/1 14:06
 * @User: admin
 * @Current File : Language.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\common\model\mysql\system;


use app\common\model\mysql\BaseModel;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\Model;

/**
 * Class Language
 * @package app\common\model\mysql\system
 */
class Language extends BaseModel
{
    protected $table = 'tb_language';

    /**
     * @param string $code
     * @return array|Model|null
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    public static function getDataByCode(string $code){
        return self::where(['code'=>$code,'status'=>1])->field('id,name,code,status')->find()->toArray();
    }

}