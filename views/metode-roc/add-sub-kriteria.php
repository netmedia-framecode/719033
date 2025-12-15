<?php require_once("../../controller/metode-roc.php");
$_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Tambah Sub Kriteria";
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
        <li class="breadcrumb-item"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></li>
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
              <div class="mb-3">
                <label for="id_kriteria" class="form-label">Kriteria</label>
                <select name="id_kriteria" id="id_kriteria" class="form-select" required>
                  <option value="" disabled selected>-- Pilih Kriteria --</option>
                  <?php foreach ($views_kriteria as $data) { ?>
                    <option value="<?= $data['id'] ?>"><?= $data['nama_kriteria'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="nama_sub_kriteria" class="form-label">Nama Sub Kriteria</label>
                <input type="text" name="nama_sub_kriteria" class="form-control" id="nama_sub_kriteria" required>
              </div>
              <div class="mb-3">
                <label for="bobot" class="form-label">Bobot</label>
                <div class="d-flex align-items-center gap-2">
                  <input type="range" name="bobot" id="bobot" min="1" max="5" value="1"
                    class="form-range"
                    oninput="bobotValue.textContent=this.value">
                  <strong><span id="bobotValue">1</span></strong>
                </div>
              </div>
              <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3"></textarea>
              </div>
              <div class="mb-3 hstack gap-2 justify-content-left">
                <a href="sub-kriteria" class="btn btn-success">Kembali</a>
                <button type="submit" name="add_sub_kriteria" class="btn btn-primary">Tambah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->

</div>

<?php require_once("../../templates/views_bottom.php") ?>