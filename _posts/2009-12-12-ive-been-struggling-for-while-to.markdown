---
layout: post
title: Correct field of view - my favorite 'feature' so far!
date: '2009-12-13T09:56:00.004+13:00'
author: Jeff
tags:
- XNA
- OpenC1
modified_time: '2011-05-05T21:58:17.081+12:00'
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-6798946389127528601
blogger_orig_url: http://blog.1amstudios.com/2009/12/ive-been-struggling-for-while-to.html
---
I've been struggling for a while to understand why the maps in OpenCarma feel smaller than in the original game.  I hadn't been able to put my finger on why until now.  I was watching a youtube video of the Maim Street map when I noticed the view from the start grid was not the same as in my engine. After some head scratching and double checking all my maths, I found out the [Field of View](http://www.geodetic.com/OriginalImages/field%20hi%20res.jpg) I was using was wrong! The field of view controls how much the camera sees sideways, which has the effect of making objects directly in front of the camera seem stretched.

Heres a screenshot from the original game. Note the lampost and small amount of yellow barrier on the right.
![](http://www.1amstudios.com/games/carmageddon/images/fov_original.jpg)

Now my game, first using the default 45 degree field of view, and then 55.55 degree (as found in general.txt settings file). On the left, you can't see the lamppost and the buildings look taller and closer compared the shot on the right, where the buildings appear to stretch into the distance more. Its made a huge difference to the feel of the game as you drive around :)

![](/img/blogger/NZvqKlRG0e4-fov_45.jpg)
![](/img/blogger/Aw1dwLaRVC8-fov_55.jpg)