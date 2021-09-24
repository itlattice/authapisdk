<?php
/**
 * 授权从这里开始
 * @author  zqu
 */
namespace iboxs\authapi;

use iboxs\authapi\Base\Common;

class Client extends Common
{
    protected static $host="https://auth.itgz8.com/";  //应用根地址
    protected static $AppID;   //应用ID
    protected static $AppSecret;   //应用秘钥

    /**
     * 系统初始化
     * @查看地址：https://auth.itgz8.com/user/info/appkey.html
     * @param string $appid APPID
     * @param string $appsecret AppSecret
     */
    public function __construct($appid, $appsecret)
    {
        self::$AppID=$appid;
        self::$AppSecret=$appsecret;
    }

    /**
     * 授权验证接口
     * @param string $userkey 用户标识符识别码
     * @return string
     */
    public function Auth($userkey)
    {
        $url=self::$host."api/auth";
        $time=time();
        $str=$this->GetRandStr(8);
        $sign=$this->GetSign($time, $str, $userkey);
        $data=array(
            'str'=>$str,
            'time'=>$time,
            'sign'=>$sign,
            'appid'=>self::$AppID,
            'userkey'=>$userkey
        );
        $result=$this->SendPost($url, $data);
        return $result;
    }

    /**
     * 添加授权接口
     * @param string $userkey 用户标识符识别码
     * @param int $expire 到期时间（Unix时间戳）
     * @param int $gradeID 应用版本ID(单版本应用无需此参数)
     * @return string
     */
    public function AddAuth($userkey, $expire, $gradeID=0)
    {
        $url=self::$host."api/addauth";
        $time=time();
        $str=$this->GetRandStr(8);
        $sign=$this->GetSign($time, $str, $userkey);
        $data=array(
            'str'=>$str,
            'time'=>$time,
            'sign'=>$sign,
            'appid'=>self::$AppID,
            'userkey'=>$userkey,
            'expire'=>$expire,
            'grade'=>$gradeID
        );
        $result=$this->SendPost($url, $data);
        return $result;
    }

    /**
     * 取消授权接口
     * @param string $userkey 用户标识符识别码
     * @return string
     */
    public function DelAuth($userkey)
    {
        $url=self::$host."api/delauth";
        $time=time();
        $str=$this->GetRandStr(8);
        $sign=$this->GetSign($time, $str, $userkey);
        $data=array(
            'str'=>$str,
            'time'=>$time,
            'sign'=>$sign,
            'appid'=>self::$AppID,
            'userkey'=>$userkey
        );
        $result=$this->SendPost($url, $data);
        return $result;
    }

    /**
     * 修改价格接口
     * @param string $duration 时长标识
     * @param double|float $price 价格
     * @param int $gradeID 应用版本ID(单版本应用无需此参数)
     * @return string
     */
    public function UpdatePrice($duration, $price, $gradeID=0)
    {
        $url=self::$host."api/updateprice";
        $time=time();
        $str=$this->GetRandStr(8);
        $sign=$this->GetSign($time, $str, $duration);
        $data=array(
            'str'=>$str,
            'time'=>$time,
            'sign'=>$sign,
            'appid'=>self::$AppID,
            'duration'=>$duration,
            'price'=>$price,
            'grade'=>$gradeID
        );
        $result=$this->SendPost($url, $data);
        return $result;
    }

    /**
     * 获取应用版本列表(仅多版本应用有效)
     * @return string
     */
    public function GetGradeList()
    {
        $url=self::$host."api/getgradelist";
        $time=time();
        $str=$this->GetRandStr(8);
        $sign=$this->GetSign($time, $str, 'getgradelist');
        $data=array(
            'str'=>$str,
            'time'=>$time,
            'sign'=>$sign,
            'appid'=>self::$AppID
        );
        $result=$this->SendPost($url, $data);
        return $result;
    }

    /**
     * 获取系统配置的价格
     * @param string $duration 时长标识
     * @param int $gradeID 应用版本ID(单版本应用无需此参数)
     * @return string
     */
    public function GetPrice($duration, $gradeID=0)
    {
        $url=self::$host."api/getprice";
        $time=time();
        $str=$this->GetRandStr(8);
        $sign=$this->GetSign($time, $str, $duration);
        $data=array(
            'str'=>$str,
            'time'=>$time,
            'sign'=>$sign,
            'appid'=>self::$AppID,
            'duration'=>$duration,
            'grade'=>$gradeID
        );
        $result=$this->SendPost($url, $data);
        return $result;
    }
    /**
     * 添加授权卡密
     * @param array|string $card 要添加卡密
     * @param string $duration 时长标识
     * @param int $gradeID 应用版本ID(单版本应用无需此参数)
     * @return string
     */
    public function AddCard($card, $duration, $gradeID=0)
    {
        $url=self::$host."api/addcard";
        $time=time();
        $str=$this->GetRandStr(8);
        $sign="";
        if (is_array($card)) {
            $sign=$this->GetSign($time, $str, $card[0]);
        } else {
            $sign=$this->GetSign($time, $str, $card);
        }
        $data=array(
            'str'=>$str,
            'time'=>$time,
            'sign'=>$sign,
            'appid'=>self::$AppID,
            'duration'=>$duration,
            'grade'=>$gradeID,
            'card'=>$card
        );
        $result=$this->SendPost($url, $data);
        return $result;
    }
    /**
     * 使用卡密
     * @param string $userkey 用户标识符识别码
     * @param string $card 要使用的卡密
     * @return string
     */
    public function UseCard($userkey, $card)
    {
        $url=self::$host."api/usecard";
        $time=time();
        $str=$this->GetRandStr(8);
        $sign=$this->GetSign($time, $str, $userkey);
        $data=array(
            'str'=>$str,
            'time'=>$time,
            'sign'=>$sign,
            'appid'=>self::$AppID,
            'userkey'=>$userkey,
            'card'=>$card
        );
        $result=$this->SendPost($url, $data);
        return $result;
    }

