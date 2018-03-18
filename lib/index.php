<?
    require_once(dirname(__FILE__) . "/./config.php");
    require_once(dirname(__FILE__) . "/./db.php");

    class user {
      public static function index() {
        $get = $_GET;
        if (isset($get['rank']) && $get['rank'] === "true") {
          $dbh = Db::getInstance();

          $stmt_select_channels = $dbh -> prepare("select * from channels order by id DESC");
          $stmt_select_channels->execute();
          $select_channels_result = $stmt_select_channels->fetchAll();

          foreach ($select_channels_result as $channel) {
            $stmt_select_movies = $dbh -> prepare("select * from movies where channels_id = :channels_id");
            $stmt_select_movies->bindParam(':channels_id', $channel['id'], PDO::PARAM_STR);
            $stmt_select_movies->execute();
            $channels_and_movies[$channel['id']]['channel'] = $channel;
            $channels_and_movies[$channel['id']]['movie'] = $stmt_select_movies->fetchAll();

            // // 最新の動画を取得channel_origin_id          
            // $url_channel = "https://www.googleapis.com/youtube/v3/channels?part=contentDetails&id=" . $channel['channel_origin_id']  . "&key=" . GOOGLE_API_KEY;
            // $channel_json = json_decode(file_get_contents($url_channel));
            // $channel_uploads = $channel_json->items[0]->contentDetails->relatedPlaylists->uploads;

            // $url_movie = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=" . $channel_uploads . "&maxResults=1&key=" . GOOGLE_API_KEY;
            // $movie_json = json_decode(file_get_contents($url_movie));
          }

          return $channels_and_movies;

        } else {
          $dbh = Db::getInstance();

          $stmt_select_channels = $dbh -> prepare("select * from channels order by id DESC");
          $stmt_select_channels->execute();
          $select_channels_result = $stmt_select_channels->fetchAll();

          foreach ($select_channels_result as $channel) {
            $stmt_select_movies = $dbh -> prepare("select * from movies where channels_id = :channels_id");
            $stmt_select_movies->bindParam(':channels_id', $channel['id'], PDO::PARAM_STR);
            $stmt_select_movies->execute();
            $channels_and_movies[$channel['id']]['channel'] = $channel;
            $channels_and_movies[$channel['id']]['movie'] = $stmt_select_movies->fetchAll();

            // // 最新の動画を取得channel_origin_id          
            // $url_channel = "https://www.googleapis.com/youtube/v3/channels?part=contentDetails&id=" . $channel['channel_origin_id']  . "&key=" . GOOGLE_API_KEY;
            // $channel_json = json_decode(file_get_contents($url_channel));
            // $channel_uploads = $channel_json->items[0]->contentDetails->relatedPlaylists->uploads;

            // $url_movie = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=" . $channel_uploads . "&maxResults=1&key=" . GOOGLE_API_KEY;
            // $movie_json = json_decode(file_get_contents($url_movie));
          }

          return $channels_and_movies;
        }
      }
    }
?>