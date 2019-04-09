<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
//include("include/styles.css");
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
}

    // echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";

/*
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>".$user."</b>     Rolė: <b>".$role."</b> <br>";
        echo "<ul id=\"menu\">";
        echo "<li><a style=\"position: absolute; left: 10px;\"href=\"logout.php\">Atsijungti</a></li><br><br>";
        echo "</td></tr><tr><td>";*/


echo "<div id=\"menubar\">";

echo "<ul id=\"menu\">";

echo "<li ><a href=\"index.php\">Pagrindinis</a></li>";
    if (($userlevel == $user_roles["Vartotojas"])) {


        echo "<li><a href=\"useredit.php\">Redaguoti paskyrą</a></li> &nbsp;&nbsp;";
        echo "<li><a href=\"operacija1-phplab.php\">Registruoti gedimą</a></li> &nbsp;&nbsp;";
        echo "<li><a href=\"perziuretiRegistruotusgedimus.php\">Peržiūrėti registruotus gedimus</a></li> &nbsp;&nbsp;";
        echo "<li><a href=\"logout.php\" onclick=\"return confirm('Ar tikrai norite atsijungti?')\";>Atsijungti</a></li>";
    }
    if (($userlevel == $user_roles["Darbuotojas"])) {


        echo "<li><a href=\"useredit.php\">Redaguoti paskyrą</a></li> &nbsp;&nbsp;";
        echo "<li><a href=\"darbuotojaiTvarko.php\">Peržiūrėti darbus</a></li> &nbsp;&nbsp;";
        echo "<li><a href=\"persiuretiSutvarkytus.php\">Peržiūrėti sutvarkytus gedimus</a></li> &nbsp;&nbsp;";
        echo "<li><a href=\"logout.php\" onclick=\"return confirm('Ar tikrai norite atsijungti?')\";>Atsijungti</a></li>";
    }
        //Administratoriaus sąsaja rodoma tik administratoriui
        if ($userlevel == $user_roles[ADMIN_LEVEL] ) {

            echo "<li><a href=\"useredit.php\">Redaguoti paskyrą</a></li> &nbsp;&nbsp;";
            echo "<li><a href=\"admin.php\">Administratoriaus sąsaja</a></li> &nbsp;&nbsp;";
            echo "<li><a href=\"perziuretiDarbuotojus.php\">Peržiūrėti darbuotojus</a></li> &nbsp;&nbsp;";
            echo "<li><a href=\"perziuretiVisusGedimus.php\">Peržiūrėti visus gedimus</a></li> &nbsp;&nbsp;";
            echo "<li><a href=\"logout.php\" onclick=\"return confirm('Ar tikrai norite atsijungti?')\";>Atsijungti</a></li>";
        }

      echo "</u1></div>";


?>       
    
 