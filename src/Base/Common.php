<?php
namespace iboxs\authapi\Base;

use iboxs\authapi\Client;

class Common{
    /**
     * 获取请求sign
     * @param int $time 时间戳
     * @param string $str 随机字符串（8位）
     * @param string $standard 标准参内容
     */
    public function GetSign($time,$str,$standard){
        $sign=md5(md5(Client::$AppID.$time.strval($standard).$str).Client::$AppSecret);
        return $sign;
    }

    /**
     * 获取随机字符串
     */
    public function GetRandStr($length){
        //字符组合
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $len = strlen($str)-1;
        $randstr = '';
        for ($i=0;$i<$length;$i++) {
         $num=mt_rand(0,$len);
         $randstr .= $str[$num];
        }
        return $randstr;
    }

    /**
     * 发送post请求
     * @param string $url 请求地址
     * @param array $post_data post键值对数据
     * @return string
     */
    public function SendPost($url, $post_data) {
        $postdata = http_build_query($post_data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/93.0.4577.82 Safari/537.36");
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}