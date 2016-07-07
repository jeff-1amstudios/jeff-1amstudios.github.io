---
layout: post
title: Rendering animated GIFs on a Commodore64
tags:
- graphics
- commodore64
- node
---

If you've always thought the one thing the world needed was rendering animated GIFs on a Commodore64, then you've come to the right place!  I've written a tool called [gif-to-c64-sprites](https://github.com/jeff-1amstudios/gif-to-c64-sprites) which takes an animated GIF file as input, and outputs a stream of Commodore64 hardware sprite format data.

[TLDR; show me the final result](#examples)

### How does that work?

First, a refresher on C64 hardware sprites... Hardware sprites are 24x21 pixels in size, and can be moved freely around the screen, either above or below the character or pixel-based screen memory. They are commonly used for small moving items because they do not require memory to be copied around to change their position on the screen. The [VIC-II](https://www.c64-wiki.com/index.php/VIC#VIC-II) graphics hardware is responsible for rendering the sprites, freeing the CPU to do other things. Up to 8 sprites can be displayed at once, each one enabled by setting the corresponding bit in `$d015` ( sprite-enable register). Other registers specify the pointer to sprite data, position of the sprite on the screen and color, horizontal and vertical scaling, and collision detection with another sprite. 

<div class="row">
<div class="col-md-6">
<br>
This example image shows how the data for a default single-color sprite is laid out. A sprite only takes up 63 bytes. In single-color mode, those 63 bytes are used to represent 24x21 pixels, where the pixel can be either set or not set and is represented with a single bit.
<p>24 bits (3 bytes) across * 21 rows = 63 bytes. In the image, the first row is the byte count, the second row is the bit count.</p>

</div>
<div class="col-md-6">
  <img src="/img/c64/c64-sprite-desc.png" style="width:100%"/>
</div>
</div>

The data pointer is only 8 bits, so to make the whole 16kb memory bank addressable, the value in the register is multiplied internally by 64 before fetching the data. Heres some example code to enable sprite #0:

<script src="https://gist.github.com/jeff-1amstudios/254ad8c3bbd1a4c752f0933db4624f27.js"></script>

To animate a C64 sprite, first you need to store multiple 63-byte chunks of sprite data, one after the other, on 64-byte boundaries. (eg at 64, 128, 192...). Then on each screen refresh you change the data pointer to point to the next chunk of sprite data, often by doing a `inc $07f8`. This command adds 1 to the specified memory address. Because the value of the register is multiplied internally by 64, this has the effect of moving the pointer to the start of the next 64 byte chunk of sprite data.  Once you reach the last chunk of sprite data, you reset the pointer back to the initial value, and you have an animation loop!

<script src="https://gist.github.com/jeff-1amstudios/7355d73284aab8e4e34aa7119e09c6a5.js"></script>

Thats the C64 side of things, for more details, there are [plenty](http://www.zimmers.net/cbmpics/cbm/c64/c64prg.txt) of [better](http://dustlayer.com/c64-coding-tutorials/2013/5/24/episode-3-3-loading-shapes-and-grasping-symbols) [descriptions](https://digitalerr0r.wordpress.com/2011/03/31/commodore-64-programming-4-rendering-sprites/) than mine!

### gif-to-c64-sprites
Now that we know how to animate hardware sprites on the C64 the only trick left is how to generate the sprite data. [SpritePad](http://www.subchristsoftware.com/spritepad.htm) is a great tool but unfortunately I am too lazy to create my own assets. :( 

Instead I wrote [gif-to-c64-sprites](https://github.com/jeff-1amstudios/gif-to-c64-sprites) - a little node script which uses [gifsicle](https://www.npmjs.com/package/gifsicle) and [get-pixels](https://www.npmjs.com/package/get-pixels) to pick out pixel data from each frame in an animated gif. Each frame is converted into a C64 sprite chunk by bitshifting pixels into byte buffers. As it only currently outputs single-color sprites, it works best for cartoon-like source images.

Below are some cool examples I generated using the tool and the C64 sprite animation code above.

<div class="row" id="examples">
  <div class="col-lg-1"></div>
  <div class="col-lg-5">
    <img data-gifffer="/img/c64/jumping-cat-animation.gif" />
  </div>
  <div class="col-lg-5">
    <a href="http://giphy.com/gifs/cat-funny-cartoon-gdV3ovQ3NY1zO">(Original cat jumping GIF)</a><br>
  </div>
</div>
<div class="row">
  <div class="col-lg-1"></div>
  <div class="col-lg-5">
    <img data-gifffer="/img/c64/running-dog-animation.gif" />
  </div>
  <div class="col-lg-5">
    <a href="http://www.animatedimages.org/data/media/202/animated-dog-image-0175.gif">(Original dog running GIF)</a>
  </div>
</div>
<div class="row">
  <div class="col-lg-1"></div>
  <div class="col-lg-5">
    <img data-gifffer="/img/c64/typing-animation.gif" />
  </div>
  <div class="col-lg-5">
    <a href="http://giphy.com/gifs/keyboard-head-smash-OG8jlh9Pkcpm8">(Original keyboard smashing GIF)</a>
  </div>
</div>


### Double-size mode
When you use the `--doubleSize` option, 4 sprites are generated per frame, by splitting the source image into 4 quadrants. This gives better image quality, with the expense of using 4x the amount of data. On the C64 we display 4 sprites in a square shape next to each other to create the image. In the screenshot below, I've set each sprite to be a different color to illustrate how the final image is combined. There is an example C64 app showing how to do this in the gif-to-c64-sprites repo.

<img src="/img/c64/4-sprites.png" style="max-width:400px"/>

[https://github.com/jeff-1amstudios/gif-to-c64-sprites](https://github.com/jeff-1amstudios/gif-to-c64-sprites)