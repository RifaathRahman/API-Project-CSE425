<?php

<?php

session_start();
session_unset();
session_destroy();
header('Location: index.php'); // Redirect to your login page or homepage
exit;


session_start();

if(isset($_SESSION['pigeon_userid']))
{
	$_SESSION['pigeon_userid'] = NULL;
	unset($_SESSION['pigeon_userid']);
}	


header("Location: login.php");
die;