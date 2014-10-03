<?
include "header.php";
kcache();


$link = mysql_connect("localhost", "root", "") or die("Could not connect: " . mysql_error());
mysql_select_db("rpg", $link);



if (!logged_in()) {
echo "Please <a href=login.php>log in</a>";
exit;
}
$username = username();

head(1, "Play RPG");

if (!@$_GET["level"]) {
echo "please select a rpg to play!";
} else {
$play = $_GET["level"];
echo "Your default RPG has been changed to '{$play}'. To actually play it, click <a href=rpg.php>here</a>.<br><br>You can resume your other RPGs by clickiing 'browse' and then 'my games'. <br>[ED: well, you cant yet...]";
$call = mysql_query("UPDATE `users` SET `levelname` = '{$play}' WHERE `username` = '{$username}' LIMIT 1 ;", $link);
$call = mysql_query("INSERT INTO `map` ( `username` , `levelname` , `fight` , `xpos` , `ypos` , `kills` , `hp` , `def` , `acc` , `atk` , `spd` , `avitar` , `exp` , `lastpos` ) VALUES ( '{$username}', '{$play}', 'n', '0', '0', '', '5', '1', '1', '1', '1', 'models/bug_laugh.gif', '', 'mofo');", $link);

}
foot(1);
?>

