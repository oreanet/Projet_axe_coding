<?php 
require_once('root.php');


// Retrieve tweets and users from database
$stmt = $database->query("SELECT * FROM tweet INNER JOIN user ON tweet.user_id=user.id");
$tweets = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>Kaguya la goat</title>
</head>

<header>
    <h1>Welcome to Kaguya's Twitter!</h1>
    <h3>The new cute social Network </h3>
</header>
<body>
    <div id="tweets_action" class="mx-auto">
        <form method="GET" action="find.php"> 
            <input type="text" name="tweet" placeholder="cherche un tweet">
            <button type="submit">rechercher</button>
        </form>
        <form method="POST" action="add_tweet.php">
            <button type="submit">Add Tweet</button>
        </form>
    </div>
    <?php foreach ($tweets as $tweet): ?>
        <div class="tweet">
            <div class="avatar">
            <?php if (!empty($tweet['picture'])): ?>
                    <img src="data:image/png;base64,<?= base64_encode($tweet['picture']) ?>" alt="Avatar">
                <?php else: ?>
                    <img src="img/delfaut-avatar.png" alt="Default Avatar">
                <?php endif; ?>
            </div>
            <div class="content" class="mx-auto">
                <div class="username"><?= "@", $tweet['pseudo'] ?></div>
                <div class="text"><?= $tweet['description'] ?></div>

                <form method="post" action="delete_tweet.php">
                    <input type="hidden" name="tweet_id" value="<?= $tweet['id'] ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this tweet?')">Delete Tweet</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>


