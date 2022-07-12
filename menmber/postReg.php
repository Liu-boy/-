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
if($pw<>$cpw)
{
	echo "<script>alert('密码与确认密码不一致');history.back();</script>";
exit;
}
//判断用户名是否重复
$sql = "select * from info where username='$username'";
$result = mysqli_query($conn,$sql);//返回一个记录集
$num=mysqli_num_rows($result);
if($num)
{
	echo "<script>alert('此用户名已经被占用，请重新输入');history.back();</script>";
exit;
}
//sql语句
$sql = "insert into info (username,password,sex,fav,createtime) values
('$username','".md5($pw)."','$sex','$fav','".time()."')";
$result = mysqli_query($conn,$sql);
if($result)
{
	echo "<script>alert('数据插入成功');location.href='index.php';</script>";
}
else
{
	echo "<script>alert('数据插入失败');history.back();</script>";
}

