<?php
//连接数据库服务器
//第一步，连接数据库服务器
$conn = mysqli_connect("localhost","root","root","menber");
if(!$conn)
{
	die("连接数据库服务器失败");
}
//第二步，设置字符集
mysqli_query($conn,"set names utf8");