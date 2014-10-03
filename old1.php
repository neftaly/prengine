<?
include "header.php";

if (!logged_in()) {
echo "Please <a href=login.php target=_parent>log in</a>";
exit;
}
$username = username();

$level = "level";  /////////////////////////////////////////////////////////////

$link = mysql_connect("localhost", "root", "") or die("Could not connect: " . mysql_error());
mysql_select_db("rpg", $link);
$call = mysql_query("SELECT `fight` , `xpos` , `ypos` , `kills` , `hp` , `def` , `acc` , `atk` , `spd` , `avitar` FROM `map` WHERE 1 AND `username` = '".$username."' AND `levelname` = '".$level."' ", $link);
$playa = mysql_fetch_row($call);

// engine data
$self = "1.php"; // or, use $_SERVER['PHP_SELF'] (i stopped using this 'cause it screwed up)
$folder = "images/objects/"; //image folder
$ext = "gif";

// charachter (self) data
$selfstats[0] = $playa[4]; //hp
$selfstats[1] = $playa[5]; //def
$selfstats[2] = $playa[6]; //atk
$selfstats[3] = $playa[7]; //speed
$selfstats[4] = $playa[5]; //accuracy (%)
$selfstats[5] = "100"; //exp////////////////////////////////////////////////////
$avitar = "$folder{$playa[9]}";

