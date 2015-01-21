---
layout: post
title: Working on Special Volumes again
date: '2010-03-04T09:32:00.003+13:00'
author: Jeff
tags:
- XNA
- OpenC1
modified_time: '2014-03-18T17:50:41.927+13:00'
thumbnail: http://4.bp.blogspot.com/-aGtoDbWwuAY/S47GUMdZUUI/AAAAAAAAACk/R1MFZy4OYWo/s72-c/ndump002.jpg
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-422740636451649358
blogger_orig_url: http://blog.1amstudios.com/2010/03/still-working-on-special-volumes.html
---
I've fixed a couple of problems that I hadn't noticed before. The main one was I wasn't always placing the volumes correctly, which was giving weird results (like water gravity being applied while driving down a road). Using the SpecVol Edit Mode in C1 and comparing it to my engine helped to fix that problem.  I love the Stainless Software left edit mode available in the original game :)  Heres a random screenshot showing correctly rotated and scaled special volumes (from the CoastB track).  These particular special volumes define the engine sound to be used in the tunnels. Also shows the latest ripped font for rendering messages to the screen. Each font takes an hour or two because I have to manually cut each glyph from the original bitmap and massage it into the XNA bitmap font format.  Its the only resource I have to modify instead of reading directly from the data files at runtime, but I'm planning to code up a proper C1 bitmap font renderer.
![](http://4.bp.blogspot.com/-aGtoDbWwuAY/S47GUMdZUUI/AAAAAAAAACk/R1MFZy4OYWo/s1600/ndump002.jpg)

The other problem is implementing the 'default water' special volume.  The race.txt file doesn't contain where the water is, so the C1 engine has to look at all the water materials, get a list of water vertices, then build up a list of locations. I've done all this, and for the most part it works, but theres still some weird edge cases to figure out.