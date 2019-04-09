<?php
// index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

session_start();
include("include/functions.php");
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="include/styles.css" rel="stylesheet" type="text/css">
    <title>IT administratorių portalas</title>
    <meta name="description" content="website description"/>
    <meta name="keywords" content="website keywords, website keywords"/>
    <meta http-equiv="content-type" content="text/html; charset=windows-1252"/>
    <link rel="stylesheet" type="text/css" href="include/styles.css"/>

    <!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
    </script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
    </script> -->
</head>
<body>
<div id="main">
    <div id="header">
        <div id="logo">
            <div id="logo_text">
                <h1><a href="index.php">IT administratorių portalas</span></a></h1>
            </div>
        </div>
     <?php

    if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
    {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
    // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']

    inisession("part");   //   pavalom prisijungimo etapo kintamuosius
    $_SESSION['prev'] = "index";

    include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
        ?>
        </div>
    <div id="content_header"></div>
    <div id="site_content">
                <?php include("include/UserInfo.php") ?>
        <div id="content">
            <h1>Sveiki atvyke!</h1>
        </div>
    </div>
    <div id="content_footer"></div>
    <div id="footer">

        <p>Copyright &copy; IT administratorių portalas</p>
    </div>
    <p>&nbsp;</p>
</body>
</html>

    <?php
    } else {
    if (!isset($_SESSION['prev'])) inisession("full");             // nustatom sesijos kintamuju pradines reiksmes
    else{
            if ($_SESSION['prev'] != "proclogin") inisession("part"); // nustatom pradines reiksmes formoms
        }
        // jei ankstesnis puslapis perdavė $_SESSION['message']
        echo "<div align=\"center\">";
        echo "<font size=\"4\" color=\"#ff0000\">" . $_SESSION['message'] . "<br></font>";
        include("include/login.php");                    // prisijungimo forma
    }
    ?>




