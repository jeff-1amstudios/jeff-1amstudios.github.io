---
layout: post
title: C1 crush data (update)
date: '2009-08-11T14:54:00.001+12:00'
author: Jeff
tags:
- XNA
- OpenC1
modified_time: '2010-10-21T08:32:47.616+13:00'
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-6391255854932823313
blogger_orig_url: http://blog.1amstudios.com/2009/08/i-havent-had-much-time-to-work-on-this.html
---
I havent had much time to work on this lately - I'm in London for 2 weeks working on a project 7 days a week.

So basically, the way the crush data seems to work - there are many of these structures in the car file:

{% highlight C %}
Vertex index
bbox min
bbox max
scale1
scale2
list of affected vertices
{% endhighlight %}

So taking a vertex, if it collides with something, it can move within the defined bounding box. The amount it moves for a collision is scaled by either scale1 or scale2 (not sure how this is determined yet).

Then the list of affected vertices is used to move points around the main vertex to make it look like the bodywork is compressing around it.  Each affected vertex has some sort of scale (1-255), at 1, all vertexes move down, at 255 they all move upwards.