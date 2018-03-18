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
            <div class="right menu item">
             <a href="/login.php" class="item">チャンネル登録</a>
             <a href="/logout.php" class="item">logout</a>
            </div>
          </div>
        </div>

        <div class="container head">
            <a href="/" class="item <? if ($_GET['rank'] !== 'true' OR !isset($_GET['rank'])): ?> active <? endif; ?>">new</a><!--
            --><a href="/?rank=true" class="item <? if ($_GET['rank'] === 'true' && isset($_GET['rank'])): ?> active <? endif; ?>">ranking</a>
        </div>

        <div class="container">
        <? foreach ($channels_and_movies as $val): ?>
            <div class="ui grid">
                <!-- <p>channel_origin_id : <?= $val['channel']['channel_origin_id'] ?></p> -->
                <img class="three wide column" src="<?= $val['channel']['channel_img'] ?>">
                <div class="thirteen wide column name">
                    <h3>チャンネル名 : <?= $val['channel']['channel_title'] ?></h3>
                    <p>登録日 : <?= $val['channel']['created_at'] ?></p>
                    <p>チャンネル概要 : <?= $val['channel']['prof'] ?></p>
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
        <p class="name">channelprof</p>
    </footer>
</body>
</html>
