<?php 
ob_start();
session_start();

include 'baglan.php';


/* ----------------------------------------------  MÜVEKKİL İŞLEMLERİ  ---------------------------------------------- */

if (isset($_POST['muvekkilEkle'])) {

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
		'sifre' => $_POST['sifre'],
		'ePosta' => $_POST['ePosta'],
		'durum' => $_POST['durum']
		));


	if ($insert) {
		header("Location:../avukat/muvekkillerim.php?durum=ok");
		exit;

	} else {
		header("Location:../avukat/muvekkillerim.php?durum=no");
		exit;
	}	
}


if (isset($_POST['muvekkilDuzenle'])) {

	$muvekkil_ID=$_POST['muvekkilID'];
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
		'sifre' => $_POST['sifre'],
		'ePosta' => $_POST['ePosta'],
		'durum' => $_POST['durum'],
	));

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
?>