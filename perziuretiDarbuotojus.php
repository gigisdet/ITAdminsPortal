<?php
// admin.php
// vartotojų įgaliojimų keitimas ir naujo vartotojo registracija, jei leidžia nustatymai
// galima keisti vartotojų roles, tame tarpe uzblokuoti ir/arba juos pašalinti
// sužymėjus pakeitimus į procadmin.php, bus dar perklausta

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "darbuotojai")&& ($_SESSION['prev'] != "admin")
    && $_SESSION['prev'] != "useredit" && ($_SESSION['prev'] != "visi"))   { header("Location: logout.php");exit;}
$_SESSION['prev']="darbuotojai";
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
            <h1>Darbuotojų informacija:</h1>
            <table  style="margin: 0px auto 50px auto;" >


                <?php
                session_start();
                $dbc=mysqli_connect('localhost','karpog', 'ohMee5ungisie9ah','karpog');

                if(!$dbc){
                    die ("Negaliu prisijungti prie MySQL:"	.mysqli_error($dbc));
                }


                //  nuskaityti viska bei spausdinti
                echo "<tr><th>Darbuotojo vardas</th><th>Paštas</th><th>Darbuotojo būsena</th><th>Atliktų darbų skaičius</th>
                        <th>Gedimų šalinimo laikas</th><th>Vidutinis suregavimo laikas</th><th>Vidutinis sutvarkymo laikas</th></tr>";
                //$registravoID = $_SESSION['userid'];

                $sql = "SELECT username,email,userid, id, kiek, arlaisvas FROM darbuotojai,users where userID = id";
                $result = mysqli_query($dbc, $sql);
                {while($row = mysqli_fetch_assoc($result))
                {
                    $arlaisvas = 'Laisvas';
                    $busena = $row['arlaisvas'];
                    if($busena == 0 ){
                        $arlaisvas='Užsiėmęs';}


                    echo "<tr><td>".$row['username']."</td><td>".$row['email']."</td><td>".$arlaisvas."</td><td>".$row['kiek'].
                        "</td>";


                    $id= $row['id'];
                    $sql7 = "SELECT sec_to_time(sum(sutvarkytaTime-registruotas)) as registruotas,
                              DaTE_FORMAT(sec_to_time(avg(sureguotaTime-registruotas)),'%k:%i:%s' ) as sureguota ,
                               DaTE_FORMAT(sec_to_time(avg(sutvarkytaTime-registruotas)),'%k:%i:%s' ) as sutvarkyta
                               FROM gedimas where darbuotojas='$id' and busena = 'Sutvarkytas'";
                    $reg = mysqli_query($dbc, $sql7);
                    {while($row = mysqli_fetch_assoc($reg))
                    {
                        echo "<td>".$row['registruotas']."</td><td>".$row['sureguota']."</td><td>".$row['sutvarkyta']."</td></tr>";
                    }
                    };
                }
                };
                echo "</table>";
                ?></table></table></div></div>
                <div id="content_footer"></div>
                <div id="footer">

                    <p>Copyright &copy; IT administratorių portalas</p>
                </div>
                <p>&nbsp;</p>
</body></html>
