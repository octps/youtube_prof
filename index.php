<?php
    require_once(dirname(__FILE__) . "/./lib/index.php");
    $channels_and_movies = user::index();
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
    require_once(dirname(__FILE__) . "/./parts/header.php");
?>
<hr>
<? foreach ($channels_and_movies as $val): ?>
    <div>
        <a href="/channels/?id=<?= $val['channel']['id'] ?>">チャンネル詳細</a>
        <p>channel_origin_id : <?= $val['channel']['channel_origin_id'] ?></p>
        <p>channel_title : <?= $val['channel']['channel_title'] ?></p>
        <p>prof : <?= $val['channel']['prof'] ?></p>
        <p>movie_title : <?= $val['movie'][0]['video_title'] ?></p>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $val['movie'][0]['video_id'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
    <hr>
<? endforeach; ?>
</body>
</html>