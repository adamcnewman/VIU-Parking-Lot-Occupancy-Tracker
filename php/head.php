<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/index_style.css">
    <title>View Park</title>
</head>
<body>
<script>
    if (!window.localStorage.getItem("LOGIN_STATUS")) // if it is the first time for the user logging in, LOGIN_STATUS is null 
    {
        window.localStorage.setItem("LOGIN_STATUS", "0");
    }
</script>
<div class="header">
    <h1>View Park</h1>
    <h3>Get the most up to date and accurate VIU parking information (slogan needs work)</h3>
</div>