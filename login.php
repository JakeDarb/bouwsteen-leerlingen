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
</head>
<body>
<?php if (isset($error)): ?>
    <div>
        <p><?php echo $error ?></p>
    </div>
<?php endif; ?>

<form method="post">
    <label for="username">username</label>
    <input id="username" name="username" placeholder="username" type="text" required autofocus/>

    <label for="password">Password</label>
    <input id="password" name="password" placeholder="Password" type="password" required />

    <input name="login" type="submit" value="Inloggen"/>
</form>    
</body>
</html>