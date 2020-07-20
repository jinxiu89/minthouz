<?php

/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/28 14:07
 * @User: admin
 * @Current File : User.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\controller\user;


use app\admin\service\user\User as service;
use app\admin\validate\user\User as userValidate;
use app\BaseController;
use think\App;
use think\facade\Env;
use think\facade\Session;
use think\facade\View;
use think\facade\Request;
use think\response\Redirect;

/**
 * Class User
 * @package app\admin\controller\user
 */
class User extends BaseController
{

    /**
     * User constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function initialize()
    {
        parent::initialize();
        $this->service = new service();
        $this->validate = new userValidate();
    }

    /**
     * @return string
     */
    public function login()
    {
        if ($this->isLogin()) return redirect(url('dashboard/index'), 200);
        $next = input('get.next') ?? (string)url('dashboard/index'); //todo::这个问题 回头再来好好研究
        if ($this->request->isGet()) {
            try {
                return View::fetch();
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
        }
        if ($this->request->isPost()) {
            $data = input('post.', [], 'htmlspecialchars');
            if (!Env::get('APP_DEBUG', false)) {
                if (!captcha_check($data['captcha'])) return show(0, '验证码不正确');
            }
            if ($data['language'] == 0) return show(0, '请选择语言');
            if (!$this->validate->scene('login')->check($data)) {
                return show(0, $this->validate->getError());
            }
            if ($this->service->login($data)) {
                return show(1, '登录成功', ['next' => $next]);
            }
            return show(0, '登录失败，未知原因');
        }
    }

    /**
     * @return Redirect
     */
    public function logout()
    {
        Session::delete('adminUser');
        Session::delete('current_language');
        return redirect(url('user/login'));
    }
}