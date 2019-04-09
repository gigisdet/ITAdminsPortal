<?php
//nustatymai.php



define("DB_SERVER", "localhost");
define("DB_NAME", "karpog");
define("DB_USER", "karpog");
define("DB_PASS", "ohMee5ungisie9ah");

define("TBL_USERS", "users");



$user_roles=array(      // vartotojų rolių vardai lentelėse ir  atitinkamos userlevel reikšmės
	"Administratorius"=>"9",
	"Darbuotojas"=>"4",
	"Vartotojas"=>"5",);   // galioja ir vartotojas "guest", kuris neturi userlevel

$gedimukai_roles=array(      // vartotojų rolių vardai lentelėse ir  atitinkamos userlevel reikšmės
    "Registruota"=>"Registruota",
    "Šalinama"=>"Šalinama",
    "Sutvarkytas"=>"Sutvarkytas",);   // galioja ir vartotojas "guest", kuris neturi userlevel


define("DEFAULT_LEVEL","Vartotojas");  // kokia rolė priskiriama kai registruojasi
define("ADMIN_LEVEL","Administratorius");  // kas turi vartotojų valdymo teisę
define("UZBLOKUOTAS","255");      // vartotojas negali prisijungti kol administratorius nepakeis rolės

$uregister="both";  // kaip registruojami vartotojai
// self - pats registruojasi, admin - tik ADMIN_LEVEL, both - abu atvejai

// * Email Constants - 
define("EMAIL_FROM_NAME", "Demo");
define("EMAIL_FROM_ADDR", "demo@ktu.lt");
define("EMAIL_WELCOME", false);

?>
