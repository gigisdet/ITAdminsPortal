<?php
// login.php - tai prisijungimo forma, index.php puslapio dalis 
// formos reikšmes tikrins proclogin.php. Esant klaidų pakartotinai rodant formą rodomos klaidos
// formos laukų reikšmės ir klaidų pranešimai grįžta per sesijos kintamuosius
// taip pat iš čia išeina priminti slaptažodžio.
// perėjimas į registraciją rodomas jei nustatyta $uregister kad galima pačiam registruotis

if (!isset($_SESSION)) {
    header("Location: logout.php");
    exit;
}
$_SESSION['prev'] = "login";
include("include/nustatymai.php");
?>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:700,600' rel='stylesheet' type='text/css'>
<link href="include/login.css" rel="stylesheet" type="text/css">
<form method="post" action="proclogin.php">
    <div class="box">
        <h1>Prisijungimas</h1>
        <input type="text" name="user" placeholder="Vartotojo vardas" class="email"
               value="<?php echo $_SESSION['name_login']; ?>"/><br>
        <?php echo $_SESSION['name_error'];
        ?>
        <input type="password" name="pass" placeholder="Slaptažodis" class="email" value="<?php echo $_SESSION['pass_login']; ?>"/><br>
        <?php echo $_SESSION['pass_error'];
        ?><br>

        <a href="#"><input class="btn" type="submit" name="login" value="Prisijungti"/></a>
        <a href="register.php">
            <div id="btn2">Registruotis</div>
        </a> <!-- End Btn2 -->
    </div> <!-- End Box -->

</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
	


