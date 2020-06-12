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

use app\libs\utils\cloud\AliOss;
use think\facade\Env;
use think\facade\Filesystem;

/**
 * Class Common
 * @package app\admin\controller
 */
class Common extends BaseAdmin
{
    public function imageUpload(){
        if($this->request->isPost()){
            $file = $this->request->file('file');
//            print_r($file->getPathname());  print_r($file->getRealPath()); // 获得文件的文件路径 path
            $key=$file->hashName(null);
            print_r($key);
            AliOss::putFile();
        }
//        print_r(Env::get('ali.accessKeyId'));
    }
}