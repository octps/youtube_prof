<?

session_start();

/*
 * You can acquire an OAuth 2.0 client ID and client secret from the
 * Google Developers Console <https://console.developers.google.com/>
 * For more information about using OAuth 2.0 to access Google APIs, please see:
 * <https://developers.google.com/youtube/v3/guides/authentication>
 * Please ensure that you have enabled the YouTube Data API for your project.
 */
$OAUTH2_CLIENT_ID = OAUTH2_CLIENT_ID;
$OAUTH2_CLIENT_SECRET = OAUTH2_CLIENT_SECRET;

$client = new Google_Client();
$client->setClientId($OAUTH2_CLIENT_ID);
$client->setClientSecret($OAUTH2_CLIENT_SECRET);
$client->setScopes('https://www.googleapis.com/auth/youtube');
$redirect = filter_var('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],  FILTER_SANITIZE_URL);
$client->setRedirectUri($redirect);

// Define an object that will be used to make all API requests.
$youtube = new Google_Service_YouTube($client);

if (isset($_GET['code'])) {
  if (strval($_SESSION['state']) !== strval($_GET['state'])) {
    die('The session state did not match.');
  }

  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  header('Location: ' . $redirect);
}

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

// Check to ensure that the access token was successfully acquired.
if ($client->getAccessToken()) {
  try {
    // Call the channels.list method to retrieve information about the
    // currently authenticated user's channel.
    $channelsResponse = $youtube->channels->listChannels('contentDetails', array(
      'mine' => 'true',
    ));
    // $_SESSION["contentDetails"] = $channelsResponse;

    $channelsResponseSnippet = $youtube->channels->listChannels('snippet', array(
      'mine' => 'true',
    ));
    // print_r($channelsResponseSnippet['items'][0]['snippet']['title']);
    $channel['id'] = $channelsResponseSnippet['items'][0]['id'];
    $channel['title'] = $channelsResponseSnippet['items'][0]['snippet']['title'];
    $channel['icon'] = $channelsResponseSnippet['items'][0]['snippet']['thumbnails']['default']["url"];
    $_SESSION["channel"] = $channel;


    // $htmlBody = '';
    foreach ($channelsResponse['items'] as $channel) {
      // Extract the unique playlist ID that identifies the list of videos
      // uploaded to the channel, and then call the playlistItems.list method
      // to retrieve that list.
      $uploadsListId = $channel['contentDetails']['relatedPlaylists']['uploads'];

      $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('snippet', array(
        'playlistId' => $uploadsListId,
        'maxResults' => 50
      ));

      // $htmlBody .= "<h3>Videos in list $uploadsListId</h3><ul>";
      // foreach ($playlistItemsResponse['items'] as $playlistItem) {
      //   $htmlBody .= sprintf('<li>%s (%s)</li>', $playlistItem['snippet']['title'],
      //     $playlistItem['snippet']['resourceId']['videoId']);
      // }
      // $htmlBody .= '</ul>';
      $i = 0;
      foreach ($playlistItemsResponse['items'] as $playlistItem) {
        $playlistItems[$i]['title'] = $playlistItem['snippet']['title'];
        $playlistItems[$i]['videoId'] = $playlistItem['snippet']['resourceId']['videoId'];
        $i = $i + 1;
      }
    }
    $_SESSION["uploadsListId"] = $uploadsListId;
    $_SESSION["playlistItems"] = $playlistItems;
  } catch (Google_Service_Exception $e) {
    header("location:/logout.php");
    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  } catch (Google_Exception $e) {
    $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
      htmlspecialchars($e->getMessage()));
  }

  $_SESSION['token'] = $client->getAccessToken();
} else {
  $state = mt_rand();
  $client->setState($state);
  $_SESSION['state'] = $state;

  $authUrl = $client->createAuthUrl();
  $htmlBody = '<h3><a href="' . $authUrl . '" class="ui primary button">Googleアカウントでログインする</a></h3>';
}

// logincheck
if (isset($_SESSION['token']['access_token'])) {
    header("location: /members/index.php");
}

?>