<?php


mysql_connect("localhost","ipintooc","Harvard41##");
mysql_select_db("ipintooc_main");



$username=mysql_real_escape_string($_POST['username']);
$SQL="select username FROM `users` WHERE `username` = '".$username."'";

    
echo $res =  mysql_num_rows(mysql_query($SQL));






