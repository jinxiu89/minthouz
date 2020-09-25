<?php

declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/2 15:17
 * @User: admin
 * @Current File : ProductCategory.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\controller\category;


use app\admin\controller\BaseAdmin;
use app\admin\service\category\ProductCategory as service;
use app\admin\validate\category\ProductCategory as validate;
use app\libs\utils\Category;
use think\App;
use think\facade\Session;
use think\facade\View;
use think\response\Json;

/**
 * Class ProductCategory
 * @package app\admin\controller\content
 */
class ProductCategory extends BaseAdmin
{
    protected $category;

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    /**
     * ProductCategory constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->service = new service();
        $this->validate = new validate();
        $arr = $this->service->getDataByLanguage((int) 1, (int)$this->language);
        $this->category = Category::toLevel((array)$arr, '&nbsp;&nbsp;');
        View::assign('category', $this->category);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function index()
    {
        if ($this->request->isGet()) {
            return View::fetch();
        }
    }

    /**
     * @return Json
     */
    public function lists()
    {
        return json($this->category);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function add()
    {
        if ($this->request->isGet()) {
            $id = $this->request->param('id', '', ['int', 'trim', 'htmlspecialchars']) ?? 0;
            View::assign('parent_id', $id);
            return View::fetch();
        }
        if ($this->request->isPost()) {
            $data = input('post.', [], 'htmlspecialchars,trim');
            $data['status'] = 1;
            $data['url_title'] = substr(md5(uniqid()), 3, 12);
            $data['language_id'] = Session::get('current_language', 1);
            if ($data['parent_id'] == 0) {
                $data['path'] = '-';
                $data['level'] = 0;
                if ($data['is_parent'] == 2) return show(0, '如果分类为顶级分类时，目录选项必须选择是');
            } else {
                $parent = $this->service->getParent((int)$data['parent_id']);
                $data['level'] = $parent->level + 1;
                $data['path'] = $parent->path . $parent->id . '-';
            }
            if (!$this->validate->scene('add')->check($data)) {
                return show(0, $this->validate->getError());
            }
            if ($this->service->create((array)$data)) {
                return show(1, '新增成功');
            }
            return show(0, '新增失败，未知原因');
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function edit()
    {
        if ($this->request->isGet()) {
            $id = $this->request->param('id', '', ['int', 'trim', 'htmlspecialchars']);
            $result = $this->service->getDataById((int)$id);
            View::assign('result', $result);
            return View::fetch();
        }
        if ($this->request->isPost()) {
            $data = input('post.', [], 'htmlspecialchars,trim');
            if (!$this->validate->scene('edit')->check($data)) {
                return show(0, $this->validate->getError());
            }
            if ($data['parent_id'] == 0) {
                $data['path'] = '-';
                $data['level'] = 0;
                $data['is_parent'] = 1;
            } else {
                $parent = $this->service->getParent((int)$data['parent_id']);
                $data['level'] = $parent->level + 1;
                $data['path'] = $parent->path . $parent->id . '-';
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
    /**
     * sortorder
     *
     * @Author: kevin qiu
     * @DateTime: 2020-09-25
     * @return void
     */
    public function sortorder()
    {
        if ($this->request->isPost()) {
            $data = input('post.', [], 'trim');
            if (!$this->validate->scene('sortorder')->check($data)) return show(0, $this->validate->getError()); //后台验证数据合法性
            $status = $this->service->sortorder((array) $data);
            if ($status == true) {
                return show(1, '排序成功');
            }
            return show(0, '不明原因，排序失败');
        }
    }
}