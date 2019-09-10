<?php include '../header.php'; ?>

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


	<?php 
	$davasor=$db->prepare("SELECT * FROM Dava where ID=:id");
	$davasor->execute(array(
		'id' => $_GET['dava_id']
	));

	$davacek=$davasor->fetch(PDO::FETCH_ASSOC); 
	?>
	<form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
		<div class="main">
			<div class="main-inner">
				<div class="container">
					<div class="row">
						<div class="span12">
							<a class="btn btn-primary" style="margin-bottom: 12px" href="davalarim.php"><i class="btn-icon-only icon-arrow-left"></i> Geri Dön</a>
							<?php 
							if ($_GET['durum']=="ok") {?>
								<b style="color:green;">İşlem Başarılı...</b>
							<?php } elseif ($_GET['durum']=="no") {?>
								<b style="color:red;">İşlem Başarısız...</b>
							<?php }
							?>
							<div class="widget widget-nopad">
								<div class="form-group" style="margin-top: 5px">
									<label for="muvekkil_id"> Müvekkil <span style="color: gray; font-size: 11px">||*Eğer ki aradığınız müvekkili bulamadıysanız 'Müvekkillerim' penceresinden müvekil durumunu Aktif yapınız</span></label>
									<div>
										<?php  
										$muv_id=$davacek['muvekkil_id'];  
										$muvekkilsor=$db->prepare("SELECT * FROM Muvekkil");
										$muvekkilsor->execute(array(
											'durum' => 1
										));
										?>
										<select class="select2_multiple form-control" required="" name="muvekkil_id">
											<?php while($muvekkilcek=$muvekkilsor->fetch(PDO::FETCH_ASSOC)) {
												$muvekkil_id=$muvekkilcek['ID'];
												?>

												<option 
												<?php if ($muv_id==$muvekkil_id) { 
													echo "selected='select'"; 
												} ?> 
												value="<?php echo $muvekkilcek['ID']; ?>"> <?php echo $muvekkilcek['adSoyad']; ?>                   
											</option>

										<?php } ?>
									</select>
									<a class="btn btn-secondary" style="margin-top:5px; margin-bottom:10px;" href="muvekkil-ekle.php"><i class="btn-icon-only icon-plus"></i></a>
								</div>
							</div>

							<div class="form-group" style="margin-top: 5px">
								<label for="davaAdi"> Dava Adı</label>
								<div>
									<input type="text" name="davaAdi" value="<?php echo $davacek['davaAdi'] ?>" class="form-control" required="">
								</div>
							</div>

							<div class="form-group" style="margin-top: 5px">
								<label for="dava_aciklama"> Dava Açıklaması</label>
								<div>
									<textarea id="editor1" style="resize: none" name="dava_aciklama" cols="50" rows="25" required=""><?php echo $davacek['dava_aciklama']; ?></textarea>
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
								<label for="dava_durum"> Durum</label>
								<div>
									<select class="form-control" name="dava_durum" required>
										<?php 
										if ($davacek['dava_durum']==0) {?>
											<option value="0">Pasif</option>
											<option value="1">Aktif</option>

										<?php } else {?>
											<option value="1">Aktif</option>
											<option value="0">Pasif</option>

										<?php  } ?>
									</select>
								</div>
							</div>

							<input type="hidden" name="dava_id" value="<?php echo $davacek['ID'] ?>">

							<div class="form-group" style="margin-top: 10px">
								<div align="left">
									<button type="submit" name="davaDuzenle" class="btn btn-success">Kaydet</button>               
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