<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Settings - Aura</title>
</head>
<body>
    <div class="settings-container">
        <h1>User Settings</h1>
      
        <form method="post" action="../backend/process_settings.php">
          Theme<br><input type="range" min=0 max=6 name="theme" /><br>
          Tab Cloak<br><input type="range" min=0 max=6 name="cloak" />
          <input type="submit" value="Save" />
        </form>
      
    </div>

    <script>
      
      const themeSlider = document.getElementById('theme-slider');
      const themeValue = document.getElementById('theme-value');
      
        document.addEventListener('DOMContentLoaded', () => {
            // Get the theme slider and value span
            
            const themeNames = [
                "Dark Blue",
                "Light Gray",
                "Midnight",
                "Crimson",
                "Forest",
                "Ocean"
            ];
        });

      function save() {
        fetch("../backend/process_settings.php", {
    method: "POST",
    body: new URLSearchParams({
      theme: themeSlider.value
      
    })
  });
}
      
            
    </script>
</body>
</html>
