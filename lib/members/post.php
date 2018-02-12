<?
    require_once(dirname(__FILE__) . "/../../lib/config.php");
    require_once(dirname(__FILE__) . "/../../lib/db.php");

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("location:/404.php");
        exit;
    }

    class post {
        public static function movie() {

            $post = $_POST;
            $videoIdFlag = false;
            $videoTitleFlag = false;
            $channel_origin_id_Flag = false;

            //vidoe idがpostされているかの確認
            if (!isset($post['videoId'])
                || !isset($post['title'])
                || !isset($post['channel_origin_id'])
            ) {
                header("location:/404.php");
                exit;
            };

            $playlistItems = $_SESSION["playlistItems"];

            // ただしいvidoe idがpostされているかの確認
            foreach($playlistItems as $playlistItem) {
                if ($videoIdFlag === false || $videoTitleFlag === false) {
                    if ($post['videoId'] === $playlistItem['videoId']) {
                        $videoIdFlag = true;
                    }
                    if ($post['title'] === $playlistItem['title']) {
                        $videoTitleFlag = true;
                    }
                }
            }

            // ただしいchannel idがpostされているかの確認
            $channel = $_SESSION["channel"];
            if ($post['channel_origin_id'] === $channel['id']) {
                $channel_origin_id_Flag = true;
            }

            //channelまたはmovieがただしくpostされているかの確認
            if ($videoIdFlag === false || $videoTitleFlag === false || $channel_origin_id_Flag === false) {
                header("location:/404.php");
                exit;
            }

            $dbh = Db::getInstance();

            $stmt_select_movie = $dbh -> prepare("select * from channels where channel_origin_id = :channel_origin_id order by id DESC");
            $stmt_select_movie->bindParam(':channel_origin_id', $channel['id'], PDO::PARAM_STR);
            $stmt_select_movie->execute();
            $select_movie_result = $stmt_select_movie->fetchAll();

            $stmt_update = $dbh -> prepare("update movies
                            set
                            video_id = :video_id
                            , video_title = :video_title
                            where
                            channels_id = :channels_id");
            $stmt_update->bindParam(':video_id', $post['videoId'], PDO::PARAM_STR);
            $stmt_update->bindParam(':video_title', $post['title'], PDO::PARAM_STR);
            $stmt_update->bindParam(':channels_id', $select_movie_result[0]['id'], PDO::PARAM_STR);
            $stmt_update->execute();

            header("location: /members/index.php");
        }

        public static function prof() {

            $post = $_POST;
            $channel_origin_id_Flag = false;

            $playlistItems = $_SESSION["playlistItems"];

            // ただしいchannel idがpostされているかの確認
            $channel = $_SESSION["channel"];
            if ($post['channel_origin_id'] === $channel['id']) {
                $channel_origin_id_Flag = true;
            }

            //channelまたはmovieがただしくpostされているかの確認
            if ($channel_origin_id_Flag === false) {
                header("location:/404.php");
                exit;
            }

            $dbh = Db::getInstance();

            $stmt_update = $dbh -> prepare("update channels
                            set
                            prof = :prof
                            where
                            channel_origin_id = :channel_origin_id");
            $stmt_update->bindParam(':prof', $post['prof'], PDO::PARAM_STR);
            $stmt_update->bindParam(':channel_origin_id', $channel['id'], PDO::PARAM_STR);
            $stmt_update->execute();

            header("location: /members/index.php");
        }
    }
?>