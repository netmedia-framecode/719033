<?php

require_once("../../config/Base.php");
require_once("../../config/Auth.php");
require_once("../../config/Alert.php");
require_once("../../views/informasi/redirect.php");

$tentang = "SELECT * FROM tentang ORDER BY id DESC LIMIT 1";
$views_tentang = mysqli_query($conn, $tentang);
if (isset($_POST["add_tentang"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (tentang($conn, $validated_post, $action = 'insert') > 0) {
    $message = "Data tentang baru berhasil ditambahkan.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: tentang-kami");
    exit();
  }
}
if (isset($_POST["edit_tentang"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (tentang($conn, $validated_post, $action = 'update') > 0) {
    $message = "Data tentang berhasil diubah.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: tentang-kami");
    exit();
  }
}
if (isset($_POST["delete_tentang"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (tentang($conn, $validated_post, $action = 'delete') > 0) {
    $message = "Data tentang berhasil dihapus.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: tentang-kami");
    exit();
  }
}

$prosedur_seleksi = "SELECT * FROM prosedur_seleksi ORDER BY id DESC LIMIT 1";
$views_prosedur_seleksi = mysqli_query($conn, $prosedur_seleksi);
if (isset($_POST["add_prosedur_seleksi"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (prosedur_seleksi($conn, $validated_post, $action = 'insert') > 0) {
    $message = "Data prosedur seleksi baru berhasil ditambahkan.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: prosedur-seleksi");
    exit();
  }
}
if (isset($_POST["edit_prosedur_seleksi"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (prosedur_seleksi($conn, $validated_post, $action = 'update') > 0) {
    $message = "Data prosedur seleksi berhasil diubah.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: prosedur-seleksi");
    exit();
  }
}
if (isset($_POST["delete_prosedur_seleksi"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (prosedur_seleksi($conn, $validated_post, $action = 'delete') > 0) {
    $message = "Data prosedur seleksi berhasil dihapus.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: prosedur-seleksi");
    exit();
  }
}

$kontak = "SELECT * FROM kontak ORDER BY id DESC";
$views_kontak = mysqli_query($conn, $kontak);
if (isset($_POST["delete_kontak"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (kontak($conn, $validated_post, $action = 'delete') > 0) {
    $message = "Pesan dari " . $_POST['nama'] . " berhasil dihapus.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: pesan-masuk");
    exit();
  }
}
