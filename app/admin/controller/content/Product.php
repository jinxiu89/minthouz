<?php
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/4 17:30
 * @User: admin
 * @Current File : Product.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\admin\controller\content;


use app\admin\controller\BaseAdmin;
use think\App;
use think\facade\Session;
use think\facade\View;
use app\admin\service\category\ProductCategory;
use app\admin\service\content\Product as service;
use app\admin\validate\content\Product as validate;

/**
 * Class Product
 * @package app\admin\controller\content
 * 后台产品类
 */
class Product extends BaseAdmin
{
    /**
     * initialize 先运行
     */
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    /**
     * Product constructor.
     * @param App $app
     * 构造注入函数 在Init后面运行
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->service = new service();
        $this->validate = new validate();
        $cateTree = (new ProductCategory())->getTree((int)Session::get('current_language', 1), (int)1);
        View::assign('category', $cateTree);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function index()
    {
        if ($this->request->isGet()) {
            $data = $this->service->getDataByStatus();
            View::assign('data', $data);
            return View::fetch();
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function add()
    {
        if ($this->request->isGet()) {
            return View::fetch();
        }
        if ($this->request->isPost()) {
            $data = input('post.', [], 'trim');
            //主表
            $product['category_id'] = $data['category_id'];
            $product['language_id'] = $this->language;
            $product['hot'] = $data['hot'];
            $product['listorder'] = $data['listorder'];
            $product['ean'] = $data['ean'];
            $product['model'] = $data['model'];
            $product['url_title'] = substr(md5(uniqid()), 3, 12);
            $product['title'] = $data['title'];
            $product['keywords'] = $data['keywords'];
            $product['description'] = $data['description'];
            $product['thumbnail'] = $data['thumbnail'];
            $product['features'] = $data['features'];
            $product['specifications'] = $data['specifications'];
            $product['create_time'] = $product['update_time'] = time();
            //相册分表
            $album = $data['album'];//是个数组
            //内容分表
            $content['desktop'] = $data['desktop'];
            $content['mobile'] = $data['mobile'];
            unset($data);
            if (!$this->validate->scene('product_add')->check($product)) return show(0, $this->validate->getError()); //后台验证数据合法性
            $status = $this->service->save((array)$product, (array)$album, (array)$content);
            if ($status == true) {
                return show(1, '新增成功');
            }
            return show(0, '不明原因失败');
        }
    }

    /**
     * @return string
     * @throws \Exception
     * 编辑
     */
    public function edit()
    {
        if ($this->request->isGet()) {
            $id = input('get.id');
            $data=$this->service->getDataByID((int)$id);
            View::assign('data',$data);
            return View::fetch();
        }
        if($this->request->isPost()){
            $data = input('post.', [], 'trim');
            //主表
            $product['id']=$data['id'];
            $product['category_id'] = $data['category_id'];
            $product['language_id'] = $this->language;
            $product['hot'] = $data['hot'];
            $product['listorder'] = $data['listorder'];
            $product['ean'] = $data['ean'];
            $product['model'] = $data['model'];
            $product['url_title'] = substr(md5(uniqid()), 3, 12);
            $product['title'] = $data['title'];
            $product['keywords'] = $data['keywords'];
            $product['description'] = $data['description'];
            $product['thumbnail'] = $data['thumbnail'];
            $product['features'] = $data['features'];
            $product['specifications'] = $data['specifications'];
            $product['create_time'] = $product['update_time'] = time();
            //相册分表
            $album = $data['album'];//是个数组
            //内容分表
            $content['desktop'] = $data['desktop'];
            $content['mobile'] = $data['mobile'];
            unset($data);
            if (!$this->validate->scene('product_edit')->check($product)) return show(0, $this->validate->getError()); //后台验证数据合法性
            $status = $this->service->save((array)$product, (array)$album, (array)$content);
            if ($status == true) {
                return show(1, '保存成功');
            }
            return show(0, '不明原因，保存失败');
        }
    }

    public function del()
    {

    }

    public function changeStatus()
    {

    }
}