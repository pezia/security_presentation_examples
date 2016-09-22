<?php

if (!empty($_REQUEST['PHPSESSID'])) {
    session_id($_REQUEST['PHPSESSID']);
}

session_start();

if (isset($_POST['login'])) {
    $_SESSION['username'] = $_POST['login']['username'];
    header('Location: ' . $_SERVER['REQUEST_URI']);
    die();
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Session fixation</title>
</head>
<body>
<h1>Session fixation</h1>
<h2>Current username: <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'anonymous'; ?></h2>
<form method="post">
    <table style="border-collapse: collapse; border: none; width: 30vw;">
        <tr>
            <td><label for="username">Username: </label></td>
            <td><input id="username" type="text" name="login[username]"/></td>
        </tr>
        <tr>
            <td style="text-align: center;"><input type="submit" value="Login"/></td>
        </tr>
    </table>
</form>
</body>
</html>
