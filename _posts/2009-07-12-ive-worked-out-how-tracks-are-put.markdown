---
layout: post
title: How track model data is organized in C1
date: '2009-07-13T14:39:00.001+12:00'
author: Jeff
tags:
- XNA
- OpenC1
modified_time: '2010-10-21T08:33:44.635+13:00'
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-7006702241708097024
blogger_orig_url: http://blog.1amstudios.com/2009/12/ive-worked-out-how-tracks-are-put.html
---
I've worked out how the tracks are put together properly, so Im now only checking and drawing visible parts of the track.  So rendering speed is great, even on my laptop. :)

The track actor file is organized into a kind of space partitioning tree, where each node in the tree has its own bounding box.  So doing camera frustum checks doesn't require many calculations as you can cull large portions (near the root of the tree) quickly without checking every single actor/model.  Very nice :)

For example, the node at the first level is a single bounding box which contains the entire track model.  Then, at the next level, there might be 4 bounding boxes, splitting the track model in 4 (upper-left, upper-right, lower-left, and lower-right).  At each level you work out which bounding box(es) your camera is looking at, and keep recursively evaluating each level until you have a list of nodes to render.

Now thats done, I am integrating the JigLib physics engine.  I've got a car that drives (and skids!) along a flat plane, next step is to feed it the track geometry.  I feel a video coming on :)

Also got horizons and proper fog going (reading from the race.txt file). 

Fun times!