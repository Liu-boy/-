<?php
session_start();//这个必须放在html语句之前

//这里用一个全局变量数组来接受数据$_GET或者$_POST
$username = trim($_POST['username']);
$pw = trim($_POST['pw']);
//进行必要验证
if(!strlen($username)||!($pw))
{
echo "<script>alert('用户名和密码都要填写');history.back();</script>";
exit;	
}
else{
    if(!preg_match('/^[a-zA-Z0-9]{3,10}$/',$username))
    {
        echo "<script>alert('用户名必填，且必须是大小写字母或数字且长度为3~10个字符');history.back()</script>";
        exit;
    }
    if(!preg_match('/^[a-zA-Z0-9_*]{6,10}$/',$pw))
    {
        echo "<script>alert('密码必填，且必须是大小写字母、数字、下划线、*且长度为6~10');history.back()</script>";
        exit;
    }
}
//连接数据库
include_once('conn.php');
$pw1=md5(trim($_POST['pw']));
//sql语句
$sql="select * from info where username = '$username' and password='".md5($pw)."'";
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
if($num==1)
{$_SESSION['loginusername']=$username;
    //判断是不是管理员
    $info=mysqli_fetch_array($result);
    if($info['admin'])
    {
$_SESSION['isadmin']=1;
    }
    else
    {
        $_SESSION['isadmin']=0;
    }
	echo "<script>alert('登录成功');location.href='index.php';</script>";
}
else
{
    unset($_SESSION['isadmin']);
    unset($_SESSION['loginusername']);
    echo "<script>alert('请验证用户名与密码是否正确');history.back();</script>";
}