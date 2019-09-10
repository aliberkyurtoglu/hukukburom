<?php include '../header.php'; ?>

<script src="../ckeditor/ckeditor.js"></script>


<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li><a href="index.php"><i class="icon-dashboard"></i><span>Anasayfa</span> </a> </li>
        <li class="active"><a href="davalarim.php"><i class="icon-list-alt"></i><span>Davalarım</span> </a> </li>
        <li><a href="muvekkillerim.php"><i class="icon-facetime-video"></i><span>Müvekkillerim</span> </a></li>
      </div>
    </div>
  </div>

  <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
    <div class="main">
      <div class="main-inner">
        <div class="container">
          <div class="row">
            <div class="span12">
              <a class="btn btn-primary" style="margin-bottom: 12px" href="davalarim.php"><i class="btn-icon-only icon-arrow-left"></i> Geri Dön</a>

              <div class="widget widget-nopad">
                <div class="form-group" style="margin-top: 5px">
                  <label for="muvekkil"> Müvekkil <span style="color: gray; font-size: 11px">||*Eğer ki aradığınız müvekkili bulamadıysanız 'Müvekkillerim' penceresinden müvekil durumunu Aktif yapınız</span></label>

                  <div>
                    <?php  
                    $sor=$db->prepare("SELECT * FROM muvekkil WHERE durum=:durum ORDER BY ID");
                    $sor->execute(array(
                      'durum' => 1
                    ));
                    ?>

                    <select class="select2_multiple form-control" required="" name="muvekkil_id" >
                      <?php 
                      while($cek=$sor->fetch(PDO::FETCH_ASSOC)) {
                        $muvekkil_id=$cek['ID'];
                        ?>
                        <option value="<?php echo $cek['ID']; ?>"> <?php echo $cek['adSoyad']; ?></option>
                      <?php } ?>
                    </select>

                    <a class="btn btn-secondary" style="margin-top:5px; margin-bottom:10px;" href="muvekkil-ekle.php"><i class="btn-icon-only icon-plus"></i></a>
                  </div>
                </div>

                <div class="form-group">
                  <label for="davaAdi"> Dava Adı</label>
                  <div>
                    <input type="text" placeholder="Kasten yaralama" name="davaAdi" class="form-control" required="">
                  </div>
                </div>

                <div class="form-group" style="margin-top: 5px">
                  <label for="davaAciklama"> Dava Açıklaması</label>
                  <div>
                    <textarea class="ckeditor" id="editor1" style="width: 400px; height: 250px; resize: none" required="" placeholder="Dava ile ilgili detaylar" name="dava_aciklama"></textarea>
                  </div>
                </div>

                <script type="text/javascript">

                 CKEDITOR.replace( 'editor1',

                 {
                  height : 300,

                  width: 500,

                  filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

                  filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',

                  filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',

                  filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

                  filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

                  filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

                  forcePasteAsPlainText: true

                } 

                );

              </script>

              <div class="form-group" style="margin-top: 5px">
                <label for="durum"> Durum</label>
                <div>
                  <select class="form-control" name="dava_durum" required>
                    <option value="1">Aktif</option>
                    <option value="0">Pasif</option>  
                  </select>
                </div>
              </div>

              <div class="form-group" style="margin-top: 10px">
                <div align="left">
                  <button type="submit" name="davaOlustur" class="btn btn-success">Oluştur</button>               
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