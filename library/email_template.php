<?php

if (isset($_GET['emailgen_text'])) {
    echo generateEmail($_GET['emailgen_text']);
}

function generateEmail ($text) {
    return "<html><head>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
            <meta charset=\"UTF-8\">
    </head><body style=\"margin: 0;\">
      <div class=\"banner\" style=\"background-color: #b8b9ed;padding: 15px;font-family: 'Google Sans';font-size: 24px;box-shadow: 1px 1px 12px 0px #9b9b9b;font-weight: lighter;\">
      <img class=\"logo\" style=\"vertical-align: middle;padding-right: 10px;\" src=\"https://cdn-minteck-projects.000webhostapp.com/images/symbolic/PinPages.png\" width=\"32px\" height=\"32px\">
        PinPages
      </div>
      <div class=\"content\" style=\"margin: 15px;font-family: 'Google Sans';font-size: 14px;\">
         ". $text . "
      </div>
    <style>

.banner {
    background-color: #deb8ed;
    padding: 15px;
    font-family: 'Roboto Light';
    font-size: 24px;
    box-shadow: 1px 1px 12px 0px #deb8ed;
}

body {
    margin: 0;
}  

.logo {
    vertical-align: middle;
    padding-right: 10px;
}

.content {
    margin: 15px;
    font-family: 'Roboto';
    font-size: 14px;
  }</style></body></html>";
}