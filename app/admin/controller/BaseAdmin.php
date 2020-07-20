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

use app\admin\middleware\Auth;
use app\BaseController;
use think\App;
use think\console\command\make\Middleware;
use think\facade\Session;
use think\facade\View;

/**
 * Class baseAdmin
 * @package app\admin\controller
 */
class BaseAdmin extends BaseController
{
    protected $service;
    protected $language;
    protected $middleware = [Auth::class];
    /**
     * baseAdmin constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * 后面多语言开启之后需要把这个移到header切换语言的地方去，并提供语言列表
     *  <li class="layui-nav-item to-index"><a href="/">{$adminUser.title}:{$adminUser.username}</a></li>
     *   <li class="layui-nav-item">
     *      <a href="javascript:;">切换语言</a>
     *      <dl class="layui-nav-child">
     *         <!-- 二级菜单 -->
     *        {volist name="languageList" id="vo"}
     *       <dd><a href="{:url('system/changeLanguage',['code'=>$vo.code])}">{$vo.name}</a></dd>
     *      {/volist}
     * </dl>
     *</li>
     */
    public function initialize()
    {
        parent::initialize();
        $this->language = Session::get('current_language', 1);
        View::assign('adminUser', Session::get('adminUser'));
    }

    /**
     * @return string
     */
    public function index()
    {
        return  View::fetch();
    }
}