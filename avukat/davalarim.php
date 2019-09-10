<?php include '../header.php'; ?>

<?php  
$sor=$db->prepare("SELECT * FROM dava ORDER BY dava_zaman DESC");
$sor->execute();

?>

<div class="subnavbar">
	<div class="subnavbar-inner">
		<div class="container">
			<ul class="mainnav">
				<li><a href="index.php"><i class="icon-dashboard"></i><span>Anasayfa</span> </a> </li>
				<li class="active"><a href="davalarim.php"><i class="icon-list-alt"></i><span>Davalarım</span> </a> </li>
				<li><a href="muvekkillerim.php"><i class="icon-facetime-video"></i><span>Müvekkillerim</span> </a></li>
			</ul>
		</div>
	</div>
</div>

<div class="main">
	<div class="main-inner">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="widget widget-table action-table col-md-4">
						<a class="btn btn-success" style="margin-top:5px; margin-bottom:10px;" href="dava-olustur.php"><i class="btn-icon-only icon-plus"></i> Dava Oluştur</a>
						<div class="widget-content">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th class="td-actions"> Durum </th>
										<th> Dava </th>
										<th> Müvekkil</th>
										<th class="td-actions"> </th>
									</tr>
								</thead>
								<tbody>
									<?php while($cek=$sor->fetch(PDO::FETCH_ASSOC)) { ?>
										<tr>
											<td>
												<center>
													<?php 
													if ($cek['dava_durum']==0) {?>
														<a href="../netting/islem.php?dava_id=<?php echo $cek['ID'] ?>&dava_dur=1&dava_durum=ok">
															<button class="btn btn-danger btn-small">Pasif</button>
														</a>
													<?php } elseif ($cek['dava_durum']==1) { ?>
														<a href="../netting/islem.php?dava_id=<?php echo $cek['ID'] ?>&dava_dur=0&dava_durum=ok">
															<button class="btn btn-success btn-small">Aktif</button>
														</a>
													<?php } ?>                    
												</center>
											</td>
											<td> <?php echo $cek['davaAdi'] ?> </td>
											<td> 
												<?php 

												$muvekkil_id=$cek['muvekkil_id'];

												$muvekkilSor=$db->prepare("SELECT * FROM muvekkil where ID=:id");
												$muvekkilSor->execute(array(
													'id' => $muvekkil_id
												));

												$muvekkilCek=$muvekkilSor->fetch(PDO::FETCH_ASSOC);

												if ($muvekkilCek['durum']==0) {
													echo $muvekkilCek['adSoyad']." (Müvekkil Devredışı)";
												} else if ($muvekkilCek['durum']== 1) {
													echo $muvekkilCek['adSoyad'];
												} ?>
												 
											</td>
											<td>
												<center>
													<?php if ($muvekkilCek['durum'] == 1) { ?>
														<a class="btn btn-success btn-small" href="dava-duzenle.php?dava_id=<?php echo $cek['ID']?>"><i class="btn-icon-only icon-edit"></i></a>
													<?php } else { ?>
														<a class="btn btn-success btn-small" disabled href="?devredisi"><i class="btn-icon-only icon-edit"></i></a>
													<?php } ?>
													
													<a class="btn btn-danger btn-small" href="../netting/islem.php?dava_id=<?php echo $cek['ID']?>&davasil=ok" 
														onclick="return confirm('<?php echo $muvekkilCek['adSoyad'] ?> isimli müvekkilinizin <?php echo $cek['davaAdi'] ?> isimli davasını silmek istediğinizden emin misiniz?')"><i class="btn-icon-only icon-remove"> </i></a>
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