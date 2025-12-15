<?php require_once("../../controller/master-data.php");
if (!isset($_GET["p"])) {
  header("Location: menu");
  exit();
} else {
  $id = valid($conn, $_GET["p"]);
  $pull_data = "SELECT * FROM periode WHERE id = '$id'";
  $store_data = mysqli_query($conn, $pull_data);
  $view_data = mysqli_fetch_assoc($store_data);
  $_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Ubah Periode";
  require_once("../../templates/views_top.php"); ?>

  <div class="nxl-content" style="height: 100vh;">

    <!-- [ page-header ] start -->
    <div class="page-header">
      <div class="page-header-left d-flex align-items-center">
        <div class="page-header-title">
          <h5 class="m-b-10"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></h5>
        </div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item">Periode</li>
          <li class="breadcrumb-item"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] . ' ' . $view_data["nama_periode"]  ?></li>
        </ul>
      </div>
    </div>
    <!-- [ page-header ] end -->

    <!-- [ Main Content ] start -->
    <div class="main-content">
      <div class="row">
        <div class="col-lg-6">
          <div class="card stretch stretch-full">
            <div class="card-body">
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $view_data['id'] ?>">
                <div class="mb-3">
                  <label for="nama_periode" class="form-label">Periode</label>
                  <input type="text" name="nama_periode" class="form-control" id="nama_periode" value="<?= $view_data['nama_periode'] ?>" required>
                </div>
                <div class="mb-3">
                  <label for="tanggal_mulai" class="form-label">Tgl Mulai</label>
                  <input type="date" name="tanggal_mulai" class="form-control" id="tanggal_mulai" value="<?= $view_data['tanggal_mulai'] ?>" required>
                </div>
                <div class="mb-3">
                  <label for="status" class="form-label">Status</label>
                  <select name="status" id="status" class="form-select" required>
                    <option value="" selected disabled>-- Pilih Status --</option>
                    <option value="Aktif" <?= $view_data['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                    <option value="Pending" <?= $view_data['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Selesai" <?= $view_data['status'] == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="keterangan" class="form-label">Keterangan</label>
                  <textarea name="keterangan" id="keterangan" class="form-control" rows="3"><?= $view_data['keterangan'] ?></textarea>
                </div>
                <div class="mb-3 hstack gap-2 justify-content-left">
                  <a href="periode" class="btn btn-success">Kembali</a>
                  <button type="submit" name="edit_periode" class="btn btn-warning">Ubah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->

  </div>

<?php }
require_once("../../templates/views_bottom.php") ?>