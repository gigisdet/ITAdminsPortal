<?php 
// useredit.php 
// vartotojas gali pasikeisti slaptažodį ar email
// formos reikšmes tikrins procuseredit.php. Esant klaidų pakartotinai rodant formą rodomos ir klaidos

session_start();
// sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "procuseredit")
        && ($_SESSION['prev'] != "useredit") && $_SESSION['prev']!="registruoti" && ($_SESSION['prev']!="perziureti")
        && ($_SESSION['prev'] != "tvarko") && ($_SESSION['prev'] != "sutvarkyti") && ($_SESSION['prev'] != "darbuotojai")
        && ($_SESSION['prev'] != "visi")&& ($_SESSION['prev'] != "admin")))
{header("Location: logout.php");exit;
}
if ($_SESSION['prev'] == "index")								  
	{$_SESSION['mail_login'] = $_SESSION['umail'];
	$_SESSION['passn_error'] = "";      // papildomi kintamieji naujam password įsiminti
	$_SESSION['passn_login'] = ""; }  //visos kitos turetų būti tuščios
$_SESSION['prev'] = "useredit"; 
?>

<?php
// admin.php
// vartotojų įgaliojimų keitimas ir naujo vartotojo registracija, jei leidžia nustatymai
// galima keisti vartotojų roles, tame tarpe uzblokuoti ir/arba juos pašalinti
// sužymėjus pakeitimus į procadmin.php, bus dar perklausta


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
                <!-- class="logo_colour", allows you to change the colour of the text -->
                <h1><a href="index.html">IT administratorių portalas</span></a></h1>
            </div>
        </div>
        <?php include("include/meniu.php") ?>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
        <?php include("include/UserInfo.php") ?>
        <div id="content">
            <h1>Paskyros redagavimas</h1>
            <table >
                <tr><td>
                        <form action="procuseredit.php" method="POST" class="login">

                            <p style="text-align:left;">Dabartinis slaptažodis:<br>
                                <input class ="s1" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"><br>
                                <?php echo $_SESSION['pass_error']; ?>
                            </p>

                            <p style="text-align:left;">Naujas slaptažodis:<br>
                                <input class ="s1" name="passn" type="password" value="<?php echo $_SESSION['passn_login']; ?>"><br>
                                <?php echo $_SESSION['passn_error']; ?>
                            </p>

                            <p style="text-align:left;">E-paštas:<br>
                                <input class ="s1" name="email" type="text" value="<?php echo $_SESSION['mail_login']; ?>"><br>
                                <?php echo $_SESSION['mail_error']; ?>
                            </p>

                            <p style="text-align:left;">
                                <input type="submit" name="login" value="Atnaujinti"/>
                            </p>
                        </form>
                    </td></tr>
            </table>
        </div>
    </div>
    <div id="content_footer"></div>
    <div id="footer">

        <p>Copyright &copy; IT administratorių portalas</p>
    </div>
    <p>&nbsp;</p>
</body>
</html>
	


