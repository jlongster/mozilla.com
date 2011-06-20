// IE9 doesn't support new Audio
if (!("Audio" in window)) {
    function Audio() {
        this.play = function(){};
        this.pause = function(){};
    }
}

createAudio = function(e) {
    var audio = document.createElement('audio');
    var source = document.createElement('source');
    source.src = e+'.ogg';
    source.type = 'audio/ogg; codecs="vorbis"';
    audio.appendChild(source);
    var source = document.createElement('source');
    source.src = e+'.ogg.mp3';
    source.type = 'audio/mpeg; codecs="mp3"';
    audio.appendChild(source);
    return audio;
}
