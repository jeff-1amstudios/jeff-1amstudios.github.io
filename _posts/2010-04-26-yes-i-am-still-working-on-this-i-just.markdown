---
layout: post
title: I love...hate...love again working on the vehicle crushing behavior
date: '2010-04-27T10:24:00.005+12:00'
author: Jeff
tags:
- XNA
- physx
- OpenC1
modified_time: '2014-03-18T17:46:32.366+13:00'
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-5713894538856791545
blogger_orig_url: http://blog.1amstudios.com/2010/04/yes-i-am-still-working-on-this-i-just.html
---
I've spent so much time trying to get PhysX to handle the vehicle deformation and trying to work around a PhysX bug that I gave up that path completely.  It made me feel annoyed at wasting so much of my life on it that I had to take a break for a couple of weeks!

In the last couple of days I've started implementing the deform system myself. Its actually been easier than I expected - the hardest bit is figuring out how the Carmageddon crush data works. No-one in the Carma editing community has figured it out, or at least I haven't found any info on it. The downside is the deform system depends on the crush data in the vehicle files - so all the user-made cars will need crush data added to deform properly.

Heres a screenshot showing the first cut of the new deformation system. The large yellow box is the reference vertex and the smaller yellow boxes are the vertices that get moved if the reference vertex is hit.
![](/img/blogger/AcO3ZoISG44-ndump012.jpg)