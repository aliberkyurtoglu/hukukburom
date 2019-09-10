<?php 
ob_start();
session_start();

include '../netting/baglan.php'; 
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
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Hesabım | ABY Hukuk Ve Danışmanlık</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style2.css" rel="stylesheet">
</head>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>Hesabım</b></a>
            <small>Avukat Hesabım</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_up" action="../netting/islem.php" method="POST" data-parsley-validate class="form-horizontal form-label-left">

                    <?php if ($_GET['durum']=="sifrehatali") { ?>
                        <div class="alert alert-danger">
                            <strong>Hata!</strong> Girdiğiniz şifre yanlış. Kontrol edin, tekrar deneyin.
                        </div>
                    <?php } elseif ($_GET['durum']=="ok") { ?>

                        <div class="alert alert-success">
                            <strong>Başarılı!</strong> Kişisel bilgileriniz başarıyla değiştirilmiştir.
                        </div>
                        <?php header("Refresh: 1; giris.php"); ?>

                    <?php } elseif ($_GET['durum']=="no") { ?>

                        <div class="alert alert-danger">
                            <strong>Hata!</strong> Bir hata meydana geldi. Sistem yöneticisine danışınız
                        </div>
                    <?php } ?>


                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="adSoyad" placeholder="Ad Soyad" value="<?php echo $kullanicicek['adSoyad'] ?>" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="kullaniciAdi" placeholder="Kullanıcı Adı" value="<?php echo $kullanicicek['kullaniciAdi'] ?>" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="sifre" placeholder="Şifre" required>
                        </div>
                    </div>

                    <input type="hidden" name="ID" value="<?php echo $kullanicicek['ID'] ?>">
                    <button class="btn btn-block btn-lg bg-pink waves-effect" name="avukatDuzenle2" type="submit">Güncelle</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="hesabim.php">Geri dönmek mi istiyorsun?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="lugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-up.js"></script>
</body>

</html>