error_reporting (E_ALL ^ E_NOTICE); //nessacary to kill 'undefined *' notices in test mode, but allows *other* error displays
header("Expires: Mon, 1 Jan 1990 05:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include "levels/$level.php";

$x = $playa[1]; if ($x == "0") { $x = $spawny; }
$y = $playa[2]; if ($y == "0") { $y = $spawny; }

if (@$levelsel) { $y = $spawny; $x = $spawnx; mysql_query("UPDATE `map` SET `xpos` = '$x', `ypos` = '$y' WHERE `username` = '$username' AND `levelname` = '".level."' ", $link); }

function fight($sprites, $enemydata) {
global $folder, $ext, $self, $selfstats;
$enemyhp = 8;
$fightupdate = "You attack, and take 2 hp off your enemy<br><br>Your enemy attacks, but misses";

echo "<br><table cellpadding=0 cellspacing=0 border=1 style='text-align:center;' align=center><tr><td style='vertical-align:top;font-weight:bold;text-align:center;'>{$sprites[1]}</td>\n";
echo "<td style='vertical-align:top;text-align:center;'>{$enemyhp}/{$enemydata[0]} HP</td></tr>\n";
echo "<tr><td style='vertical-align:top;text-align:center;'><img src='{$folder}{$sprites[0]}.{$ext}' style='width:100px;height:100px;' border=0></td>\n";
echo "<td style='vertical-align:top;width:200px;'>{$fightupdate}</td></tr></table><br>\n\n";
echo "<table cellpadding=0 cellspacing=0 border=1 align=center><tr><td style='vertical-align:top;text-align:center;'>\n";
echo "<a href='$self?move=atk'>Attack</a> <a href='$self?move=def'>Defend</a> <a href='$self?move=b1'>Run</a> <a href='$self?move=inv'>Inventory</a><br>how the heck do you do fights and stuff with d&d rules? email me, idiotproof@paradise.net.nz\n";
echo "</td></tr></table>\n\n";

}

function display($cur) { 
global $c, $r, $coffset, $kcl, $krl, $sprites, $folder, $sz, $ext;
$rc = 1;
$sz = 30;
$pc = ($c * $sz) + $coffset + $kcl;
$pr = ($r * ($sz / 2)) + $krl;
		if ($cur[0]) { 
			echo "<img src='images/textures/".$cur[1].".".$ext."' style='position:absolute;right:$pc;bottom:$pr;' border=0>\n";
		} else {
			echo "<img src='images/textures/-.".$ext."' style='position:absolute;right:$pc;bottom:$pr;' border=0>\n";
		}

		if ($sprites[$cur[2]][2] == "y") { 
			$pra = $pr + 10;
			$pca = $pc + 10;

			echo "<img src='".$folder.$sprites[$cur[2]][0].".".$ext."' style='position:absolute;right:$pca;bottom:$pra;' border=0>\n";  

		} 
$kcl++;
$c--;
if ($c < $rc) { $kcl = 0; $krl++; $c = 13; $r--; echo "\n\n\n"; $coffset = $coffset + 14;};
} 



if (@$_GET["move"]) { 
 
if ($_GET["move"] == "b0"){ 
$cur = explode(".", @$map[$x][$y-1]); 
if (@$cur[0] == "n") {
$y=$y-1;
} }

if ($_GET["move"] == "b1"){ 
$cur = explode(".", @$map[$x][$y+1]); 
if (@$cur[0] == "n") {
$y=$y+1;
} }

if ($_GET["move"] == "a0"){ 
$cur = explode(".", @$map[$x-1][$y]); 
if (@$cur[0] == "n") {
$x=$x-1;
} }

if ($_GET["move"] == "a1"){ 
$cur = explode(".", @$map[$x+1][$y]); 
if (@$cur[0] == "n") {
$x=$x+1;
} }

if ($_GET["move"] == "2b0"){ 
$cur = explode(".", @$map[$x][$y-1]); 
if (@$cur[0] == "n") {
$y=$y-1; 
$cur = explode(".", @$map[$x][$y-1]); 
if (@$cur[0] == "n" && (!$sprites[$cur[2]][2] == "y")) {
$y=$y-1; 
} }
}

if ($_GET["move"] == "2b1"){ 
$cur = explode(".", @$map[$x][$y+1]); 
if (@$cur[0] == "n") {
$y=$y+1; 
$cur = explode(".", @$map[$x][$y+1]); 
if (@$cur[0] == "n" && (!$sprites[$cur[2]][2] == "y")) {
$y=$y+1; 
} }
}

if ($_GET["move"] == "2a0"){ 
$cur = explode(".", @$map[$x-1][$y]); 
if (@$cur[0] == "n") {
$x=$x-1; 
$cur = explode(".", @$map[$x-1][$y]); 
if (@$cur[0] == "n" && (!$sprites[$cur[2]][2] == "y")) {
$x=$x-1; 
} }
}

if ($_GET["move"] == "2a1"){ 
$cur = explode(".", @$map[$x+1][$y]); 
if (@$cur[0] == "n") {
$x=$x+1; 
$cur = explode(".", @$map[$x+1][$y]); 
if (@$cur[0] == "n" && (!$sprites[$cur[2]][2] == "y")) {
$x=$x+1; 
} }
}

mysql_query("UPDATE `map` SET `xpos` = '$x', `ypos` = '$y' WHERE `username` = '$username' AND `levelname` = '".level."' ", $link);
}


echo "<body bgcolor=ffffff text=000000 link=000000 vlink=000000 style='margin: 0px; padding: 0px;'>\n";

$cur = explode(".", $map[$x][$y]);
	if ($sprites[$cur[2]][2] == "y") {
	$executethis = $types[$sprites[$cur[2]][1]][0];
	$executethis = explode (";", $executethis);
	$nocs = count($executethis); // number of commands
if ($nocs > 1) {
$nocs--; //- 1 to kill traling semicolon
		echo "<div style='position:absolute;right:60;bottom:14;'><font size=-2><table style='width:450;height:45;border-style:dashed;border-width:1px' cellspacing=0 cellpadding=0><tr><td><center>\n";

		for ($cno = 0; $cno < $nocs; $cno++) {
		echo " <img src='".$folder.$sprites[$cur[2]][0].".".$ext."' border=0 height=15> ";


		$command = explode ("|", $executethis[$cno]);

			if ($command[0] == "say") {
			echo "{$command[1]}\n";
			}

			if ($command[0] == "attack") {
			//$attacked = 1;
			echo "<b>You are attacked!</b>\n";
			}

			if ($command[0] == "getitem") {
			$exeparts = explode (",",$command[1]);
			echo "Obtained <b>{$exeparts[0]}</b> of <b>'{$exeparts[1]}'</b>\n";
			}
		echo ". ";
		} 
		echo "</center></td></tr></table></font></div>\n\n";
	
	}
}


if ($attacked == 1) {
			$exeparts = explode (",",$command[1]);
			$killdisplay = 1;	fight($sprites[$cur[2]], $exeparts);
}


// cut engine HERE if particular event requires tiles to be hidden
if (!$killdisplay == 1) {



$r = 16;
$c = 13; 
$coffset = 0;
$kcl = 0;
$krl = 0;


for ($currxcell = -6; $currxcell <= 6; $currxcell++) {
	for ($currycell = -6; $currycell <= 6; $currycell++) {
	$cur = explode(".", $map[$x+$currxcell][$y+$currycell]); display($cur);
		if ($currxcell == 0 && $currycell == 0) {
		echo "<img src='$avitar' style='position:absolute;right:313;bottom:164;' border=0>\n";
		}
	}
	echo "\n";
}


error_reporting (E_ALL); 



$cur = explode(".", @$map[$x][$y]); echo "<!-- ({@$x}, {@$y}) - ".@$cur." [".@$cur[0]."] -->";


?>
<div style='position:absolute;right:90;bottom:72;'><img src="images/nav.gif" usemap="#nav" border=0></div> <div><map id="nav" name="nav">
<area shape="poly" coords="0,29,15,29,30,14,15,14" href="<? echo $self; ?>?move=2b0">
<area shape="poly" coords="24,35,16,43,45,43,53,35" href="<? echo $self; ?>?move=2a1">
<area shape="poly" coords="50,8,79,8,87,0,58,0" href="<? echo $self; ?>?move=2a0">
<area shape="poly" coords="73,29,88,14,102,14,87,29" href="<? echo $self; ?>?move=2b1">
<area shape="poly" coords="15,29,30,14,44,14,29,29" href="<? echo $self; ?>?move=b0">
<area shape="poly" coords="24,35,31,28,60,28,53,35" href="<? echo $self; ?>?move=a1">
<area shape="poly" coords="50,8,43,15,72,15,79,8" href="<? echo $self; ?>?move=a0">
<area shape="poly" coords="88,14,73,29,58,29,73,14" href="<? echo $self; ?>?move=b1">
<area shape="poly" coords="44,14,29,29,58,29,73,14" nohref>
<area shape="default" nohref="nohref">
</map></div>
<?
}

?>