    /**
     * 删除卡密
     * @param array|string $card 要删除的卡密
     * @return string
     */
    public function DelCard($card)
    {
        $url=self::$host."api/delcard";
        $time=time();
        $str=$this->GetRandStr(8);
        $sign="";
        if (is_array($card)) {
            $sign=$this->GetSign($time, $str, $card[0]);
        } else {
            $sign=$this->GetSign($time, $str, $card);
        }
        $data=array(
            'str'=>$str,
            'time'=>$time,
            'sign'=>$sign,
            'appid'=>self::$AppID,
            'card'=>$card
        );
        $result=$this->SendPost($url, $data);
        return $result;
    }
    /**
     * 查询单个卡密详情
     * @param string $card 要查询的卡密
     * @return string
     */
    public function GetCard($card)
    {
        $url=self::$host."api/getcard";
        $time=time();
        $str=$this->GetRandStr(8);
        $sign=$this->GetSign($time, $str, $card);
        $data=array(
            'str'=>$str,
            'time'=>$time,
            'sign'=>$sign,
            'appid'=>self::$AppID,
            'card'=>$card
        );
        $result=$this->SendPost($url, $data);
        return $result;
    }

    /**
     * 购买授权获取支付二维码
     * @param string $userkey 用户识别码
     * @param string $duration 时长标识
     * @param int $paytype 支付方式（0支付宝，1微信）
     * @param int $gradeID 应用版本ID（单版本应用无需本参数）
     * @param double|float $price 价格（系统未配置价格时本参数必传，若系统有配置价格的，本参数也被同时传入的，以此参数传入价格为准）
     * @return string
    */
    public function GetPayCode($userkey,$duration,$paytype=0,$gradeID=0,$price=0){
        $url=self::$host."api/getpaycode";
        $time=time();
        $str=$this->GetRandStr(8);
        $sign=$this->GetSign($time, $str, $userkey);
        $data=array(
            'str'=>$str,
            'time'=>$time,
            'sign'=>$sign,
            'appid'=>self::$AppID,
            'userkey'=>$userkey,
            'duration'=>$duration,
            'paytype'=>$paytype,
            'grade'=>$gradeID
        );
        if($price>=0.01){
            $data['price']=$price;
        }
        $result=$this->SendPost($url, $data);
        return $result;
    }
    /**
     * 获取支付状态
     * @param string $order 订单号
     * @return string
    */
    public function GetPayState($order){
        $url=self::$host."api/getpaystate";
        $time=time();
        $str=$this->GetRandStr(8);
        $sign=$this->GetSign($time, $str, $order);
        $data=array(
            'str'=>$str,
            'time'=>$time,
            'sign'=>$sign,
            'appid'=>self::$AppID,
            'order'=>$order
        );
        $result=$this->SendPost($url, $data);
        return $result;
    }

    /**
     * 获取用户余额接口
     * @return string
     */
    public function GetAmount(){
        $url=self::$host."api/getamount";
        $time=time();
        $str=$this->GetRandStr(8);
        $sign=$this->GetSign($time, $str, "getamount");
        $data=array(
            'str'=>$str,
            'time'=>$time,
            'sign'=>$sign,
            'appid'=>self::$AppID
        );
        $result=$this->SendPost($url, $data);
        return $result;
    }
    /**
     * 获取用户账单数据
     * @param int $limit 获取最近多少条（最高20条，若需更多请到网站系统后台查询）
     * @return string
     */
    public function GetBill($limit=20){
        $url=self::$host."api/getbill";
        $time=time();
        $str=$this->GetRandStr(8);
        $sign=$this->GetSign($time, $str, "getbill");
        $data=array(
            'str'=>$str,
            'time'=>$time,
            'sign'=>$sign,
            'appid'=>self::$AppID,
            'limit'=>$limit
        );
        $result=$this->SendPost($url, $data);
        return $result;
    }
}