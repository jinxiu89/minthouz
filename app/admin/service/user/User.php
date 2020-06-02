<?php
declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/28 16:26
 * @User: admin
 * @Current File : User.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\service\user;

use think\facade\Request;
use app\admin\service\BaseService;
use app\common\model\mysql\user\User as model;
use think\Exception;
use think\facade\Env;
use think\facade\Session;

/**
 * Class User
 * @package app\admin\service\user
 */
class User extends BaseService
{
    public function __construct()
    {
        $this->model = new model();
    }

    /**
     * @param array $data
     */
    public function login(array $data)
    {
        try {
            $user = $this->model::where(['username' => $data['username']])->field('id,username,title,password,salt,login_num')->findOrEmpty();
            if (!Env::get('app_debug')) {
                if (!captcha_check($data['captcha'])) {
                    abort(500, '验证码错误');
                }
            }
            if ($user->isEmpty()) {
                abort(500, '用户不存在');
            }
            if (md5($data['password'] . $user->salt) != $user->password) {
                abort(500, '密码错误');
            }
            $updateData = ['login_num' => $user->login_num + 1, 'last_login_time' => time(), 'ip' => get_client_ip()];
            $this->model::updateDataById($user->id, $updateData);
            Session::set('adminUser', ['id' => $user->id, 'username' => $user->username, 'title' => $user->title]);
            Session::set('current_language',$data['language']);
            return true;
        } catch (\Exception $exception) {
            if (true == Env::get('APP_DEBUG')) {
                abort(500, $exception->getMessage());
            }
            abort(500, '服务器内部错误');
        }
    }
}