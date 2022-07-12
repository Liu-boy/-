<?php
session_start();//打开会话
session_destroy();//销毁所有会话记录
header("Location:index.php");//进行跳转到首页