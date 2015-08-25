 <?php
include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/ajax_page.inc.php';
$data=new DBSQL();

if($_GET['action']=='add'){
$title=$_GET['title'];


$context=$_GET['context'];
$context = preg_replace( "/\[Y\](.+?)\[\/\Y\]/" , "<img src=images/\\1.gif>", $context );
$context=ereg_replace("'","\'",$context);
$time=date("Y-m-d");
$sql="insert into coment(title,context,time) values('$title','$context','$time')";
$data->insert($sql);
}

if($_GET['action']=='rq'){
$title=$_GET['title'];
$context=$_GET['context'];
$time=date("Y-m-d");
$id=$_GET['id'];
$qsql="select context from coment where id=$id";
$nw=$data->select($qsql);
$oldcon=$nw[0][0];
$context="<div class=newarticle>".$oldcon."</div>".$context;
$context = preg_replace( "/\[Y\](.+?)\[\/\Y\]/" , "<img src=images/\\1.gif>", $context );
$context=ereg_replace("'","\'",$context);
$sql="insert into coment(title,context,time) values('$title','$context','$time')";
$data->insert($sql);
}



if($_GET['action']=='show'){
$id=$_GET['id'];
$smarty->assign('id',$id);
$smarty->display("text.htm");


}

if($_GET['action']=='image'){
$id=$_GET['id'];
for($i=1;$i<=count($imagearray);$i++){
$str.="<a href='javascript:void(0)' onclick=setallimage('$i,$id')>".$imagearray[$i]."</a>";
}
echo $str;

}

?>