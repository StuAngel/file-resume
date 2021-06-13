# file-resume
server side file download / resume in PHP

this came about due to the fact that something like "document.getElementById('audo_player').currentTime = 10" wont work on a webserver that doesnt support byte ranges, eg. the PHP dev server - 

all it does is checks 

$_SERVER["HTTP_RANGE"]

to see if its been set with a specific range, if so it will only feed the required part of the file to the browser, this is also how file download resume works so 2 birds with one stone so to speak, 

additionally: if offset is set to 0 I log the fact the file has been accessed also, this is for my own purposes


example usage:
http://localhost:8000/file.php?/music/pop/inxs/the+greatest+hits/02+original+sin.mp3

in my case:

var a = document.createElement("audio");
var s = document.createElement("source");
s.type = 'audio/mpeg';
s.src = '/file.php?/music/pop/inxs/the+greatest+hits/02+original+sin.mp3';
a.appendChild(s);
a.play();

this will now allow 

a.currentTime = a.duration-5;

to function correctly.
