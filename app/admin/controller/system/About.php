<?php

declare(strict_types=1);

namespace app\admin\controller\system;

use app\admin\controller\BaseAdmin;
use Exception;
use think\App;
use think\facade\View;
use app\admin\validate\system\About as validate;
use app\admin\service\system\About as service;

/**
 * @Create by vscode,
 * 
 * @author:jinxiu89@163.com
 * @Create Date:2020年07月20日 17:57:00 Monday
 * @User: admin
 * @Current File : About.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/
class About extends BaseAdmin
{
    /**
     * 构造函数 
     *
     * @Author: kevin qiu
     * @DateTime: 2020-07-21
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
    }
    /**
     * 实例化工具
     *
     * @Author: kevin qiu
     * @DateTime: 2020-07-21
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->validate = new validate();
        $this->service = new service();
    }
    /**
     * 列表页
     *
     * @Author: kevin qiu
     * @DateTime: 2020-07-21
     * @return void
     */
    public function index()
    {
        if ($this->request->isGet()) {
            $data = $this->service->getObj((int) $this->language);
            View::assign('data', $data);
            return View::fetch();
        }
    }
    /**
     * 关于我们的添加功能，由于是多语言环境，所有的语言都从 $this->language 中取
     *
     * @Author: kevin qiu
     * @DateTime: 2020-07-21
     * @return void
     */
    public function add()
    {
        if ($this->request->isGet()) {
            return View::fetch();
        }
        if ($this->request->isPost()) {
            $data = input('post.', []);
            $data['language_id'] = $this->language;
            if (!$this->validate->scene('add')->check($data)) {
                return show(0, $this->validate->getError());
            }
            if ($this->service->create((array)$data)) {
                return show(1, '新增成功');
            }
            return show(0, '新增失败，未知原因');
        }
    }

    public function edit()
    {
        if ($this->request->isGet()) {
            $id = $this->request->param('id', '', ['int', 'trim', 'htmlspecialchars']);
            $result = $this->service->getDataById((int)$id);
            View::assign('result', $result);
            return View::fetch();
        }
        if ($this->request->isPost()) {
            $data = input('post.', []);
            if (!$this->validate->scene('edit')->check($data)) {
                return show(0, $this->validate->getError());
            }
            if ($this->service->update((array)$data)) {
                return show(1, '保存成功');
            }
            return show(0, '新增失败，未知原因');
        }
    }

    /**
     * @return Json
     */
    public function changeStatus()
    {
        $id = input('get.id');
        $status = input('get.status');
        $result = $this->service->changeStatus((int)$id, (int)$status);
        if ($result->id) {
            return show(1, '保存成功');
        }
        return show(0, '保存失败，未知原因');
    }
}