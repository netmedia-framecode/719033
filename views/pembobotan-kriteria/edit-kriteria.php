<?php require_once("../../controller/metode-roc.php");
if (!isset($_GET["p"])) {
  header("Location: menu");
  exit();
} else {
  $id = valid($conn, $_GET["p"]);
  $pull_data = "SELECT * FROM kriteria WHERE id = '$id'";
  $store_data = mysqli_query($conn, $pull_data);
  $view_data = mysqli_fetch_assoc($store_data);
  $_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Ubah Kriteria";
  require_once("../../templates/views_top.php"); ?>

  <div class="nxl-content" style="height: 100vh;">

    <!-- [ page-header ] start -->
    <div class="page-header">
      <div class="page-header-left d-flex align-items-center">
        <div class="page-header-title">
          <h5 class="m-b-10"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></h5>
        </div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item">Kriteria</li>
          <li class="breadcrumb-item"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] . ' ' . $view_data["nama_kriteria"]  ?></li>
        </ul>
      </div>
    </div>
    <!-- [ page-header ] end -->

    <!-- [ Main Content ] start -->
    <div class="main-content">
      <div class="row">
        <div class="col-lg-6">
          <div class="card stretch stretch-full">
            <fo class="card-body">
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $view_data["id"] ?>">
                <div class="mb-3">
                  <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                  <input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria" value="<?= $view_data["nama_kriteria"] ?>" required>
                </div>
                <div class="mb-3">
                  <label for="jenis" class="form-label">Jenis Kriteria</label>
                  <select name="jenis" id="jenis" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Jenis Kriteria --</option>
                    <option value="benefit" <?= $view_data["jenis"] == 'benefit' ? 'selected' : '' ?>>Benefit</option>
                    <option value="cost" <?= $view_data["jenis"] == 'cost' ? 'selected' : '' ?>>Cost</option>
                  </select>
                </div>
                <div class="mb-3 hstack gap-2 justify-content-left">
                  <a href="kriteria" class="btn btn-success">Kembali</a>
                  <button type="submit" name="edit_kriteria" class="btn btn-warning">Ubah</button>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->

  </div>

<?php }
require_once("../../templates/views_bottom.php") ?>