<?php

require_once("../../config/Base.php");
require_once("../../config/Auth.php");
require_once("../../config/Alert.php");
require_once("../../views/metode-roc/redirect.php");

$kriteria = "SELECT * FROM kriteria ORDER BY id DESC";
$views_kriteria = mysqli_query($conn, $kriteria);
if (isset($_POST["add_kriteria"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (kriteria($conn, $validated_post, $action = 'insert') > 0) {
    $message = "Data kriteria baru berhasil ditambahkan.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: kriteria");
    exit();
  }
}
if (isset($_POST["edit_kriteria"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (kriteria($conn, $validated_post, $action = 'update') > 0) {
    $message = "Data kriteria " . $_POST['nama_kriteria'] . " berhasil diubah.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: kriteria");
    exit();
  }
}
if (isset($_POST["delete_kriteria"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (kriteria($conn, $validated_post, $action = 'delete') > 0) {
    $message = "Data kriteria " . $_POST['nama_kriteria'] . " berhasil dihapus.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: kriteria");
    exit();
  }
}

$sub_kriteria = "SELECT kriteria.kode_kriteria, kriteria.nama_kriteria, kriteria.jenis, sub_kriteria.* FROM sub_kriteria JOIN kriteria ON sub_kriteria.id_kriteria = kriteria.id ORDER BY sub_kriteria.id DESC";
$views_sub_kriteria = mysqli_query($conn, $sub_kriteria);
if (isset($_POST["add_sub_kriteria"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (sub_kriteria($conn, $validated_post, $action = 'insert') > 0) {
    $message = "Data sub kriteria baru berhasil ditambahkan.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: sub-kriteria");
    exit();
  }
}
if (isset($_POST["edit_sub_kriteria"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (sub_kriteria($conn, $validated_post, $action = 'update') > 0) {
    $message = "Data sub kriteria " . $_POST['nama_sub_kriteria'] . " berhasil diubah.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: sub-kriteria");
    exit();
  }
}
if (isset($_POST["delete_sub_kriteria"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (sub_kriteria($conn, $validated_post, $action = 'delete') > 0) {
    $message = "Data sub kriteria " . $_POST['nama_sub_kriteria'] . " berhasil dihapus.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: sub-kriteria");
    exit();
  }
}

if (isset($_POST['hitung_roc'])) {
  if (metode_roc($conn, $_POST['prioritas'])) {
    $message = "Berhasil! Nilai bobot ROC telah dihitung ulang.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: pembobotan-nilai");
  } else {
    $message = "Gagal menghitung bobot. Data prioritas kosong.";
    $message_type = "danger";
    alert($message, $message_type);
  }
}
