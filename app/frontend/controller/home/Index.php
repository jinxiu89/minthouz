<?php
namespace app\frontend\controller\home;

use app\frontend\controller\Base;
use think\facade\Cookie;
use think\facade\Request;

/**
 * Class Index
 * @package app\frontend\controller\home
 * 首页相关的页面渲染
 */
class Index extends Base
{
    public function index()
    {
        print_r($this->request->code);
    }
}
