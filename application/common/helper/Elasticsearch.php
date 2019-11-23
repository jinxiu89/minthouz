<?php
/**
 * Created by PhpStorm.
 * User: guo
 * Date: 2018/5/27
 * Time: 17:22
 */

namespace app\common\helper;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use think\facade\Config;

/**
 * Class Search
 * @package app\common\helper
 */
class Elasticsearch
{
    protected $params = [
        'index' => '',
        'body' => [],
    ];

    /**
     * @return Client
     * 创建客户端
     */
    public static function Client()
    {
        $builder = ClientBuilder::create()->setHosts(Config::get('search.client'));
        /*if(Config::get('app.debug') == true){
            //todo:: 写日志（到thinkphp本地来）
        }*/
        return $builder->build();
    }

    /**
     * @param $index
     * @return Elasticsearch 创建索引表明
     * 创建索引表明
     */
    public function Index($index)
    {
        $this->params['index'] = $index;
        return $this;
    }

    /**
     * @param array $settings
     * @return Elasticsearch
     */
    public function setting($settings = [])
    {
        $this->params['body']['settings'] = $settings;
        return $this;
    }

    /**
     * 创建索引映射类型
     * @param array $properties
     * @return Elasticsearch
     */
    public function mappings($properties = [])
    {

        $this->params['body']['mappings']['_default_']['properties'] = $properties;
        return $this;
    }


    /**
     * @param $params
     * @return array|callable
     */
    public static function createIndex($params)
    {
        return self::Client()->indices()->create($params);
    }

    /**
     * @param $index
     * @return array|callable|void
     * 删除一个索引
     */
    public static function delIndex($index)
    {
        try {
            return self::Client()->indices()->delete(['index' => $index]);
        } catch (\Exception $exception) {
            return;//todo;
        }
    }

    /**
     * 改 //todo：后面更新时再来写
     */
    public static function PutMapping()
    {

    }

    /**
     * get //todo：后面在来写
     */
    public static function getMapping()
    {

    }

    /**
     * @param $size
     * @param $page
     * @return Elasticsearch
     * 添加分页查询
     */
    public function paginate($size, $page)
    {
        $this->params['body']['from'] = ($page - 1) * $size;
        $this->params['body']['size'] = $size;
        return $this;
    }
//    public function getDoc($index,$type,){
//
//    }



    /**
     * @param $status
     * @return $this
     * 传递要查询的状态码
     */
    public function status($status)
    {
        $this->params['body']['query']['bool']['filter'][] = ['term' => ['status' => $status]];
        return $this;
    }
}