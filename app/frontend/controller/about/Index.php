<?php

declare(strict_types=1);

namespace app\frontend\controller\about;

use app\frontend\controller\Base;
use think\App;
use think\facade\View;
use app\frontend\service\About;

/**
 * @Create by vscode,
 * @author:jinxiu89@163.com
 * @Create Date:2020年07月23日 10:59:34 Thursday
 * @User: admin
 * @Current File : Index.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/
class Index extends Base
{
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->service = new About();
    }
    public function index($about)
    {
        if ($this->request->isGet()) {
            //todo::拿about文章
            $data = $this->service->getDataByUrl((string) htmlspecialchars(trim($about)), (int)$this->language['id']);
            View::assign('data', $data);
            View::assign('current', 'about');
            return  View::fetch($this->template . '/about/index.html');
        }
    }
    public function detail($url)
    {
        if ($this->request->isGet()) {
            $data = $this->service->getDataByUrl((string) htmlspecialchars(trim($url)), (int)$this->language['id']);
            View::assign('data', $data);
            View::assign('current', $url);
            return View::fetch($this->template . '/about/detail.html');
        }
    }
}