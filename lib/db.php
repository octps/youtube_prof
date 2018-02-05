<?php

class Db
{
  private static $pdo = null;

  public static function getInstance() {
    $config = (object) array(
        'db' => (object) array(
          'host' => 'localhost'
          , 'database' => 'youtube_prof'
          , 'username' => 'root'
          , 'password' => DB_PASSWORD
        )
    );

    if (is_null(self::$pdo)) {
      self::$pdo = new PDO(sprintf(
        '%s:host=%s; port=%d; dbname=%s; charset=utf8;'
        , 'mysql'
        , $config->db->host
        , 3306
        , $config->db->database
      ), $config->db->username, $config->db->password);

      self::$pdo->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    return self::$pdo;
  }
}
