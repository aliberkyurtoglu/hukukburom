<?php 
ob_start();
session_start();

include 'baglan.php';

$kullanicisor=$db->prepare("SELECT * FROM avukat WHERE kullaniciAdi=:kullaniciAdi");
$kullanicisor->execute(array(
	'kullaniciAdi' => $_SESSION['kullaniciAdi']
));

$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
?>

<?php if (!isset($_SESSION['kullaniciAdi'])) { ?>
	<?php header("Location: 404.php"); ?>
<?php } 
?>


<?php

/* ----------------------------------------------  MÜVEKKİL İŞLEMLERİ  ---------------------------------------------- */

if (isset($_POST['muvekkilEkle'])) {
	$kullanicisor=$db->prepare("SELECT * FROM muvekkil WHERE kullaniciAdi=:kullaniciAdi OR ePosta=:mail");
	$kullanicisor->execute(array(
		'kullaniciAdi' => $_POST['kullaniciAdi'],
		'mail' => $_POST['ePosta']
	));

	$say=$kullanicisor->rowCount();
	if ($say==0) {
		$sifre=md5($_POST['sifre']);

		$kaydet=$db->prepare("INSERT INTO muvekkil SET
			adSoyad=:adSoyad,
			kullaniciAdi=:kullaniciAdi,
			sifre=:sifre,
			ePosta=:ePosta,
			durum=:durum
			");

		$insert=$kaydet->execute(array(
			'adSoyad' => $_POST['adSoyad'],
			'kullaniciAdi' => $_POST['kullaniciAdi'],
			'sifre' => $sifre,
			'ePosta' => $_POST['ePosta'],
			'durum' => $_POST['durum']
		));

		if ($insert) {
			header("Location:../avukat/muvekkil-ekle.php?durum=basarili");
		} else {
			header("Location:../avukat/muvekkil-ekle.php?durum=basarisiz");
		}

	} else {
		header("Location:../avukat/muvekkil-ekle.php?durum=kayitlikullanici");
	}
}


if (isset($_POST['muvekkilDuzenle'])) {

	$muvekkil_ID=$_POST['muvekkilID'];
	$sifre = md5($_POST['sifre']);
	if (!empty($_POST['sifre']))
	{
		$kaydet=$db->prepare("UPDATE muvekkil SET
		adSoyad=:adSoyad,
		kullaniciAdi=:kullaniciAdi,
		sifre=:sifre,
		ePosta=:ePosta,
		durum=:durum
		WHERE ID={$_POST['muvekkilID']}
		");

		$update=$kaydet->execute(array(
			'adSoyad' => $_POST['adSoyad'],
			'kullaniciAdi' => $_POST['kullaniciAdi'],
			'sifre' => $sifre,
			'ePosta' => $_POST['ePosta'],
			'durum' => $_POST['durum'],
		));
	} else {
		$kaydet=$db->prepare("UPDATE muvekkil SET
		adSoyad=:adSoyad,
		kullaniciAdi=:kullaniciAdi,
		ePosta=:ePosta,
		durum=:durum
		WHERE ID={$_POST['muvekkilID']}
		");

		$update=$kaydet->execute(array(
			'adSoyad' => $_POST['adSoyad'],
			'kullaniciAdi' => $_POST['kullaniciAdi'],
			'ePosta' => $_POST['ePosta'],
			'durum' => $_POST['durum'],
		));
	}



	if ($update) {
		Header("Location:../avukat/muvekkil-duzenle.php?durum=ok&muvekkil_id=$muvekkil_ID");
	} else {
		Header("Location:../avukat/muvekkil-duzenle.php?durum=no&muvekkil_id=$muvekkil_ID");
	}
}


if ($_GET['muvekkilsil']=="ok") {

	$sil=$db->prepare("DELETE from muvekkil where ID=:id");
	$kontrol=$sil->execute(array(
		'id'=> $_GET['muvekkil_id']
	));

	if ($kontrol) {
		header("Location: ../avukat/muvekkillerim.php?sil=ok");
		exit;

	} else{
		header("Location: ../avukat/muvekkillerim.php?sil=no");
		exit;
	}
}


if ($_GET['muvekkil_durum']=="ok") {
	$duzenle=$db->prepare("UPDATE muvekkil SET	
		durum=:durum
		WHERE ID={$_GET['muvekkil_id']}");

	$guncelle=$duzenle->execute(array(
		'durum' => $_GET['muvekkil_dur']
	));

	if ($guncelle) {
		Header("Location:../avukat/muvekkillerim.php?durum=guncellendi");
	} else {
		Header("Location:../avukat/muvekkillerim.php?durum=no");
	}
}




















/* ----------------------------------------------  DAVA İŞLEMLERİ  ---------------------------------------------- */

if (isset($_POST['davaOlustur'])) {

	$kaydet=$db->prepare("INSERT INTO dava SET
		muvekkil_id=:muvekkil_id,
		davaAdi=:davaAdi,
		dava_aciklama=:dava_aciklama,
		dava_durum=:dava_durum
		");

	$insert=$kaydet->execute(array(
		'muvekkil_id' => $_POST['muvekkil_id'],
		'davaAdi' => $_POST['davaAdi'],
		'dava_aciklama' => $_POST['dava_aciklama'],
		'dava_durum' => $_POST['dava_durum'],
	));


	if ($insert) {
		header("Location:../avukat/davalarim.php?durum=ok");
		exit;

	} else {
		header("Location:../avukat/davalarim.php?durum=no");
		exit;
	}	
}


if (isset($_POST['davaDuzenle'])) {
	
	$dava_id=$_POST['dava_id'];
	$kaydet=$db->prepare("UPDATE dava SET
		muvekkil_id=:muvekkil_id,
		davaAdi=:davaAdi,
		dava_aciklama=:dava_aciklama,
		dava_durum=:dava_durum
		WHERE ID={$_POST['dava_id']}
		");

	$update=$kaydet -> execute(array(
		'muvekkil_id' => $_POST['muvekkil_id'],
		'davaAdi' => $_POST['davaAdi'],
		'dava_aciklama' => $_POST['dava_aciklama'],
		'dava_durum' => $_POST['dava_durum']
	));

	if ($update) {
		Header("Location:../avukat/dava-duzenle.php?durum=ok&dava_id=$dava_id");
	} else {
		Header("Location:../avukat/dava-duzenle.php?durum=no&dava_id=$dava_id");
	}
}


if ($_GET['davasil']=="ok") {
	$sil=$db->prepare("DELETE from dava where ID=:id");
	$kontrol=$sil->execute(array(
		'id'=> $_GET['dava_id']
	));

	if ($kontrol) {
		header("Location: ../avukat/davalarim.php?sil=ok");
		exit;

	} else{
		header("Location: ../avukat/davalarim.php?sil=no");
		exit;
	}
}


if ($_GET['dava_durum']=="ok") {
	$duzenle=$db->prepare("UPDATE dava SET	
		dava_durum=:dava_durum
		WHERE ID={$_GET['dava_id']}");

	$guncelle=$duzenle->execute(array(
		'dava_durum' => $_GET['dava_dur']
	));

	if ($guncelle) {
		Header("Location:../avukat/davalarim.php?durum=guncellendi");
	} else {
		Header("Location:../avukat/davalarim.php?durum=no");
	}
}













/* ----------------------------------------------  GİRİŞ İŞLEMLERİ  ---------------------------------------------- */
if (isset($_POST['avukatGiris'])) {

	$kullaniciAdi=$_POST['kullaniciAdi'];
	$sifre=md5($_POST['sifre']);

	$kullanicisor=$db->prepare("SELECT * FROM avukat where kullaniciAdi=:kAdi and sifre=:sifre");
	$kullanicisor->execute(array(
		'kAdi' => $kullaniciAdi,
		'sifre' => $sifre,
	));

	$say=$kullanicisor->rowCount();

	if ($say==1) {

		$_SESSION['kullaniciAdi']=$kullaniciAdi;
		header("Location:../avukat/index.php");
		exit;

	} else {

		header("Location:../avukat/giris.php?durum=no");
		exit;
	}
}



if (isset($_POST['muvekkilGiris'])) {

	$kullaniciAdi=$_POST['kullaniciAdi'];
	$sifre=md5($_POST['sifre']);

	$kullanicisor=$db->prepare("SELECT * FROM muvekkil where kullaniciAdi=:kAdi and sifre=:sifre");
	$kullanicisor->execute(array(
		'kAdi' => $kullaniciAdi,
		'sifre' => $sifre,
	));

	$say=$kullanicisor->rowCount();

	if ($say==1) {

		$_SESSION['mkullaniciAdi']=$kullaniciAdi;
		header("Location:../muvekkil/index.php");
		exit;

	} else {

		header("Location:../giris.php?durum=no");
		exit;
	}
}
















/* ----------------------------------------------  AVUKAT DÜZENLEME İŞLEMLERİ  ---------------------------------------------- */
if (isset($_POST['avukatDuzenle'])) {

	$kullanici_eskipassword=trim($_POST['eskiSifre']); 
	$kullanici_passwordone=trim($_POST['sifre']);
	$kullanici_passwordtwo=trim($_POST['sifreTwo']);

	$kullanici_password=md5($kullanici_eskipassword);

	$kullanicisor=$db->prepare("SELECT * FROM avukat WHERE sifre=:password");
	$kullanicisor->execute(array(
		'password' => $kullanici_password
	));

			//dönen satır sayısını belirtir
	$say=$kullanicisor->rowCount();

	if ($say==0) {
		header("Location:../avukat/hesabim.php?durum=sifrehatali");
	} else {

	//eski şifre doğruysa başla
		if ($kullanici_passwordone==$kullanici_passwordtwo) {

			if (strlen($kullanici_passwordone)>=6) {
				$password=md5($kullanici_passwordone);

				$kullanicikaydet=$db->prepare("UPDATE avukat SET
					sifre=:kullanici_password
					WHERE ID={$_POST['ID']}");
				
				$insert=$kullanicikaydet->execute(array(
					'kullanici_password' => $password
				));

				if ($insert) {
					header("Location:../avukat/hesabim.php?durum=sifredegisti");
				} else {
					header("Location:../avukat/hesabim.php?durum=no");
				}
	//Bitiş
			} else {
				header("Location:../avukat/hesabim.php?durum=eksiksifre");
			}

		} else {
			header("Location:../avukat/hesabim.php?durum=sifreleruyusmuyor");
			exit;
		}
	}
	exit;

	if ($update) {
		header("Location:../avukat/hesabim.php?durum=ok");
	} else {
		header("Location:../avukat/hesabim.php?durum=no");
	}

}



if (isset($_POST['avukatDuzenle2'])) {
	
	$kullanici_id=$_POST['ID'];
	$kullaniciSifre=trim($_POST['sifre']); 
	$kullaniciPassword=md5($kullaniciSifre);

	$kullanicisor=$db->prepare("SELECT * FROM avukat WHERE sifre=:sifre");
	$kullanicisor->execute(array(
		'sifre' => $kullaniciPassword
	));

	$say=$kullanicisor->rowCount();
	if ($say==0) {
		header("Location:../avukat/hesabim2.php?durum=sifrehatali");
	} else {
			//dönen satır sayısını belirtir
		$say=$kullanicisor->rowCount();
		$ayarkaydet=$db->prepare("UPDATE avukat SET
			adSoyad=:adSoyad,
			kullaniciAdi=:kullaniciAdi
			WHERE ID={$_POST['ID']}");

		$update=$ayarkaydet->execute(array(
			'adSoyad' => $_POST['adSoyad'],
			'kullaniciAdi' => $_POST['kullaniciAdi']
		));


		if ($update) {
			header("Location:../avukat/hesabim2.php?durum=ok");
			exit;

		} else {
			header("Location:../avukat/hesabim2.php?durum=no");
			exit;
		}
	}
}
?>