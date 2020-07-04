<?php
declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/29 14:07
 * @User: admin
 * @Current File : Auth.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\middleware;


use think\facade\Request;
use think\facade\Session;
use think\response\Redirect;

/**
 * Class Auth
 * @package app\customer\middleware
 */
class Auth
{
    /**
     * @param $request
     * @param \Closure $next
     * @return mixed|Redirect
     */
    public function handle($request, \Closure $next)
    {
        $jump= Request::instance()->url(true) ?? (string)url('dashboard/index');
        if (!Session::get('adminUser', '')) {
            Session::set('adminLogin',false);
            return redirect((string)url('user/login',['next'=>$jump]));
        }
        return $next($request);
    }
}