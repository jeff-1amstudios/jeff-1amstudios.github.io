---
layout: post
title: These pixels haven't been seen for 20 years!
---

In the original Need for Speed 1 game, there are 9 open-road tracks in environments (Alpine, Coastal, City). They are 'real' roads with traffic, as opposed to the circuit tracks where you simply raced a number of laps. The end of each open-road track is marked by a checkpoint, and once you drive underneath it, the car brakes to a stop. The faster you drive under the checkpoint, the further past the checkpoint you would travel before stopping.  When I played this game back in 1995, I was fascinated with what lay beyond the checkpoint, and always tried to see around that last corner! For people who haven't played the original (or did, but forgot in the last 20 years, heres a quick clip of exactly that happening.)  See the track carrying on to who knows where!

![](/img/opennfs1/original-checkpoint.gif)

With [OpenNFS1](http://1amstudios.com/projects/opennfs1), (my open-source NFS1 engine) we control whether the checkpoints stop your car or if allow you to drive right past them. 


### _We can now see those parts of the track which haven't been seen by anyone except the original developers back in 1995._

In this screenshot, we've driven past the checkpoint, and are looking back at it. This is the first time a screenshot has been captured showing the track from this position :)

![](/img/opennfs1/past-checkpoint-looking-back.jpg)

### So how are the checkpoints implemented in the Need for Speed engine? ###

A checkpoint is a piece of scenery, just like a tree or road sign.  Each scenery item has a position and an orientation, relative to the track, and a pointer to a scenery descriptor. A scenery descriptor describes a type of scenery, including size, textures, vertices, animations etc. Many scenery items can share a single descriptor. 

{% highlight C %}
struct SceneryObject
{
	SceneryObjectDescriptor Descriptor;
	int ReferenceNode;
	float Orientation;
	Vector3 PositionRelativeToRoad;
}

struct SceneryObjectDescriptor
{
	int Id;
	float Width, Height;
	SceneryFlags Flags;
	SceneryType Type;
	int ResourceId, Resource2Id;
	int AnimationFrameCount;
}
{% endhighlight %}

After some digging, it turns out that the checkpoint scenery descriptor always has a resourceId of 0x7c, which points to the checkpoint texture for the track, and also flags to the engine that this is _the checkpoint_.

There are no easter eggs unfortunately - it would have been great to find a photo of the dev team or something at the end of a track. But anyway, heres a video showing each of the previously lost sections of the open-road tracks!

<div class="video"><div class="videowrapper"><iframe src="http://www.youtube.com/embed/Xfv_UrDq-As?rel=0" frameborder="0" allowfullscreen></iframe>
</div></div>
