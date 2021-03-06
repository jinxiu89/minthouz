<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/9 15:25
 * @User: admin
 * @Current File : Common.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\controller;

use app\admin\service\system\Language;
use app\libs\utils\cloud\AliOss;
use think\facade\Request;
use think\facade\Session;

/**
 * Class Common
 * @package app\admin\controller
 */
class Common extends BaseAdmin
{
    public function imageUpload()
    {
        if ($this->request->isPost()) {
            $file = $this->request->file('file');
//            print_r($file->getPathname());  print_r($file->getRealPath()); // 获得文件的文件路径 path
            $key = $file->hashName(null);
            print_r($key);
            AliOss::putFile();
        }
//        print_r(Env::get('ali.accessKeyId'));
    }

    /**
     * @return \think\response\Redirect
     */
    public function changeLanguage()
    {
        $language = input('get.code', 'en_us', 'trim,htmlspecialchars');
        $refer = Request::header('referer')?Request::header('referer'): url('dashboard/index');
        $result = (new Language())->getLanguageByCode((string)$language);
        Session::set('current_language', $result['id']);
        return redirect($refer);
    }
}