---
layout: post
title: Opponents are up and running
date: '2010-03-14T22:39:00.011+13:00'
author: Jeff
tags:
- XNA
- OpenC1
modified_time: '2014-03-18T17:48:16.880+13:00'
thumbnail: http://img.youtube.com/vi/JXaXxoTA4pg/default.jpg
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-9071558715497427851
blogger_orig_url: http://blog.1amstudios.com/2010/03/ill-write-more-about-implementation.html
---
Heres a video showing the new opponents system! You can see some debugging bits that I added - lines show paths and boxes show nodes (see below for what that even means...)

<div class="video"><div class="videowrapper">
<iframe allowfullscreen="" frameborder="0" src="http://www.youtube.com/embed/JXaXxoTA4pg"></iframe>
</div></div>

The opponent data baked into each track is made up of nodes (points) and paths between nodes. After parsing that data, I end up with a list of nodes, and for each node, several possible paths.

When the race starts, each opponent finds the node closest to themselves. They then work out which path to take from that node, and also what they will do at the end of that next path. (So the opponents are looking 2 steps ahead).  This means they know how tight the next corner is going to be. As they accelerate along the path, they constantly work out how long it will take to brake to get around the corner. This means they can keep their speed up, but slow down enough to get around tight corners (usually!).  The opponent data also has a max speed setting per path, like if the path ends  at the edge of a cliff, but its not used consistently. I'm not even sure if the original game uses it.
I've made each node quite big, so opponents don't need to drive exactly over it - this means they will start turning before reaching the middle of the corner, and can get around it a bit faster. There are three different types of paths - _Race, General and Cheat._

_Race_ paths direct the AI around the race track. _General_ paths let them drive around random streets. _Cheat_, as far as I can see, lets them get to places that normally they wouldn't normally be able to get to. (Like hard to reach rooftops). A good implementation will be to choose a mix of race and general paths, generally biasing towards race paths, and use cheat paths occasionally when the player isn't looking! Currently, the opponents always choose the race path.

Also, when the player gets far away from an opponent, the original game teleports the opponent near the player.  I still have to implement that and also opponents attacking the player. Fun stuff :)