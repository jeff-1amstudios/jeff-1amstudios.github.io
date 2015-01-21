---
layout: post
title: Special volume support
date: '2010-02-25T17:34:00.005+13:00'
author: Jeff
tags:
- XNA
- physx
- OpenC1
modified_time: '2010-10-21T08:28:23.526+13:00'
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-9007975670114089988
blogger_orig_url: http://blog.1amstudios.com/2010/02/im-halfway-most-of-way-through.html
---
Im <strike>halfway</strike> most of the way through implementing specvols (special volumes). Special volumes are areas in the map where the environment changes (engine sound, gravity, viscosity etc.)  Its how water and tunnels are implemented.  They can have entry and exit sounds (the splash sound when going in and out of the water), and also the material for the reflective windscreen.

Im still experimenting with with PhysX forcefields to handle the gravity, otherwise everything else is done except the reflective windscreens which I'm doing next.

It will be a big milestone, as specvols are the last (as far as I know) environment feature outstanding :)

Edit: I've also had an idea for how to implement proper directional lighting.  Screenshots coming...