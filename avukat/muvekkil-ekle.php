<?php include '../header.php'; ?>

<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li><a href="index.php"><i class="icon-dashboard"></i><span>Anasayfa</span> </a> </li>
        <li><a href="davalarim.php"><i class="icon-list-alt"></i><span>Davalarım</span> </a> </li>
        <li class="active"><a href="muvekkillerim.php"><i class="icon-facetime-video"></i><span>Müvekkillerim</span> </a></li>
      </div>
    </div>
  </div>

  <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
    <div class="main">
      <div class="main-inner">
        <div class="container">
          <div class="row">
            <div class="span12">
              <?php if ($_GET['durum']=="kayitlikullanici") { ?>
                <div class="alert alert-danger">
                  <strong>Hata!</strong> Bu mail ya da kullanıcı adı daha önce kullanılmıştır.
                </div>

              <?php } elseif ($_GET['durum']=="basarisiz") { ?>
                <div class="alert alert-danger">
                  <strong>Hata!</strong> Kayıt yapılamadı. Sistem yöneticisine danışınız.
                </div>

              <?php } elseif ($_GET['durum']=="basarili") { ?>
                <div class="alert alert-success">
                  <strong>Kayıt Başarılı!</strong> Giriş yapabilirsiniz.
                </div>

              <?php } ?>

              <a class="btn btn-primary" style="margin-bottom: 12px" href="muvekkillerim.php"><i class="btn-icon-only icon-arrow-left"></i> Geri Dön</a>
              <div class="widget widget-nopad">
                <div class="form-group">
                  <label for="adSoyad"> Ad Soyad</label>
                  <div>
                    <input type="text" placeholder="ABY Hukuk" name="adSoyad" class="form-control" required="">
                  </div>
                </div>

                <div class="form-group" style="margin-top: 5px">
                  <label for="adSoyad"> E-Posta</label>
                  <div>
                    <input type="email" placeholder="Örn: abyhukukdanismanlik@gmail.com" name="ePosta" class="form-control" required="">
                  </div>
                </div>

                <div class="form-group" style="margin-top: 5px">
                  <label for="adSoyad"> Kullanıcı Adı</label>
                  <div>
                    <input type="text" placeholder="Örn: abyhukukdanismanlik" name="kullaniciAdi" class="form-control" required="">
                  </div>
                </div>

                <div class="form-group" style="margin-top: 5px">
                  <label for="adSoyad"> Şifre</label>
                  <div>
                    <input type="password" name="sifre" class="form-control" required="">
                  </div>
                </div>

                <div class="form-group" style="margin-top: 5px">
                  <label for="durum"> Durum</label>
                  <div>
                    <select id="durum" class="form-control" name="durum" required>
                      <option value="1">Aktif</option>
                      <option value="0">Pasif</option>  
                    </select>
                  </div>
                </div>

                <div class="form-group" style="margin-top: 10px">
                  <div align="left">
                    <button type="submit" name="muvekkilEkle" class="btn btn-success">Ekle</button>               
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <?php include '../footer.php'; ?>