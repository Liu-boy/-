<?php
//这里用一个全局变量数组来接受数据$_GET或者$_POST
$username = trim($_POST['username']);
$pw = trim($_POST['pw']);
$cpw = trim($_POST['cpw']);
$sex = $_POST['sex'];
$fav = implode(",",$_POST['fav']);
echo "你输入的用户名是：".$username."<br>";
echo "您输入的密码是：".$pw."<br>";
echo "您输入的确认密码是：".$cpw."<br>";
echo "您输入的性别是：".$sex."<br>";
echo "你的爱好是：".implode(",",$fav)."<br>";
include_once('conn.php');
//进行必要验证
if(!empty($pw))
{
    if(!preg_match('/^[a-zA-Z0-9_*]{6,10}$/',$pw)){
        echo "<script>alert('密码必填，且必须是大小写字母、数字、下划线、*且长度为6~10');history.back()</script>";
        exit;
    if($pw<>$cpw)
        echo "<script>alert('密码与确认密码不一致');history.back();</script>";
    exit;  
    }
}
if($pw)
    {
    $sql="update info set password='".md5($pw)."',sex='$sex',fav='$fav' where username='$username'";
    $url='logout.php';
    // }
}
else{
    $sql="update info set sex='$sex',fav='$fav' where username='$username'";
    $url='index.php';
}
$result=mysqli_query($conn,$sql);
if($result)
{
echo "<script>alert('跟新资料成功！'); location.href='$url'</script>";
}
else
{
    echo "<script>alert('跟新资料失败！'); history.back();</script>";
}