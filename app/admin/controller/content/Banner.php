<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/6 16:19
 * @User: admin
 * @Current File : Banner.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\controller\content;


use app\admin\controller\BaseAdmin;
use think\App;
use think\facade\View;

/**
 * Class Banner
 * @package app\admin\controller\content
 */
class Banner extends BaseAdmin
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function index()
    {
        if ($this->request->isGet()) {
            return View::fetch();
        }
    }

    /**
     * @return string
     */
    public function add(){
        if($this->request->isGet()){

            return View::fetch();
        }
        if($this->request->isPost()){

        }
    }
}