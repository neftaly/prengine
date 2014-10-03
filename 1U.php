<?
include "header.php";

if (!logged_in()) {
echo "alert('logged out!');\n";
exit;
}


if (!@$_GET['mmoo']) { exit; }


$username = username();


$link = mysql_connect("localhost", "root", "") or die("Could not connect: " . mysql_error());
mysql_select_db("rpg", $link);

$level = mysql_fetch_row(mysql_query("SELECT `levelname` FROM `users` WHERE 1 AND `username` = '{$username}'", $link));
$level = $level[0];

$call = mysql_query("SELECT `fight` , `xpos` , `ypos` , `kills` , `hp` , `def` , `acc` , `atk` , `spd` , `avitar` FROM `map` WHERE 1 AND `username` = '".$username."' AND `levelname` = '".$level."' ", $link);
$playa = mysql_fetch_row($call);

// engine constants
$folder = "images/objects/"; //image folder
$ext = "png";

error_reporting (E_ALL ^ E_NOTICE); //nessacary to kill 'undefined *' notices in test mode, but allows *other* error displays

if ($_GET["sta"]) { $sta = $_GET["sta"]; } else { $sta = 0; }

kcache();

include "levels/{$level}.php";

echo "<script>";
$y = $playa[1]; if ($y == "0") { $y = $spawny; }
$x = $playa[2]; if ($x == "0") { $x = $spawny; }


$lag = @$_GET['lag'];
$mdir = @$_GET['mdir'];
$mamt = @$_GET['mamt'];
$mmoo = @$_GET['mmoo'];

$sx = $x;
$sy = $y;

if (@$mdir) { 
 
if (@$mdir == "l"){ 
$cur = explode(".", @$map[$y][$x-1]); 
if (@$cur[0] == "n") {
$x=$x-1;
} }

if (@$mdir == "r"){ 
$cur = explode(".", @$map[$y][$x+1]); 
if (@$cur[0] == "n") {
$x=$x+1;
} }

if (@$mdir == "u"){ 
$cur = explode(".", @$map[$y-1][$x]); 
if (@$cur[0] == "n") {
$y=$y-1;
} }

if (@$mdir == "d"){ 
$cur = explode(".", @$map[$y+1][$x]); 
if (@$cur[0] == "n") {
$y=$y+1;
} }

mysql_query("UPDATE `map` SET `xpos` = '$y', `ypos` = '$x' WHERE `username` = '$username' AND `levelname` = '".$level."' ", $link);
}

if (@$levelsel) { $x = $spawny; $y = $spawnx; mysql_query("UPDATE `map` SET `xpos` = '$y', `ypos` = '$x' WHERE `username` = '$username' AND `levelname` = '".level."' ", $link); }


function display($cur, $ruc) { 
global $c, $r, $coffset, $kcl, $krl, $sprites, $folder, $sz, $ext;
$rc = 1;
$sz = 30;
$pc = ($c * $sz) + $coffset + $kcl;
$pr = ($r * ($sz / 2)) + $krl;

  if (!$cur[0]) { 
  $cur[1] = "-";//blank tile
  }
  if (!$ruc[0]) { 
  $ruc[1] = "-";//blank tile
  }

if ($sprites[$cur[2]][1] == 1) { 

// crazy shit
$siccx = "\"".$sprites[$cur[2]][0]."\";"; if ($siccx == "\"\";") { $sprites[$cur[2]][0] = "-"; }
// above line was pissing me off, so i did a hatchet job

echo "s{$c}x{$r}=\"".$sprites[$cur[2]][0]."\"; "; 
} else {
if ($sprites[$ruc[2]][1] == 1) {
echo "s{$c}x{$r}=\"-\"; "; //blank sprite
}
}


if ($cur[1] != $ruc[1]) { echo "t{$c}x{$r}=\"{$cur[1]}\"; "; } //only if they are not the same tile
// [NB: this was used to generate the update fbunction - echo "document.pgrid.t{$c}x{$r}.innerHTML = \"<img src='\" + parent.dw.t{$c}x{$r} + \".\" + parent.dw.ext + \"' border=0>\";\n"; ]... yeah.
$kcl++;
$c--;
if ($c < $rc) { $kcl = 0; $krl++; $c = 13; $r--; $coffset = $coffset + 14;};
} 

$cur = explode(".", $map[$y][$x]);

$r = 16;
$c = 13; 
$coffset = 0;
$kcl = 0;
$krl = 0;


for ($currxcell = -6; $currxcell <= 6; $currxcell++) {
 for ($currycell = -6; $currycell <= 6; $currycell++) {
 $cur = explode(".", $map[$y+$currxcell][$x+$currycell]); 
  $ruc = explode(".", $map[$sy+$currxcell][$sx+$currycell]);
 if ($mmoo == "111111" || @$lag == 1) { $ruc[0] = "RESERVED%"; $ruc[1] = "RESERVED%"; $sprites[$ruc[2]][1] = 1; }
 display($cur, $ruc);
 }
}

echo "ext=\"{$ext}\"; sta=\"{$sta}\"; moo=\"{$mmoo}\"; parent.mw.ug(); </script>";

error_reporting (E_ALL); 


// 4 <= R <= 16 step -1
// 1 <= c <= 13 step -1
if ($mmoo == "111111") { echo "[cleaned screen] "; }
?>update window