<?php include '../header.php'; ?>

<?php  
$sor=$db->prepare("SELECT * FROM Muvekkil WHERE durum=:durum ORDER BY ID ASC");
$sor->execute(array(
  'durum' => 1
));


$davasor=$db -> prepare("SELECT * FROM Dava WHERE dava_durum=:durum ORDER BY dava_zaman DESC");
$davasor->execute(array(
  'durum' => 1
));
?>

  <div class="subnavbar">
    <div class="subnavbar-inner">
      <div class="container">
        <ul class="mainnav">
          <li class="active"><a href="index.php"><i class="icon-dashboard"></i><span>Anasayfa</span> </a> </li>
          <li><a href="davalarim.php"><i class="icon-list-alt"></i><span>Davalarım</span> </a> </li>
          <li><a href="muvekkillerim.php"><i class="icon-user"></i><span>Müvekkillerim</span> </a></li>
        </ul>
      </div>
    </div>
  </div>
<body>
  <!-- /subnavbar -->
  <div class="main">
    <div class="main-inner">
      <div class="container">
        <div class="row">
          <div class="span6">
            <div class="widget widget-nopad">
              <div class="widget-header"> <i class="icon-list-alt"></i>
                <h3> Aktif Müvekkillerim </h3>
              </div>
              <div class="widget-content">
                <div class="widget big-stats-container">
                  <div class="widget-content">
                   <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th> Ad Soyad </th>
                        <th> Kullanıcı Adı</th>
                        <th class="td-actions"> </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while($cek=$sor->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td> <?php echo $cek['adSoyad'] ?> </td>
                          <td> <?php echo $cek['kullaniciAdi']; ?> </td>
                          <td>
                            <center><a class="btn btn-success btn-small" href="muvekkil-duzenle.php?muvekkil_id=<?php echo $cek['ID']?>"><i class="btn-icon-only icon-edit"></i></a></center> 
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

        <div class="span6">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3> Aktif Davalarım </h3>
            </div>
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th> Dava </th>
                        <th> Müvekkil</th>
                        <th class="td-actions"> </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while($davacek=$davasor->fetch(PDO::FETCH_ASSOC)) {?>
                        <tr>
                          <td> <?php echo $davacek['davaAdi'] ?> </td>
                          <td> 
                            <?php 

                            $muvekkil_id=$davacek['muvekkil_id'];

                            $muvekkilsor=$db->prepare("SELECT * FROM muvekkil where ID=:id");
                            $muvekkilsor->execute(array(
                              'id' => $muvekkil_id
                            ));

                            $muvekkilcek=$muvekkilsor->fetch(PDO::FETCH_ASSOC);

                            if ($muvekkilcek['durum']==0) {
                              echo $muvekkilcek['adSoyad']." (Müvekkil Devredışı)";
                            } else if ($muvekkilcek['durum']== 1) {
                              echo $muvekkilcek['adSoyad'];
                            } ?>
                          </td>
                          <td>
                            <center>
                              <?php if ($muvekkilcek['durum'] == 1) { ?>
                                <a class="btn btn-success btn-small" href="dava-duzenle.php?dava_id=<?php echo $davacek['ID']?>"><i class="btn-icon-only icon-edit"></i></a>
                              <?php } else { ?>
                                <a class="btn btn-success btn-small" disabled href="?devredisi"><i class="btn-icon-only icon-edit"></i></a>
                              <?php } ?>
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
  </div>
</div>
</div>

</div>


<!-- /main -->

<!-- /extra -->
<?php include '../footer.php'; ?>

</body>
</html>
