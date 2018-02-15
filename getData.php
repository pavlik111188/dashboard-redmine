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
        if ($_GET && $_GET['type'] == 'getData') {
          $getSheets = $g->getSheets($_GET['sheetId']);
                  
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
                  <form action="getData.php" method="get">
                    <div class="form-group">
                      <label>SpreadSheet ID</label>
                      <input type="text" placeholder="SpreadSheet ID" name="sheetId" class="form-control" required="">
                    </div>
                    <div class="form-group">       
                      <label>Range</label>
                      <input type="text" placeholder="A:Z" name="range" class="form-control" required="">
                    </div>
                    <div class="form-group">       
                      <input type="submit" value="Show data" class="btn btn-primary">
                    </div>
                    <input type="hidden" name="type" value="getData">
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
              
              <?php if (isset($getSheets)) { ?>
                <ul class="nav nav-tabs" role="tablist">                                 
                  <?php
                      foreach ($getSheets as $key => $value) {
                       ?>
                      <li class="nav-item">
                        <a class="nav-link <?php echo ($key == 0 ? 'active' : ''); ?> " href="#<?php echo $key; ?>" role="tab" data-toggle="tab"><?php echo $value['properties']['title']; ?></a>
                      </li>
                  <?php
                      echo ($key == count($getSheets) - 1 ? '</ul>' : '');
                      ?>
                      
                  <?php } ?>
                      <!-- Tab panes -->
                      <div class="tab-content">
                  <?php
                    foreach ($getSheets as $key => $value) {
                  ?>
                  
                        <div role="tabpanel" class="tab-pane fade in <?php echo ($key == 0 ? 'active show' : ''); ?>" id="<?php echo $key; ?>">
                          <?php
                              $get_result = $g->getRows($_GET['sheetId'], $value['properties']['title'] . '!' . $_GET['range']);
                              if (isset($get_result)) {
                           ?>
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
                                      }
                                    ?>                       
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                        </div>                      
                  <?php }
                  ?>
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