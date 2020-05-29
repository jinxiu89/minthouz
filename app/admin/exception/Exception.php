<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/5/29 10:50
 * @User: admin
 * @Current File : Exception.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\exception;


use think\exception\Handle;
use think\exception\HttpException;
use think\Response;
use Throwable;

/**
 * Class Exception
 * @package app\admin\exception
 */
class Exception extends Handle
{
    protected $httpStatus = 500;

    /**
     * Render an exception into an HTTP response.
     *
     * @access public
     * @param \think\Request $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        /*if($e instanceof ValidateException){
            //
        }*/
        //如果异常由Http异常抛出，还是ajax/post请求，就使用json数据抛出
        if ($e instanceof HttpException && $request->isPost()) {
            return show(0, $e->getMessage(), [], $e->getStatusCode());
        }
        return parent::render($request, $e);
    }
}