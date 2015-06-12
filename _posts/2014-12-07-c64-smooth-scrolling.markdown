---
layout: post
title: How to implement smooth full-screen scrolling on c64
---

<img src="/img/c64/c64.png" style="float:right" class="hidden-sm" />
Programming in assembly for a Commodore 64 wasn't ever on my bucket list, or even my [Trello](http://www.trello.com) list. But I got drawn into it anway by reading ['Programming the Atari ST 20 years later'](http://www.voidbred.com/blog/2014/09/programming-the-atari-st-20-years-later/) which made assembly and old computers sound fun. But after beating up my brain trying to follow the Atari ST [bitplane](http://www.codetapper.com/amiga/maptapper/documentation/gfx/gfx-mode)-[based](http://www.atarimagazines.com/compute/issue80/the_great_graphics_leap.php) [graphics](http://mikro.naprvyraz.sk/docs/Coding/Atari/Undercover/C2P_2.TXT), I <s>wanted</s> needed something simpler. Enter the c64! I could go on about the [specs](https://www.youtube.com/watch?v=ZsRRCnque2E), [the thousands of games](http://gamebase64.com/search.php?h=0), [the active demoscene](http://www.pouet.net/prodlist.php?platform%5B%5D=Commodore%2064), this [amazingly great tutorial site](http://dustlayer.com), or that [the entire programmers guide is a single txt file](http://www.zimmers.net/cbmpics/cbm/c64/c64prg.txt). People much better at writing and explaining have already talked forever about all of those things. Instead I'll just write about how to implement smooth scrolling on it, because who doesn't want that?

I'm going to go ahead and assume you know (or can figure out) 6502 assembly, buffering, interrupts and raster timings. In any case, heres a incredibly brief description of the graphics configuration: I'm working in character mode, so the screen area is 40x25 characters, and the RAM for the screen data is a relocatable block of 1000 bytes. In addition, there is a fixed 1000 bytes of color RAM to provide a color for each character. There are many different graphics configurations, but in this simple case, we're assuming character-mode, single color-per-character graphics. The [VIC-II](http://en.wikipedia.org/wiki/MOS_Technology_VIC-II#Programming) is the graphics chip in the C64. Programs can set interrupts on the VIC-II based on the current raster line, so we can run code, for example, after the last line has been drawn each frame to update game logic etc.

Default screen memory is at $0400, color RAM is at $d800. The following simple code will put some characters on the screen. This is nothing you wouldn't find in any hello world tutorial, but it shows just how simple it is to start coding for the C64.

<script src="https://gist.github.com/jeff-1amstudios/10fdb176536e0908568a.js"></script>
![](/img/c64/alphabet.png)
Jumping ahead now, taking that simple example and expanding on it, lets imagine we now have drawn a screen like this: ![](/img/c64/static.png)

How do we scroll the background across the screen? The simplest approach is to move each byte in each line of screen RAM to the left. Then, at the right edge of the screen, we draw the new column. This results in jerky movement though, as the screen moves a character (8 pixels) per frame. 
To avoid this, the VIC-II chip has two hardware scroll registers, one horizontal, one vertical. They allow the screen to be offset by up to 7 pixels in each direction. Heres how that works: 

 *   Start by setting the scroll register to 7 (assuming we want to scroll to the left)
 *   Each frame, you decrement the scroll register by 1
 *   The screen contents move 1 pixel to the left
 *   Once it falls below 0, shift the entire screen RAM contents over by 1 byte
 *   Reset the scroll register to 7 
 *   Now the screen contents have again appeared to move to the left by 1 pixel
 *   Rinse and repeat. 

Here is an implementation:
<script src="https://gist.github.com/jeff-1amstudios/286955e4270392831b0a.js"></script>


We're now copying 1000 bytes of screen RAM, 1000 bytes of color RAM, plus adding the new columns and dealing with the hardware scroll register. And we need to do it all before the VIC-II starts drawing the first line of the next frame. You think the 6502 CPU can do all this?

<div class="video">
<div class="videowrapper"><iframe src="//www.youtube.com/embed/1M8qJV2yJvM?rel=0" frameborder="0"></iframe></div>
</div>

Nope! Not a chance! The flickering and tearing you see there is caused by screen/color RAM being updated while the screen is being drawn, and hardware scroll register being updated in the middle of the frame. 

Alright, we need to get a bit smarter at this. Currently, we do nothing for 7 frames except twiddle the scroll register, waiting for it to fall below 0. To use this time, we need to implement double buffering. We'll reserve another 1000 byte block in RAM to be our back buffer. This allows us to shift screen data at any time, because we are writing to the back buffer, not the visible screen.

Unfortunately, this still isn't good enough, because it can take longer than the vblank to shift the screen ram, which means there is no time left over for game logic. We have to split it out further, and shift portions of the screen on different vblank intervals. In the example below, we copy screen when the scroll value is 4 and then 2.
<script src="https://gist.github.com/jeff-1amstudios/3c959f67ef231e095c81.js"></script>

The interesting thing to note here, is that we can shift portions of screen RAM across multiple vblanks thanks to our back buffer, but we can't do the same with color RAM. Color RAM is fixed and cannot be buffered or relocated in memory. Unfortunately, we _still_ don't have enough time to shift 1000 bytes of color RAM, and run music and game logic in a single vblank. What can happen is as we're shifting color RAM (and adding new colors at the right edge of each row), the VIC-II is also rasterizing the screen, pulling values from the same color RAM that we're writing to. When the shifted colors are different, the screen tears and flickers as colors are updated.

The final piece of the puzzle, then, is how to deal with this color RAM. From reading a bunch of forum posts it sounds like there are several ways to handle it, but here is what I've implement and works nicely:

 *   Add a new interrupt a few lines below the top of the screen. When the interrupt fires, and xscroll==0, we know that _next frame_ we need updated color RAM.
 *   In that case, shift the top half of color RAM now. Because we start the copy a couple of lines below the top of the screen, we follow behind the raster beam down the screen, shifting color entries which have already been used on this frame.
 *   On the vblank interrupt, after swapping screen buffers etc, we start shifting the lower half of color RAM. As long as we're careful, we can shift it all before the VIC-II starts rasterizing the lower half of the next frame!

 <script src="https://gist.github.com/jeff-1amstudios/2e3dc4162e3391d9b065.js"></script>

<div class="video">
<div class="videowrapper"><iframe src="//www.youtube.com/embed/aid5klNPmiA?rel=0" frameborder="0"></iframe></div>
</div>

And there you have it. If anyone has a different implementation of this, I'd sure be interested to see it! :) Now, onto actually making a playable game...

[Source code for the version above](https://github.com/jeff-1amstudios/c64-smooth-scrolling)
