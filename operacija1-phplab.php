<?php
// admin.php
// vartotojų įgaliojimų keitimas ir naujo vartotojo registracija, jei leidžia nustatymai
// galima keisti vartotojų roles, tame tarpe uzblokuoti ir/arba juos pašalinti
// sužymėjus pakeitimus į procadmin.php, bus dar perklausta

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "useredit")&& ($_SESSION['prev'] != "perziureti")
    && ($_SESSION['prev'] != "registruoti"))
{ header("Location: logout.php");exit;}
$_SESSION['prev']="registruoti";
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
            <h1>Registruokite gedimą</h1>
            <b><?php echo $_SESSION['message1']; $_SESSION['message1'] = null; ?></b>
            <table class="center" style="margin: 0px auto 50px auto;" >


<?php
		//session_start();
include("include/nustatymai.php");
$dbc=mysqli_connect('localhost','karpog', 'ohMee5ungisie9ah','karpog');
		if(!$dbc){
			die ("Negaliu prisijungti prie MySQL:"	.mysqli_error($dbc));
		}	
		if($_POST !=null){

            if(!in_array(null, $_POST))
            {

                $sql = "SELECT * FROM darbuotojai \n"
                    . "ORDER BY arlaisvas DESC , kiek ASC\n"
                    . "limit 1";
                $result = mysqli_query($dbc, $sql);
                $row = mysqli_fetch_assoc($result);
                $darb = $row['id'];

                $tipas = $_POST['tipas'];
                $zinute = $_POST['zinute'];
                $userID = $_SESSION['userid'];
                $busena = 'Registruotas';


                $sql = "INSERT INTO gedimas (tipas, aprasymas, registruotas, registravoID, darbuotojas, busena) VALUES ('$tipas', '$zinute',now(), '$userID','$darb', '$busena')";
                if (mysqli_query($dbc, $sql))
                {
                    $_SESSION['message1'] = "Gedimas irašytas sėkmingai!";
                    header("Location: operacija1-phplab.php");
                }
                else
                {
                    $_SESSION['message1'] =  "Klaida!";
                    header("Location: operacija1-phplab.php");
                    //echo "<script type = 'text/javascript'>alert(`$erroras`);</script>";
                }

            }
            else
            {
                $_SESSION['message1'] = "Ne visi laukai užpildyti";
                header("Location: operacija1-phplab.php");
                //echo "<script type = 'text/javascript'>alert(`$erroras`);</script>";
            }
	    };
?>
<br>

<div class="container">
  <form method='POST'>
     
	  <div class="form-group col-lg-4">
          <label for="kam" class="control-label">Gedimo tipas:</label><br>

          <select id="tipas" name="tipas">
              <option value="Nepasirinkta">--Pasirinkite gedimo tipa--</option>
              <option value="PC">PC</option>
              <option value="LAN">LAN</option>
          </select>
		           
     </div>
     <div class="form-group col-lg-12">
          <label for="zinute" class="control-label">Gedimo aprašymas:</label><br>
          <textarea name='zinute' class="form-control input-sm"></textarea>
     </div>
     <div class="form-group col-lg-2">
         <input type='submit' name='ok' value='Registruoti' class="btnbtn-default">
     </div>

	  
 </form>
</div>
</body>
