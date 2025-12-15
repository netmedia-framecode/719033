<?php if (!isset($_SESSION)) {
  session_start();
}
require_once("../controller/auth.php");
if (isset($_SESSION["project_sistem_penerimaan_blt"])) {
  unset($_SESSION["project_sistem_penerimaan_blt"]);
  header("Location: ./");
  exit();
}
