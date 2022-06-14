<?php

include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . "/classes/Signup.php");
include_once(__DIR__ . "/classes/Student.php");

session_start();
session_destroy();


if (!empty($_POST)) {
    try {
        $user = new Signup(null, $_POST["name"], $_POST["surname"], $_POST["username"], $_POST["password"], $_POST["classNumber"], $_POST["classId"]);
        $user->register();
        Student::insertSmiley(Student::getUserId($_POST["username"]));
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

$classes = Signup::fetchClasses();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if (isset($error)): ?>
        <div>
            <p><?php echo $error ?></p>
        </div>
    <?php endif; ?>
    <form method="POST">
        <label for="name">name</label>
        <input id="name" name="name" placeholder="name" type="text" required/>

        <label for="surname">surname</label>
        <input id="surname" name="surname" placeholder="surname" type="text" required/>

        <label for="username">username</label>
        <input id="username" name="username" placeholder="username" type="text" required/>

        <label for="password">password</label>
        <input id="password" name="password" placeholder="password" type="text" required/>

        <label for="classNumber">classNumber</label>
        <input id="classNumber" name="classNumber" placeholder="classNumber" type="number" required/>

        <label for="classId">klas:</label>
        <select id="classId" name="classId">
            <?php foreach($classes as $class): ?>
                <option value="<?php echo $class["id"]; ?>"><?php echo $class["name"]; ?></option>
            <?php endforeach; ?>
        </select>

        <input name="signup" type="submit" value="Signup"/>
    </form>
</body>
</html>