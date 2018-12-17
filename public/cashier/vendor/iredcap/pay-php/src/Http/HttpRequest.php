<?php/** *  +---------------------------------------------------------------------- *  | 草帽支付系统 [ WE CAN DO IT JUST THINK ] *  +---------------------------------------------------------------------- *  | Copyright (c) 2018 http://www.iredcap.cn All rights reserved. *  +---------------------------------------------------------------------- *  | Licensed ( https://www.apache.org/licenses/LICENSE-2.0 ) *  +---------------------------------------------------------------------- *  | Author: Brian Waring <BrianWaring98@gmail.com> *  +---------------------------------------------------------------------- */namespace IredCap\Pay\Http;use IredCap\Pay\Util\HttpUtil;use IredCap\Pay\Util\LogUtil;use IredCap\Pay\Exception\InvalidRequestException;class HttpRequest{    const CAHRSET = 'utf-8';    /**     * $var string The Cmpay API version     */    public static $version = '1.0.0';    /**     * @var string The base URL for the Cmpay unifiedorder.     */    public static $baseUrl = 'https://api.pay.iredcap.cn/';    /**     * @var string The Cmpay mch ID     */    private static $mchId = null;    /**     * @var string The Cmpay notifyUrl     */    private static $notifyUrl = null;    /**     * @var string The Cmpay returnUrl     */    private static $returnUrl = null;    /**     * @var string SecretKey     */    private static $secretKey = null;    /**     * @var null The Cmpay privateKey     */    private static $privateKey = null;    /**     * @var null The Cmpay privateKey     */    private static $publicKey = null;    /**     * @var null The Cmpay platform privateKey     */    private static $payPublicKey = null;    /**     * @return string     */    public static function getBaseUrl()    {        return self::$baseUrl;    }    /**     * @param string $baseUrl     */    public static function setBaseUrl($baseUrl)    {        self::$baseUrl = $baseUrl;    }    /**     * @return string     */    public static function getMchId()    {        return self::$mchId;    }    /**     * @param string $mchId     */    public static function setMchId($mchId)    {        self::$mchId = $mchId;    }    /**     * @return string     */    public static function getNotifyUrl()    {        return self::$notifyUrl;    }    /**     * @param string $notifyUrl     */    public static function setNotifyUrl($notifyUrl)    {        self::$notifyUrl = $notifyUrl;    }    /**     * @return string     */    public static function getReturnUrl()    {        return self::$returnUrl;    }    /**     * @param string $returnUrl     */    public static function setReturnUrl($returnUrl)    {        self::$returnUrl = $returnUrl;    }    /**     * @return null|string     */    public static function getApiVersion()    {        return self::$version;    }    /**     * @param null|string $apiVersion     */    public static function setApiVersion($apiVersion)    {        self::$version = $apiVersion;    }    /**     * @return string     */    public static function getSecretKey()    {        return self::$secretKey;    }    /**     * @param string $secretKey     */    public static function setSecretKey($secretKey)    {        self::$secretKey = $secretKey;    }    /**     * @return null     */    public static function getPrivateKey()    {        return self::$privateKey;    }    /**     * @param null $privateKey     */    public static function setPrivateKey($privateKey)    {        self::$privateKey = $privateKey;    }    /**     * @return null     */    public static function getPublicKey()    {        return self::$publicKey;    }    /**     * @param null $publicKey     */    public static function setPublicKey($publicKey)    {        self::$publicKey = $publicKey;    }    /**     * @return null     */    public static function getPayPublicKey()    {        return self::$payPublicKey;    }    /**     * @param null $payPublicKey     */    public static function setPayPublicKey($payPublicKey)    {        self::$payPublicKey = $payPublicKey;    }    /**     * 请求验证     *     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>     *     * @param string $url     * @param string $method     * @param array $params     *     * @return mixed|string     * @throws InvalidRequestException     * @throws \IredCap\Pay\Exception\InvalidParameterException     */    protected static function _request($url = '', $method = 'GET', $params = [])    {        $opts = self::_validateParams($params);        LogUtil::INFO('Create Params :'.json_encode($params));        $respose = new HttpUtil();        return $respose->request($url, $method, $opts, 5);    }    /**     * 参数补全     *     * @author 勇敢的小笨羊 <brianwaring98@gmail.com>     *     * @param $options     *     * @return mixed     * @throws InvalidRequestException     */    private static function _validateParams($options)    {        //参数填充        if (!array_key_exists('mchid', $options)) {            $options['mchid'] = self::getMchId();        }        if (!array_key_exists('return_url', $options)) {            $options['return_url'] = self::getReturnUrl();        }        if (!array_key_exists('notify_url', $options)) {            $options['notify_url'] =self::getNotifyUrl();        }        if (!array_key_exists('client_ip', $options)) {            $options['client_ip'] = $_SERVER['REMOTE_ADDR'];        }        if (empty(self::getPrivateKey())){            throw new InvalidRequestException("The Path of User Private Key can not be blank.");        }        if (empty(self::getPayPublicKey())){            throw new InvalidRequestException("The Path of Platform Public Key can not be blank.");        }        return $options;    }}