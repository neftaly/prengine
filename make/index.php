<? include "../header.php"; kcache(); if (!logged_in()) { echo "You ain't logged in!"; exit; } ?><center><br><iframe src='menu.php?a=<? echo time(); ?>&mode=texture' style="width:500px; height:100px; border: 1px solid; " name=menu></iframe></center><form name="grid" method="post" action="save.php">
<script>
function dr(a,b) {
 if (menu.document.fmenu.modus_operandi.value == "texture") {
  if (menu.document.fmenu.selmode.value == '1') { 
  eval("document.images['i" + a + "x" + b + "'].src='../images/textures'+menu.document.fmenu.imgt.value; ");
  eval("document.grid.t" + a + "f" + b +".value=menu.document.fmenu.imgt.value; ");
  } 
 } else if (menu.document.fmenu.modus_operandi.value == "object") {
 eval("document.images['o" + a + "x" + b + "'].src='../images/objects'+menu.document.fmenu.imgo.value; ");
 eval("document.grid.o" + a + "f" + b +".value=menu.document.fmenu.imgo.value; ");

 } else {
 // stop wasting my time and select something already, retard...
 }
}

function drt(a,b) {
 if (menu.document.fmenu.modus_operandi.value == "texture") {
  if (menu.document.fmenu.selmode.value == '2') { 
  eval("document.images['i" + a + "x" + b + "'].src='../images/textures'+menu.document.fmenu.imgt.value; ");
  eval("document.grid.t" + a + "f" + b +".value=menu.document.fmenu.imgt.value; ");
  }
 }
}
</script>

<?
$ext = "png";
$rows = 10;
$cols = 10;

for ($cyc = $rows; $cyc >= 1; $cyc--) {
 for ($cxc = $cols; $cxc >= 1; $cxc--) {
$ty = $cyc * 15 + 20; $tx = $cxc * 30 + 20 + ($cyc * -15) + $rows * 15; $by = $ty + 7; $bx = $tx + 17;
echo "<div style='position:absolute;right:$tx;bottom:$ty;' name=di{$cxc}x{$cyc}><img name=i{$cxc}x{$cyc} src='../images/textures/-.".$ext."' border=0 ></div>\n";
echo "<input type=hidden name='t{$cxc}f{$cyc}' value='-'> ";
$ox=$tx+10; $oy=$ty+5;
echo "<div style='position:absolute;right:$ox;bottom:$oy;' name=oi{$cxc}x{$cyc}><img name=o{$cxc}x{$cyc} src='../images/objects/-.".$ext."' border=0 ></div>\n";
echo "<input type=hidden name='o{$cxc}f{$cyc}' value='-'> ";
 }
echo "\n";
}

for ($cyc = $rows; $cyc >= 1; $cyc--) {
 for ($cxc = $cols; $cxc >= 1; $cxc--) {
$ty = $cyc * 15 + 20; $tx = $cxc * 30 + 20 + ($cyc * -15) + $rows * 15; $by = $ty + 7; $bx = $tx + 17;
echo "<div style='cursor:crosshair;' onClick=\"dr('{$cxc}','{$cyc}'); \" onMouseOver=\"drt('{$cxc}','{$cyc}'); \"><img src='bullet_g.png' style='position:absolute;right:$bx;bottom:$by;border:0px;width:10;height:10;;'></div>";
echo "<input type=hidden name='b{$cxc}f{$cyc}' value=''> ";
 }
echo "\n";
}

?>


<script type="text/javascript">
// will make my own when I get the chance

/*
Simple Image Trail script- By JavaScriptKit.com
Visit http://www.javascriptkit.com for this script and more
This notice must stay intact
*/

var offsetfrommouse=[-13,11] //image x,y offsets from cursor position in pixels. Enter 0,0 for no offset

if (document.getElementById || document.all)
document.write('<div id="trailimageid" style="position:absolute;visibility:visible;left:0px;top:0px;width:1px;height:1px;"><img name=curse src="../images/textures/-.png" border="0"></div>')

function gettrailobj(){
if (document.getElementById)
return document.getElementById("trailimageid").style
else if (document.all)
return document.all.trailimagid.style
}

function truebody(){
return (!window.opera && document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function followmouse(e){
var xcoord=offsetfrommouse[0]
var ycoord=offsetfrommouse[1]
if (typeof e != "undefined"){
xcoord+=e.pageX
ycoord+=e.pageY
}
else if (typeof window.event !="undefined"){
xcoord+=truebody().scrollLeft+event.clientX
ycoord+=truebody().scrollTop+event.clientY
}
gettrailobj().left=xcoord+"px"
gettrailobj().top=ycoord+"px"
}

document.onmousemove=followmouse
</script>
</form>