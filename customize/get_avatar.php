<?php
require("/var/www/html/site/bopimo.php");

if(!$bop->logged_in())
{
	die(header("location: /account/login"));
}

$avatar = $bop->avatar($_SESSION['id']);
?>
<img src="https://bricktaria.com/storagerage//avatars/<?=$avatar->cache?>.png" class="image">
