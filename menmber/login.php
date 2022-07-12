<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会员注册管理系统</title>
    <style>
        .main
        {
            width: 80%;
            margin: 0 auto;
            text-align:center;
        }
        h2
        {
          font-size:23px;  
        }
        h2 a
        {
            color:navy;
            text-decoration:none;
            margin-right:15px ;
        }
        h2 a:last-child
        {
            margin-right: 0;
        }
        h2 a:hover
        {
            color:blue;
            text-decoration:underline;
        }
    </style>
</head>
<body>
   <div class="main">
   <?php
       include_once('nav.php');
       ?>
       <form action="postlogin.php" method="post" onsubmit="return check()">
           <table align="center" border="1" style="border-collapse:collapse;"cellpadding="10" cellspseing="0">
               <tr>
                   <td>用户名</td>
                   <td><input type="text" name="username"></td>
               </tr>
               <tr>
                   <td>密码</td>
                   <td><input type="password" name="pw"></td>
               </tr>
               <tr>
                   <td>
                       <input type="submit" value="提交">
                       <input type="reset" value="重置">
                   </td>
               </tr>
           </table>
       </form>
   </div> 
   <script>
   function check(){
	   let username=document.getElementsByName('username')[0].value.trim();
       let pw=document.getElementsByName('pw')[0].value.trim();
      let usernameReg=/^[a-zA-Z0-9]{3,10}$/;
      if(!usernameReg.test(username))
      {
alert('用户名必填，且必须是大小写字母或数字且长度为3~10个字符');
return false;
      }
      let pwreg=/^[a-zA-Z0-9_*]{6,10}$/
      if(!pwreg.test(pw))
      {
alert('密码必填，且必须是大小写字母、数字、下划线、*且长度为6~10')
return false;
      }
      return true;
   }
   </script>
</body>
</html>