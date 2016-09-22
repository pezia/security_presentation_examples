<?php

$target = 'none';
$amount = 'none';

if (
    isset($_POST['target'])
    && isset($_POST['amount'])
) {
    $target = $_POST['target'];
    $amount = $_POST['amount'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cross-site Request Forgery</title>
</head>
<body>
<h1>Cross-site Request Forgery</h1>
<p>
    Target: <?php echo $target; ?><br/>
    Amount: <?php echo $amount; ?>
</p>
</body>
</html>
