<?php
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Headers:Content-Type');
header('Access-Control-Allow-Methods:GET,POST');
$name = $_POST['username'];
$pass = $_POST['userpass'];
$connection = new PDO('mysql:host=localhost:3309;dbname=fake_wechat;charset=utf8', 'root', 'root');
if (mysqli_connect_errno()) {
    echo "连接数据库失败：" . mysqli_connect_error();
    $connection = null;
    exit;
}
$res = $connection->query("select * from usertable where username =  '$name' ")->fetchAll(PDO::FETCH_ASSOC);
if($pass == $res[0]['password']){
    $arr = array();
    $arr['code'] = '200';
    $arr['msg'] = '登陆成功';
    $arr['nickname'] = $res[0]['nickname'];
    $arr['usericon'] = $res[0]['usericon'];
    exit(json_encode($arr));
}else{
    exit(json_encode($res));
}
// echo($_POST['name']);