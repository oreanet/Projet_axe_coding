<?php
require_once('root.php');

if (isset($_GET['tweet'])) {
    // Retrieve tweets and users from database
    $stmt = $database->prepare("SELECT * FROM tweet INNER JOIN user ON tweet.user_id=user.id WHERE description LIKE :keyword");
    $stmt->bindValue(':keyword', '%' . $_GET['tweet'] . '%', PDO::PARAM_STR);
    $stmt->execute();
    $tweets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $tweets = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>Search tweets</title>
    <style>
        .tweet {
            border: 1px solid black;
            margin: 10px;
            padding: 10px;
        }
        .avatar img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
<h1>Go Back</h1>
    <form method="GET" action="index.php"> 
        <button type="submit">Home</button>
    </form>
    <h1>Search tweets</h1>
    <form method="GET" action="find.php"> 
        <input type="text" name="tweet" placeholder="Search for tweets">
        <button type="submit">Search</button>
    </form>

    <?php foreach ($tweets as $tweet): ?>
        <div class="tweet">
            <div class="avatar">
            <?php if (!empty($tweet['picture'])): ?>
                    <img src="data:image/png;base64,<?= base64_encode($tweet['picture']) ?>" alt="Avatar">
                <?php else: ?>
                    <img src="img/delfaut-avatar.png" alt="Default Avatar">
                <?php endif; ?>
            </div>
            <div class="content">
                <div class="username"><?= $tweet['pseudo'] ?></div>
                <div class="text"><?= $tweet['description'] ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>
