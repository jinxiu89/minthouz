<?php
declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/28 9:57
 * @User: admin
 * @Current File : Login.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\controller\user;


use app\BaseController;
use think\facade\View;

/**
 * Class Login
 * @package app\admin\controller\user
 */
class Login extends BaseController
{
    /**
     * @return string
     */
    public function login(){
        try {
            return View::fetch();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}