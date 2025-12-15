<?php require_once("../../controller/informasi.php");
$_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Tentang Kami";
require_once("../../templates/views_top.php"); ?>

<div class="nxl-content" style="height: 100vh;">

  <!-- [ page-header ] start -->
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Tentang Kami</li>
        <li class="breadcrumb-item"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></li>
      </ul>
    </div>
    <div class="page-header-right ms-auto">
      <div class="page-header-right-items">
        <div class="d-flex d-md-none">
          <a href="javascript:void(0)" class="page-header-right-close-toggle">
            <i class="feather-arrow-left me-2"></i>
            <span>Back</span>
          </a>
        </div>
      </div>
      <div class="d-md-none d-flex align-items-center">
        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
  </div>
  <!-- [ page-header ] end -->

  <!-- [ Main Content ] start -->
  <div class="main-content">
    <div class="row justify-content-center">
      <div class="col-lg-10">

        <?php
        // 1. Cek & Fetch Data
        if (isset($views_tentang) && mysqli_num_rows($views_tentang) > 0) {
          $data = mysqli_fetch_assoc($views_tentang);
        ?>

          <div class="card stretch stretch-full">
            <div class="card-body">

              <div class="d-flex justify-content-between align-items-center mb-4">
                <span class="badge bg-primary">Profil Website</span>
                <div class="action-btn d-flex gap-2">
                  <a href="edit-tentang-kami?p=<?= $data['id'] ?>" class="btn btn-warning btn-sm">
                    <i class="feather-edit me-1"></i> Ubah
                  </a>

                  <form action="" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <input type="hidden" name="gambar_lama" value="<?= $data['gambar'] ?>">
                    <button type="submit" name="delete_tentang" class="btn btn-danger btn-sm">
                      <i class="feather-trash-2 me-1"></i> Hapus
                    </button>
                  </form>
                </div>
              </div>

              <div class="text-center mb-4">
                <?php if (!empty($data['gambar'])) : ?>
                  <img src="<?= $baseURL ?>assets/img/<?= $data['gambar'] ?>"
                    alt="<?= $data['judul'] ?>"
                    class="img-fluid rounded shadow-sm"
                    style="max-height: 400px; width: auto; object-fit: cover;">
                <?php else : ?>
                  <div class="alert alert-warning">Tidak ada gambar yang diunggah.</div>
                <?php endif; ?>
              </div>

              <div class="content-text">
                <h2 class="text-left text-dark fw-bold mb-4"><?= $data['judul'] ?></h2>
                <div class="text-muted" style="line-height: 1.8; font-size: 16px;">
                  <?= nl2br($data['deskripsi']) ?>
                </div>
              </div>

            </div>
          </div>

        <?php
        } else {
          // TAMPILAN JIKA DATA KOSONG
        ?>

          <div class="card">
            <div class="card-body text-center py-5">
              <div class="mb-4">
                <i class="feather-layout fs-1 text-muted opacity-50"></i>
              </div>
              <h4 class="text-muted">Belum ada informasi "Tentang Kami"</h4>
              <a href="add-tentang-kami" class="btn btn-primary mt-3">
                <i class="feather-plus me-2"></i> Tambah Data Sekarang
              </a>
            </div>
          </div>

        <?php } ?>

      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->

</div>

<?php require_once("../../templates/views_bottom.php") ?>