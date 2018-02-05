<?
    require_once(dirname(__FILE__) . "/../../lib/config.php");
    require_once(dirname(__FILE__) . "/../../lib/db.php");

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("location:/404.php");
        exit;
    }

    $post = $_POST;
    $videoIdFlag = false;
    $channel_origin_id_Flag = false;

    if (!isset($post['videoId'])
        || !isset($post['channel_origin_id'])
    ) {
        header("location:/404.php");
        exit;
    };


    $playlistItems = $_SESSION["playlistItems"];

    foreach($playlistItems as $playlistItem) {
        if ($videoIdFlag === false) {
            if ($post['videoId'] === $playlistItem['videoId']) {
                $videoIdFlag = true;
            }
        }
    }

    $channel = $_SESSION["channel"];
    if ($post['channel_origin_id'] === $channel['id']) {
        $channel_origin_id_Flag = true;
    }
    if ($videoIdFlag === false || $channel_origin_id_Flag === false) {
        header("location:/404.php");
        exit;        
    }

    $dbh = Db::getInstance();
    $stmt1 = $dbh -> prepare("insert into channels (
                    channel_origin_id
                    , created_at
                ) values (
                    :channel_origin_id
                    , null
                )"
        );
    $stmt1->bindParam(':channel_origin_id', $post['channel_origin_id'], PDO::PARAM_STR);
    $stmt1->execute();

    $lastChannelId = $dbh->lastInsertId();
    $stmt2 = $dbh -> prepare("insert into movies (
                    channels_id
                    , video_id
                    , created_at
                ) values (
                    :channels_id
                    , :video_id
                    , null
                )"
        );
    $stmt2->bindParam(':channels_id', $lastChannelId, PDO::PARAM_STR);
    $stmt2->bindParam(':video_id', $post['videoId'], PDO::PARAM_STR);
    $stmt2->execute();

    header("location: /members/index.php");

?>