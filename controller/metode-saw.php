<?php

require_once("../../config/Base.php");
require_once("../../config/Auth.php");
require_once("../../config/Alert.php");
require_once("../../views/seleksi-dan-hasil/redirect.php");

$alternatif = "SELECT * FROM alternatif ORDER BY id ASC";
$views_alternatif = mysqli_query($conn, $alternatif);
if (isset($_POST["add_alternatif"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (alternatif($conn, $validated_post, $action = 'insert') > 0) {
    $message = "Data alternatif baru berhasil ditambahkan.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: data-penduduk");
    exit();
  }
}
if (isset($_POST["edit_alternatif"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (alternatif($conn, $validated_post, $action = 'update') > 0) {
    $message = "Data alternatif " . $_POST['nama_lengkap'] . " berhasil diubah.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: data-penduduk");
    exit();
  }
}
if (isset($_POST["delete_alternatif"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (alternatif($conn, $validated_post, $action = 'delete') > 0) {
    $message = "Data alternatif " . $_POST['nama_lengkap'] . " berhasil dihapus.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: data-penduduk");
    exit();
  }
}

$periode = "SELECT id FROM periode WHERE status = 'Aktif' ORDER BY id DESC LIMIT 1";
$views_periode = mysqli_query($conn, $periode);
$id_periode = mysqli_fetch_assoc($views_periode)['id'];
if (isset($_POST['simpan_nilai'])) {
  if (save_penilaian($conn, $_POST)) {
    $message = "Berhasil! Data penilaian telah berhasil disimpan.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: penilaian-penduduk");
    exit;
  }
}

if (isset($_GET['periode'])) {
  $id_periode_aktif = $_GET['periode'];
} else {
  $q_last = mysqli_query($conn, "SELECT id FROM periode ORDER BY id DESC LIMIT 1");
  $id_periode_aktif = (mysqli_num_rows($q_last) > 0) ? mysqli_fetch_assoc($q_last)['id'] : 1;
}
$data_ranking = hitung_ranking_saw($conn, $id_periode_aktif);
if (isset($_POST['simpan_permanen'])) {
  if (simpan_hasil_seleksi($conn, $id_periode_aktif, $data_ranking)) {
    $message = "Hasil seleksi periode ini berhasil disimpan permanen.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: hasil-seleksi?periode=$id_periode_aktif");
    exit();
  } else {
    $message = "Gagal menyimpan. Data ranking kosong.";
    $message_type = "danger";
    alert($message, $message_type);
  }
}
