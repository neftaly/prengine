<?
$levelname = "level"; $spawnx = 1; $spawny = 1;

$map = array (
1 => array (1 => "n.grass.","n.grass.1","n.stones.","n.dirt.","c.water.","c.water.","c.water.","n.dirt.", ),
2 => array (1 => "n.grass.","n.grass.","n.stones.","n.dirt.","n.dirt.","n.dirt.","n.dirt.","n.dirt.", ),
3 => array (1 => "n.grass.","n.grass.","n.stones.","n.stones.","n.stones.","n.stones.","n.stones.","n.grass.", ),
4 => array (1 => "c.3D/stoneblock.","c.3D/stoneblock.","c.3D/stoneblock.","c.water.","n.dirt.", "n.dirt.", "n.stones.", "n.grass.", ),
5 => array (1 => "c.3D/stoneblock.","n.stones.3","c.3D/stoneblock.","c.water.","c.water.","c.water.","n.stones.","n.grass.", ),
6 => array (1 => "c.3D/stoneblock.","n.stones.2","c.water.","c.water.","c.water.","c.water.","n.stones.","n.grass.", ),
7 => array (1 => "c.3D/stoneblock.","n.stones.","c.water.","c.water.","c.water.","n.dirt.","n.stones.", "n.grass.", ),
8 => array (1 => "n.stones.","n.stones.","c.water.","c.water.","c.water.","c.water.","n.stones.","n.grass.", ),
9 => array (1 => "n.stones.","c.water.","c.water.","c.water.","c.water.","c.water.","n.stones.","n.grass.", ),
10 => array (1 => "n.stones.","n.stones.","n.dirt.","c.water.","c.water.","n.dirt.","n.stones.","n.grass.", ),
11 => array (1 => "n.grass.","n.stones.","n.stones.","n.stones.","n.stones.","n.stones.","n.stones.","n.grass.", ),
12 => array (1 => "n.grass.","n.grass.","n.grass.","n.grass.","n.grass.","n.grass.","n.grass.","n.grass.", ),
);

$sprites = array (
//   image address  is the sprite "alive"?
1 => array ( "models/bug_cool", 1),
2 => array ( "models/bug_yell", 1),
3 => array ( "items/any",  1),
);


//

$types = array (
// [say|"varible"]; -  say|hey there; = "hey there"
//
// [attack|"heath","defense","attack points","speed","accuracy","exp gained on win"]; - 
// attack|10,5,2,4,80,50; = player attacked by monster with 10 health, 5 defense,
// 2 damage per hit, a speed of 4, 80% success of hitting player with a 50 exp reward
// on successful takedown
//
// [getitem|"quantity","item type"] - getitem|50,money; = player rewarded with 50 cash
//
// sprite type   sprite abilities (code)-
"joe friendly" => array ( "say|Joe friendly: heya, welcome to the engine tech demo;"),
"drunkard" => array ( "say|Drunk guy: im gonna kill you;attack|10,5,2,4,80,50;"),
"50 money" => array ( "say|Looks like that guy left his stuff here;getitem|50,money;"),
);

// ADD COMMAND die; !
?>
