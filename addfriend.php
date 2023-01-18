<?php
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Headers:Content-Type');
header('Access-Control-Allow-Methods:GET,POST');
$sq_userid = $_POST['sq_userid'];
$bsq_userid = $_POST['bsq_userid'];
$connection = new PDO('mysql:host=localhost:3309;dbname=fake_wechat;charset=utf8', 'root', 'root');
if (mysqli_connect_errno()) {
    echo "连接数据库失败：" . mysqli_connect_error();
    $connection = null;
    exit;
}
$createdTime = date('Y-m-d');
// echo '<pre>';
// var_dump($createdTime);
// echo '</pre>';
// $res = $connection->query("select * from usertable where id =  '$bsq_userid' ")->fetchAll(PDO::FETCH_ASSOC);
$res = $connection->query('Insert Into friendlist(sq_userid,bsq_userid,created_time) values ( "'.$sq_userid.'","'.$bsq_userid.'","'.$createdTime.'")');
print_r($res);
$arr =array();
$arr['code'] = '200';
$arr['msg'] = '添加成功';
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
// echo($_POST['name']);