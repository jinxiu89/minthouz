<?php
declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/28 16:30
 * @User: admin
 * @Current File : User.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\common\model\mysql\user;


use app\common\model\mysql\BaseModel;

/**
 * Class User
 * @package app\common\model\user
 *
 */
class User extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'tb_manager';

}