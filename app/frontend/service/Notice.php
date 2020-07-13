<?php
declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/13 14:21
 * @User: admin
 * @Current File : Notice.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\frontend\service;

use app\common\model\mysql\content\Notice as model;
use think\Exception;

/**
 * Class Notice
 * @package app\frontend\service
 */
class Notice extends BaseService
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new model();
    }

    /**
     * @param int $language
     * @param int $status
     * @return array|\think\Model|null
     */
    public function getNoticeByLanguage(int $language, int $status)
    {
        try {
            return $this->model::getNoticeByLanguage((int)$language, (int)$status)->toArray();
        } catch (Exception $exception) {

        }
    }
}