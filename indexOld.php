
<?php
require_once __DIR__ . '/vendor/autoload.php';


define('APPLICATION_NAME', 'Google Sheets API PHP Quickstart');
define('CREDENTIALS_PATH', 'token.json');
define('CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json');
define('SHEET_ID', '1Ygd6cEvi0tcGa3GF11hUIZfomh0Ms9r1mZN-MfcqruE');
define('SCOPES', implode(' ', array(
  Google_Service_Sheets::SPREADSHEETS)
));


/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient() {
  $client = new Google_Client();
  $client->setApplicationName(APPLICATION_NAME);
  $client->setScopes(SCOPES);
  $client->setAuthConfig(CLIENT_SECRET_PATH);
  $client->setAccessType('offline');
  // $client->setAprovalPromt('force');
  // Load previously authorized credentials from a file.
  $credentialsPath = expandHomeDirectory(CREDENTIALS_PATH);
  if (file_exists($credentialsPath)) {
    $accessToken = json_decode(file_get_contents($credentialsPath), true);
  } else {
    // Request authorization from the user.
    $authUrl = $client->createAuthUrl();
    printf("Open the following link in your browser:\n%s\n", $authUrl);
    print 'Enter verification code: ';
    $authCode = trim(fgets(STDIN));
    // Exchange authorization code for an access token.
    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
    // Store the credentials to disk.
    if(!file_exists(dirname($credentialsPath))) {
      mkdir(dirname($credentialsPath), 0700, true);
    }
    file_put_contents($credentialsPath, json_encode($accessToken));
    printf("Credentials saved to %s\n", $credentialsPath);
  }
  $client->setAccessToken($accessToken);
  // Refresh the token if it's expired.
  if ($client->isAccessTokenExpired()) {
    $refresh_token = $accessToken['refresh_token'];
    $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    
    $new_token = $client->getAccessToken();
    if(!isset($new_token['refresh_token'])) {
      $new_token['refresh_token'] = $refresh_token;
    }
    file_put_contents($credentialsPath, json_encode($new_token));
  }
  return $client;
}

/**
 * Expands the home directory alias '~' to the full path.
 * @param string $path the path to expand.
 * @return string the expanded path.
 */
function expandHomeDirectory($path) {
  $homeDirectory = getenv('HOME');
  if (empty($homeDirectory)) {
    $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
  }
  return str_replace('~', realpath($homeDirectory), $path);
}

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Sheets($client);


function getValues($spreadsheetId, $range, $service) {
  $response = $service->spreadsheets_values->get($spreadsheetId, $range);
  $values = $response->getValues() ? $response->getValues() : [];
  $result = '';
  if (!$values && count($values) == 0) {
    $result = "No data found.";
  } else {
    foreach ($values as $row => $value) {      
      $result .= '<tr>';
      $result .= '<td>' . $value[0] . '</td>';
      $result .= '<td>' . $value[1] . '</td>';
      $result .= '<td>' . $value[2] . '</td>';
      $result .= '<td>' . $value[3] . '</td>';
      $result .= '<td>' . $value[4] . '</td>';
      $result .= '</tr>';
    }
  }
  return $result;
}

function addRowToSpreadsheet($sheetsService, $spreadsheetId, $sheetId, $newValues = []) {
    // Build the CellData array
    $values = [];
    foreach ($newValues AS $d) {
        $cellData = new Google_Service_Sheets_CellData();
        $value = new Google_Service_Sheets_ExtendedValue();
        $value->setStringValue($d);
        $cellData->setUserEnteredValue($value);
        $values[] = $cellData;
    }
    // Build the RowData
    $rowData = new Google_Service_Sheets_RowData();
    $rowData->setValues($values);
    // Prepare the request
    $append_request = new Google_Service_Sheets_AppendCellsRequest();
    $append_request->setSheetId($sheetId);
    $append_request->setRows($rowData);
    $append_request->setFields('USER_ENTERED');

    // Set the request
    $request = new Google_Service_Sheets_Request();
    $request->setAppendCells($append_request);
    
    // Add the request to the requests array
    $requests = array();
    $requests[] = $request;
    // Prepare the update
    $batchUpdateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest(array(
        'requests' => $requests
    ));
    // var_dump($batchUpdateRequest);
    $range = 'Sales 3!A2:EL';
    try {
        // Execute the request
        $response = $sheetsService->spreadsheets_values->append($spreadsheetId, $range, $request);
        if ($response->valid()) {            
            return true;// Success, the row has been added
        }
    } catch (Exception $e) {        
        error_log($e->getMessage());// Something went wrong
    }

    return false;
}

$val = array(
    array(
        "Mickey","Mouse " . rand(11111,99999)
    ),
    array(
      "Donald","Duck"
    )
);

echo '<pre>';
// addRowToSpreadsheet($service, '1Ygd6cEvi0tcGa3GF11hUIZfomh0Ms9r1mZN-MfcqruE', 1, $val);
echo '</pre>';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">

    <title>Dashboard Redmine</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="/">Dashboard Redmine</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="container">
      <div>
        <?php 
          $getSheets = $service->spreadsheets->get('1Ygd6cEvi0tcGa3GF11hUIZfomh0Ms9r1mZN-MfcqruE')->getSheets();
          foreach ($getSheets as $key => $sheet) {
            echo '<h5>' . $sheet['properties']['title'] . '</h5>';
            $rangeNew = $sheet['properties']['title']."!B3:Z1001";
            $getValues = getValues('1Ygd6cEvi0tcGa3GF11hUIZfomh0Ms9r1mZN-MfcqruE', $rangeNew, $service);
            if ($getValues !== "No data found.") {
        ?>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>№</th>
                  <th>Имя</th>
                  <th>Время</th>
                  <th>ЗП</th>
                  <th>Тег</th>
                </tr>
              </thead>
              <tbody>
               <?php
                  
                  echo $getValues;
                ?>
              </tbody>
            </table>
          </div>
        <?php
            } else {
              echo $getValues;
            }
          }
        ?>
      </div>
    </main><!-- /.container -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>