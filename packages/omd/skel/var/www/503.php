#!###ROOT###/etc/apache/php-wrapper

<!DOCTYPE html>
<!--
    This is the omd maintenance page for when a proxied service is not available.
-->
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv='refresh' content='60'>
    <title>OMD Site Maintenance</title>
    <style>
      body {
        font-family: Arial, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
        color: #333;
      }
      .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        text-align: center;
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        gap: 15px;
        box-shadow: inset 0 0 0.5px 1px hsla(0, 0%, 100%, 0.075),
            0 0 0 1px hsla(0, 0%, 0%, 0.05),
            0 0.3px 0.4px hsla(0, 0%, 0%, 0.02),
            0 0.9px 1.5px hsla(0, 0%, 0%, 0.045),
            0 3.5px 6px hsla(0, 0%, 0%, 0.09);
      }
      h1 {
        margin: 0;
      }
      p {
        margin-bottom: 20px;
      }
      .warning {
        font-size: 42px;
        color: #ea580c;
      }
      /* dark mode colors */
      body.dark-mode {
        background-color: #333;
        color: #eee;
      }
      .dark-mode .container {
        background-color: #444;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="warning">&#x26A0;</div>
      <?php
        foreach($_REQUEST as $key => $val) {
            if(isset($_SERVER["CONFIG_".$key])) {
                if($_SERVER["CONFIG_".$key] == $val) {
                    print "<div><h1>OMD: $key not started</h1></div><div>Service '".$key."' is currently undergoing maintenance.</div>";
                } else {
                    print "<div><h1>OMD: $key not enabled</h1></div><div>Service '".$key."' is disabled.</div>";
                }
            }
        }
      ?>
      <div>Please check back later.</div>
      <div><button onclick="window.location.reload()">retry now</button></div>
    </div>
  </body>
  <script>
    function setTheme() {
      const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
      if(prefersDarkScheme.matches) {
          document.body.classList.add('dark-mode');
      } else {
          document.body.classList.remove('dark-mode');
      }
    }
    setTheme();
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
      setTheme();
    });
  </script>
</html>

