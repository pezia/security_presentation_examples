<?php

$pdo = new PDO('sqlite:my_db.sqlite');
$pdo->query('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, username VARCHAR(255), password VARCHAR(255), created_at DATETIME DEFAULT CURRENT_TIMESTAMP);');
$pdo->query('CREATE TABLE IF NOT EXISTS messages (id INTEGER PRIMARY KEY AUTOINCREMENT, user_id INTEGER NOT NULL, message VARCHAR(255), created_at DATETIME DEFAULT CURRENT_TIMESTAMP);');

if (isset($_POST['message'])) {
    $query = sprintf('INSERT INTO messages (user_id, message) VALUES (%s, \'%s\');', $_POST['message']['user_id'], $_POST['message']['message']);
    $pdo->query($query);

    header('Location: ' . $_SERVER['REQUEST_URI']);
    die();
}

if (isset($_POST['registration'])) {
    $query = sprintf('INSERT INTO users (username, password) VALUES (\'%s\', \'%s\');', $_POST['registration']['username'], $_POST['registration']['password']);
    $pdo->query($query);

    header('Location: ' . $_SERVER['REQUEST_URI']);
    die();
}

if (!empty($_GET['user_id'])) {
    $where = ' user_id = ' . $_GET['user_id'];
}

$query = 'SELECT * FROM messages' . (isset($where) ? ' WHERE ' . $where : '') . ' ORDER BY created_at DESC;';
$messages = $pdo->query($query)->fetchAll();

$users = $pdo->query('SELECT * FROM users ORDER BY username;')->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SQL Injection</title>
</head>
<body>
<h1>SQL Injection</h1>
<form method="post">
    <table style="border-collapse: collapse; border: none; width: 30vw;">
        <tr>
            <td><label for="username">Username: </label></td>
            <td><input id="username" type="text" name="registration[username]"/></td>
        </tr>
        <tr>
            <td><label for="password">Password: </label></td>
            <td><input id="password" type="password" name="registration[password]"/></td>
        </tr>
        <tr>
            <td style="text-align: center;"><input type="submit" value="Register user"/></td>
        </tr>
    </table>
</form>
<form method="post">
    <table style="border-collapse: collapse; border: none; width: 30vw;">
        <tr>
            <td>
                <select name="message[user_id]">
                    <option value="">Select a user</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><textarea style="width: 100%;" name="message[message]"
                          placeholder="Enter you message here..."></textarea></td>
        </tr>
        <tr>
            <td style="text-align: center;"><input type="submit" value="Send message"/></td>
        </tr>
    </table>
</form>
<h2>Messages</h2>
<form method="get">
    <select name="user_id">
        <option value="">Filter for a user</option>
        <?php foreach ($users as $user): ?>
            <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Filter"/>
</form>
<?php foreach ($messages as $message): ?>
    <p>
        Created at: <?php echo $message['created_at']; ?><br/>
        Message: <?php echo htmlentities($message['message'], ENT_QUOTES); ?>
    </p>
<?php endforeach; ?>
</body>
</html>
