<?php
/**
 * Created by PhpStorm.
 * User: guo
 * Date: 2018/3/14
 * Time: 11:18
 */

namespace app\customer\controller;
use think\Session;
use app\common\model\Customer as User;

class Login extends Base_reg
{

    public function index()
    {
        if(request()->isAjax()){
            //先验证是否这个邮箱是否有注册，如果是就不应该让他注册两次哇   逗比：你的AOP在哪里？
            $data = input('post.');
            $result = (new User())->CheckCustomer($data);
            $login_url=url('customer_login');
            $index=url('customer_index');
            if ($result == -1){
                return show(0,lang('User does not exist'),'','',$login_url,'');
            }
            if ($result == -2){
                return show(0,lang('Password Error'),'','',$login_url);
            }
            if ($result == 1){
                return show(1,lang('Success'),'','',$index);
            }
        }
        return $this->fetch();
    }
    public function login()
    {
        //假设登录成功了
        //todo::登录逻辑
        //设置session
        Session::set('username', '', 'Customer');
        $this->redirect(url('customer_index'));
    }
}