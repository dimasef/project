<?php
session_start();
$username = $_POST[username];
$password = $_POST[password];
$conn = mysql_connect('localhost','solar','test_pass') 
or die ("Ooops something went wrong! <br>".mysql_error());
mysql_select_db('solar_system',$conn);
$querry = "SELECT login,password,access_level FROM users WHERE login=\"$username\"";
$res1 = mysql_query($querry);
$row = mysql_fetch_array($res1);
if ($res1=""||$row[password]!=md5(md5($password)+"kovalyk_ischadie_ada"))
 {
  //header("Refresh: 2;  url=..\main.php");
  //echo "Wrong Login/Password";
 	$_SESSION['err']=1;
 	echo "<script>history.go(-1);</script>";
 	//header("Location: main.php");
 }
 else 
 {
 	$_SESSION['log']=$username;
    $_SESSION['ac_lvl']=$row[access_level];
    if ($_SESSION['page']=="reg")
    {
    	unset($_SESSION['page']);
    	header("Location: main.php");
    }
    else 
    echo "<script>history.go(-1);</script>";
 }
?>