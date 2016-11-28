---
layout: post
title: Slack client for Commodore 64
tags:
- commodore64
- node
- slack
- assembly
---

[Slack](http://slack.com) is great. [Many](
http://www.theatlantic.com/technology/archive/2016/06/slack-eats-internet/488033/) [smarter](https://www.wired.com/2016/06/slack-social-network/) [people](http://arstechnica.com/information-technology/2016/03/what-slack-is-doing-to-our-offices-and-our-minds/) than me also think that Slack is great. Slack is great because its simple and easier to deal with than emails. With all the time it saves me on emails, I &nbsp; <s>relax</s> &nbsp; <s>go the beach</s> &nbsp; <s>write more code</s> &nbsp; send messages via Slack instead.

But while Slack might be great, it does not have a great native client for the Commodore 64. In fact, they have [no client for Commodore 64](https://slack.com/downloads/) at all!

## _This is clearly a problem._
<br>
Reasoning that _"a pull request is better than a complaint"_, I'm happy to present the first (and most likely only) Slack client for Commodore 64!
![](/img/c64/slack-header.jpg)

_"Team communication for the 21st century"_ ... now backwards compatible with 1985!

The C64 has an extension port called the [Userport](https://www.c64-wiki.com/index.php/User_Port) which, via an adapter, can communicate over RS-232 serial. I connected the Userport to a Raspberry Pi with a artisanal, locally sourced, homemade cable with the UserPort connector on one end, and a usb TTL-RS-232 converter on the other.  The fastest I have been able to run this reliably is a solid 1200 baud / 150 bytes per second.

<div class="row">
  <div class="col-md-4">
    <img src="/img/c64/cables.jpg" class="img-responsive" />
  </div>
  <div class="col-md-8">
    <img src="/img/c64/connect-1.jpg" class="img-responsive" />
  </div>
</div>

On the Commodore, I wrote an [application in 6502 assembly](https://github.com/jeff-1amstudios/c64-slack-client).  It uses built-in [Kernal](https://www.c64-wiki.com/index.php/Kernal) ROM functions to read and write the serial port and update the screen.

On the Pi, I wrote a [NodeJS app](https://github.com/jeff-1amstudios/c64-slack-client/tree/master/raspberry_pi) which talks to the Slack [RTM API](https://api.slack.com/rtm). It is reponsible for translating a simple RPC protocol between the C64 and itself and connecting to the outside world (in this case, Slack). It uses [serialport](https://www.npmjs.com/package/serialport) to talk to the USB serial driver.

<div class="row">
  <div class="col-md-6">
    <img src="/img/c64/loading.gif" class="img-responsive" />
  </div>
  <div class="col-md-6">
    <img src="/img/c64/slack-channels-full.gif" class="img-responsive" />
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <img src="/img/c64/slack-dm.gif" class="img-responsive" />
  </div>
  <div class="col-md-6">
    <img src="/img/c64/slash-commands.gif" class="img-responsive" />
  </div>
</div>

## RPC API

A simple RPC message format is defined between the C64 and Pi. The description below is all C-style, but of course on the C64 this is all implemented in 6502 assembly.

{% highlight C %}
struct rpc_message_t {
  char command_id;
  void *payload;
  char message_end_marker (0x7e);
}

struct channel_t {
  char len;
  char[9] channel_id;
  char[len-9] channel_name;
}
{% endhighlight %}

When the Pi gets a connection to Slack's RTM api, it kicks off communication with the C64. The protocol follows like this:

{% highlight C %}
[Pi >> ] HELLO {user: jeff}
[Commodore >> ] REQUEST_CHANNEL_LIST
[Pi >> ] CHANNELS_HEADER { channel_count, list_size_in_bytes }
[Pi >> ] CHANNELS_LIST { channel_data }

// user selects a channel on the C64
[Commodore >> ] CHANNEL_SELECT { channel_id }

// message arrives via Slack RTM api in the selected channel
[Pi >> ] MESSAGE_HEADER_LINE { ascii_data }
[Pi >> ] MESSAGE_LINE { ascii_data }
[Pi >> ] MESSAGE_LINE { ascii_data }
...

// user sends message from C64
[Commodore >> ] SEND_MESSAGE { message }
{% endhighlight %}

When the channel data has finished streaming, we switch to the Channels screen. This shows a scrollable list of all channels and groups, ordered by `unread_count, name`.
Hitting `[RETURN]` on a channel name sends `channel_id` to the Pi and switches to the Messages screen.

When a channel is joined, the Pi app sends the last couple of messages in the channel to the C64. Subsequently, whenever a message for that channel is recieved via the Slack websocket connection, it gets converted into a multiple lines of C64-compatible characters and sent across the serial connection.

Slash commands work too! We use the undocumented `chat.command` API found with help from Chrome dev tools :)

<div class='embed-container'><iframe src="http://www.youtube.com/embed/aIuSKUNrR6o?rel=0" frameborder="0" allowfullscreen></iframe>
</div>

<br>
Heres an example of the kind of code running on the C64. This is the top level processing loop:
<script src="https://gist.github.com/jeff-1amstudios/66cee5f3dd4e57c601e188ffc73d702d.js"></script>


### Want to do this yourself?  Of course you do. Why else are you still reading? ###

Hardware needed:

- 1 x Commodore64
- 1 x Raspberry Pi (really anything with usb which can run NodeJS)
- 1 x homemade C64 Userport <-> USB serial cable. [instructions](https://1200baud.wordpress.com/2012/10/14/build-your-own-c64-2400-baud-usb-device-for-less-than-15/)

Software:

- [https://github.com/jeff-1amstudios/c64-slack-client](https://github.com/jeff-1amstudios/c64-slack-client)
- `git clone https://github.com/jeff-1amstudios/c64-slack-client && vim c64-slack-client/README.md`

### Legal bit ###
_It goes without saying (surely?!) that the company named 'Slack' is not affiliated in any way with this project. I'm not sure if they would be happy or horrified to see this creation._