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
<link href="/css/members/custom.css" rel="stylesheet">
<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous">
</script>
<script type="text/javascript" src="/js/members/custom.js"></script>
</head>
<body class="members detail">
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
    <p onclick="window.youtube_prof.members.movie_select_button();">動画を選択する</p>

    <div class="movie_select">
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