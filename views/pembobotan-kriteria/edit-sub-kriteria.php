<?php require_once("../../controller/metode-roc.php");
if (!isset($_GET["p"])) {
  header("Location: menu");
  exit();
} else {
  $id = valid($conn, $_GET["p"]);
  $pull_data = "SELECT kriteria.kode_kriteria, kriteria.nama_kriteria, kriteria.jenis, sub_kriteria.* FROM sub_kriteria JOIN kriteria ON sub_kriteria.id_kriteria = kriteria.id WHERE sub_kriteria.id = '$id'";
  $store_data = mysqli_query($conn, $pull_data);
  $view_data = mysqli_fetch_assoc($store_data);
  $_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Ubah Sub Kriteria";
  require_once("../../templates/views_top.php"); ?>

  <div class="nxl-content" style="height: 100vh;">

    <!-- [ page-header ] start -->
    <div class="page-header">
      <div class="page-header-left d-flex align-items-center">
        <div class="page-header-title">
          <h5 class="m-b-10"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></h5>
        </div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item">Sub Kriteria</li>
          <li class="breadcrumb-item"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] . ' ' . $view_data["nama_sub_kriteria"]  ?></li>
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
                  <label for="id_kriteria" class="form-label">Kriteria</label>
                  <select name="id_kriteria" id="id_kriteria" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Kriteria --</option>
                    <?php foreach ($views_kriteria as $data) { ?>
                      <option value="<?= $data['id'] ?>" <?= $data['id'] == $view_data['id_kriteria'] ? 'selected' : '' ?>><?= $data['nama_kriteria'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="nama_sub_kriteria" class="form-label">Nama Sub Kriteria</label>
                  <input type="text" name="nama_sub_kriteria" class="form-control" id="nama_sub_kriteria" value="<?= $view_data['nama_sub_kriteria'] ?>" required>
                </div>
                <div class="mb-3">
                  <label for="bobot" class="form-label">Bobot</label>
                  <div class="d-flex align-items-center gap-2">
                    <input type="range" name="bobot" id="bobot" min="1" max="5" value="<?= $view_data['bobot'] ?>"
                      class="form-range"
                      oninput="bobotValue.textContent=this.value">
                    <strong><span id="bobotValue"><?= $view_data['bobot'] ?></span></strong>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="deskripsi" class="form-label">Deskripsi</label>
                  <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3"><?= $view_data['deskripsi'] ?></textarea>
                </div>
                <div class="mb-3 hstack gap-2 justify-content-left">
                  <a href="sub-kriteria" class="btn btn-success">Kembali</a>
                  <button type="submit" name="edit_sub_kriteria" class="btn btn-warning">Ubah</button>
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