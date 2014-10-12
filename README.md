This is a browser-based pseudo-3D multiplayer RPG from ~2002-2003. It was probably one of my first projects in PHP.
It uses &lt;script&gt; tags inside a hidden iframe for updates, a common technique before XMLHTTPRequest.

![Screenshot](/images/editor_textures_sea.png?raw=true)

I've modified the DB from my 2005 SourceForge release and fixed a couple of SQL holes, but the rest is in its original sphagetti-code glory. 

Setup the DB with:
```
grep -rl "\"root\", \"\")" | xargs sed -i 's/"root", "")/"MYSQL_USERNAME", "MYSQL_PASSWORD")/g'
```

Login with user "test", password "test".
