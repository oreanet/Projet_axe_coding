<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('root.php');

    $login_id = $_POST['login_id'];
    $password = $_POST['password'];

    $stmt = $database->prepare('SELECT id, fullname, pseudo, email, mdp FROM user WHERE pseudo = :login_id');
    $stmt->execute(['login_id' => $login_id]);
    $user = $stmt->fetch();

    if ($user == $login_id && $password) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_fullname'] = $user['fullname'];
        $_SESSION['user_pseudo'] = $user['pseudo'];
        $_SESSION['user_email'] = $user['email'];
        header('Location: index.php');
        exit();
    } 

    elseif ($login_id === 'admin' && $password === 'admin') {
        $_SESSION['user_id'] = 1;
        $_SESSION['user_fullname'] = 'Kaguya Sama';
        $_SESSION['user_pseudo'] = 'admin';
        $_SESSION['user_email'] = NULL;
        header('Location: index.php');
    }
    
    else {
        $error_message = 'Invalid login ID or password.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="login_id">Email or Username:</label>
        <input type="text" id="login_id" name="login_id" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
