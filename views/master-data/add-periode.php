<?php require_once("../../controller/master-data.php");
$_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Tambah Periode";
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
          <fo class="card-body">
            <form action="" method="post">
              <div class="mb-3">
                <label for="nama_periode" class="form-label">Periode</label>
                <input type="text" name="nama_periode" class="form-control" id="nama_periode" required>
              </div>
              <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tgl Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" id="tanggal_mulai" required>
              </div>
              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                  <option value="" selected disabled>-- Pilih Status --</option>
                  <option value="Aktif">Aktif</option>
                  <option value="Pending">Pending</option>
                  <option value="Selesai">Selesai</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
              </div>
              <div class="mb-3 hstack gap-2 justify-content-left">
                <a href="periode" class="btn btn-success">Kembali</a>
                <button type="submit" name="add_periode" class="btn btn-primary">Tambah</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->

</div>

<?php require_once("../../templates/views_bottom.php") ?>