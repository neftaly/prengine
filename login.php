<? 
include "header.php";

if (@$_POST["username"]) {
$link = mysql_connect("localhost", "root", "") or die("Could not connect: " . mysql_error());
mysql_select_db("rpg", $link);
$username = $_POST["username"];
$call = mysql_query("SELECT `password` , `validated` FROM `users` WHERE `username` = '{$username}'", $link);
$playa = mysql_fetch_row($call);
$pass = $playa[0];



if ($pass == $_POST["password"]) {
if ($playa[1] == "n") { 
echo "account not yet validated <a href=http://neftaly.com/create.php?validate=TEMP&username=$username>[click to validate]</a>";
exit;
}
$password = md5("\n".$_POST["password"]);

$ipad = $_SERVER["REMOTE_ADDR"];

setcookie("login", "$username<$password", time()+60*60*24*7*2);
head(3, "Login");
if (!$_POST['whereto']) { $whereto = "default.php"; } else { $whereto = $_POST['whereto']; }
echo "<a href='{$whereto}'>Click here to continue</a>, or wait to be redirected\n<script language=javascript>document.location='{$whereto}'; </script>";
foot(1);
exit;

} else {
head(3, "Login");
$head = 1;
echo "<b>Incorrect username/password</b><br>\n";
}
}

if (@$_GET["logout"] == 1) {
setcookie("login", "");
echo "<b>You were logged out.</b><br>\n<a href=default.php>\Click to continue</a>, or wait to be redirected\n<script language=javascript>document.location = 'default.php';</script>";
exit;
}

if (!@$head == 1) {
head(3, "Login");
}

if (@$username = username()) {
echo "[You are already logged in as {$username}]<br>\n";
}
?>

<form name=login action=login.php method=post>
<input type=hidden name=whereto value='<? $whereto = @$_GET['whereto']; if (@$whereto) { echo $whereto; } else { echo "default.php"; } ?>'>
login name: <input type=text name=username><br>
password: <input type=password name=password><br>
<input type=submit value=login>
</form>Dont already have an account? <a href=create.php>Create one!</a><br><br>
<? foot(1); ?>

