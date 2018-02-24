<?
    require_once(dirname(__FILE__) . "/../../lib/config.php");
    require_once(dirname(__FILE__) . "/../../lib/db.php");

    //現在youtubeに登録されている情報を取得
    $playlistItems = $_SESSION["playlistItems"];
    $channel = $_SESSION["channel"];

    // membersに来た時にdbにchannel名を登録する
    // select してあったら登録しない
    // なかったら登録
    $dbh = Db::getInstance();

    $stmt_select = $dbh -> prepare("select * from channels where channel_origin_id = :channel_origin_id order by id DESC");
    $stmt_select->bindParam(':channel_origin_id', $channel['id'], PDO::PARAM_STR);
    $stmt_select->execute();
    $select_result = $stmt_select->fetchAll();
    
    if (empty($select_result)) {
        $stmt1 = $dbh -> prepare("insert into channels (
                channel_origin_id
                , channel_title
                , channel_img
                , created_at
            ) values (
                :channel_origin_id
                , :channel_title
                , :channel_img
                , null
            )"
        );
        $stmt1->bindParam(':channel_origin_id', $channel['id'], PDO::PARAM_STR);
        $stmt1->bindParam(':channel_title', $channel['title'], PDO::PARAM_STR);
        $stmt1->bindParam(':channel_img', $channel['icon'], PDO::PARAM_STR);
        $stmt1->execute();
        $lastChannelId = $dbh->lastInsertId();
    } elseif ($select_result[0]['channel_title'] !== $channel['title']
        || $select_result[0]['channel_img'] !== $channel['icon']) {
        $stmt_update1 = $dbh -> prepare("update channels set channel_title = :title,
            channel_img = :channel_img
            where channel_origin_id = :channel_origin_id");
        $stmt_update1->bindParam(':title', $channel['title'], PDO::PARAM_STR);
        $stmt_update1->bindParam(':channel_img', $channel['icon'], PDO::PARAM_STR);
        $stmt_update1->bindParam(':channel_origin_id', $channel['id'], PDO::PARAM_STR);
        $stmt_update1->execute();
        $lastChannelId = $dbh->lastInsertId();
    } else {
        $lastChannelId = $select_result[0]['id'];
        $prof = $select_result[0]['prof'];
        $icon = $select_result[0]['channel_img'];
    }

    // 最新の動画を登録する
    // 動画が登録されているか確認する
    // なかったときは最新の動画を登録
    $stmt_select_movie = $dbh -> prepare("select * from movies where channels_id = :channels_id order by id DESC");
    $stmt_select_movie->bindParam(':channels_id', $lastChannelId, PDO::PARAM_STR);
    $stmt_select_movie->execute();
    $select_movie_result = $stmt_select_movie->fetchAll();


    if (empty($select_movie_result)) {
        $stmt2 = $dbh -> prepare("insert into movies (
                    channels_id
                    , video_id
                    , video_title
                    , created_at
                ) values (
                    :channels_id
                    , :video_id
                    , :video_title
                    , null
                )"
        );
        $stmt2->bindParam(':channels_id', $lastChannelId, PDO::PARAM_STR);
        $stmt2->bindParam(':video_id', $playlistItems[0]['videoId'], PDO::PARAM_STR);
        $stmt2->bindParam(':video_title', $playlistItems[0]['title'], PDO::PARAM_STR);
        $stmt2->execute();
    }

    // 登録されている動画を取得する
    $stmt_get_movie = $dbh -> prepare("select * from movies where channels_id = :channels_id order by id DESC");
    $stmt_get_movie->bindParam(':channels_id', $lastChannelId, PDO::PARAM_STR);
    $stmt_get_movie->execute();
    $stmt_get_movie_result = $stmt_get_movie->fetchAll();
    $selected_movie_id = $stmt_get_movie_result[0]["video_id"];
    $selected_movie_title = $stmt_get_movie_result[0]["video_title"];

?>