<?php
declare(strict_types=1);

// 应用公共文件
use think\response\Json;
use think\facade\Config;

/**
 * @param int $status
 * @param string $message
 * @param array $data
 * @param int $httpStatus
 * @return Json
 */
function show(int $status, string $message = 'error', array $data = [], int $httpStatus = 200)
{
    $result = [
        'status' => $status,
        'message' => $message,
        'result' => $data
    ];
    return json($result);
}

/**
 * @param int $type
 * @param bool $adv
 * @return mixed
 */
function get_client_ip(int $type = 0, bool $adv = false)
{
    $type = $type ? 1 : 0;
    static $ip = NULL;
    if ($ip !== NULL)
        return $ip[$type];
    if ($adv) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if (false !== $pos)
                unset($arr[$pos]);
            $ip = trim($arr[0]);
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证, 防止通过IP注入攻击
    $long = sprintf("%u", ip2long($ip));
    $ip = $long ? [$ip, $long] : ['0.0.0.0', 0];
    return $ip[$type];
}

/**
 * @param $header
 * @return string|string[]
 */
function get_lang($header)
{
    //拿到浏览器的语言，初始化语言项
    if (empty($header['accept-language'])) {
        return 'en_us';
    } else {
        $lang_code = $header['accept-language'];
        $result = array_slice(explode(',', $lang_code), 0, 2);
        $code = '';
        foreach ($result as $item) {
            if (preg_match("/-/i", $item)) {
                $code = explode(';', $item)[0];
            }
        }
        $result = strtolower(str_ireplace('-', '_', $code));
        if (in_array($result, Config::get('app.allow_lang'))) return $result;
        return 'en_us';
    }
}

/***
 * 判断是否是移动端
 */
function is_mobile()
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return true;
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')) {
        return false;
    }
    if (strrpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 10.0')) {
        return false;
    }
    //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA'])) {
        //找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }

    //判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = [
            'nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile_old'
        ];
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    //协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}