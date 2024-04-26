<?php
error_reporting(0);
header("Content-Type:application/json;charset=utf-8");
//https://www.yangshipin.cn/#/tv/home?pid=600001859
function getsjs($length=10){
    $characters='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string='';
    for($i=0;$i<$length;$i++){
        $string.=$characters[rand(0,strlen($characters)-1)];
    }
    return substr(sha1($string),0,$length);
}
function cj_url($url,$hdr,$ck,$data){
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    if($hdr!="") curl_setopt($ch,CURLOPT_HTTPHEADER,$hdr);
    if($ck!="") curl_setopt($ch,CURLOPT_COOKIE,$ck);
    if($data!="") curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    $cj_tempz=curl_exec($ch);
    curl_close($ch);
    return $cj_tempz;
}
$id=isset($_GET['id'])?$_GET['id']:'cctv1';
$n=[
    //央视
    'cctv4k' => 2022575203, //cccv-4k
    'cctv8k' => 2020603421, //cccv-8k
    'cctv1' => 2022576803, //cccv1
    'cctv2' => 2022576703, //cccv2
    'cctv3' => 2022576503, //cccv3(vip)
    'cctv4' => 2022576603, //cccv4
    'cctv5' => 2022576403, //cccv5
    'cctv5p' => 2022576303, //cccv5+
    'cctv6' => 2022574303, //cccv6(vip)
    'cctv6hd' => 2013693901, //cccv6(vip)
    'cctv7' => 2022576203, //cccv7
    'cctv8' => 2022576103, //cccv8(vip)
    'cctv9' => 2022576003, //cccv9
    'cctv10' => 2022573003, //CCTV10
    'cctv11' => 2022575903, //CCTV11
    'cctv12' => 2022575803, //CCTV12
    'cctv13' => 2022575703, //CCTV13
    'cctv14' => 2022575603, //CCTV14
    'cctv15' => 2022575503, //CCTV15
    'cctv16' => 2022575403, //CCTV16
    'cctv16-4k' => 2022575103, //CCTV16-4k(vip)
    'cctv17' => 2022575303, //CCTV17
    //央视数字
    'bqkj' => 2012513403, //CCTV兵器科技(vip)
    'dyjc' => 2012514403, //CCTV第一剧场(vip)
    'hjjc' => 2012511203, //CCTV怀旧剧场(vip)
    'fyjc' => 2012513603, //CCTV风云剧场(vip)
    'fyyy' => 2012514103, //CCTV风云音乐(vip)
    'fyzq' => 2012514203, //CCTV风云足球(vip)
    'dszn' => 2012514003, //CCTV电视指南(vip)
    'nxss' => 2012513903, //CCTV女性时尚(vip)
    'whjp' => 2012513803, //CCTV央视文化精品(vip)
    'sjdl' => 2012513303, //CCTV世界地理(vip)
    'gefwq' => 2012512503, //CCTV高尔夫网球(vip)
    'ystq' => 2012513703, //CCTV央视台球(vip)
    'wsjk' => 2012513503, //CCTV卫生健康(vip)
    //央视国际
    'cgtn' => 2022575001, //CGTN
    'cgtnjl' => 2022574703, //CGTN纪录
    'cgtne' => 2022571703, //CGTN西语
    'cgtnf' => 2022574903, //CGTN法语
    'cgtna' => 2022574603, //CGTN阿语
    'cgtnr' => 2022574803, //CGTN俄语
    //教育
    'cetv1' => 2022823801, //教育1台
    //卫视
    'bjws' => 2000272103, //北京卫视
    'dfws' => 2000292403, //东方卫视
    'tjws' => 2019927003, //天津卫视
    'cqws' => 2000297803, //重庆卫视
    'hljws' => 2000293903, //黑龙江卫视
    'lnws' => 2000281303, //辽宁卫视
    'hbws' => 2000293403, //河北卫视
    'sdws' => 2000294803, //山东卫视
    'ahws' => 2000298003, //安徽卫视
    'hnws' => 2000296103, //河南卫视
    'hubws' => 2000294503, //湖北卫视
    'hunws' => 2000296203, //湖南卫视
    'jxws' => 2000294103, //江西卫视
    'jsws' => 2000295603, //江苏卫视
    'zjws' => 2000295503, //浙江卫视
    'dnws' => 2000292503, //东南卫视
    'gdws' => 2000292703, //广东卫视
    'szws' => 2000292203, //深圳卫视
    'gxws' => 2000294203, //广西卫视
    'gzws' => 2000293303, //贵州卫视
    'scws' => 2000295003, //四川卫视
    'xjws' => 2019927403, //新疆卫视
    'hinws' => 2000291503, //海南卫视
    'btws' => 2022606701,  // 兵团卫视
];
$a_id=$n[$id];
if($a_id=="") die("404");
$rand=getsjs(10);
$guid=getsjs(8)."_".getsjs(11);
$hdr=["Referer:https://www.yangshipin.cn","Cookie:guid=$guid;versionCode=999999;platformVersion=Chrome;deviceModel=122;vplatform=109;","Yspappid:519748109"];
$auth="appid=ysp_pc&guid=".$guid."&pid=0&rand_str=".$rand;
$auth=$auth."&signature=".md5($auth.'Q0uVOpuUpXTOUwRn');
$token=cj_url("https://player-api.yangshipin.cn/v1/player/auth",$hdr,"",$auth);
$token=json_decode($token);
$token=$token->data->token;
if($token=="") die("404");
$salt='0f$IVHi9Qno?G';
$platform="5910204";
$key=hex2bin("48e5918a74ae21c972b90cce8af6c8be");
$iv=hex2bin("9a7e7d23610266b1d9fbf98581384d92");
$t=time();
$el="|{$a_id}|{$t}|mg3c3b04ba|V1.0.0|{$guid}|{$platform}|www.yangshipin.cn|mozilla/5.0|Mozilla|Netscape|Win32|";
$len=strlen($el);
$xl=0;
for($i=0;$i<$len;$i++){
    $xl=($xl<<5)-$xl+ord($el[$i]);
    $xl&= $xl&0xFFFFFFFF;
}
$xl=($xl>2147483648)?$xl-4294967296:$xl;
$el='|'.$xl.$el;
$ckey="--01".strtoupper(bin2hex(openssl_encrypt($el,"AES-128-CBC",$key,1,$iv)));
$params=["adjust"=>1,"appVer"=>"V1.0.0","app_version"=>"V1.0.0","cKey"=>"{$ckey}","channel"=>"ysp_tx","cmd"=>"2","cnlid"=>"{$a_id}","defn"=>"fhd","devid"=>"devid","dtype"=>"1","encryptVer"=>"8.1","guid"=>$guid,"otype"=>"ojson","platform"=>"{$platform}","rand_str"=>"{$rand}","sphttps"=>"1","stream"=>"2"];
$sign=md5(http_build_query($params).$salt);
$params["signature"]=$sign;
$postdata=json_encode($params);
$hdr=["Content-Type: application/json","Referer:https://www.yangshipin.cn","Cookie: guid={$guid};versionCode=999999;vplatform=109;platformVersion=Chrome;deviceModel=114","Yspappid: 519748109","Yspplayertoken: {$token}"];
$data=cj_url("https://player-api.yangshipin.cn/v1/player/get_live_info",$hdr,"",$postdata);
$data=json_decode($data);
$purl=$data->data->playurl;
if($purl=="") die("404");
$m3u8=cj_url($purl,"","","");
$m3u8=preg_replace("/(.*?.ts)/",dirname($purl)."/$1",$m3u8);
header('Content-Type:application/vnd.apple.mpegurl');
die($m3u8);
?>