---
layout: post
title: XNA Performance Profiling
date: '2008-10-20T23:31:00.000+13:00'
author: Jeff
tags:
- nProf
- XNA
- Profiling
modified_time: '2009-03-05T02:32:09.529+13:00'
thumbnail: http://1.bp.blogspot.com/_xZUP9f4gN7g/SPxhBn6AczI/AAAAAAAAADU/xs0o_fAYDMM/s72-c/nprof.jpg
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-4433302468980774624
blogger_orig_url: http://blog.1amstudios.com/2008/10/xna-performance-profiling.html
---
Finally having all the main bits working in XNA NFS, I was looking at the performance, which wasn't great, even on my fairly decent PC.

I first went through my normal optimization - limiting the number of DrawPrimitive() calls.  After bringing it down to only the minimum of calls (by only drawing a small part of the track), I still had an annoying camera 'jump' every second or so.  This is at a pretty even 50-60 fps windowed (ie, maxed for my refresh rate).

After going through my camera classes and not finding anything wrong, I figured I'd try profiling it - although given the framerate I didnt expect to find anything unusual.

A quick google of XNA performance profiling turned up a link to [nProf](http://nprof.sourceforge.net/Site/Description.html) - a freeware &amp; open source .NET profiler.

Here is a screenshot of the nProf window after running for a couple of minutes.
[![](http://1.bp.blogspot.com/_xZUP9f4gN7g/SPxhBn6AczI/AAAAAAAAADU/xs0o_fAYDMM/s320/nprof.jpg)](http://1.bp.blogspot.com/_xZUP9f4gN7g/SPxhBn6AczI/AAAAAAAAADU/xs0o_fAYDMM/s1600-h/nprof.jpg)

Notice the selected line - the BasicEffect constructor.  The total amount of time spent in the BasicEffect.ctor() was almost as much as the total amount of time spent rendering the track!

This immediately didn't look right, and having a look at where I was calling new BasicEffect() revealed the problem.  I was creating about 5 new BasicEffects per frame

The ease of creating a BasicEffect, and even the name itself implies you can create them whenever you need one - but the reality is they are <span style="font-weight: bold;">SLOW </span>to create, so you better not be creating them per frame!

I changed my code to create them once then update properties on them per frame.
In fact, all but 2 were identical, so I was able to get down to 2 BasicEffect.ctor() calls for the whole lifetime of the game.  The framerate is now always 59-60fps, and the annoying pause/jump (which I now assume was the GarbageCollector doing its thing) is gone.  And without using nProf I would never have guessed the problem. 

So the lesson is (as I've been told and forgotten many times) is to profile then optimize, not the other way around.

Life is good again :)

And heres the latest screenshot, showing the corrected gamma and track barriers:
[![](http://2.bp.blogspot.com/_xZUP9f4gN7g/SPxlL5yEeuI/AAAAAAAAADc/cdypNBn3lQo/s320/Image4.jpg)](http://2.bp.blogspot.com/_xZUP9f4gN7g/SPxlL5yEeuI/AAAAAAAAADc/cdypNBn3lQo/s1600-h/Image4.jpg)