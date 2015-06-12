---
layout: post
title: MiniMap overlay
date: '2010-09-04T12:56:00.003+12:00'
author: Jeff
tags:
- XNA
- OpenC1
modified_time: '2014-03-18T17:40:42.751+13:00'
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-2776497703881275573
blogger_orig_url: http://blog.1amstudios.com/2010/09/got-map-view-working.html
---
Got the map view working. Was quite easy in the end - in the map data files is a matrix which describes how to calculate the 2d map position from where the vehicle is in the 3d world. Then I just had to scale the result for the current resolution (out of the matrix of course it is scaled for 320x200 resolution).

I've overlaid the map instead of rendering the map over the whole screen and having the race view in a little window like the original.  Its not quite as cool, but at this point I want to keep moving onto other features.

![](/img/blogger/clYR5DCarCs-ndump045.jpg)

Next up is doing some basic UI for choosing races and cars :)