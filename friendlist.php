<?php
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Headers:Content-Type');
header('Access-Control-Allow-Methods:GET,POST');
$userid = $_GET['userid'];
$connection = new PDO('mysql:host=localhost:3309;dbname=fake_wechat;charset=utf8', 'root', 'root');
if (mysqli_connect_errno()) {
    echo "连接数据库失败：" . mysqli_connect_error();
    $connection = null;
    exit;
}
$res = $connection->query("select * from friendlist where (sq_userid =  '$userid' or bsq_userid = '$userid') and is_agree = 1 ")->fetchAll(PDO::FETCH_ASSOC);
$arr = array();
$arr['code'] = '200';
$arr['msg'] = '查询成功';
$arr['data'] = $res;
exit(json_encode($arr));

// echo($_POST['name']);