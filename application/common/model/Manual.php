<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/12/18
 * Time: 17:07
 */

namespace app\common\model;

use app\common\model\Language as LanugaeModel;

/**
 * Class Manual
 * @package app\common\model
 */
class Manual extends BaseModel
{
    protected $table = "tb_manual";
    protected $autoWriteTimestamp = 'date';


    public function downloads()
    {
        return $this->hasMany('ManualDownload', 'manual_id');
    }

    public function getDataByLanguage($language_id)
    {
        $result = $this->where(['status' => 1, 'language_id' => $language_id])->paginate(6);
        return ModelsArr($result, 'model', 'modelGroup');
    }

    // 前台 获取当前选择的子分类下的驱动列表，models产品型号字段处理
    public function getManualByCategoryId($code, $categoryId)
    {
        $language_id = LanugaeModel::getLanguageCodeOrID($code);
        $data = [
            'status' => 1,
            'language_id' => $language_id,
        ];
        $order = [
            'listorder' => 'desc',
            'id' => 'desc',
        ];
        if (empty($categoryId)) {
            $result = $this->where($data)->order($order)->paginate(6);
        } else {
            $result = $this->where($data)->where('category_id', '=', $categoryId)->order($order)->paginate(6);
        }
        $result = ModelsArr($result, 'models', 'modelsGroup');
        return $result;
    }

    /***
     * @param $chinld
     * 当有 child 的分类 用这个方法获取到他所有的子分类下的内容
     */
    public function getdataByChild($code, $chinld, $parent)
    {
        $language_id = LanugaeModel::getLanguageCodeOrID($code);//$code 转成 language_id
        try {
            if (empty($chinld)) {
                //没有下一级分类的情况
                $chinldData = $this->where(array(
                    'language_id' => $language_id,
                    'category_id' => $parent['id'],
                ))->select();
                $data=TurnArray($chinldData);
            }
            if (!empty($chinld)) {
                foreach ($chinld as $vo) {
                    $result = $this->where(array(
                        'language_id' => $language_id,
                        'category_id' => $vo['id'],
                    ))->select();
                    $res[] = TurnArray($result);//TurnArray就返回的是一个二维数组 ，在压到$data就变成了三维数组了
                }
                foreach ($res as $vo) {
                    foreach ($vo as $io) {
                        $data[] = $io;
                    }
                }
                $parentData = $this->where(array(
                    'language_id' => $language_id,
                    'category_id' => $parent['id']
                ))->select();
                $data = array_merge($data, TurnArray($parentData));
            }
            return $data;
        } catch (\Exception $e) {
            //抛出异常
        }
    }

    public function getSelectManual($code, $key)
    {
        $language_id = LanugaeModel::getLanguageCodeOrID($code);
        $model = 'Manual';
        $map['status'] = 1;
        $map['title|model|url_title|keywords|description'] = array('like', '%' . $key . '%');
        $map['language_id'] = $language_id;
        $order = [
            'id' => 'desc',
        ];
        return Search($model, $map, $order);
    }

    public function getDownloadByTitle($code, $url_title)
    {
        $language_id = LanugaeModel::getLanguageCodeOrID($code);//$code 转成 language_id
        try {
            $data = $this->where(array(
                'language_id' => $language_id,
                'url_title' => $url_title
            ))->find();
            if ($data) {
                $result['manual'] = $data->toArray();
                $result['downloads'] = TurnArray($data->downloads);
                return $result;
            }
        } catch (\Exception $e) {
            //异常后面修好
            return $e->getMessage();
        }
    }

    public function getUrlTitle($category)
    {
        return getUrlByCategoryID($category);
    }
}