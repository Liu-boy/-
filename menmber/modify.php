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
       include_once('conn.php');
       $username=$_GET['username'];
       if($username)
       {
        $sql="select * from info where username='$username'";
       }
       else 
       {
       $sql="select * from info where username='".$_SESSION['loginusername']."'";
       }
       $result=mysqli_query($conn,$sql);
       if(mysqli_num_rows($result))
       {
$info=mysqli_fetch_array($result);//返回一个数组
$fav=explode(",", $info['fav']);
       }
       else
       {
        echo "<script>alert('未找到有效用户，请先登录！');location.href='login.php';</script>";
       }
       ?>
       <form action="postmodify.php" method="post" onsubmit=" return check()">
           <table align="center" border="1" style="border-collapse:collapse;"cellpadding="10" cellspseing="0">
               <tr>
                   <td>用户名</td>
                   <td><input type="text" name="username" readonly value="<?php echo $info['username'] ?>"></td>
               </tr>
               <tr>
                   <td>密码</td>
                   <td><input type="password" name="pw" placeholder="不修改密码请留空"></td>
               </tr>
               <tr>
                   <td>确认密码</td>
                   <td><input type="password" name="cpw" placeholder="不修改密码请留空"></td>
               </tr>
               <tr>
                   <td>性别</td>
                   <td><input type="radio" name="sex"<?php if($info['sex']=='男'){?> checked <?php } ?>value="男">男
                       <input type="radio" name="sex" value="女" <?php if($info['sex']=='女'){?> checked <?php } ?>>女
                </td>
               </tr>
               <tr>
                   <td>爱好</td>
                   <td><input type="checkbox" name="fav[]" value="听音乐" <?php if(in_array('听音乐',$fav)){?>checked<?php } ?>>听音乐
                       <input type="checkbox" name="fav[]" value="玩游戏" <?php if(in_array('玩游戏',$fav)){?>checked<?php } ?>>玩游戏
                       <input type="checkbox" name="fav[]" value="踢足球" <?php if(in_array('踢足球',$fav)){?>checked<?php } ?>>踢足球
                  </td>
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
       let pw=document.getElementsByName('pw')[0].value.trim();
       let cpw=document.getElementsByName('cpw')[0].value.trim();
      if(pw.length>0)
      {
        let pwreg=/^[a-zA-Z0-9_*]{6,10}$/
      if(!pwreg.test(pw))
      {
alert('密码必填，且必须是大小写字母、数字、下划线、*且长度为6~10')
return false;
      }
      else
      {
        if(pw!=cpw)
        {
            alert('密码必须与确认密码相同');
            return false;
        }
      }
      return true;
      }
   }
   </script>
</body>
</html>