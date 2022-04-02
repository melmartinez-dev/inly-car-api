<?php

router("GET", "^/.*$", function () {
   die("<h1>SERVER ONLINE</h1>");
});

router("POST", "^/calculate$", new \App\http\controllers\CalculatorController());

header("HTTP/1.0 404 Not Found");
die('404 Not Found');
