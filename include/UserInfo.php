<?php
if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
//include("include/styles.css");
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
{if ($x_value == $userlevel) $role=$x;}
}

echo "<div id=\"sidebar_container\">";
echo "<div class=\"sidebar\">";
echo "<div class=\"sidebar_top\"></div>";
echo "        <div class=\"sidebar_item\">";
           echo"<h3>Vartotojo informacija</h3>";
           echo "<p style=\"margin-rigth:160px\">Prisijungęs vartotojas: <b>".$user."</b><br>     Rolė: <b>".$role."</b></p>";
echo "</div><div class=\"sidebar_base\"></div></div></div> ";
?>