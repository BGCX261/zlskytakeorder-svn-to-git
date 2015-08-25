<?php
@exec("ipconfig /all",$array);
for($Tmpa;$Tmpa<count($array);$Tmpa++){
if(eregi("Physical",$array[$Tmpa])){
$mac=explode(":",$array[$Tmpa]);
echo $mac[1];
}
}
?>
