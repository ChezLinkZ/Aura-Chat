<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Virtual Keyboard</title>
<style>
  body {
    background-color: #f5f5f5;
    font-family: 'Raleway', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }
  .keyboard {
    display: grid;
    grid-template-columns: repeat(14, 1fr);
    grid-gap: 5px;
    max-width: 800px;
    padding: 20px;
    border-radius: 10px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  }
  .key {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 60px;
    border: 2px solid #ccc;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.1s, transform 0.1s;
    user-select: none;
    font-size: 18px;
  }
  .key.active {
    background-color: #eee;
    transform: scale(0.95);
  }
</style>
<link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
</head>
<body>
<div class="keyboard" id="keyboard">
  <div class="key" style="grid-column: 1 / span 1;">~<br>`</div>
  <div class="key" style="grid-column: 2 / span 1;">1<br>!</div>
  <div class="key" style="grid-column: 3 / span 1;">2<br>@</div>
  <div class="key" style="grid-column: 4 / span 1;">3<br>#</div>
  <div class="key" style="grid-column: 5 / span 1;">4<br>$</div>
  <div class="key" style="grid-column: 6 / span 1;">5<br>%</div>
  <div class="key" style="grid-column: 7 / span 1;">6<br>^</div>
  <div class="key" style="grid-column: 8 / span 1;">7<br>&</div>
  <div class="key" style="grid-column: 9 / span 1;">8<br>*</div>
  <div class="key" style="grid-column: 10 / span 1;">9<br>(</div>
  <div class="key" style="grid-column: 11 / span 1;">0<br>)</div>
  <div class="key" style="grid-column: 12 / span 1;">-<br>_</div>
  <div class="key" style="grid-column: 13 / span 1;">=<br>+</div>
  <div class="key" style="grid-column: 14 / span 1;">Backspace</div>

  <div class="key" style="grid-column: 1 / span 1;">Tab</div>
  <div class="key" style="grid-column: 2 / span 1;">Q</div>
  <div class="key" style="grid-column: 3 / span 1;">W</div>
  <div class="key" style="grid-column: 4 / span 1;">E</div>
  <div class="key" style="grid-column: 5 / span 1;">R</div>
  <div class="key" style="grid-column: 6 / span 1;">T</div>
  <div class="key" style="grid-column: 7 / span 1;">Y</div>
  <div class="key" style="grid-column: 8 / span 1;">U</div>
  <div class="key" style="grid-column: 9 / span 1;">I</div>
  <div class="key" style="grid-column: 10 / span 1;">O</div>
  <div class="key" style="grid-column: 11 / span 1;">P</div>
  <div class="key" style="grid-column: 12 / span 1;">[<br>{</div>
  <div class="key" style="grid-column: 13 / span 1;">]<br>}</div>
  <div class="key" style="grid-column: 14 / span 1;">\ <br>|</div>

  <div class="key" style="grid-column: 1 / span 1;">Caps<br>Lock</div>
  <div class="key" style="grid-column: 2 / span 1;">A</div>
  <div class="key" style="grid-column: 3 / span 1;">S</div>
  <div class="key" style="grid-column: 4 / span 1;">D</div>
  <div class="key" style="grid-column: 5 / span 1;">F</div>
  <div class="key" style="grid-column: 6 / span 1;">G</div>
  <div class="key" style="grid-column: 7 / span 1;">H</div>
  <div class="key" style="grid-column: 8 / span 1;">J</div>
  <div class="key" style="grid-column: 9 / span 1;">K</div>
  <div class="key" style="grid-column: 10 / span 1;">L</div>
  <div class="key" style="grid-column: 11 / span 1;">;<br>:</div>
  <div class="key" style="grid-column: 12 / span 1;">'<br>"</div>
  <div class="key" style="grid-column: 13 / span 2;">Enter</div>

  <div class="key" style="grid-column: 1 / span 1;">Shift</div>
  <div class="key" style="grid-column: 2 / span 1;">Z</div>
  <div class="key" style="grid-column: 3 / span 1;">X</div>
  <div class="key" style="grid-column: 4 / span 1;">C</div>
  <div class="key" style="grid-column: 5 / span 1;">V</div>
  <div class="key" style="grid-column: 6 / span 1;">B</div>
  <div class="key" style="grid-column: 7 / span 1;">N</div>
  <div class="key" style="grid-column: 8 / span 1;">M</div>
  <div class="key" style="grid-column: 9 / span 1;">,<br>&lt;</div>
  <div class="key" style="grid-column: 10 / span 1;">.<br>&gt;</div>
  <div class="key" style="grid-column: 11 / span 1;">/<br>?</div>
  <div class="key" style="grid-column: 12 / span 1;">Shift</div>

  <div class="key" style="grid-column: 1 / span 2;">Ctrl</div>
  <div class="key" style="grid-column: 3 / span 1;">Win</div>
  <div class="key" style="grid-column: 4 / span 1;">Alt</div>
  <div class="key" style="grid-column: 9 / span 3;">Space</div>
  <div class="key" style="grid-column: 12 / span 2;">Alt</div>
  <div class="key" style="grid-column: 14 / span 1;">Ctrl</div>
</div>
<script>
  const keys = document.querySelectorAll('.key');

  keys.forEach(key => {
    key.addEventListener('mousedown', () => {
      key.classList.add('active');
    });

    key.addEventListener('mouseup', () => {
      key.classList.remove('active');
    });

    key.addEventListener('mouseout', () => {
      key.classList.remove('active');
    });

    key.addEventListener('touchstart', () => {
      key.classList.add('active');
    });

    key.addEventListener('touchend', () => {
      key.classList.remove('active');
    });
  });

  document.addEventListener('keydown', event => {
    const key = event.key.toUpperCase();
    const targetKey = document.querySelector(`.key:contains('${key}')`);

    if (targetKey) {
      targetKey.classList.add('active');
    }
  });

  document.addEventListener('keyup', event => {
    const key = event.key.toUpperCase();
    const targetKey = document.querySelector(`.key:contains('${key}')`);

    if (targetKey) {
      targetKey.classList.remove('active');
    }
  });


  </div>
<script>
  const keys = document.querySelectorAll('.key');

  keys.forEach(key => {
    key.addEventListener('click', () => {
      key.style.backgroundColor = '#ddd';
      key.style.transform = 'scale(0.95)';
      setTimeout(() => {
        key.style.backgroundColor = '';
        key.style.transform = '';
      }, 100);
    });
  });

  document.addEventListener('keydown', event => {
    const key = event.key.toUpperCase();
    const pressedKey = Array.from(keys).find(k => k.textContent === key);
    if (pressedKey) {
      pressedKey.style.backgroundColor = '#ddd';
      pressedKey.style.transform = 'scale(0.95)';
      setTimeout(() => {
        pressedKey.style.backgroundColor = '';
        pressedKey.style.transform = '';
      }, 100);
    }
  });

</script>
</body>
</html>

  
</div>
<script>
  const keys = document.querySelectorAll('.key');

  keys.forEach(key => {
    key.addEventListener('click', () => {
      key.style.backgroundColor = '#ddd';
      key.style.transform = 'scale(0.95)';
      setTimeout(() => {
        key.style.backgroundColor = '';
        key.style.transform = '';
      }, 100);
    });
  });

  document.addEventListener('keydown', event => {
    const key = event.key.toUpperCase();
    const pressedKey = Array.from(keys).find(k => k.textContent === key);
    if (pressedKey) {
      pressedKey.style.backgroundColor = '#ddd';
      pressedKey.style.transform = 'scale(0.95)';
      setTimeout(() => {
        pressedKey.style.backgroundColor = '';
        pressedKey.style.transform = '';
      }, 100);
    }
  });
</script>
</body>
</html>
