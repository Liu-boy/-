<?php
session_start();
//首先判断是不是管理员
if(!(isset($_SESSION['isadmin'])&&$_SESSION['isadmin']))
{
    echo "<script>alert('请你以管理员身份登入');location.href='login.php'</script>";
exit;
}
?>