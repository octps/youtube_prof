<?php
    require_once(dirname(__FILE__) . "/../lib/channels/index.php");
    $result = channel_index::movie();
    // echo("<pre>");
    // print_r($result);
    // echo("</pre>");
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
</head>
<body>
<?
    require_once(dirname(__FILE__) . "/../parts/header.php");
?>
<div>
    this channel id is <?= $result["channels"][0]['channel_origin_id'] ?>.<br>
    this channel titile is <?= $result["channels"][0]['channel_title'] ?>.<br>
    チャンネルの紹介文:<br>
         <?= @htmlspecialchars($result["channels"][0]["prof"]) ?>
    <p>動画</p>
    <h2>video title is <?= $result["movies"][0]["video_title"] ?></h2>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $result["movies"][0]["video_id"] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
</div>
</body>
</html>