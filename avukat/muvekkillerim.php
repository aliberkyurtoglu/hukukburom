<?php include '../header.php'; ?>

<?php  
$sor=$db->prepare("SELECT * FROM Muvekkil ORDER BY ID ASC");
$sor->execute();

?>

<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li><a href="index.php"><i class="icon-dashboard"></i><span>Anasayfa</span> </a> </li>
        <li><a href="davalarim.php"><i class="icon-list-alt"></i><span>Davalarım</span> </a> </li>
        <li class="active"><a href="muvekkillerim.php"><i class="icon-facetime-video"></i><span>Müvekkillerim</span> </a></li>
      </ul>
    </div>
  </div>
</div>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">

        <div class="span12">
          <?php 
          if ($_GET['durum']=="ok") {?>
            <b style="color:green;">İşlem Başarılı...</b>
          <?php } elseif ($_GET['durum']=="no") {?>
            <b style="color:red;">İşlem Başarısız...</b>
          <?php }
          ?>

            <div class="widget widget-table action-table col-md-4">
              <a class="btn btn-success" style="margin-top:5px; margin-bottom:10px;" href="muvekkil-ekle.php"><i class="btn-icon-only icon-plus"></i> Müvekkil Ekle</a>
              <a class="btn btn-primary" style="margin-top:5px; margin-bottom:10px;" href="davalarim.php"><i class="btn-icon-only icon-arrow-left"></i> Davalara Git</a>
              <div class="widget-content">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th class="td-actions"> Durum </th>
                      <th> Ad Soyad </th>
                      <th> Kullanıcı Adı</th>
                      <th class="td-actions"> </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($cek=$sor->fetch(PDO::FETCH_ASSOC)) { ?>
                      <tr>
                        <td>
                          <center>
                            <?php 
                            if ($cek['durum']==0) {?>
                              <a href="../netting/islem.php?muvekkil_id=<?php echo $cek['ID'] ?>&muvekkil_dur=1&muvekkil_durum=ok">
                                <button class="btn btn-danger btn-small">Pasif</button>
                              </a>
                            <?php } elseif ($cek['durum']==1) { ?>
                              <a href="../netting/islem.php?muvekkil_id=<?php echo $cek['ID'] ?>&muvekkil_dur=0&muvekkil_durum=ok">
                                <button class="btn btn-success btn-small">Aktif</button>
                              </a>
                            <?php } ?>                    
                          </center>
                        </td>
                        <td> <?php echo $cek['adSoyad'] ?> </td>
                        <td> <?php echo $cek['kullaniciAdi']; ?> </td>
                        <td>
                          <center>
                            <a class="btn btn-success btn-small" href="muvekkil-duzenle.php?muvekkil_id=<?php echo $cek['ID']?>"><i class="btn-icon-only icon-edit"></i></a>
                            <a class="btn btn-danger btn-small" href="../netting/islem.php?muvekkil_id=<?php echo $cek['ID']?>&muvekkilsil=ok" onclick="return confirm('<?php echo $cek['adSoyad'] ?> isimli müvekkilini silmek istediğinizden emin misiniz?')"><i class="btn-icon-only icon-remove"> </i></a>
                          </center>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include '../footer.php'; ?>