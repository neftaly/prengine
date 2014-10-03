<?

function kcache() {
// kills page caching. dead.
header("Expires: Mon, 1 Jan 1990 05:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
}

function logged_in() {
 if (!@$_COOKIE["login"]) {
 return false;
 }
$user = explode("<", @$_COOKIE["login"]);

$link = mysql_connect("localhost", "root", "") or die("Could not connect: " . mysql_error());
mysql_select_db("rpg", $link);
$username = $user[0];
$cill = mysql_query("SELECT `password` FROM `users` WHERE `username` = '{$username}'", $link);
$plas = mysql_fetch_row($cill);


     if ($user[1] == md5("\n".$plas[0]))
     {
     return true;
     } else {
     return false;
     }
}


function username() {
@$ret = explode("<", @$_COOKIE["login"]);
return @$ret[0];
}

function head($mode, $what) {
// mode = 1 = full headers, 2 = partial headers [for the rpg screen and crap]
// 3 = full headers without password validation, 4 = no val. part headers
// what = message to show on page (eg "account settings")
kcache();
 $username = username();
 if ($mode == 1 || $mode == 2) {
 $link = mysql_connect("localhost", "root", "") or die("Could not connect: " . mysql_error());
 mysql_select_db("rpg", $link);
  if (!logged_in()) {
  echo "Please <a href=login.php>log in</a>";
  exit;
  }
 $call = mysql_query("SELECT `levelname` FROM `users` WHERE `username` = '{$username}'", $link);
 $levelname = mysql_fetch_row($call);
 }

 if (!@$username) {
 $username = " ";
 }

echo "<html><head><title>myrpg</title></head><body>";

 if ($mode == 1 || $mode == 3) { 
 echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr><td width='100%' style='background-image:url(images/bar/backcenter.png); background-repeat: repeat-x; ' valign='top'><table border='0' cellpadding='0' cellspacing='0' width='100%'><tr><td width='1'><img border='0' src='images/bar/side.png' width='1' height='18'></td><td><center><img border='0' src='images/bar/myrpg.png' height='18'></center></td><td width='100%'><div align='left'><table border='0' cellpadding='0' cellspacing='0' width=400 ><tr><td><center><a href=default.php><img border='0' src='images/bar/news.png' height='18' alt='What\'s new'></a></center></td><td><center><a href=login.php><img border='0' src='images/bar/login.png' alt='Login to your account' height='18'></a></center></td><td><center><a href='rpg.php'><img border='0' src='images/bar/play.png' height='18' alt='Get playing! =]'></a></center></td><td><center><a href=browse.php><img border='0' src='images/bar/browse.png' height='18' alt='See other people\'s RPG's'></a></center></td><td><center><a href=make/><img border='0' src='images/bar/editor.png' height='18' alt='Create/edit your own RPG'></a></center></td><td><center><a href=account.php><img border='0' src='images/bar/account.png' height='18' alt='Access your account settings'></a></center></td><td><center><font size=-2>&nbsp;&nbsp;&nbsp;&nbsp;<a href=forum/>[Forum]</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=http://www.topwebgames.com/in.asp?id=2597 target=_blank>[Vote/TWG]</a></font></center></td></tr></table></div></td><td width='1'><img border='0' src='images/bar/side.png' width='1' height='18'></td></tr></table></td></tr></table>";
  if (logged_in()) {
  echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr><td width='100%' align=right><font face='Arial' size='1'>Logged in as \"{$username}\". <a href='login.php?logout=1'>Click to logout</a>&nbsp;&nbsp;</font></td></tr></table>\n";
  }
 echo "<font face=arial><br><table border='0' cellpadding='0' cellspacing='1' width='100%'><tr><td width='20%'><p align='center'><b>{$what}</b></td><td width='80%'>&nbsp;</td></tr><tr><td width='20%'>&nbsp;</td><td width='80%'>\n";
 }
}

function foot($mode) {
// 1 = for full, 2 = for partial
 if ($mode == 1) { 
 echo "\n</td></tr></table></font><center><font face=arial size=1 color=eeeeee><br>Copyright (c) Neftaly \"idiotproof\" Hernandez (2000 - ".date("Y").") | neftaly<script>document.write('@neftaly');</script>.com</font></center>";
 }
echo "\n</body></html>\n";
}
?>
