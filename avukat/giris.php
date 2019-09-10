<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Avukat Girişi | ABY HUKUK VE DANIŞMANLIK</title>
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

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Avukat Giriş Paneli<b> ABY</b></a>
            <small>ABY HUKUK VE DANIŞMANLIK</small>
        </div>
        <div class="card">
            <div class="body">

                <form id="sign_in" action="../netting/islem.php"method="POST">
                    <div class="msg"><a href="../giris.php">Müvekkil girişi</a></div>

                    <?php if ($_GET['durum']=="no") { ?>
                        <div class="alert alert-danger">
                          <strong>Hata!</strong> Kullanıcı adı ya da şifre hatalı
                      </div>

                    <?php } ?>
                  <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="kullaniciAdi" placeholder="Kullanıcı Adı" required autofocus>
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
                <div class="row">
                    <div class="col-xs-6" style="margin-left: 75px">
                       <center><button class="btn btn-block bg-pink waves-effect" name="avukatGiris" type="submit">Giriş Yap</button></center>
                   </div>
               </div>
           </form>

       </div>
   </div>
</div>

<!-- Jquery Core Js -->
<script src="../../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../../plugins/bootstrap/js/bootstrap.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../../plugins/node-waves/waves.js"></script>

<!-- Validation Plugin Js -->
<script src="../../plugins/jquery-validation/jquery.validate.js"></script>

<!-- Custom Js -->
<script src="../../js/admin.js"></script>
<script src="../../js/pages/examples/sign-in.js"></script>
</body>

</html>