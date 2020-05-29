<?php
declare(strict_types=1);
// 应用公共文件
use think\response\Json;

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
function get_client_ip(int $type = 0, bool $adv = false) {
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
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
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