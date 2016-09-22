<?php
$userContent = '';

$pdo = new PDO('sqlite:my_db.sqlite');
$pdo->query('CREATE TABLE IF NOT EXISTS messages (message VARCHAR(255), created_at DATETIME DEFAULT CURRENT_TIMESTAMP);');

if (isset($_POST['message'])) {
    $stmt = $pdo->prepare('INSERT INTO messages (message) VALUES (:message);');
    $stmt->bindValue(':message', $_POST['message']);
    $stmt->execute();
    $stmt->closeCursor();

    header('Location: ' . $_SERVER['REQUEST_URI']);
    die();
}

$messages = $pdo->query('SELECT * FROM messages ORDER BY created_at DESC;');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Persistent XSS</title>
</head>
<body>
<h1>Persistent XSS</h1>
<form method="post">
    <table style="border-collapse: collapse; border: none; width: 30vw;">
        <tr>
            <td><textarea style="width: 100%;" name="message" placeholder="Enter you message here..."></textarea></td>
        </tr>
        <tr>
            <td style="text-align: center;"><input type="submit" value="Send message"/></td>
        </tr>
    </table>
</form>
<h2>Messages</h2>
<?php foreach ($messages as $message): ?>
    <p>
        Created at: <?php echo $message['created_at']; ?><br/>
        Message: <?php echo $message['message']; ?><br/>
        Message escaped: <?php echo htmlentities($message['message'], ENT_QUOTES); ?>
    </p>
<?php endforeach; ?>
</body>
</html>
