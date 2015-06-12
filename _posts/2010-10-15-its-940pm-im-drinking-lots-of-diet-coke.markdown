---
layout: post
title: The best use case for Diet Coke is for nighttime coding productivity
date: '2010-10-15T21:56:00.005+13:00'
author: Jeff
tags:
- XNA
- OpenC1
modified_time: '2014-03-18T17:37:32.070+13:00'
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-6196050037467167128
blogger_orig_url: http://blog.1amstudios.com/2010/10/its-940pm-im-drinking-lots-of-diet-coke.html
---
Its 9:40pm, I'm drinking lots of diet coke, got [di.fm](http://di.fm) trance playing, and going hard coding on OpenC1. Ive got a list of about 20 things I need to do for the demo release that I want to get through tonight.

Its been annoyingly tricky getting OpenC1 to work with the Carmageddon demo files, but I've just fixed the last problem (that I can see at least...)

The curbs (bit between pavement and road) in the demo map are designed differently to the full game maps.  They we being rendered in weird psychedelic colors so its something that needed fixing.  After quite a few hours of pulling things apart to find the exact vertices that make up the curbs and looking at their properties, I've found all the curbs in the demo are marked as un-textured (in a way the full game maps don't do), and then (I'm guessing) hard-coded to the dark grey color in the game engine.  Its a small thing, but I'm just happy to have fixed it now!  Heres a couple of victory screenshots showing nice grey curbs (and some pedestrian carnage!)

![](/img/blogger/jxur-ZgbSF4-ndump009.jpg)
![](/img/blogger/YBWhaxX7jzU-ndump012.jpg)
