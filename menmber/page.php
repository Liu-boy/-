<?php
//为了避免重复包含文件，加了判断函数是否存在
if(!function_exists('pageft'))
{
    //定义pageft()函数,其三个参数为：
    //$total:信息总数
    //$displayPG:每页显示信息数，这里默认为20
    //$url:分页导航中的链接，除了加入不同查询信息"page"外的部分都与这个URL相同
function pageft($total,$realTotal,$displayPG=20,$url=''){
//定义几个全局变量：
//$page:当前页码
//$firstCount:（数据库）查询的起始页
//$pageNav:页面导航代码，函数内并没有将它输出
//$_SERVER:读取本页URL"$_SERVER[REQUEST_URI]"所必须
global $page,$firstCount,$pageNav,$_SERVER;
//为了使函数外部访问这里的"$displayPG",将它也设为全局变量
$GLOBALS["$displayPG"]=$displayPG;
$page=$_GET['page'] ?? 1;
//如果$url使用默认既是空值，则赋值为本页的URL
if(!$url)
{
$url=$_SERVER["REUUEST_URI"];
}
$parse_url=parse_url($url);
$url_query=$parse_url['query'] ?? '';
if($url_query)
{
$url_query=preg_replace("/(^|&)page=$page/","",$url_query);
$url=str_replace($parse_url["query"],$url_query,$url);
if($url_query) $url.='&page';else $url.="page";
}
else{
    $url.="?page";
}
$laspg=ceil($total/$displayPG);
$page=min($laspg,$page);
$prepg=$page-1;
$nextpg=($page==$laspg ? 0 : $page+1);
$firstCount=($page-1)*$displayPG;
//开始分页导航代码
$pageNav="第<B>".($total?($firstCount+1):0)."</B>-<B>".min($firstCount+$displayPG,$total)."</B> 条,共<B> $realToal</B>条记录";
if($laspg<=1) return false;
$pageNav.="<a href=$url=1 mce_href=$url=1>首页</a>";
if($prepg) $pageNav.="<a href=$url=$prepg mce_href=$url=$prege>上页</a>"; else $pageNav.="上页";
if($nextpg) $pageNav.="<a href=$url=$nextpg mce_href=$url=$nextpg>下页</a>"; else $pageNav.="下页";
$pageNav.="<a href=$url=$laspg mce_href=$url=$laspg>尾页</a>";
$pageNav.="到第 <select name='topage' size='1' stytle='font-size:12px' mce_stytle='font-size: 12px' onchange='window.location=\"$url=\"+this.value'>\n";
for($i=1;$i<=$laspg;$i++)
{if($i==$page) $pageNav.="<option value='$i' selected>$i</option>\n";
else $pageNav.="<option value='$i'>$i</option>\n";
}
$pageNav.="</select> 页,共 $laspg 页";
}
    }
?>