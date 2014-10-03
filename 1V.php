<?

include "header.php";

if (!logged_in()) {
echo "Please <a href=login.php target=_parent>log in</a>";
exit;
}
$username = username();


$link = mysql_connect("localhost", "root", "") or die("Could not connect: " . mysql_error());
mysql_select_db("rpg", $link);

$level = mysql_fetch_row($call = mysql_query("SELECT `levelname` FROM `users` WHERE 1 AND `username` = '{$username}'", $link));
$level = $level[0];

$call = mysql_query("SELECT `fight` , `xpos` , `ypos` , `kills` , `hp` , `def` , `acc` , `atk` , `spd` , `avitar` FROM `map` WHERE 1 AND `username` = '".$username."' AND `levelname` = '".$level."' ", $link);
$playa = mysql_fetch_row($call);

// engine constants
$folder = "images/objects/"; //image folder
$ext = "png";

// charachter (self) data
$selfstats[0] = $playa[4]; //hp
$selfstats[1] = $playa[5]; //def
$selfstats[2] = $playa[6]; //atk
$selfstats[3] = $playa[7]; //speed
$selfstats[4] = $playa[5]; //accuracy (%)
$selfstats[5] = "100"; //exp
//SET ME FROM DB, THIS IS TEMP!!!////
$avitar = "$folder{$playa[9]}";

error_reporting (E_ALL ^ E_NOTICE); //nessacary to kill 'undefined *' notices in test mode, but allows *other* error displays

kcache();

include "levels/$level.php";

?>
<script>
function ug() {

document.pg.statuz.value = "  loading";
for(x = 16; x > 3; x--) {
for(i = 13; i > 0; i--) {
eval ('if (parent.dw.t'+i+'x'+x+') { document.images["i'+i+'x'+x+'"].src = "images/textures/" + parent.dw.t'+i+'x'+x+' + "." + parent.dw.ext; }');
eval ('if (parent.dw.s'+i+'x'+x+') { document.images["s'+i+'x'+x+'"].src = "images/objects/" +  parent.dw.s'+i+'x'+x+' +  "." + parent.dw.ext; }');
}
}
document.pg.statuz.value = "  ready";
}

function move (dir, amt) {
setTimeout("lag();", 1000);

if (document.pg.statuz.value == "  ready") {
document.pg.statuz.value = "  updating";
moo = document.pg.moo.value;
if (moo > 11111) { moo = ""; }
document.pg.moo.value = moo + 1;
parent.dw.location = "1U.php?mdir=" + dir + "&mamt=" + amt + "&mmoo=" + document.pg.moo.value;
}

if (document.pg.statuz.value == "  lagging") {
document.pg.statuz.value = "  updating";
moo = document.pg.moo.value;
if (moo > 11111) { moo = ""; }
document.pg.moo.value = moo + 1;
parent.dw.location = "1U.php?lag=1&mmoo=" + document.pg.moo.value;
// it must be lagging quite a bit. refresh the page but dont move
}

if (document.pg.statuz.value == "  updating" || document.pg.statuz.value == "  loading") {
// wait... its updating you tard [make nothing happen]
}

}


function lag () {
 if (parent.dw.moo != document.pg.moo.value) {
 document.pg.statuz.value = "  lagging";
 }
}
</script>
<?
$x = $playa[1]; if ($x == "0") { $x = $spawny; }
$y = $playa[2]; if ($y == "0") { $y = $spawny; }

if (@$levelsel) { $y = $spawny; $x = $spawnx; mysql_query("UPDATE `map` SET `xpos` = '$x', `ypos` = '$y' WHERE `username` = '$username' AND `levelname` = '".level."' ", $link); }


function display($cur, $av) { 
global $c, $r, $coffset, $kcl, $krl, $sprites, $folder, $sz, $ext, $avitar;
$rc = 1;
$sz = 30;
$pc = ($c * $sz) + $coffset + $kcl - 30;
$pr = ($r * ($sz / 2)) + $krl;
$pcs = $pc;// + 13;
$prs = $pr;// + 4;
  if ($cur[0]) { 
   echo "<div style='position:absolute;right:$pc;bottom:$pr;' name=i{$c}x{$r}><img name=i{$c}x{$r} src='images/textures/".$cur[1].".".$ext."' border=0></div>\n";
  } else {
   echo "<div style='position:absolute;right:$pc;bottom:$pr;' name=i{$c}x{$r}><img name=i{$c}x{$r} src='images/textures/-.".$ext."' border=0></div>\n";
  }

if ($av == 1) { echo "<img src='$avitar' style='position:absolute;right:283;bottom:164;' border=0>\n"; }


  if ($sprites[$cur[2]][1] == 1) { 
   echo "<div style='position:absolute;right:$pcs;bottom:$prs;' name=s{$c}x{$r}><img name=s{$c}x{$r} src='images/objects/".$sprites[$cur[2]][0].".".$ext."' border=0></div>\n";
  } else {
   echo "<div style='position:absolute;right:$pcs;bottom:$prs;' name=s{$c}x{$r}><img name=s{$c}x{$r} src='images/objects/-.{$ext}' border=0></div>\n";
  }

$kcl++;
$c--;
if ($c < $rc) { $kcl = 0; $krl++; $c = 13; $r--; echo "\n\n\n"; $coffset = $coffset + 14;}
} 

echo "<body bgcolor=ffffff text=000000 link=000000 vlink=000000 style='margin: 0px; padding: 0px;'><form name=pg>\n";

$cur = explode(".", $map[$x][$y]);

$r = 16;
$c = 13; 
$coffset = 0;
$kcl = 0;
$krl = 0;

for ($currxcell = -6; $currxcell <= 6; $currxcell++) {
 for ($currycell = -6; $currycell <= 6; $currycell++) {
  if ($currxcell == 0 && $currycell == 0) { $av = 1; } else { $av = 0; } 
 $cur = explode(".", $map[$x+$currxcell][$y+$currycell]); display($cur, $av);
 }
 echo "\n";
}

error_reporting (E_ALL); ?>

<input type=hidden value=1 name=moo><input type=text value='  ready' name='statuz' style='width:100%; position:absolute;right:0;bottom:0; ' >
</form>
<table>
<tr align=center><td></td><td><a href="javascript:move('u', 1);">^</a></td><td></td></tr>
<tr align=center><td><a href="javascript:move('l', 1);">&lt;</a></td><td></td><td>
<a href="javascript:move('r', 1);">&gt;</a></td></tr>
<tr align=center><td></td><td><a href="javascript:move('d', 1);">V</a></td><td></td></tr>
</table>


<script language="javascript">
alert("If you use firefox, you can try using your cursor keys!");
// Initial code ripped off comment at http://rtfm.atrax.co.uk/infinitemonkeys/articles/javascript/992.asp. 
// I hit the konqueror bug thing too =[ (but script works in firefox, pity I only use it for development) 

if(!document.all){
window.captureEvents(Event.KEYUP);
}else{
document.onkeypress = keypressHandler;
}
function keypressHandler(e){
if(document.all) { //it's IE
var e = window.event.keyCode;
}else{
e = e.which;
}

if (e==37){
move('l', 1);}
if (e==38){
move('u', 1);}
if (e==39){
move('r', 1);}
if (e==40){
move('d', 1);}
}
window.onkeyup = keypressHandler;
</script>
