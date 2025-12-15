<?php require_once("../../controller/metode-saw.php");
$_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Tambah Data Alternatif";
require_once("../../templates/views_top.php");
?>

<div class="nxl-content" style="height: 100vh;">
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Metode SAW</li>
        <li class="breadcrumb-item"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></li>
      </ul>
    </div>
  </div>
  <div class="main-content">
    <div class="row">
      <div class="col-lg-8">
        <div class="card stretch stretch-full">
          <div class="card-body">
            <form action="" method="post">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="nik" class="form-label">NIK (Nomor Induk Kependudukan)</label>
                  <input type="number" name="nik" class="form-control" id="nik" placeholder="16 digit NIK" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="no_kk" class="form-label">Nomor Kartu Keluarga (KK)</label>
                  <input type="number" name="no_kk" class="form-control" id="no_kk" placeholder="16 digit No. KK" required>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Sesuai KTP" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                  <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" required>
                  <div class="form-text text-primary">*Umur akan dihitung otomatis oleh sistem.</div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="status_keluarga" class="form-label">Status dalam Keluarga</label>
                  <select name="status_keluarga" id="status_keluarga" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Status --</option>
                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                    <option value="Istri">Istri</option>
                    <option value="Anak">Anak</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="pekerjaan" class="form-label">Pekerjaan</label>
                  <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" placeholder="Contoh: Buruh Tani, Nelayan" required>
                </div>
              </div>
              <div class="mt-4 hstack gap-2">
                <a href="data-alternatif" class="btn btn-secondary">Kembali</a>
                <button type="submit" name="add_alternatif" class="btn btn-primary">
                  <i class="feather-save me-2"></i> Tambah
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once("../../templates/views_bottom.php") ?>