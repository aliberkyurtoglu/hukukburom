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


	<?php 
	$sor=$db->prepare("SELECT * FROM Muvekkil where ID=:id");
	$sor->execute(array(
		'id' => $_GET['muvekkil_id']
	));

	$cek=$sor->fetch(PDO::FETCH_ASSOC); 
	?>


	
	<form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
		<div class="main">
			<div class="main-inner">
				<div class="container">
					<div class="row">
						<div class="span12">
							<a class="btn btn-primary" style="margin-bottom: 12px" href="muvekkillerim.php"><i class="btn-icon-only icon-arrow-left"></i> Geri Dön</a>
							<?php 
							if ($_GET['durum']=="ok") {?>
								<b style="color:green;">İşlem Başarılı...</b>
							<?php } elseif ($_GET['durum']=="no") {?>
								<b style="color:red;">İşlem Başarısız...</b>
							<?php }
							?>
							<div class="widget widget-nopad">
								<div class="form-group">
									<label for="adSoyad"> Ad Soyad</label>
									<div>
										<input type="text" id="adSoyad" name="adSoyad" value="<?php echo $cek['adSoyad'] ?>" class="form-control" required="">
									</div>
								</div>

								<div class="form-group" style="margin-top: 5px">
									<label for="adSoyad"> E-Posta</label>
									<div>
										<input type="email" id="ePosta" name="ePosta" value="<?php echo $cek['ePosta'] ?>" class="form-control" required="">
									</div>
								</div>

								<div class="form-group" style="margin-top: 5px">
									<label for="adSoyad"> Kullanıcı Adı</label>
									<div>
										<input type="text" id="kullaniciAdi" name="kullaniciAdi" value="<?php echo $cek['kullaniciAdi'] ?>" class="form-control" required="">
									</div>
								</div>

								<div class="form-group" style="margin-top: 5px">
									<label for="adSoyad"> Şifre</label>
									<div>
										<input type="password" id="sifre" name="sifre" value="" class="form-control">
									</div>
								</div>

								<div class="form-group" style="margin-top: 5px">
									<label for="durum"> Durum</label>
									<div>
										<select id="durum" class="form-control" name="durum" required>
											<?php 
											if ($cek['durum']==0) {?>
												<option value="0">Pasif</option>
												<option value="1">Aktif</option>

											<?php } else {?>
												<option value="1">Aktif</option>
												<option value="0">Pasif</option>

											<?php  } ?>
										</select>

										<input type="hidden" name="muvekkilID" value="<?php echo $cek['ID'] ?>">
									</div>
								</div>

								<div class="form-group" style="margin-top: 10px">
									<div align="left">
										<button type="submit" name="muvekkilDuzenle" class="btn btn-success">Kaydet</button>               
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