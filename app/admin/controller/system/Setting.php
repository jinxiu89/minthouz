<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/2 9:43
 * @User: admin
 * @Current File : Setting.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\controller\system;


use app\admin\controller\BaseAdmin;
use think\App;
use think\facade\Session;
use think\facade\View;
use app\admin\service\system\Setting as service;
use app\admin\validate\system\Setting as validate;

class Setting extends BaseAdmin
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    /**
     * Setting constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->service = new service();
        $this->validate = new validate();
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function setting()
    {
        if ($this->request->isGet()) {
            $language = Session::get('current_language', 1);
            $data = $this->service->getDtaByLanguage((int)$language);
            View::assign('data', $data);
            return View::fetch();
        }
        if ($this->request->isPost()) {
            $data = input('post.', []);
            if (!$this->validate->check($data)) {
                return show(0, $this->validate->getError());
            }
            if ($this->service->update((array)$data)) {
                return show(1, '保存成功');
            }
            return show(0, '新增失败，未知原因');
        }
    }
}