<?php

require_once("../../config/Base.php");
require_once("../../config/Auth.php");
require_once("../../config/Alert.php");
require_once("../../views/master-data/redirect.php");

$periode = "SELECT * FROM periode ORDER BY id DESC";
$views_periode = mysqli_query($conn, $periode);
if (isset($_POST["add_periode"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (periode($conn, $validated_post, $action = 'insert') > 0) {
    $message = "Data periode baru berhasil ditambahkan.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: periode");
    exit();
  }
}
if (isset($_POST["edit_periode"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (periode($conn, $validated_post, $action = 'update') > 0) {
    $message = "Data periode " . $_POST['nama_periode'] . " berhasil diubah.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: periode");
    exit();
  }
}
if (isset($_POST["delete_periode"])) {
  $validated_post = array_map(function ($value) use ($conn) {
    return valid($conn, $value);
  }, $_POST);
  if (periode($conn, $validated_post, $action = 'delete') > 0) {
    $message = "Data periode " . $_POST['nama_periode'] . " berhasil dihapus.";
    $message_type = "success";
    alert($message, $message_type);
    header("Location: periode");
    exit();
  }
}
