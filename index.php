<?php
header("Access-Control-Allow-Origin:*");
header('Content-Type:application/json; charset=utf-8;');
function connectDb()
{
    $connection = new PDO('mysql:host=localhost:3309;dbname=fake_wechat;charset=utf8', 'root', 'root');
    if (mysqli_connect_errno()) {
        echo "连接数据库失败：" . mysqli_connect_error();
        $connection = null;
        exit;
    }
    $res = $connection->query("select * from usertable")->fetchAll(PDO::FETCH_ASSOC);
    exit(json_encode($res));
}
connectDb();
