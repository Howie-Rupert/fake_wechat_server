<?php
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Headers:Content-Type');
header('Access-Control-Allow-Methods:GET,POST');

$connection = new PDO('mysql:host=localhost:3309;dbname=fake_wechat;charset=utf8', 'root', 'root');
if (mysqli_connect_errno()) {
    echo "连接数据库失败：" . mysqli_connect_error();
    $connection = null;
    exit;
}
if ($_POST['userid']) {
    $userid = $_POST['userid'];
    $res = $connection->query("select * from usertable where id =  '$userid' ")->fetchAll(PDO::FETCH_ASSOC);
    $arr = array();
    $arr['code'] = '200';
    $arr['msg'] = '搜索成功';
    $arr['data'] = $res;
    exit(json_encode($arr));
}else if($_POST['nickname']){
    $nickname = $_POST['nickname'];
    $res = $connection->query("select * from usertable where nickname like '".'%'."".$nickname."".'%'."'")->fetchAll(PDO::FETCH_ASSOC);
    $arr = array();
    $arr['code'] = '200';
    $arr['msg'] = '搜索成功';
    $arr['data'] = $res;
    exit(json_encode($arr));
}
