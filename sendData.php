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
        /*if ($_GET && $_GET['type'] == 'sendData') {
          $get_result = $g->getRows($_GET['sheetId'], $_GET['range']);
        }*/
      ?>
      <!-- Header Section-->
      
      <section class="forms">
        <div class="container-fluid">
          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Send Data to the Google SpreadSheet</h1>
          </header>
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header d-flex align-items-center">
                  <h4>Fill the Form</h4>
                </div>
                <div class="card-body">
                  <div class="form-group dynamic-element" style="display:none">
                    <div class="row">                      
                    <!-- Replace these fields -->
                    <div class="col-md-3">
                      <input type="text" placeholder="Col 1" name="value1" class="form-control" required="">
                    </div>
                    <div class="col-md-3">
                      <input type="text" placeholder="Col 2" name="value2" class="form-control" required="">
                    </div>
                    <div class="col-md-3">
                      <input type="text" placeholder="Col 3" name="value3" class="form-control" required="">
                    </div>
                    <div class="col-md-3">
                      <input type="text" placeholder="Col 4" name="value4" class="form-control" required="">
                    </div>
                      <div class="col-md-1 delete-area">
                        <button type="button" class="close delete" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    </div>
                  </div>
                  <form id="sendData">
                    <div class="form-group">
                      <label>SpreadSheet ID</label>
                      <input type="text" placeholder="SpreadSheet ID" id="sheetId" name="sheetId" class="form-control" required="">
                    </div>
                    <div class="form-group">       
                      <label>Range</label>
                      <input type="text" placeholder="List!A:Z" name="range" id="range" class="form-control" required="">
                    </div>
                    <div class="form-group"> 
                      <h5>Data Inputs</h5>
                      <div class="dynamic-stuff">
                        <!-- Dynamic element will be cloned here -->
                        <!-- You can call clone function once if you want it to show it a first element-->
                      </div>
                      <div class="add-row-area">
                        <button type="button" class="add-one btn btn-secondary fa fa-plus"></button>
                      </div>
                    </div>
                    <div class="form-group">       
                      <input type="submit" value="Submit" class="btn btn-success">
                    </div>
                    <input type="hidden" name="type" value="sendData">
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