<?php

// Call set_include_path() as needed to point to your client library.
require_once(dirname(__FILE__) . "/./lib/google-api-php-client/vendor/autoload.php");
require_once(dirname(__FILE__) . "/./lib/config.php");
require_once(dirname(__FILE__) . "/./lib/login.php");
// session_start();

// /*
//  * You can acquire an OAuth 2.0 client ID and client secret from the
//  * Google Developers Console <https://console.developers.google.com/>
//  * For more information about using OAuth 2.0 to access Google APIs, please see:
//  * <https://developers.google.com/youtube/v3/guides/authentication>
//  * Please ensure that you have enabled the YouTube Data API for your project.
//  */
// $OAUTH2_CLIENT_ID = OAUTH2_CLIENT_ID;
// $OAUTH2_CLIENT_SECRET = OAUTH2_CLIENT_SECRET;

// $client = new Google_Client();
// $client->setClientId($OAUTH2_CLIENT_ID);
// $client->setClientSecret($OAUTH2_CLIENT_SECRET);
// $client->setScopes('https://www.googleapis.com/auth/youtube');
// $redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],  FILTER_SANITIZE_URL);
// $client->setRedirectUri($redirect);

// // Define an object that will be used to make all API requests.
// $youtube = new Google_Service_YouTube($client);

// if (isset($_GET['code'])) {
//   if (strval($_SESSION['state']) !== strval($_GET['state'])) {
//     die('The session state did not match.');
//   }

//   $client->authenticate($_GET['code']);
//   $_SESSION['token'] = $client->getAccessToken();
//   header('Location: ' . $redirect);
// }

// if (isset($_SESSION['token'])) {
//   $client->setAccessToken($_SESSION['token']);
// }

// // Check to ensure that the access token was successfully acquired.
// if ($client->getAccessToken()) {
//   try {
//     // Call the channels.list method to retrieve information about the
//     // currently authenticated user's channel.
//     $channelsResponse = $youtube->channels->listChannels('contentDetails', array(
//       'mine' => 'true',
//     ));

//     $htmlBody = '';
//     foreach ($channelsResponse['items'] as $channel) {
//       // Extract the unique playlist ID that identifies the list of videos
//       // uploaded to the channel, and then call the playlistItems.list method
//       // to retrieve that list.
//       $uploadsListId = $channel['contentDetails']['relatedPlaylists']['uploads'];

//       $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('snippet', array(
//         'playlistId' => $uploadsListId,
//         'maxResults' => 50
//       ));

//       $htmlBody .= "<h3>Videos in list $uploadsListId</h3><ul>";
//       foreach ($playlistItemsResponse['items'] as $playlistItem) {
//         $htmlBody .= sprintf('<li>%s (%s)</li>', $playlistItem['snippet']['title'],
//           $playlistItem['snippet']['resourceId']['videoId']);
//       }
//       $htmlBody .= '</ul>';
//     }
//   } catch (Google_Service_Exception $e) {
//     $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
//       htmlspecialchars($e->getMessage()));
//   } catch (Google_Exception $e) {
//     $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
//       htmlspecialchars($e->getMessage()));
//   }

//   $_SESSION['token'] = $client->getAccessToken();
// } else {
//   $state = mt_rand();
//   $client->setState($state);
//   $_SESSION['state'] = $state;

//   $authUrl = $client->createAuthUrl();
//   $htmlBody = <<<END
//   <h3>Authorization Required</h3>
//   <p>You need to <a href="$authUrl">authorize access</a> before proceeding.<p>
// END;
// }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>channelprof login</title>
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
            <div class="item"><a href="/">top</a></div>
            <div class="right menu item">
             <a href="/login.php" class="active item">チャンネル登録</a>
             <a href="/logout.php" class="item">logout</a>
            </div>
          </div>
        </div>
        <div class="container login">
            <?=$htmlBody?>
        </div>
    </div>
    <footer>
        channelprof
    </footer>
  </body>
</html>