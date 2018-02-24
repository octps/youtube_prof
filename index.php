<?php
    require_once(dirname(__FILE__) . "/./lib/index.php");
    $channels_and_movies = user::index();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>channelprof</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.js"></script>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="shortcut icon" href="">
</head>
<body>
    <div class="main">
        <div class="ui menu my_head">
          <div class="container">
            <div class="header item"><h1>channelprof</h1></div>
            <div class="active item"><a href="/">top</a></div>
            <div class="right menu">
             <a href="/login.php" class="item">login</a>
             <a href="/logout.php" class="item">logout</a>
            </div>
          </div>
        </div>

        <div class="container head">
            <a href="/" class="item active">new</a><!--
            --><a href="/" class="item">ranking</a>
        </div>

        <div class="container">
        <? foreach ($channels_and_movies as $val): ?>
            <div>
                <!-- <p>channel_origin_id : <?= $val['channel']['channel_origin_id'] ?></p> -->
                <h3>チャンネル : <?= $val['channel']['channel_title'] ?></h3>
                <p>チャンネル紹介 : <?= $val['channel']['prof'] ?></p>
                <h3>動画タイトル : <?= $val['movie'][0]['video_title'] ?></h3>
                <div class="t-a-center">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $val['movie'][0]['video_id'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="t-a-right to_detail">
                    <a class="ui primary button" href="/channels/?id=<?= $val['channel']['id'] ?>">チャンネル詳細</a></button>
                </div>
            </div>
            <hr>
        <? endforeach; ?>
        </div>
    </div>

    <footer>
        channelprof
    </footer>
</body>
</html>
