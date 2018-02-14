<?php
require_once 'common.php';

$g = new GoogleSheets($config['googleAppName'], $config['googleCredentialsFile'], $config['googleClientSecretFile']);
if (!$g->isReady()) {
    $_SESSION['auth_url'] = $g->getAuthUrl();
    header("Location: token.php");
    die();
}
$contact = [
        1,
        'Pavlo',
        'Salo',
        'Pavlo',
        'Salo',
        'Pavlo',
        'Salo',
        'subscribed'
    ];
// $g->append($config['googleListId'], $config['googleSheetRange'], $contact);
    $get_result = $g->getRows($config['googleListId'], 'Продажи 1!B3:F');

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
               foreach ($get_result as $row => $value) {      
                  echo '<tr>';
                  echo '<td>' . $value[0] . '</td>';
                  echo '<td>' . $value[1] . '</td>';
                  echo '<td>' . $value[2] . '</td>';
                  echo '<td>' . $value[3] . '</td>';
                  echo '<td>' . $value[4] . '</td>';
                  echo '</tr>';
                  $contact = [
                      $value[0],                
                      $value[1],                
                      $value[2],                
                      $value[3],                
                      $value[4],                
                  ];
                  // $g->append($config['googleListId'], 'Sales 3!B3:F', $contact);
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </main><!-- /.container -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>