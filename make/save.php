<? 
include "../header.php"; kcache(); 

if (@$_GET["resize"] == 1) {
if (!(@$_GET["x"] && @$_GET["y"] && @$_GET["resmode"])) {
echo "missing varible!";
exit;
}
}



reset ($_POST); $row = 0; $col = 0; $bsyet=0; $obid=1;
$thisrow=0;
while (list ($key, $val) = each ($_POST)) {
$key = str_replace("\"", "", $key);
$val = str_replace("\"", "", $val);
$kes = @$kez;
$kez = explode("f", $key); 
$kex[1] = $kez[0]{0}; $kex[0] = str_replace($kex[1], "", $kez[0]); // (a) find, and (b) delete first charachter
if ($kex[1] == "b" && $bsyet==0) { $row=0; $bsyet=1; }
if (@$kez[1] != @$kes[1] && $row > 0 && $kex[1] == "t") { $texmex=@$texmex." ), \n"; $thisrow=0;}
if (@$kez[1] != @$kes[1]) { $row++; $col = 1; if ($kex[1] == "t") { $texmex=@$texmex."{$row} => array (1 => "; } } 
if ($kex[1] == "t") { $texmex=@$texmex."\"n.$val."; $thisrow++; }

if ($kex[1] == "o") {
if ($val == "-") { 
$texmex=@$texmex."\","; 
} else { 
$texmex=@$texmex."{$obid}\","; 
$obxmex=@$obxmex."{$obid} => array ( \"{$val}\", 1),\n";
$obid++; 
} 
} 




if ($kex[1] == "o") { $col++; }
if ($kex[1] == "b") { $col++; }
}

if (!@$texmex) { echo "no data!"; exit; }
$texmex="\n\$map = array (\n".$texmex." ), \n); \n";
$obxmex="\n\$sprites = array (\n".@$obxmex."); \n";
$texmex = str_replace(".gif", "", $texmex); // fix this up lata
$obxmex = str_replace(".gif", "", $obxmex); // fix this up lata


$mapdata="<?\n\$levelname = \"MAP_".username()."\"; \$spawnx = 1; \$spawny = 1;\n{$texmex}{$obxmex}\n?>";

if (!logged_in()) {
echo "You appear to be logged out. CRAP... <b>You MUST copy the folowing and save it in a text editor</b>, else you will forever loose these changes. <br><textarea rows=30 cols=100>".str_replace("<", "&lt;", $mapdata)."</textarea>\n";
exit;
} else {

$fpx = fopen("../levels/MAP_".username().".php","w");
fputs($fpx, $mapdata);
fclose($fpx);

$link = mysql_connect("localhost", "root", "") or die("Could not connect: " . mysql_error());
mysql_select_db("rpg", $link);
@mysql_query("INSERT INTO `levels` ( `name` , `username` , `popularity` , `description` , `rating` ) VALUES ( 'MAP_".username()."', '".username()."', '1', 'User-made RPG map', '50');", $link);

echo "<b>Map saved</b><pre>".str_replace("<", "&lt;", $mapdata)."</pre>";
}

?>
<br><a href="../play.php?level=MAP_<? echo username(); ?>">Play this map!</a>