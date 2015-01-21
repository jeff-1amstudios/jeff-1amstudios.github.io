---
layout: post
title: Carmageddon 1 debugging symbols dumped
---

_TL;DR - Dumped a 17 year old debugging symbol file for a game called Carmageddon. Take a look at the [symbols](https://github.com/jeff-1amstudios/carmageddon1-symbol-dump) folder to see the output._


In the Carmageddon Splat Pack folder, there is a file called 'DETHRSC.SYM', last modified 13th November 1997. 

It has sat there, un-noticed and un-loved for the last 17 years, [ignored by the internet](https://www.google.com/#q=DETHRSRC.SYM+-torrent). Having made a [remake of the Carmageddon engine](http://1amstudios.com/projects/openc1), and being generally curious about random binary files, I tried to figure out the file format.  Immediately by looking at it in a hex editor, it was obviously a debugging symbol file, the question was which type of symbol file?  Of course, there are many symbol files with a .sym extension, and after some trial and error, it turned out to be a Watcom symbol file.  I grabbed a copy of [OpenWatcom](http://www.openwatcom.org/) and fired up the debugger, wd. It could read the symbols, but I never found any Carmageddon executable that matched up with it. It seems likely it was left there by mistake from a debug build.

![](/img/watcom-debugger.jpg)

Using wd to look at the symbols 1 by 1 in a little DOS window quickly becomes tiring, so then I wanted to dump the symbols out. For that, I needed the source code for the Watcom tools, and a working Open Watcom development environment.

(...Fast forward a while getting the environment up and finding where the code for handling symbol files lives...)

In the Watcom world, symbol file support is provided by various [DIPs](http://www.openwatcom.org/index.php/Debugging_Format_Interoperability). To use a DIP dll requires the calling program to implement various client-side methods to allow the DIP to alloc memory etc, and then to provide callback functions for the DIP to call when walking the symbol list. It's all pretty complex, but luckily there are a couple of utilities which illustrate generally how it should be done.  I based jsonsymdump off dipdump (which is advertised as dumping symbol files to text format, but crashes on DETHRSRC.SYM). I did the minimal amount of work in C required to generate a valid json file, then wrote a node.js script to take that json file and generate some semi-valid-ish c files.

### So what do we have after all that work?

![](/img/c1-symbols-filesystem.png)

You can browse the output in the symbols folder in the [carmageddon1-symbol-dump repo](https://github.com/jeff-1amstudios/carmageddon1-symbol-dump).

We now know all the methods and properties that were implemented in at least some build of the Carmageddon engine.  It's not going to allow anyone to reverse-engineer the engine without a matching executable, and we don't know how any of the methods were actually implemented. But it is interesting to see how things were named and organized, and by reading the method names, one can make some good guesses at what is happening at a high level in the game engine.

 * Files underneath the DETHRACE directory are Carmageddon. 
 * Files underneath the BRSRC13 directory are  [BRender](http://en.wikipedia.org/wiki/Argonaut_Games#BRender), a 3d graphics engine which Carmageddon used.


Some of the symbol names are funny, some might offend people, and some make no sense unless you are one of the original developers! A few examples:
{% highlight c %}
pedestrn: MakeFlagWavingBastardWaveHisFlagWhichIsTheProbablyTheLastThingHeWillEverDo()
globvars: _gSausage_override
opponent: ClearTwattageOccurrenceVariables()
opponent: _gNumber_of_cops_before_faffage
pedestrn: _gReally_stupid_ped_bug_enable
racestrt: DrawSceneyMappyInfoVieweyThing()
{% endhighlight %}


### How to build and run yourself (if anyone ever wants to...) ###

 * Follow the README in jsonsymdump to build the C binary
 * Run the node script:
 
{% highlight bash %}
npm install mkdirp
node jsonsymdump-to-headers.js
{% endhighlight %}