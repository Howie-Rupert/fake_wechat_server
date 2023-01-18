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
$res = $connection->prepare("select * from usertable where username =  '$name' ");
$res->execute();
$result = $res->fetchAll(PDO::FETCH_ASSOC);
if (sizeof($result) == 0) {
    $res = $connection->prepare('insert into usertable(username,password) values (  "' . $name . '"  ,  "' . $pass . '"  )');
    $res->execute();
    $code = $res->errorCode();
    if ($code === '00000') {
        $arr = array();
        $arr['code'] = '200';
        $arr['msg'] = '注册成功';
        exit(json_encode($arr));
    } else {
        $msg = $res->errorInfo();
        $arr = array();
        $arr['code'] = '501';
        $arr['msg'] = $msg;
        exit(json_encode($arr));
    }
} else {
    $arr = array();
    $arr['code'] = '500';
    $arr['msg'] = '用户名重复';
    exit(json_encode($arr));
}
// $res = $connection->prepare("insert into usertable(username,password) values (" . $name . "," . $pass . ")");
// $res->execute();
// $code = $res->errorInfo();
// var_dump ($code);

// if($pass == $res[0]['password']){
//     $arr = array();
//     $arr['code'] = '200';
//     $arr['msg'] = '登陆成功';
//     $arr['nickname'] = $res[0]['nickname'];
//     $arr['usericon'] = $res[0]['usericon'];
//     exit(json_encode($arr));
// }else{
//     exit(json_encode($res));
// }