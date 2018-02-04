<?
session_start();
if (!isset($_SESSION['token']['access_token'])) {
    header("location: /");
}
?>