<?php
include_once 'blogheader.php';
include_once 'login.php';
include_once 'functions.php';

if (!isset($_SESSION['prenom'])) die ("please login to view this page");

$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die ("Cannot connect to database server" . mysql_error());
mysql_select_db('users', $db_server) or die ("unable to open database");

echo <<<_END
<div class='notheader'>
<h2>Existing Blogs <span class='parens'>(sort by: <a href=
'bloghome.php?sort=time'>Most Recent</a> | <a href='bloghome.php?sort=pop'>
Most Popular</a>)</span></h2>
_END;

if (isset($_GET['sort'])){
	if ($_GET['sort'] == "time"){
		$result = mysql_query("SELECT * FROM allblogs ORDER BY 
		id DESC");
	}
	if ($_GET['sort'] =="pop"){
		$result = mysql_query("SELECT * FROM allblogs ORDER BY 
		followerscount DESC");
	}
}
else {
	$result = mysql_query("SELECT * FROM allblogs ORDER BY id DESC");
}
for ($i = 0; $i < mysql_num_rows($result); $i++){
	$row = mysql_fetch_row($result);
	echo "<p class='profile'><a class='plainbody' 
	href='blog.php'>$row[0]</a> - $row[2] ($row[4])
	</p>";
}
echo "</div>";
?>