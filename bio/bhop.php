<!DOCTYPE html>
<html>
<head>
    <title>Bhop</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />




    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  /> 
  <style>
    body {
      margin: 0;
      overflow: hidden;
    }

    #canvas {
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0); /* background */
      z-index: -1;
    }
  </style>
</head>
<body>
  
    <div class="snow-container">
        <div class="snow"></div>
    </div>
    <div class="content-container">
        <img class="profile-pic" src="../assets/images/profile.jpg" alt="Profile Picture">
        <h1 class="name">Bhop <img class="verified-icon" src="../assets/images/verified.png" alt="Verified"></h1>
        <p class="description">Hi 👋, I cheat in a block game.</p>
      
        <style> body { background-image: url('../assets/video/darkvideo.gif'); background-repeat: no-repeat;
  background-size: 100vw 100vh} </style>
        <!-- links -->
        <div class="links">
            <a href="https://github.com/Bhoppings" target="_blank" class="link-btn"><i class="fab fa-github"></i></a>
            <a href="https://discord.gg/55CUz7fcZh" target="_blank" class="link-btn"><i class="fab fa-discord"></i></a>
            <a href="https://www.youtube.com/channel/UCIEDodB2qUqUV945f6cL7Bg" target="_blank" class="link-btn"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
    <audio src="../assets/sounds/example.mp3" id="my_audio" loop="loop"></audio>
    <div class="transparent-button" onclick="music();">
        <a href="#" id="play-audio-button">
            <img src="../assets/images/audio2.png" alt="" class="button-image">
        
        </a>
    </div>
  <canvas id="canvas"></canvas>
    <style>

            /* click anywhere overlay */





      
        body {
    margin: 0;
    padding: 0;
    overflow: hidden;
  }
  #overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 1);
    display: flex;
    justify-content: center;
    align-items: center;
    transition: opacity 0.5s;
    pointer-events: auto;
    z-index: 9999;
  }
  #overlay.hidden {
    opacity: 0;
    pointer-events: none;
  }
  #overlay-text {
    color: white;
    font-size: 24px;
    text-align: center;
  }







     
            body * {
      font-family: Raleway;
              font: Raleway;
    }
    body {
    margin: 0;
    font-family: 'Raleway', sans-serif;
    background-color: #1a1a1a;
    color: white;
    overflow: hidden;
}





    @font-face {
        font-family: 'Raleway';
        src: url('../assets/fonts/Raleway-VariableFont_wght.ttf') format('truetype');
    }

    .body {
        font-family: 'Raleway', sans-serif;
    }






      
.snow-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    pointer-events: none;
    z-index: -1;
    opacity: 0.7;
}

.snow {
    background-image: url('../assets/images/snowflake.png');
    animation: snowfall 5s linear infinite;
    pointer-events: none;
    opacity: 0.8;
}

@keyframes snowfall {
    to {
        transform: translateY(100vh);
    }
}



    body {
    margin: 0;
    font-family: 'Montserrat', sans-serif;
    background-color: #1a1a1a;
    color: white;
}

.content-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
  background-color: url("../assets/images/japan-blur.png");
}

.profile-pic {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
}

.name {
    font-size: 2rem;
    margin: 10px 0;
    position: relative;
    animation: pulse;
}

.verified-icon {
    width: 20px;
    height: 20px;
    margin-left: 5px;
    vertical-align: middle;
}

.description {
    font-size: 0.875rem;
    margin-bottom: 20px;
}

.links {
    display: flex;
    gap: 10px;
}

.link-btn {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #424242;
    color: white;
    transition: background-color 0.3s;
    text-decoration: none;
}

.link-btn:hover {
    background-color: #525252;
}

.link-btn i {
    font-size: 1.5rem;
}


      .button-image {
        position: relative;
        left: 50%;
        top: 50%;
        transform: TranslateX(-50%);
      }
/*
there i fixed it*/




 
    </style>
  <div id="overlay" class="" onclick="hideOverlay()">
  <div id="overlay-text">[ CLICK ANYWHERE ]</div>
</div>

    <script>
  
          function hideOverlay() {
    const overlay = document.getElementById("overlay");
    overlay.classList.add("hidden");
  }
    
    document.addEventListener('DOMContentLoaded', () => {
    const glowingText = document.querySelector('.name');
    glowingText.classList.add('glow-text');

      
    const typingText = document.querySelector('.description');
    typingEffect(typingText, 'Hi 👋, I cheat in a block game.', 100);
});

function typingEffect(element, text, delay) {
    element.textContent = '';
    let index = 0;

    function type() {
        if (index < text.length) {
            element.textContent += text[index];
            index++;
            setTimeout(type, delay);
        }
    }

    type();

  
}


        // event listener
        document.getElementById("play-audio-button").addEventListener("click", function() {
            //document.getElementById("my_audio").play();
        });


      
    </script>

    <script>
      var audio = new Audio("../assets/sounds/example.mp3");
      function music() {
       // file load

      var context = new AudioContext();
      var src = context.createMediaElementSource(audio);
      var analyser = context.createAnalyser();

      var canvas = document.getElementById("canvas");
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
      var ctx = canvas.getContext("2d");

      src.connect(analyser);
      analyser.connect(context.destination);

      analyser.fftSize = 256;

      var bufferLength = analyser.frequencyBinCount;
      var dataArray = new Uint8Array(bufferLength);

      var WIDTH = canvas.width;
      var HEIGHT = canvas.height;

      var barWidth = (WIDTH / bufferLength) * 2.5;
      var barHeight;
      var x = 0;

      function renderFrame() {
        requestAnimationFrame(renderFrame);

        x = 0;

        analyser.getByteFrequencyData(dataArray);

        ctx.clearRect(0, 0, WIDTH, HEIGHT);

        for (var i = 0; i < bufferLength; i++) {
          barHeight = dataArray[i];

          var r = barHeight + (172 * (i / bufferLength));
          var g = 221 * (i / bufferLength);
          var b = 238;

          ctx.fillStyle = "rgb(" + r + "," + g + "," + b + ")";
          ctx.fillRect(x, HEIGHT - barHeight, barWidth, barHeight);

          x += barWidth + 1;
        }
      }

      audio.play();
      renderFrame();
    };
    </script>
      
</body>
<style>
    /* transparent button */
    .transparent-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .button-image {
        max-width: 40%;
        max-height: 40%;
        align-content: center;
        justify-content: center;
        align-items: center;
        width: 40%;
        height: 40%;
    }
</style>
</html>
