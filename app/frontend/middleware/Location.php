<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/7/4 17:28
 * @User: admin
 * @Current File : Localtion.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\frontend\middleware;

use think\response\Redirect;
use app\common\model\mysql\system\Language;
/**
 * Class Auth
 * @package app\customer\middleware
 */
class Location
{
    /**
     * @param $request
     * @param \Closure $next
     * @return mixed|Redirect
     */
    public function handle($request, \Closure $next)
    {
        $code = explode('/', $request->url())[1];
        $language_id=
        $request->code=$code;
        /*if (!empty($path)) Cookie::set('lang_var', $code);*/
        //就在这里加载语言呢？
        return $next($request);
    }
}