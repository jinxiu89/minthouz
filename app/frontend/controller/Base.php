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
use app\frontend\service\Setting;
use app\frontend\service\Category;
use app\frontend\service\Notice;
use app\frontend\service\About;
use think\App;
use think\facade\Lang;
use think\facade\Session;
use think\response\Redirect;
use think\facade\View;

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
        $this->language = (new Language())->getDataByCode((string)$code)->toArray();
        View::assign('code', $code);
        if (!empty($this->language) || $this->language['status'] != 1) { //todo:关于语言状态还没处理
            Session::set('language', $this->language);
            Session::set('lang_var', $this->language['code']);
            Lang::load(app()->getAppPath() . 'lang/' . $this->language['code'] . '.php');
        } else {
            abort(403, '不合法的语言选项');
        }
        parent::initialize();
        if (is_mobile()) {
            $this->template = app()->getRootPath() . 'app/' . app('http')->getName() . '/view/mobile';
        } else {
            $this->template = app()->getRootPath() . 'app/' . app('http')->getName() . '/view/desktop';
        }
        $this->init((int)$this->language['id']);
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

    /**
     * @param int $language
     */
    public function init(int $language)
    {
        //主页SEO、统计、版权声明
        $BaseSetting = (new Setting())->getDataByLanguage((int)$language);
        // print_r($BaseSetting);
        //通知 不用走缓存
        $notice = (new Notice())->getNoticeByLanguage((int)$language, (int)$status = 1);
        $treeCategory = (new Category())->getDataByLanguage((int)$language);
        print_r($treeCategory);
        $list = (new About())->getAboutList((int) $this->language['id']);
        View::assign('notice', $notice);
        View::assign('list', $list);
        View::assign('treeCategory', $treeCategory);
        View::assign('BaseSetting', $BaseSetting);
    }
}