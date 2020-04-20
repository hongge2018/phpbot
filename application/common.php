<?php
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