<?php
include_once(__DIR__ . "/classes/Student.php");

session_start();
session_destroy();

if (!empty($_POST)) {
    try {
        Student::login($_POST['username'], $_POST['password']);
        var_dump($user);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bouwsteen leerlingen login | De app om kinderen van de lagere school meer motivatie te geven</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
</head>
<body>
<div class="container">
    <img src="images/logo.svg" alt="logo" class="logo">

    <div class="form">
        <?php if (isset($error)): ?>
            <div>
                <p class="error"><?php echo $error ?></p>
            </div>
        <?php endif; ?>

        <form method="post">
            <label for="username">Gebruikersnaam</label>
            <input id="username" name="username" type="text" required autofocus/>

            <label for="password">Wachtwoord</label>
            <input id="password" name="password" type="password" required />

            <input name="login" type="submit" value="Inloggen" class="btn-submit"/>
    </form>   
    </div> 
</div>
</body>
</html>