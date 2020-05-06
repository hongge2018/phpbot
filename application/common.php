<?php
use think\Db;

/**
 * 数组转换为JSON
 * @param array $array 数组
 * @return string
 */
function array2json($array = [])
{
    if (!is_array($array) || empty($array)) {
        return '';
    }
    return json_encode($array, JSON_UNESCAPED_UNICODE);
}

/**
 * JSON转换为数组
 * @param string $string JSON字符串
 * @return array|mixed
 */
function json2array($string = '')
{
    if (empty($string)) {
        return [];
    }
    if (!is_string($string)) {
        return [];
    }
    preg_match('/{.*}/', $string, $json_arr);
    return empty($json_arr) ? [] : json_decode($string, true);
}

/**
 * 缓存管理
 * @param $name
 * @param string $value
 * @param array $options
 * @return array|bool|mixed
 */
function getCache($name, $value = '', $options = [])
{
    if ($value) {
        cache($name, $value);//生成缓存
        return true;
    }
    // 读取缓存
    $data = cache($name);
    // 如果缓存为空，则重新生成缓存
    if (empty($data)) {
        $pk = isset($options['pk']) ? $options['pk'] : 'id';
        $order = isset($options['order']) ? $options['order'] : $pk . ' asc';
        $where = isset($options['where']) ? $options['where'] : [];
        $data = Db::name($name)->where($where)->order($order)->column('*', $pk);//查询数据
        cache($name, $data);//生成缓存
    }
    return $data;
}

/**
 * 密码加密
 * @param $password  密码
 * @param $password_code 加密字符
 * @return string
 */
function zzcmsPassword($password, $password_code)
{
    return md5(md5($password) . md5($password_code));
}