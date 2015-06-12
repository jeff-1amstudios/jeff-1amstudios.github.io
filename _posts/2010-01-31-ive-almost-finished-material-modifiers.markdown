---
layout: post
title: Material modifiers
date: '2010-02-01T10:03:00.001+13:00'
author: Jeff
tags:
- XNA
- OpenC1
modified_time: '2010-10-21T08:29:31.077+13:00'
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-6224892000918957815
blogger_orig_url: http://blog.1amstudios.com/2010/02/ive-almost-finished-material-modifiers.html
---
I've been working on implementing material modifiers.  Material modifiers give a certain material physical properties, like bumpiness, slipperyness, what kind of particles should used when driving / skidding.

It means that now the grass is bumpy and more slippery than the road, so just like in the original game its easier to spin out.  Simulating bumpiness is a cool idea, because the environment polygon count is kept low by using large flat polygons, but with the car bouncing around it makes the environment seem more detailed.

Probably the coolest thing is the frozen lake in the winter maps, now the car goes sliding with almost no grip across the lake. Lots of fun!

Right now I am working on tire tracks (which are also affected by the material modifiers)

_EDIT:_ Someone asked how I actually implemented the bumpiness.  I used the PhysX method AddLocalForceAtLocalPosition to randomly push the car upwards under one of the wheels every few milliseconds