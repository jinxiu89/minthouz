<?php
declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/4 14:39
 * @User: admin
 * @Current File : base.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\frontend\controller;


use app\BaseController;
use app\frontend\service\Language;
use think\App;
use think\facade\Env;
use think\facade\Request;
use think\facade\Session;
use app\frontend\service\BaseService;
use think\response\Redirect;

/**
 * Class Base
 * @package app\frontend\controller
 */
class Base extends BaseController
{
    protected $service;
    protected $language;
    protected $template;

    /**
     * 在tp中，initialize 在__construct前面运行
     */
    public function initialize()
    {
        $code = explode('/', request()->url())[1];
        $this->language = (new Language())->getDataByCode((string)$code);
        if (!empty($this->language) || $this->language['status'] != 1) { //todo:关于语言状态还没处理
            Session::set('language', $this->language);
            Session::set('lang_var', $this->language['code']);
        } else {
            abort(403, '不合法的语言选项');
        }
        parent::initialize();
        if (is_mobile()) {
            $this->template = app()->getRootPath() . 'app/' . app('http')->getName() . '/view/mobile';
        } else {
            $this->template = app()->getRootPath() . 'app/' . app('http')->getName() . '/view/desktop';
        }
        (new BaseService())->init((int)$this->language['id']);

    }

    /**
     * Base constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {

        // parent 前面的代码走在initialize 前面
        parent::__construct($app);

    }

    /**
     * @return Redirect
     */
    public function autoload()
    {
        $code = (Session::get('lang_var')) ? (Session::get('lang_var')) : 'en_us';
        return redirect('/' . $code, 200);
    }
}