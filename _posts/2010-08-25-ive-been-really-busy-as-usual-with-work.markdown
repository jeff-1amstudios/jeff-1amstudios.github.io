---
layout: post
title: Back in the coding zone
date: '2010-08-26T16:31:00.003+12:00'
author: Jeff
tags:
- OpenC1
modified_time: '2010-10-21T08:24:11.514+13:00'
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-4268848988632147267
blogger_orig_url: http://blog.1amstudios.com/2010/08/ive-been-really-busy-as-usual-with-work.html
---
I've been really busy as usual with work and not a lot of time to work on OpenCarmageddon. In the last week or so I've got back into it though, and right now its full steam ahead :)

Thanks for the feedback from the last video, hopefully i've sorted most of the problems:

Done:

*   Vehicles don't bounce away from walls in big crashes (as seen in the last video)
*   Corrected the center of rotation for taller vehicles (Screwie and Dump especially)
*   Reduced amount of vehicle particles (in the last video they were all over the screen)
*   Implemented the width of AI paths defined in the map data so AI can get around the tracks much better
*   When the player gets far away from the AI, the AI is respawned near the player
*   If the player gets far enough away from an attacking AI vehicle, the AI will resume racing, instead of trying to track down and kill the player forever...
*   Cops! Cops are now implemented and fully functional, including the Special Forces cop in the Blood On The Rooftops map.

Todo in the next couple of days:

*   Race completed - camera animation, exit the map etc.
*   UI to choose car and map. &nbsp;Right now its all hard-coded.
Then&nbsp;I'll finally be ready to implement pedestrians. &nbsp;I'm going to try to spend a bunch of time on&nbsp;OpenC1&nbsp;in the next couple of weeks to get pedestrians in there :)