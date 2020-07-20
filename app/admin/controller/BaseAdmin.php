<?php
declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/28 9:23
 * @User: admin
 * @Current File : baseAdmin.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\controller;


use app\BaseController;
use think\App;
use think\facade\View;

/**
 * Class baseAdmin
 * @package app\admin\controller
 */
class BaseAdmin extends BaseController
{
    protected $service;
    /**
     * baseAdmin constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     *
     */
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * @return string
     */
    public function index(){
        return  View::fetch();
    }
}