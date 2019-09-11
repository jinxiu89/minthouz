<?php
namespace app\zh_cn\controller;
use think\Controller;
use think\Session;

/**
 * Created by PhpStorm.
 * User: guo
 * Date: 2018/3/7
 * Time: 17:01
 */

class Login extends Controller
{
    protected $template;
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        if(isMobile()){
            $this->template=APP_PATH.request()->module().'/view/mobile';
        }else{
            $this->template=APP_PATH.request()->module().'/view/pc';
        }
    }

    public function index(){
//        $model = request()->module();
//        Session::clear('Customer');
//        Session::set('langModel',$model,'Customer');
//        $this->redirect(url('customer/Login/index'));
        return view($this->template.'/base/404.html');
    }
}