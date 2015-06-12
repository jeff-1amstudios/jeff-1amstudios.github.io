---
layout: post
title: Need for Speed XNA update
date: '2014-05-25T14:51:00.000+12:00'
author: Jeff Harris
tags: 
modified_time: '2014-08-15T10:12:12.278+12:00'
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-951052659232437726
blogger_orig_url: http://blog.1amstudios.com/2014/05/need-for-speed-xna-update.html
---
It's been at least 4 years since I did any work on my remake of the original need for speed game. Back then it got picked up by a few gamedev sites and I was contacted by EA Canada asking if I was interested in interviewing with them! (A completely different story to Square Enix and my Carmageddon remake!). Looking at my code after so long is pretty cringe-worthy - I cut a lot of corners before the release, the code is messy but it is still sort of fun to play.  With [the end of XNA](http://www.gamasutra.com/view/news/185894/Its_official_XNA_is_dead.php), and being between projects, I decided to do a quick port to [MonoGame](http://www.monogame.net/) and move the project to GitHub.

![](http://1amstudios.com/img/opennfs1/100-cars-3.jpg)

I figured it would be a few days of work and I'd be done with the port, as MonoGame implements almost all of XNA 4. Unfortunately, I had compiled against XNA 3, so first I had to update to XNA 4 and deal with all the breaking changes. Once that was done, it was running in MonoGame pretty quickly. As all developers love to do, I started ripping, replacing and refactoring. The problem now was when I wrote the code I had built up a really good mental model of the Need for Speed track structure and how it was represented in code and in the data files. It's quite complex, with many parts, represented by classes with names like TrackNode, TerrainSegment, TerrainRow, TerrainStrip etc. The code didn't do a good job of explaining how these objects fitted together. I used to just know that a TerrainSegment always had 4 TerrainRows, and each row had 10 TerrainStrips, but coming back to it took a quite a while to get back in the groove.

A few weeks of late nights later, a load of new features, bug fixing, and more digging around the original data files with a hex editor, OpenNFS1 is much cleaner and more faithful to the original. A couple of things that made the biggest look and feel difference was changing the field of view and aspect ratio to match screenshots of the original. The values I originally used were way off, and resulted in a lack of feeling of speed. I've added some simple AI to race against, here are a couple of screenshots with 100 racers! The original game used some really fun optimizations to have 8 cars simulated at once, which I am also using, and 100 cars is actually pretty computationally simple because of it.

![](http://1amstudios.com/img/opennfs1/100-cars-2.jpg)
![](http://1amstudios.com/img/opennfs1/100-cars-1.jpg)

 I'm going to write a few posts about how the tracks and scenery and physics are organized in the original game (as far as I can guess from understanding the data files) because some of the ideas could work well for mobile games today. Also, if I don't write it down this time, I'll forget and hopefully it will be interesting for someone else too.