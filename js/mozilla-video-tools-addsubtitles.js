/* Copyright (c) 2010, INRIAlpes
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of INRIAlpes nor the names of its contributors may
 *       be used to endorse or promote products derived from this software
 *       without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS ``AS IS''
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE REGENTS AND CONTRIBUTORS BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

/*
 * author            : Fabien Cazenave
 * contact           : fabien.cazenave@inria.fr, kaze@kompozer.net
 * license           : BSD
 * last modified     : 2010-07-13
 * Mozilla.com hooks : Pascal Chevrel <pascal@mozilla.com>
 */

var gTimeTable   = null;

// Initialize the two main objects as soon as the media duration is known.
function getSubtitles(haut) {
    //console.log(videoid);
  if(videoid == undefined) { videoid = "mediaPlayer" }

  videoidDesc = videoid +"Description";

  document.getElementById(videoid).style.display= '';
  var player = document.getElementById("htmlPlayer");
  var slides = document.getElementById(videoidDesc)
                       .getElementsByTagName("div");

  if (player.duration) {
    // metadata already loaded (media duration)
    gTimeTable   = new TimeTable(player, slides);

  }
  else {
    // wait for the metadata to be loaded (webkit browsers)
    player.addEventListener("durationchange", function() {
      gTimeTable   = new TimeTable(player, slides);
    }, true);
  }

// reposition subtitles compared to position of the video player in the window
// works with main video on top of page, buggy when you scroll the page and click another video

    subPos = 390 + parseFloat(haut);
    document.getElementById(videoid).style.top = subPos + 'px';
}

function hideSubtitles() {

    var subs = document.getElementsByClassName('subtitles');
    for (var i = 0; i < subs.length; i++)
    {
      subs[i].setAttribute("style.display", "none");
    }

    //put all slides as inactive so as to avoid having the last displayed slide reappear
    // on top of the first one of you close/restart the video player

    var len = document.getElementsByClassName('active').length;
    for (var i = 0; i < len; i++)
    {
      document.getElementsByClassName('active')[i].setAttribute("class", "");
    }

}

// This object fires an event
// when the <audio|video> player reaches a time segment edge.
function TimeTable(player, slides) {
  // read-only properties
  var segments = new Array();
  var index    = -1;
  this.getSegments = function() { return segments; };
  this.getIndex    = function() { return index;    };

  // parse start/stop times and colors
  for (var i = 0; i < slides.length; i++) {
    var segment = {};
    segment.slide = slides[i];
    segment.title = slides[i].getAttribute("data-title");
    segment.color = slides[i].getAttribute("data-color");
    segment.time_in = parseFloat(slides[i].getAttribute("data-start"));
    if (i < slides.length - 1)
      segment.time_out = parseFloat(slides[i+1].getAttribute("data-start"));
    else
      segment.time_out = player.duration;
    segments.push(segment);
  }

  // fire an event when <audio|video> reaches the edge of a segment
  player.addEventListener("timeupdate", function() {
    var time = player.currentTime;
    var oldIndex = index;
    var newIndex = 0;
    if ((oldIndex < 0) || (time < segments[oldIndex].time_in)
                       || (time > segments[oldIndex].time_out)) {
      // entering a new segment, let's find out which
      while ((newIndex < segments.length) && (segments[newIndex].time_out < time))
        newIndex++;
      index = newIndex; // store the new segment index
      // now display the related <div> node
      if (oldIndex >= 0)
        slides[oldIndex].setAttribute("class", "");
        slides[newIndex].setAttribute("class", "active");
    }
  }, true);
}