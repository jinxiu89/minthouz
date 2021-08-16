<?php

declare(strict_types=1);
/**
 * @Create by PhpStorm
 * @author:jinxiu89@163.com
 * @Create Date:2020/6/9 16:30
 * @User: admin
 * @Current File : AliOss.php
 * @格言：溪涧岂能留得住，终归大海做波涛 --李忱
 * @格言： 我的内心因看见大海而波涛汹涌
 **/

namespace app\libs\utils\cloud;


use OSS\Core\OssException;
use OSS\Model\ObjectListInfo;
use OSS\OssClient;
use think\facade\Config;
use think\facade\Env;

/**
 * Class AliOss
 * @package app\libs\utils\cloud
 */
class AliOss
{
    /***
     * @return OssClient
     */
    public static function createClient()
    {
        $accessKeyID = Env::get('ali.accessKeyId');
        $accessKeySecret = Env::get('ali.accessSecret');
        $endpoint = Env::get('oss.endpoint');
        try {
            return new OssClient($accessKeyID, $accessKeySecret, $endpoint, false);
        } catch (OssException $ossException) {
            // todo: 抛出异常
        }
    }

    /***
     * 列出 桶里的数据
     * 后面使用的时候再来丰富注释和功能 列出桶里的文件，参数说明：
     * 1、默认桶为wavlink通，我们wavlink 的所有资料都放在wavlink里
     * 2、prefix参数，是指列出桶里的哪个文件夹里的文件，默认拿images文件夹
     * 3、如果我们在视频的功能里列出文件就应该拿videos文件夹里的文件
     * @param string $bucket
     * @param string $prefix
     * @return array
     */
    public static function listObj(string $bucket = 'wavlink', string $prefix = 'images')
    {
        $nextMarker = '';
        $options = ['delimiter' => '/', 'marker' => $nextMarker, 'prefix' => $prefix];
        try {
            $listObjectInfo = self::createClient()->listObjects($bucket, $options);
        } catch (OssException $e) {
            //todo:异常还没处理
            printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            return;
        }
        $objectList = $listObjectInfo->getObjectList(); // object list
        $prefixList = $listObjectInfo->getPrefixList();
        $dir = [];
        if (!empty($prefixList)) {
            foreach ($prefixList as $prefixInfo) {
                $tem['dir'] = true;
                $dirName = explode('/', $prefixInfo->getPrefix());
                $tem['key'] = $prefixInfo->getPrefix();
                $name = array_splice($dirName, -2, 1)[0];
                $tem['name'] = $name;
                $dir[] = $tem;
            }
            unset($dirName);
            unset($tem);
        }
        $items = [];
        if (!empty($objectList)) {
            foreach ($objectList as $objectInfo) {
                if ($objectInfo->getSize() != 0) {
                    $tmp['size'] = $objectInfo->getSize();
                    $tmp['key'] = $objectInfo->getKey();
                    $Filenames = explode('/', $objectInfo->getKey());
                    $tmp['name'] = array_pop($Filenames);
                    $tmp['type'] = $objectInfo->getType();
                    $tmp['last_modified'] = $objectInfo->getLastModified();
                    $items[] = $tmp;
                }
            }
            unset($Filenames);
            unset($tmp);
        }
        return array_merge($dir, $items);
    }

    /**
     * @param string $bucket
     * @param string $key
     * @return bool
     */
    public static function mkdir(string $bucket, string $key)
    {
        try {
            $result = self::createClient()->createObjectDir((string) $bucket, (string) $key);
            return $result['info']['http_code'];
        } catch (OssException $exception) {
            //todo：：日志
            return false;
        }
    }

    /**
     *
     * @param string $key 文件名
     * @param 实体文件（也可以是路径，一般上传时就指定到） $file
     * @return bool
     */
    public static function putFile(string $key, $file)
    {
        try {
            $data = self::createClient()->uploadFile((string)$bucket = Env::get('oss.bucket'), $key, $file);
            return $data['info']['http_code'];
        } catch (OssException $exception) {
            //todo::待解决异常问题
            return show(0, $exception->getMessage(), '', '', '', $exception->getMessage());
        }
    }

    /**
     * @param string $bucket
     * @param string $object
     * @return bool
     */
    public static function delFile(string $bucket, string $object)
    {
        try {
            $data = self::createClient()->deleteObject($bucket, $object);
            return $data['info']['http_code'];
        } catch (OssException $exception) {
            //todo::阿里云那边的异常在此做
            return show((int) 0, (string) $exception->getMessage(), [], 500);
        }
    }
}