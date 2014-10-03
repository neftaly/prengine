<? 
include "header.php";
head(1, "Browse RPG's");
$link = mysql_connect("localhost", "root", "") or die("Could not connect: " . mysql_error());
echo "<table border='1' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' bgcolor='#111111'><tr><td width='100%'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' bgcolor='#FFFF99'><tr><td width='50%'>&nbsp;<font face='Arial'> &#9679;</font>&nbsp;&nbsp; &quot;MP Test&quot;</td><td width='50%'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%'><tr><td width='50%' height='18'></td><td width='50%' height='18'></td></tr></table></td></tr></table></td></tr><tr><td width='100%'><table border='0' cellpadding='0' cellspacing='1' style='border-collapse: collapse' bordercolor='#808080' width='100%' bgcolor='#CCCCCC'><tr><td width='100%' height='18'>Multiplayer TEST</tr></table><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' height='1'><tr><td width='100%'></td></tr></table><table border='0' cellpadding='0' cellspacing='1' style='border-collapse: collapse' bordercolor='#111111' width='100%' bgcolor='#999999' onMouseOut='this.style.backgroundColor = \"#999999\"; ' onMouseOver='this.style.backgroundColor = \"#333333\"; '><tr><td width='100%'><a style='text-decoration:none;color=#000000;' href='mp'><div width=100% height=100%><center>Play</center></div></a></td></tr></table></td></tr></table><br>\n";
$call = mysql_query("SELECT * FROM `levels` ORDER BY `popularity` ASC , `rating` ASC LIMIT 0 , 100", $link);
$playa = mysql_fetch_row($call);
while (@$playa) {
$playa[0] = str_replace("<", "&lt;", $playa[0]);
$playa[0] = str_replace(">", "&gt;", $playa[0]);
$name = $playa [0];
$user = $playa [1];
$popularity = $playa[2];
$playa[3] = str_replace("<", "&lt;", $playa[3]);
$playa[3] = str_replace(">", "&gt;", $playa[3]);
$description = str_replace("\n", "<br>", $playa[3]);
$type = $playa[4];
echo "<table border='1' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' bgcolor='#111111'><tr><td width='100%'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' bgcolor='#FFFF99'><tr><td width='50%'>&nbsp;<font face='Arial'> &#9679;</font>&nbsp;&nbsp; &quot;{$name}&quot; - {$user}</td><td width='50%'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%'><tr><td width='50%' height='18'>Popularity: {$popularity}</td><td width='50%' height='18'>{$type}%</td></tr></table></td></tr></table></td></tr><tr><td width='100%'><table border='0' cellpadding='0' cellspacing='1' style='border-collapse: collapse' bordercolor='#808080' width='100%' bgcolor='#CCCCCC'><tr><td width='100%' height='18'>{$description}</tr></table><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' height='1'><tr><td width='100%'></td></tr></table><table border='0' cellpadding='0' cellspacing='1' style='border-collapse: collapse' bordercolor='#111111' width='100%' bgcolor='#999999' onMouseOut='this.style.backgroundColor = \"#999999\"; ' onMouseOver='this.style.backgroundColor = \"#333333\"; '><tr><td width='100%'><a style='text-decoration:none;color=#000000;' href='play.php?level={$name}'><div width=100% height=100%><center>Play</center></div></a></td></tr></table></td></tr></table><br>\n";
$playa = mysql_fetch_row($call);
}

?>
<br>0 - 100
<? foot(1); ?>