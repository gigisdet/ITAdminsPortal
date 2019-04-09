<?php
// admin.php
// vartotojų įgaliojimų keitimas ir naujo vartotojo registracija, jei leidžia nustatymai
// galima keisti vartotojų roles, tame tarpe uzblokuoti ir/arba juos pašalinti
// sužymėjus pakeitimus į procadmin.php, bus dar perklausta

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "tvarko") && ($_SESSION['prev'] != "sutvarkyti")
&& $_SESSION['prev'] != "useredit")   { header("Location: logout.php");exit;}
$_SESSION['prev']="tvarko";
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
            <h1>Paskirti darbai</h1>
            <h2><?php echo $_SESSION['message1']; $_SESSION['message1'] = null; ?></h2>
            <table class="center" style="margin: 0px auto 50px auto;" >

                <?php
                session_start();
                include("include/nustatymai.php");
                $dbc = mysqli_connect('localhost', 'karpog', 'ohMee5ungisie9ah', 'karpog');

                if (!$dbc) {
                    die ("Negaliu prisijungti prie MySQL:" . mysqli_error($dbc));
                }

                //  nuskaityti viska bei spausdinti
                echo "<tr><th>Nr</th><th>Gedimo tipas</th><th>Gedimo aprašymas</th><th>Būsena</th></tr>";
                $darbuotojoID = $_SESSION['userid'];


                $sql = "SELECT * FROM gedimas where darbuotojas ='$darbuotojoID' and busena != 'Sutvarkytas'";
                $result = mysqli_query($dbc, $sql);

                {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $busena = $row['busena'];
                        $darbID = $row['darbuotojas'];
                        $id = $row['id'];
                        //$id = $row['id'];
                        echo "<tr><td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['tipas'] . "</td>";
                        echo "<td>" . $row['aprasymas'] . "</td>";


                        $gedimai_roles = array(      // vartotojų rolių vardai lentelėse ir  atitinkamos userlevel reikšmės
                            "Registruotas",
                            "Salinama",
                            "Sutvarkytas",);

                        echo "<td><form method = \"POST\"><select name=\"role_" . $id . "\">";
                        // echo "<select name=\"role_".$user."\">";
                        $yra = false;
                        foreach ($gedimai_roles as $x) {
                            echo "<option ";
                            if ($x == $busena) {
                                $yra = true;
                                //$pasirinktaBusena = $busena;

                                echo "selected ";
                                $id = $row['id'];
                            }
                            echo "value=\"" . $x . "\" ";
                            echo ">" . $x . "</option>";

                        }
                        echo "</form></select></td>";

                    }
                };


                $sql1 = "SELECT * FROM gedimas where darbuotojas ='$darbuotojoID' and busena != 'Sutvarkytas'";
                $result1 = mysqli_query($dbc, $sql1);

                if (isset($_POST['atnaujinti'])) {

                    if ($_POST != null) {
                        if (!in_array(null, $_POST)) {

                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $id = $row1['id'];
                                $busena = $_POST['role_' . $id];
                                $darbID = $row1['darbuotojas'];


                                $dbc = mysqli_connect('localhost', 'karpog', 'ohMee5ungisie9ah', 'karpog');


                                $sql = "Update gedimas set busena = '$busena' where id = '$id'";
                                mysqli_query($dbc, $sql);

                                if ($busena == 'Salinama') {
                                    $sql5 = "Update gedimas set sureguotaTime=now() where id = '$id'";
                                    mysqli_query($dbc, $sql5);

                                    $sql2 = "Update darbuotojai set arlaisvas = 0 where id='$darbID'";
                                    mysqli_query($dbc, $sql2);
                                }
                                if ($busena == 'Sutvarkytas') {
                                    $sql6 = "Update gedimas set sutvarkytaTime=now() where id = '$id'";
                                    mysqli_query($dbc, $sql6);
                                    $sql3 = "Update darbuotojai set kiek = kiek+1, arlaisvas = 1 where id='$darbID'";
                                    mysqli_query($dbc, $sql3);
                                }
                                $_SESSION['message1'] = "Pakeitimai atnaujinti sėkmingai!";
                                header("Location: darbuotojaiTvarko.php");

                            }


                        }
                    }
                }

                ?>
            </table>
            <form method="POST">
                <div class="form-group col-lg-2" style="margin-left: 160px;">
                    <input type='submit' name='atnaujinti' value='Atnaujinti'
                           class="btnbtn-default">
                </div>

            </form>
        </div>
    </div>
    <div id="content_footer"></div>
    <div id="footer">

        <p>Copyright &copy; IT administratorių portalas</p>
    </div>
    <p>&nbsp;</p>
</body>
</html>