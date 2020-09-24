<?php

declare(strict_types=1);

namespace app\frontend\controller\product;

use app\frontend\controller\Base;
use think\App;
use think\facade\View;
use app\frontend\service\Category;

/**
 * @Create by vscode,
 * @author:jinxiu89@163.com
 * @Create Date:2020年07月24日 15:59:49 Friday
 * @User: admin
 * @Current File : index.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/
class Index extends Base
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }
    public function index()
    {
        $data = (new Category())->getProductByCategory((int) $status = 1, (int) $this->language);
        print_r($data);
        return View::fetch($this->template . '/product/index.html');
    }
    public function detail($url)
    {
        return View::fetch($this->template . '/product/detail.html');
    }
}