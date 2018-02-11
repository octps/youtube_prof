<?php
    require_once(dirname(__FILE__) . "/../lib/loginCheck.php");
    require_once(dirname(__FILE__) . "/../lib/members/index.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="">
<link rel="shortcut icon" href="">
</head>
<body>
<?
    require_once(dirname(__FILE__) . "/../parts/header.php");
?>
<div>
    this channel id is <?= $channel['id'] ?>.<br>
    this channel titile is <?= $channel['title'] ?>.<br>
    <p>現在選択中の動画</p>
    <h2>video title is <?= $selected_movie_title ?></h2>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $selected_movie_id ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    <br>
    <div>
    <? foreach($playlistItems as $playlistItem): ?>
    <h2>video title is <?= $playlistItem['title'] ?></h2>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $playlistItem['videoId'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    <form action="/members/post.php" method="post">
        <input type="text" name="title" value="<?= $playlistItem['title'] ?>">
        <input type="text" name="videoId" value="<?= $playlistItem['videoId'] ?>">
        <input type="text" name="channel_origin_id" value="<?= $channel['id'] ?>">
        <input type="submit" value="登録">
    </form>
    <? endforeach; ?>
    </div>
</div>
</body>
</html>