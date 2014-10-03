This is a web-based Isometric game engine I wrote in highschool, some time around 2002-2003. 

Login with user "test", password "test".

****

I stuck it up on Sourceforge in 2005, but was aparently aware (even then) how messy it was.
It uses <script> tags with some vars in an embedded iframe for updates - the precursor to JSON over AJAX (it'd actually only take a few minor changes to get it working via AJAX). 

I remember experimenting with long-polling (nowdays known as AJAX Push/COMET/HTTP Streaming) but I don't think it worked that well with browser tech at the time. 
You could re-impliment it with about 5 lines of PHP, however - wrap the display code into a loop, and bypass that loop whenever the script is called with movement vars.

I cut my teeth on BASIC, but at some point got into trouble with the principal & sysadmin regarding a LPRINT loop and several reams of paper. 
The result was my being effectively banned from using BASIC again (unfortunatly the only teacher with any programming knowledge, Fr. Merv Duffy, had left on a Catholic mission a year or two prior). 
I instead decided to try the whole internet dev thing, which seemed like a cool new technology at the time. Tried ASP but decided to experiment with  the "new hotness", PHP.

****

I've modified the DB slightly from the SF release, and slapped on some basic anti-SQL-injection, but the rest is pretty much in its original sphagetti-code glory. 
Haven't bothered fixing the editor. I think it supports multiple simultaneous players (can't remember).

Beware that I had yet to learn/rediscover global config vars, let alone persistant connections. As such: 
* grep -rl "\"root\", \"\")" | xargs sed -i 's/"root", "")/"root", "MYSQL_PASSWORD")/g'
In my defense, PDO wasn't a thing back then, and it'd be years before I met anyone who had even heard of PHP.
