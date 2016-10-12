
var canvas = document.querySelector("canvas");
var image = document.querySelector("#userImg");
var video = document.querySelector("#videoElement");
var ctx = canvas.getContext('2d');
var localMediaStream = null;
var activeOverlay = 1;
var activeOverlayElem;

document.querySelector("#ovr2").style.backgroundColor =  "rgba(54,70,93, .2)";
document.querySelector("#ovr1").style.backgroundColor =  "#444";

function    setActiveOverlay(image)
{
    if (image <= 2 && image > 0)
    {
        activeOverlay = image;
        console.log("image : ", activeOverlay)
        switch (activeOverlay) 
        {
			case 2:   
        	    document.querySelector("#ovr2").style.backgroundColor = "#444";
				document.querySelector("#ovr1").style.backgroundColor = "rgba(54,70,93, .2)";
				break;
			default:
				document.querySelector("#ovr1").style.backgroundColor = "#444";
				document.querySelector("#ovr2").style.backgroundColor = "rgba(54,70,93, .2)";
          break;
        }
    }
}

function dataURItoBlob(dataURI) 
{
    var binary = atob(dataURI.split(',')[1]);
    var array = [];
    for(var i = 0; i < binary.length; i++) {
        array.push(binary.charCodeAt(i));
    }
    return new Blob([new Uint8Array(array)], {type: 'image/png'});
}

function snapshot()
{
  if (localMediaStream)
  {
    var w = video.offsetWidth;
    var h = w / 1.333333333333;
    canvas.width = w;
    canvas.height = h;
    ctx.drawImage(video, 0, 0, w, h);
    document.getElementById( 'upload_status' ).innerHTML = '<h1>Uploading...</h1>';
    var dataURL = canvas.toDataURL('image/png')
    image.src = dataURL;
    var blob = dataURItoBlob(dataURL);
    uploadFile(blob,"webcam", null);
  }
}

video.addEventListener('click', snapshot, false);

navigator.getUserMedia = navigator.getUserMedia 
  || navigator.webkitGetUserMedia || navigator.mozGetUserMedia 
  || navigator.msGetUserMedia || navigator.oGetUserMedia;

if (navigator.getUserMedia) {
    navigator.getUserMedia({video: true}, handleVideo, videoError);
}

function handleVideo(stream) 
{
    video.src = window.URL.createObjectURL(stream);
    localMediaStream = stream;
}

function videoError(e) 
{
    alert("Unable to open stream");
}

