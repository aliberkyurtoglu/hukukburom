<?php 
ob_start();
session_start();
include 'header.php'; ?>

<?php  
$kullanicisor=$db->prepare("SELECT * FROM muvekkil WHERE kullaniciAdi=:kullaniciAdi");
$kullanicisor->execute(array(
	'kullaniciAdi' => $_SESSION['mkullaniciAdi']
));

$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

$davasor=$db -> prepare("SELECT * FROM Dava WHERE muvekkil_id=:mID ORDER BY dava_zaman DESC");
$davasor->execute(array(
	'mID' => $kullanicicek['ID']
));
?>
<body>
	<!-- /subnavbar -->
	<div class="main" style="margin-top: 100px">
		<div class="main-inner">
			<div class="container">
				<div class="row">
					<div class="span12">
						<div class="widget widget-nopad">
							<h6>Hoşgeldiniz, <?php echo $kullanicicek['adSoyad'] ?></h6>
							<p>Bitmiş ya da sürmekte olan davalarınız aşağıda yer almaktadır. Aktif davalarınız hakkında yazdığım detayları yanındaki göz işaretine basarak okuyabilirsiniz.</p>
							<div class="widget-header"> <i class="icon-bookmark"></i>
								<h3> Davalarım </h3>
							</div>
							<div class="widget-content">
								<div class="widget big-stats-container">
									<div class="widget-content">
										<table class="table table-striped table-bordered">
											<thead>
												<tr>
													<th class="td-actions"> Durum </th>
													<th> Yazı Tarihi / Saati</th>
													<th> Dava </th>
													<th class="td-actions"> </th>
												</tr>
											</thead>
											<tbody>
												<?php while($davacek=$davasor->fetch(PDO::FETCH_ASSOC)) {?>
													<?php $zaman=explode(" ",$davacek['dava_zaman']); ?>
													<tr>
														<td>
															<?php 
															if ($davacek['dava_durum']==0) {?>
																<button disabled="" class="btn btn-danger btn-small">Pasif</button>
															<?php } elseif ($davacek['dava_durum']==1) { ?>	
																<button disabled="" class="btn btn-success btn-small">Aktif</button>
															<?php } ?>   
														</td>
														<td><?php echo $zaman[0]." / ". $zaman[1]; ?></td>
														<td> <?php echo $davacek['davaAdi'] ?> </td>
														<td>
															<?php if ($davacek['dava_durum'] == 1) { ?>
																<center>
																	<a class="btn btn-success btn-small" href="davaincele.php?dava_id=<?php echo $davacek['ID']?>"><i class="btn-icon-only icon-eye-open"></i></a>
																</center> 
															<?php } else { ?>
																<center>
																	<a class="btn btn-success btn-small" disabled href="?devredisi"><i class="btn-icon-only icon-eye-close"></i></a>
																</center>
															<?php } ?> 
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


	<!-- /main -->

	<!-- /extra -->
	
</body>
<?php include 'footer.php'; ?>
</html>
