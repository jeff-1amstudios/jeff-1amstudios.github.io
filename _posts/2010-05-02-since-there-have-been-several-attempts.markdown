---
layout: post
title: Carmageddon Crush Data decoded
date: '2010-05-03T08:46:00.012+12:00'
author: Jeff
tags:
- XNA
- OpenC1
modified_time: '2010-10-21T08:18:46.574+13:00'
blogger_id: tag:blogger.com,1999:blog-5214518507411835668.post-3338556720429820343
blogger_orig_url: http://blog.1amstudios.com/2010/05/since-there-have-been-several-attempts.html
---
Since there have been several attempts to understand the C1 Crush data, I'll document it here, as far as I've worked out.

There are two header sections marked with `// CRUSH DATA`.  The first might be used only in low-mem mode, as it doesn't contain any crush positions, so I ignore it in OpenCarma.

Heres what the second header looks like:

{% highlight C %}
// CRUSH DATA
0.450000             /* damage multiplier.  This is lower for strong vehicles and higher for small, light vehicles */
0.150000,0.400000    // unknown.  seems to always be the same
0.050000             // (same)
0.050000             // (same)
0.000000             // (same)
0.000000             // (same)
93                   // number of vertices participating in crush
{% endhighlight %}

Next, a section for each of the 93 vertices (in this example) which are checked for crushing:

{% highlight C %}
65                          // index of this vertex
-0.1682, -0.1328, -0.4427   // min position that this vert can move to
-0.0682, -0.0540, -0.3427   // max position that this vert can move to
0.0121, 0.0156, 0.0062      // multipliers for left, top, rear collisions
0.0378, 0.0234, 0.0437      // multipliers for right, bottom, front collisions
74                          // number of child vertices to move if the main vertex is hit
{% endhighlight %}

Next, a section for each child vertex.

{% highlight C %}
// ----- (child vertex 1) -----
5        // vertex reference. This must be added to a counter which starts at -1 and incremented for each child vertex. So this actually references vertex 4 (-1 + 5) in PlayThing
178      // distance of this vert from the parent vertex

// ----- (child vertex 2) -----
5        // vertex reference. This is vertex 5 in PlayThing (-1 + 1 + 5)
133      // distance of this vert from the parent vertex

// ----- (child vertex 3) -----
5        // vertex reference. This is vertex 6 in PlayThing (-1 + 2 + 5)
117      // distance of this vert from the parent vertex
{% endhighlight %}

And so on for the other 71 children (in this example)

Hope that finally clears it up :)