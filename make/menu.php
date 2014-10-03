<? include "../header.php"; kcache(); if (!logged_in()) { echo "You ain't logged in!"; exit; } ?><form name=fmenu action=menu.php?mode=<? echo @$_GET["mode"]; ?> method=post><b><a href=menu.php?mode=texture>Textures</a> - <a href=menu.php?mode=object>Objects</a> - <a href=menu.php?mode=script>Scripts</a> - <a href=menu.php?mode=setting>Save/load</a> - <a href=menu.php?mode=resize>Grid size</a></b><br>
<?

$ext = ".gif";
if (@$_GET["mode"] == "texture") {
echo "<input type=hidden name=modus_operandi value=texture>";
$dir = @$_POST["dir"]; 
if (!@$dir) { $dir = ""; $sel = " selected"; } else { $sel = ""; }
$dir = str_replace (".", "", $dir);
echo "<b>Textures</b> - Using tileset <select name=dir onChange='submit();'><option$sel value=''>Base</option> "; $sel = ""; 
if ($hd = opendir("../images/textures/")) { while ($sz = readdir($hd)) { if (!strstr($sz, ".")) { if (preg_match("/^\./",$sz)==0) { if ("/".$sz == $dir) { $sel = " selected"; } echo "<option{$sel} value='/{$sz}'>{$sz}</option> "; } } } closedir($hd); } 
echo "</select>\n| Tile selection <select name=selmode><option value=1 selected>onClick</option><option value=2>onMouseOver</option></select>\n<br><input type=hidden name=imgt value='{$dir}/-{$ext}'";
if ($hd = opendir("../images/textures$dir")) { while ($sz = readdir($hd)) { if (strstr($sz, ".")) { if (preg_match("/^\./",$sz)==0) { echo "<img src='../images/textures{$dir}/{$sz}' border=1 onClick='document.fmenu.imgt.value=\"{$dir}/{$sz}\"; parent.document.images[\"curse\"].src=\"../images/textures{$dir}/{$sz}\";'> "; } } } closedir($hd); } 

} else if (@$_GET["mode"] == "object") {
echo "<input type=hidden name=modus_operandi value=object>";
$dir = @$_POST["dir"]; 
if (!@$dir) { $dir = ""; $sel = " selected"; } else { $sel = ""; }
$dir = str_replace (".", "", $dir);
echo "<b>Objects</b> - Using objectset <select name=dir onChange='submit();'><option$sel value=''>[Base]</option> "; $sel = ""; 
if ($hd = opendir("../images/objects/")) { while ($sz = readdir($hd)) { if (!strstr($sz, ".")) { if (preg_match("/^\./",$sz)==0) { echo "[/".$sz."]"; if ("/".$sz == $dir) { $sel = " selected"; } echo "<option{$sel} value='/{$sz}'>{$sz}</option> "; } } } closedir($hd); } 
echo "</select>\n| Object selection \n<br><input type=hidden name=imgo value='{$dir}/-{$ext}'";
if ($hd = opendir("../images/objects$dir")) { while ($sz = readdir($hd)) { if (strstr($sz, ".")) { if (preg_match("/^\./",$sz)==0) { echo "<img src='../images/objects{$dir}/{$sz}' border=1 onClick='document.fmenu.imgo.value=\"{$dir}/{$sz}\"; parent.document.images[\"curse\"].src=\"../images/objects{$dir}/{$sz}\";'> "; } } } closedir($hd); } 

} else if (@$_GET["mode"] == "setting") {
 echo "<input type=hidden name=modus_operandi value=setting>";
 echo "<input type=button value='Save file' onClick='parent.document.grid.submit(); '> - ";
 echo "<input type=button value='Load file' onClick='document.location=\"load.php\"; '><br>";
echo "note: currently, load does not work. Also, once you save, you overwrite your old map file";
} else if (@$_GET["mode"] == "resize") {
 echo "<input type=hidden name=modus_operandi value=resize0><b>Grid size</b> - grid will be saved then resized";
 echo "<br>Cols(X): <input type=text name=rescol value='10' style='width:40;' maxlength=3>&nbsp; Rows(Y): <input type=text name=resrow value='10' style='width:40;' maxlength=3>&nbsp; ";
echo "<select name=resmode onChange=\"document.fmenu.rpre.src=this.value+'.png';\"><option value=rcc>Centre</option><option value=rdl>Down/Left</option><option value=rdr>Down/Right</option><option value=rul>Up/Left</option><option value=rur>Up/Right</option></select>&nbsp; <img name=rpre src=rcc.png> "; 
 echo "&nbsp; <input type=button value='Save & Resize' onClick=\"parent.document.grid.action='save.php?resize=1&x=' + document.fmenu.rescol.value + '&y=' + document.fmenu.resrow.value + '&resmode=' + document.fmenu.resmode.value; parent.document.grid.submit(); \">";
} else {
echo "<input type=hidden name=modus_operandi value=null>";
}
?>

</form>