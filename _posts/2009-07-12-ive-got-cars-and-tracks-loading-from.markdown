---
layout: post
title: Loading cars and tracks
date: '2009-07-13T14:27:00.003+12:00'
author: Jeff
tags:
- XNA
- OpenC1
modified_time: '2014-03-18T18:03:33.186+13:00'
thumbnail: http://3.bp.blogspot.com/-9q5Vho-wSs4/TcJcPJ-oNcI/AAAAAAAAAGc/q7JmuaCHxMs/s72-c/cityb.jpg
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-6083964001182069446
blogger_orig_url: http://blog.1amstudios.com/2009/12/ive-got-cars-and-tracks-loading-from.html
---
I've got cars and tracks loading from their config files (so I can specify Data\Cars\blkeagle.txt, and Races\Citya1.txt) and all the associated textures, models and materials are loaded). Haven't done any performance tuning yet, so its a bit slow but heres a shot of CityB.  Note the dense fog - looks just like the original Carmageddon!

![](http://3.bp.blogspot.com/-9q5Vho-wSs4/TcJcPJ-oNcI/AAAAAAAAAGc/q7JmuaCHxMs/s1600/cityb.jpg)

The kerb material isn't being applied for some reason which is why its bright white.
Next step is to get a skybox running with the Carmageddon horizon texture to get rid of that white sky.  And fix the too-dark textures. Lots to do!