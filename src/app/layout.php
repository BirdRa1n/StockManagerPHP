<?php
function renderHead($title = 'StockManager') {
    echo "<!DOCTYPE html>
<html lang=\"pt-br\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>$title</title>
    <script src=\"https://cdn.tailwindcss.com\"></script>
</head>";
}

function renderFooter() {
    echo "</body></html>";
}