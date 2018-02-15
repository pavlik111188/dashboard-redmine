<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard Redmine</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <?php 
      require_once 'left-side.php';
    ?>
    <div class="page">
      <?php 
        require_once 'header.php';
        if ($_GET && $_GET['type'] == 'importExport') {
          $get_result = $g->getRows($_GET['sheetIdImport'], $_GET['rangeImport']);
        }
      ?>
      <!-- Header Section-->
      
      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Get Data from Google SpreadSheet</h1>
          </header>
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Fill the Form</h4>
                </div>
                <div class="card-body">
                  <form action="importExport.php" method="get">
                    <h5>Inputs for import</h5>
                    <div class="form-group">
                      <label>SpreadSheet ID for import</label>
                      <input type="text" placeholder="SpreadSheet ID" name="sheetIdImport" class="form-control" required="">
                    </div>
                    <div class="form-group">       
                      <label>Range for import</label>
                      <input type="text" placeholder="List!A:Z" name="rangeImport" class="form-control" required="">
                    </div>
                    <h5>Inputs for export</h5>
                    <div class="form-group">
                      <label>SpreadSheet ID for export</label>
                      <input type="text" placeholder="SpreadSheet ID" name="sheetIdExport" class="form-control" required="">
                    </div>
                    <div class="form-group">       
                      <label>Range for export</label>
                      <input type="text" placeholder="List!A:Z" name="rangeExport" class="form-control" required="">
                    </div>
                    <div class="form-group">       
                      <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                    <input type="hidden" name="type" value="importExport">
                  </form>
                </div>
              </div>
            </div>            
          </div>
        </div>
      </section>

      <section>
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <?php if (isset($get_result)) { ?>
              <div class="card">
                <div class="card-header">
                  <h4>Showing Data from Google Spreadsheet</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
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
                            echo '<th scope="row">' . $value[0] . '</th>';
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
                            $g->append($_GET['sheetIdExport'], $_GET['rangeExport'], $contact);               
                          }
                        ?>                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </section>

      <?php 
        require_once 'footer.php';
      ?>
    </div>
    <!-- Javascript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
  </body>
</html>