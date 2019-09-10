<?php 
ob_start();
session_start();
include 'header.php'; ?>
<?php 
$davasor=$db->prepare("SELECT * FROM Dava where ID=:id");
$davasor->execute(array(
	'id' => $_GET['dava_id']
));

$davacek=$davasor->fetch(PDO::FETCH_ASSOC); 
?>

<form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
	<div class="main" style="margin-top: 100px; margin-left: 100px">
		<div class="main-inner">
				<div class="row">
					<div class="col-md-12">
						<a class="btn btn-primary" style="margin-left: -12px; margin-top: -50px" href="index.php"><i class="btn-icon-only icon-arrow-left"></i> Geri Dön</a>
						<?php $zaman=explode(" ",$davacek['dava_zaman']); ?>
						<div class="form-group" style="margin-top: 5px">
							<label for="muvekkil_id"> Yazı Tarihi </label>
							<div>
								<input type="text" disabled="" name="yaziTarih" value="<?php echo $zaman[0]; ?>" class="form-control">
							</div>
						</div>

						<div class="form-group" style="margin-top: 5px">
							<label for="muvekkil_id"> Yazı Saati </label>
							<div>
								<input type="text" disabled="" name="yaziSaat" value="<?php echo $zaman[1]; ?>" class="form-control">
							</div>
						</div>

						<div class="form-group" style="margin-top: 5px">
							<label for="davaAdi"> Dava Adı</label>
							<div>
								<input type="text" disabled="" name="davaAdi" value=" <?php echo $davacek['davaAdi'] ?>" class="form-control">
							</div>
						</div>

						<div class="form-group" style="margin-top: 5px">
							<label for="dava_aciklama"> Dava Açıklaması</label>
							<div>
                                <p><?php echo $davacek['dava_aciklama']; ?></p>
							</div>
						</div>

						<div class="form-group" style="margin-top: 5px">
							<label for="dava_durum"> Durum</label>
							<div>
								<?php 
								if ($davacek['dava_durum']==0) {?>
									<input type="text" disabled="" name="dava_durum" value="Pasif" class="form-control" style="font-weight: bold; color: red">
								<?php } else {?>
									<input type="text" disabled="" name="dava_durum" value="Aktif" class="form-control" style="font-weight: bold; color: green">
								<?php  } ?>
							</div>
						</div>

					</div>
				</div>
		</div>
	</div>
</form>

<?php include 'footer.php'; ?>