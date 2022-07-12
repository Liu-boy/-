

<style>
    td
    {
        font-size:larger;
    }
    body
    {
        background-image:url(./image/4.jpg);
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: cover;
    }
       .logged{
font-size:16px;
color: gray;
        }
        .logout a
        {
            font-size:16px;
color: green;
text-decoration:none;
        }
        .current
        {
            color:red;
        }
        .nocurrent
        {
            color:black;
        }
</style>
<h1>会员注册管理系统</h1>
       <?php
       if(isset($_SESSION['loginusername'])&&$_SESSION['loginusername']<>'')
       {
?>
<div class="logged">当前登录者：<?php echo $_SESSION['loginusername'];?><?php if($_SESSION['isadmin']) { ?><span style="color:red;">(欢迎管理员登录)</span><?php } ?>
    <span class="logout"><a href="logout.php">注销</a></span>
       </div>
<?php
       }
       $id=isset($_GET['id']) ? $_GET['id'] : 1;
       ?>
       <h2>
           <a href="index.php?id=1" <?php if($id==1){?>class="current"<?php } else{?>class="nocurrent"<?php } ?> style="text-decoration:none;">首页</a>
           <a href="signup.php?id=2" <?php if($id==2){?>class="current"<?php } else{?>class="nocurrent"<?php } ?> style="text-decoration:none;">会员注册</a>
           <a href="login.php?id=3" <?php if($id==3){?>class="current"<?php } else{?>class="nocurrent"<?php } ?> style="text-decoration:none;">会员登录</a>
           <a href="modify.php?id=4" <?php if($id==4){?>class="current"<?php } else{?>class="nocurrent"<?php } ?> style="text-decoration:none;">个人资料修改</a>
           <a href="admin.php?id=5" <?php if($id==5){?>class="current"<?php } else{?>class="nocurrent"<?php } ?> style="text-decoration:none;">后台管理</a>
       </h2>