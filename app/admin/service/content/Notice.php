<?php
declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/10 17:43
 * @User: admin
 * @Current File : Notice.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\service\content;


use app\admin\service\BaseService;
use app\common\model\mysql\content\Notice as model;
use think\facade\Env;

class Notice extends BaseService
{
    public function __construct()
    {
        $this->model=new model();
    }

    /**
     * @param int $language
     * @return mixed
     */
    public function getDataByLanguage(int $language){
        try{
            $obj=$this->model::getDtaByLanguage((int) $language);
            return $obj->toArray();
        }catch (\Exception $exception){
            if (!Env::get('app_debug')) abort(500, $exception->getMessage());
            abort(500, '服务器内部错误');
        }
    }
}