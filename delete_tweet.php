<?php
require_once('root.php');

if (isset($_POST['delete_tweet'])) {
    $tweet_id = $_POST['delete_tweet'];
}

if (isset($_POST['delete_tweet'])) {
    $stmt = $database->prepare("DELETE FROM tweet WHERE id=:tweet_id");
    $stmt->bindValue(":tweet_id", $tweet_id, PDO::PARAM_INT);
    $stmt->execute();
}

header("Location: index.php");
exit;
?>



