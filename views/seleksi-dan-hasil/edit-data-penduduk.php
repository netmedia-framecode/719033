<?php require_once("../../controller/metode-saw.php");
if (!isset($_GET["p"])) {
  header("Location: menu");
  exit();
} else {
  $id = valid($conn, $_GET["p"]);
  $pull_data = "SELECT * FROM alternatif WHERE id = '$id'";
  $store_data = mysqli_query($conn, $pull_data);
  $view_data = mysqli_fetch_assoc($store_data);
  $_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Ubah Data Penduduk";
  require_once("../../templates/views_top.php"); ?>
  <div class="nxl-content" style="height: 100vh;">

    <!-- [ page-header ] start -->
    <div class="page-header">
      <div class="page-header-left d-flex align-items-center">
        <div class="page-header-title">
          <h5 class="m-b-10"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></h5>
        </div>
        <ul class="breadcrumb">
          <li class="breadcrumb-item">Data Penduduk</li>
          <li class="breadcrumb-item"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] . ' ' . $view_data["nama_lengkap"]  ?></li>
        </ul>
      </div>
    </div>
    <!-- [ page-header ] end -->

    <!-- [ Main Content ] start -->
    <div class="main-content">
      <div class="row">
        <div class="col-lg-8">
          <div class="card stretch stretch-full">
            <div class="card-body">
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $view_data['id'] ?>">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="nik" class="form-label">NIK (Nomor Induk Kependudukan)</label>
                    <input type="number" name="nik" value="<?= $view_data['nik'] ?>" class="form-control" id="nik" placeholder="16 digit NIK" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="no_kk" class="form-label">Nomor Kartu Keluarga (KK)</label>
                    <input type="number" name="no_kk" value="<?= $view_data['no_kk'] ?>" class="form-control" id="no_kk" placeholder="16 digit No. KK" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="<?= $view_data['nama_lengkap'] ?>" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                      <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                      <option value="L" <?= $view_data['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                      <option value="P" <?= $view_data['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" value="<?= $view_data['tgl_lahir'] ?>" class="form-control" id="tgl_lahir" required>
                    <div class="form-text text-primary">*Umur akan dihitung otomatis oleh sistem.</div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="status_keluarga" class="form-label">Status dalam Keluarga</label>
                    <select name="status_keluarga" id="status_keluarga" class="form-select" required>
                      <option value="" disabled selected>-- Pilih Status --</option>
                      <option value="Kepala Keluarga" <?= $view_data['status_keluarga'] == 'Kepala Keluarga' ? 'selected' : '' ?>>Kepala Keluarga</option>
                      <option value="Istri" <?= $view_data['status_keluarga'] == 'Istri' ? 'selected' : '' ?>>Istri</option>
                      <option value="Anak" <?= $view_data['status_keluarga'] == 'Anak' ? 'selected' : '' ?>>Anak</option>
                      <option value="Lainnya" <?= $view_data['status_keluarga'] == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                    <input type="text" name="pekerjaan" value="<?= $view_data['pekerjaan'] ?>" class="form-control" id="pekerjaan" placeholder="Pekerjaan" required>
                  </div>
                </div>
                <div class="mt-4 hstack gap-2">
                  <a href="data-penduduk" class="btn btn-secondary">Kembali</a>
                  <button type="submit" name="edit_alternatif" class="btn btn-warning">
                    <i class="feather-save me-2"></i> Ubah
                  </button>
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