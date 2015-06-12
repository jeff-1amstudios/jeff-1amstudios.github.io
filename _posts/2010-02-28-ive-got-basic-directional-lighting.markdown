---
layout: post
title: Directional lighting
date: '2010-03-01T18:08:00.006+13:00'
author: Jeff
tags:
- XNA
- OpenC1
modified_time: '2014-03-18T17:52:47.119+13:00'
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-2881457135482065481
blogger_orig_url: http://blog.1amstudios.com/2010/03/ive-got-basic-directional-lighting.html
---
I've got basic directional lighting working in the engine.  The tricky part was the original models all had shared vertices, which means that hard edge lighting just didn't work.  And since pretty much every edge should be a hard edge in the low-poly C1 world, that was a problem.  So now I inject the required extra vertices into each model so each face can be properly lit.

I haven't got the right lighting configuration yet, like most things it takes a bit of time to work out what feels right. For example, in the screenshots below the ground is too dark, and has a blue tint, but hopefully its enough to show what I mean. The top images are with no lighting, the bottom images show how a simple directional light can add some depth to the image.

![](/img/blogger/P-N-CkuWE94-lighting_example_1.jpg)