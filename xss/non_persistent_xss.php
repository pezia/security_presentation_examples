<?php
$userContent = '';

if (isset($_GET['inject_me'])) {
    $userContent = $_GET['inject_me'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Non-persistent XSS</title>
</head>
<body>
<h1>Non-persistent XSS</h1>
<ul>
    <li><a href="/?inject_me=%22%3E%3Cscript%3Ealert();%3C/script%3E%3C/p%3E%3Cp%20class=%22">Example 1</a></li>
</ul>
<h2>Without escape</h2>
<p><?php echo $userContent; ?></p>
<p class="<?php echo $userContent; ?>"></p>

<h2>Properly escaped</h2>
<p><?php echo htmlentities($userContent, ENT_QUOTES); ?></p>
</body>
</html>
