<?php
include_once 'checkadmin.php';
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
        tr:hover
        {
background-color:gray;
        }
        .trclick1
        {
            background-color:yellow;
        }
        .trclick2
        {
            background-color:white;
        }
    </style>
</head>
<body>
   <div class="main">
       <?php
       include_once('nav.php');
       include_once('conn.php');
    //    include_once('page.php');
    //    $sql="select count(id) as total from info";
    //    $result=mysqli_query($conn,$sql);
    //    $info=mysqli_fetch_array($result);
    //    $total=$info['total'];
    //    $perpage=2;
    //    $page=$_GET['page'] ?? 1;
    //    pageft($total,$perpage);
       $sql="select * from info order by id desc";
       $result=mysqli_query($conn,$sql);
       ?>
       <table border="1" cellspacing="0" cellpadding="10" style="border-collapse:collapse;" align="center" width="70%">
<tr>
    <td>序号</td>
    <td>用户名</td>
    <td>性别</td>
    <td>爱好</td>
    <td>是否为管理员</td>
    <td>操作</td>
</tr>
<?php
$i=1;
while($info=mysqli_fetch_array($result))
{
?>
<tr onclick="if(this.className=='trclick1'){this.className='trclick2'}else{this.className='trclick1'}" class="trclick2">
    <td ><?php echo $i ?></td>
    <td><?php echo $info['username'] ?></td>
    <td><?php echo $info['sex'] ?></td>
    <td><?php echo $info['fav'] ?></td>
    <td><?php echo $info['admin'] ?'是':'否' ?></td>
    <td>
    <a href="modify.php?id=4&username=<?php echo $info['username'] ?>" style="color:red; text-decoration:none; ">修改资料</a>    
    <?php if($info['username']<>'admin')
    {
        ?> <a href="javascript:del(<?php echo $info['id'] ?>,'<?php echo $info['username'] ?>')" style="color:red; text-decoration:none; ">删除会员</a> 
    <?php     
    } 
    else
    {
       echo   '<span style="color:gray;">删除会员</span>';
    }
?>

    <?php if($info['admin'])
    { 
    if($info['username']<>'admin'){
    ?> <a href="setadmin.php?action=0&id=<?php echo $info['id'] ?>
    "style="color:red; text-decoration:none; ">
    取消管理员</a>
    <?php } 
    else { echo '<span style="color:gray;">取消管理员</span>';}
    }
    else { 
        if($info['username']<>'admin'){
        ?> <a href="setadmin.php?action=1&id=<?php echo $info['id'] ?>" 
    style="color:red; text-decoration:none; ">设置管理员</a> <?php }
    else{echo '<span style="color:gray;">取消管理员</span>'; }
        }
    ?> </td>
</tr>
<?php
$i++;
}
?>
       </table>
      
   </div> 
   <script>
    function del(id,name)
    {
if(confirm('你确定删除' + name +'?'))
{
    location.href='del.php?id=' + id +'&username=' + name;
}
    }
   </script>
</body>
</html>