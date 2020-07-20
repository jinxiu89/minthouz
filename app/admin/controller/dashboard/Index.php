<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/18 17:32
 * @User: kevin
 * @Current File : Index.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\controller\dashboard;
use app\admin\controller\BaseAdmin;
use think\App;
use think\facade\View;

class Index extends BaseAdmin
{
    /**
     * Index constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * @return string
     */
    public function index()
    {
        return View::fetch();
    }
}