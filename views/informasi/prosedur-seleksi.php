<?php require_once("../../controller/informasi.php");
$_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Prosedur Seleksi";
require_once("../../templates/views_top.php"); ?>

<div class="nxl-content">

  <!-- [ page-header ] start -->
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Prosedur Seleksi</li>
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
      <div class="col-lg-12"> <?php
                              // 1. Cek & Fetch Data
                              if (isset($views_prosedur_seleksi) && mysqli_num_rows($views_prosedur_seleksi) > 0) {
                                $data = mysqli_fetch_assoc($views_prosedur_seleksi);
                              ?>

          <div class="card stretch stretch-full">
            <div class="card-body">

              <div class="d-flex justify-content-between align-items-center mb-4">
                <span class="badge bg-primary">Prosedur Seleksi</span>
                <div class="action-btn d-flex gap-2">
                  <a href="edit-prosedur-seleksi?p=<?= $data['id'] ?>" class="btn btn-warning btn-sm">
                    <i class="feather-edit me-1"></i> Ubah
                  </a>
                  <form action="" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <input type="hidden" name="gambar_lama" value="<?= $data['gambar'] ?>">
                    <button type="submit" name="delete_prosedur_seleksi" class="btn btn-danger btn-sm">
                      <i class="feather-trash-2 me-1"></i> Hapus
                    </button>
                  </form>
                </div>
              </div>

              <div class="content-text mb-5">
                <h2 class="text-left text-dark fw-bold mb-3"><?= $data['judul'] ?></h2>
                <div class="text-muted" style="line-height: 1.8; font-size: 16px;">
                  <?= nl2br($data['deskripsi']) ?>
                </div>
              </div>

              <div class="row g-4">
                <div class="col-md-6">
                  <h5 class="fw-bold mb-3 d-flex align-items-center text-muted">
                    <i class="feather-image me-2"></i> Ilustrasi Gambar
                  </h5>
                  <?php if (!empty($data['gambar'])) : ?>
                    <img src="<?= $baseURL ?>assets/img/<?= $data['gambar'] ?>"
                      alt="<?= $data['judul'] ?>"
                      class="img-fluid rounded shadow-sm w-100"
                      style="object-fit: cover; min-height: 250px;"> <?php else : ?>
                    <div class="alert alert-warning">Tidak ada gambar yang diunggah.</div>
                  <?php endif; ?>
                </div>

                <div class="col-md-6">
                  <h5 class="fw-bold mb-3 d-flex align-items-center text-danger">
                    <i class="feather-youtube me-2"></i> Video Panduan
                  </h5>

                  <?php if (!empty($data['link_video'])) : ?>
                    <div class="video-section p-3 bg-light rounded border h-100"> <?php
                                                                                  $url = $data['link_video'];
                                                                                  $youtubeID = '';
                                                                                  $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
                                                                                  if (preg_match($pattern, $url, $match)) {
                                                                                    $youtubeID = $match[1];
                                                                                  }
                                                                                  ?>

                      <?php if ($youtubeID) : ?>
                        <div class="ratio ratio-16x9 shadow-sm rounded">
                          <iframe src="https://www.youtube.com/embed/<?= $youtubeID ?>"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                          </iframe>
                        </div>
                      <?php else : ?>
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                          <i class="feather-info me-2"></i>
                          <div>Link video tersedia untuk ditonton secara eksternal.</div>
                        </div>
                        <div class="d-grid">
                          <a href="<?= $url ?>" target="_blank" class="btn btn-danger">
                            <i class="feather-play-circle me-2"></i> Tonton Video di Tab Baru
                          </a>
                        </div>
                      <?php endif; ?>

                    </div>
                  <?php else : ?>
                    <div class="alert alert-secondary d-flex align-items-center h-75 justify-content-center text-muted" role="alert">
                      <div><i class="feather-video-off me-2"></i> Video panduan belum tersedia.</div>
                    </div>
                  <?php endif; ?>
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
              <h4 class="text-muted">Belum ada informasi "Prosedur Seleksi"</h4>
              <a href="add-prosedur-seleksi" class="btn btn-primary mt-3">
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