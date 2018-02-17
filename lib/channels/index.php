<?
    require_once(dirname(__FILE__) . "/../../lib/config.php");
    require_once(dirname(__FILE__) . "/../../lib/db.php");


    class channel_index {
        public static function movie() {

            $dbh = Db::getInstance();
            
            if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
                header("location:/");
                exit;
            }
            $get = $_GET;

            $stmt_check_channels = $dbh -> prepare("select * from channels where id = :id");
            $stmt_check_channels->bindParam(':id', $get['id'], PDO::PARAM_STR);
            $stmt_check_channels->execute();
            $select_channels_result = $stmt_check_channels->fetchAll();

            if (empty($select_channels_result)) {
                header("location:/");
                exit;                
            }


            $stmt_select_movies = $dbh -> prepare("select * from movies where channels_id = :channels_id");
            $stmt_select_movies->bindParam(':channels_id', $select_channels_result[0]['id'], PDO::PARAM_STR);
            $stmt_select_movies->execute();
            $select_movies_result = $stmt_select_movies->fetchAll();

            $result['channels'] = $select_channels_result;
            $result['movies'] = $select_movies_result;
            
            return $result; 
        }
    }


?>