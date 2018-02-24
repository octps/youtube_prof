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
    <div class="ui menu my_head">
      <div class="container">
        <div class="header item"><h1>channelprof</h1></div>
        <div class="item"><a href="/">top</a></div>
        <div class="right menu">
         <a href="/login.php" class="item">login</a>
         <a href="/logout.php" class="item">logout</a>
        </div>
      </div>
    </div>

    <div class="container">
    <img src="<?= $_SESSION['channel']['icon'] ?>">
    <h3>チャンネル : <?= $result["channels"][0]['channel_title'] ?></h3>
    チャンネル紹介 : <?= @htmlspecialchars($result["channels"][0]["prof"]) ?>
    <h3>動画タイトル : <?= $result["movies"][0]["video_title"] ?></h3>
    <div class="t-a-center">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $result["movies"][0]["video_id"] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
    <div class="t-a-right to_detail">
        <a class="ui primary button" href="https://www.youtube.com/channel/<?= $result["channels"][0]['channel_origin_id'] ?>" target="_blank">youtubeで見る</a>
    </div>
    </div>
    <footer>
        channelprof
    </footer>

</body>
</html>