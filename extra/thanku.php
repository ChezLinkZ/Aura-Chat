<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>made with love</title>
<style>
  body {
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: white;
    overflow: hidden;
  }

  .text-container {
    position: relative;
    font-family: 'Your Cool Font', sans-serif; /* Replace with your desired font */
    font-size: 36px;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    animation: wiggleAndChange 5s ease-in-out infinite, fadeIn 2s ease-in;
  }

  @keyframes wiggleAndChange {
    0%, 3% {
      transform: translateX(0);
    }
    25% {
      transform: translateX(-5px) rotate(-2deg);
    }
    75% {
      transform: translateX(5px) rotate(2deg);
    }
  }

  @keyframes fadeIn {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }

  .animated-text {
    background-image: linear-gradient(45deg, #ed70dd, #b32dd6, #7ac7c5, #a87ac7, #ed70dd);
    background-size: 1000% 1000%;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: colorChange 2s linear infinite;
  }

  @keyframes colorChange {
    0% {
      background-position: 0% 0%;
    }
    100% {
      background-position: 100% 100%;
    }
  }
</style>
</head>
<body>
<div class="text-container">
  <h1 class="animated-text">made on our shitty servers with love <3</h1>
</div>
</body>
</html>
