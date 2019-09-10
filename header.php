<?php 
ob_start();
session_start();

include 'netting/baglan.php'; 
?>

<?php 

$kullanicisor=$db->prepare("SELECT * FROM avukat WHERE kullaniciAdi=:kullaniciAdi");
$kullanicisor->execute(array(
  'kullaniciAdi' => $_SESSION['kullaniciAdi']
));

$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
?>

<?php if (!isset($_SESSION['kullaniciAdi'])) { ?>
  <?php header("Location: 404.php"); ?>
<?php } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>ABY Hukuk ve Danışmanlık</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
  rel="stylesheet">
  <link href="css/font-awesome.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/pages/dashboard.css" rel="stylesheet">
  <link rel="icon" href="../../favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

  <!-- Bootstrap Core Css -->
  <link href="avukat/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Waves Effect Css -->
  <link href="avukat/plugins/node-waves/waves.css" rel="stylesheet" />

  <!-- Animation Css -->
  <link href="avukat/plugins/animate-css/animate.css" rel="stylesheet" />

  <!-- JQuery DataTable Css -->
  <link href="avukat/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

  <!-- Custom Css -->
  <link href="avukat/css/style2.css" rel="stylesheet">

  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <link href="avukat/css/themes/all-themes.css" rel="stylesheet" />
  <script src="https://cdn.ckeditor.com/4.8.0/standard-all/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'editor1', {
      height:300
      width:500
    });
  </script>
  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
        class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="index.php">ABY Hukuk ve Danışmanlık</a>
        
        <?php if (isset($_SESSION['kullaniciAdi'])) { ?>
          <div class="nav-collapse">
            <ul class="nav pull-right">
              <li><a href="hesabim.php?avukat_id=<?php echo $kullanicicek['ID']?>">
                <i class="icon-cog"></i> Hesabım </a>
              </li>
              <li><a href="cikis.php">Çıkış</a></li>
            </ul>
          </div>
        <?php } ?>
        <!--/.nav-collapse --> 
      </div>
      <!-- /container --> 
    </div>
    <!-- /navbar-inner --> 
  </div>
  <!-- /navbar -->

