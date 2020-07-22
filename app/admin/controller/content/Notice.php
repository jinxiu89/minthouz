<?php

declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/10 17:40
 * @User: admin
 * @Current File : Notice.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\controller\content;


use app\admin\controller\BaseAdmin;
use think\App;
use app\admin\service\content\Notice as service;
use think\facade\Session;
use think\facade\View;

/**
 * Class Notice
 * @package app\admin\controller\content
 */
class Notice extends BaseAdmin
{
    /**
     * Notice constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->service = new service();
    }

    /**
     * @return string|\think\response\Json
     */
    public function notice()
    {
        if ($this->request->isGet()) {
            $language = Session::get('current_language', 1);
            $data = $this->service->getDataByLanguage((int)$language);
            View::assign('data', $data);
            return View::fetch();
        }
        if ($this->request->isPost()) {
            $data = input('post.', [], 'htmlspecialchars');
            $data['language_id'] = $this->language;
            //后面有时间做一个验证进来，现在可以这样用
            if (intval($data['id'])) {
                $result = $this->service->update((array)$data);
            } else {
                $result = $this->service->saveData((array)$data);
            }
            if ($result) {
                return show(1, '保存成功');
            }
            return show(0, '新增失败，未知原因');
        }
    }
}