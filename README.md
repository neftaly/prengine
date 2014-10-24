prengine
========

This is a browser-based pseudo-3D multiplayer RPG, written when I was first learning PHP (2002-2003).
It uses &lt;script&gt; tags inside a hidden iframe for updates, a common technique before AJAX.

**Warning:** There are several known SQL/XSS holes. I was ignorant of security practices and code cleanliness at the time. 

![Screenshot](/images/editor_textures_sea.png?raw=true)




Setup the DB with:
```
grep -rl "\"root\", \"\")" | xargs sed -i 's/"root", "")/"MYSQL_USERNAME", "MYSQL_PASSWORD")/g'
```

Login with user "test", password "test".
