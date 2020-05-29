<?php
declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/28 9:46
 * @User: admin
 * @Current File : index.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\controller\content;


use app\admin\controller\BaseAdmin;
use think\App;
use app\admin\middleware\Auth;

/**
 * Class Index
 * @package app\admin\controller\content
 */
class Index extends BaseAdmin
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    protected $middleware = [
//        Auth::class=>['except'=>['index']]
        Auth::class
    ];

    /**
     * @return string
     */
    public function index()
    {
        return "hello world in content";
    }
}