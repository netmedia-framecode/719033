<?php
// Pastikan path controller benar sesuai struktur folder Anda
require_once("../controller/dashboard.php");
$_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Dashboard";
require_once("../templates/views_top.php");
?>

<div class="nxl-content">

  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10">Dashboard</h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Dashboard</li>
      </ul>
    </div>
    <div class="page-header-right ms-auto">
      <div class="d-flex align-items-center gap-2">
        <span class="badge bg-soft-primary text-primary fs-12 fw-bold px-3 py-2">
          <i class="feather-calendar me-2"></i> Periode Aktif: <?= $nama_periode_aktif ?>
        </span>
      </div>
    </div>
  </div>
  <div class="main-content">
    <div class="row">

      <div class="col-xxl-3 col-md-6">
        <div class="card stretch stretch-full">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
              <div class="d-flex gap-4 align-items-center">
                <div class="avatar-text avatar-lg bg-soft-primary text-primary">
                  <i class="feather-users"></i>
                </div>
                <div>
                  <div class="fs-4 fw-bold text-dark"><span class="counter"><?= $total_penduduk ?></span></div>
                  <h3 class="fs-13 fw-semibold text-muted">Total Penduduk</h3>
                </div>
              </div>
            </div>
            <div class="pt-2">
              <span class="fs-12 text-muted">Data calon penerima terdaftar</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xxl-3 col-md-6">
        <div class="card stretch stretch-full">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
              <div class="d-flex gap-4 align-items-center">
                <div class="avatar-text avatar-lg bg-soft-warning text-warning">
                  <i class="feather-list"></i>
                </div>
                <div>
                  <div class="fs-4 fw-bold text-dark"><span class="counter"><?= $total_kriteria ?></span></div>
                  <h3 class="fs-13 fw-semibold text-muted">Kriteria Penilaian</h3>
                </div>
              </div>
            </div>
            <div class="pt-2">
              <span class="fs-12 text-muted">Parameter seleksi aktif (ROC)</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xxl-3 col-md-6">
        <div class="card stretch stretch-full">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
              <div class="d-flex gap-4 align-items-center">
                <div class="avatar-text avatar-lg bg-soft-success text-success">
                  <i class="feather-check-circle"></i>
                </div>
                <div>
                  <div class="fs-4 fw-bold text-dark">
                    <span class="counter"><?= $total_seleksi ?></span> / <?= $total_penduduk ?>
                  </div>
                  <h3 class="fs-13 fw-semibold text-muted">Sudah Diseleksi</h3>
                </div>
              </div>
            </div>
            <div class="pt-2">
              <div class="d-flex align-items-center justify-content-between">
                <span class="fs-12 text-muted">Progress Periode Ini</span>
                <span class="fs-11 fw-bold text-success"><?= $progress_persen ?>%</span>
              </div>
              <div class="progress mt-2 ht-3">
                <div class="progress-bar bg-success" role="progressbar" style="width: <?= $progress_persen ?>%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xxl-3 col-md-6">
        <div class="card stretch stretch-full">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
              <div class="d-flex gap-4 align-items-center">
                <div class="avatar-text avatar-lg bg-soft-danger text-danger">
                  <i class="feather-calendar"></i>
                </div>
                <div>
                  <div class="fs-4 fw-bold text-dark">Aktif</div>
                  <h3 class="fs-13 fw-semibold text-muted">Periode Seleksi</h3>
                </div>
              </div>
            </div>
            <div class="pt-2">
              <span class="fs-12 fw-bold text-dark"><?= $nama_periode_aktif ?></span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xxl-8">
        <div class="card stretch stretch-full">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Top 5 Rekomendasi Penerima BLT</h5>
            <a href="metode-saw/hasil-seleksi" class="btn btn-sm btn-light-brand">Lihat Semua</a>
          </div>
          <div class="card-body custom-card-action p-0">
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead class="bg-light">
                  <tr>
                    <th class="text-center" width="50">Rank</th>
                    <th>Nama Lengkap</th>
                    <th>NIK</th>
                    <th>Pekerjaan</th>
                    <th class="text-end">Nilai Akhir (V)</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($top_candidates)) : ?>
                    <?php foreach ($top_candidates as $row) :
                      // Badge Rank
                      $badge = "bg-light text-muted";
                      if ($row['peringkat'] == 1) $badge = "bg-warning text-dark";
                      if ($row['peringkat'] == 2) $badge = "bg-secondary text-white";
                      if ($row['peringkat'] == 3) $badge = "bg-light border border-warning text-warning";
                    ?>
                      <tr>
                        <td class="text-center">
                          <span class="badge rounded-pill <?= $badge ?>"><?= $row['peringkat'] ?></span>
                        </td>
                        <td>
                          <div class="d-flex align-items-center gap-3">
                            <div class="avatar-text avatar-sm bg-soft-primary text-primary rounded-circle">
                              <?= substr($row['nama_lengkap'], 0, 1) ?>
                            </div>
                            <span class="fw-bold text-dark"><?= $row['nama_lengkap'] ?></span>
                          </div>
                        </td>
                        <td><?= $row['nik'] ?></td>
                        <td><?= $row['pekerjaan'] ?></td>
                        <td class="text-end fw-bold text-primary">
                          <?= number_format($row['skor'], 4) ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <tr>
                      <td colspan="5" class="text-center py-5 text-muted">
                        Belum ada hasil seleksi untuk periode ini.
                      </td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xxl-4">
        <div class="card stretch stretch-full">
          <div class="card-header">
            <h5 class="card-title">Penduduk Baru Ditambahkan</h5>
            <a href="metode-saw/data-alternatif" class="btn btn-sm btn-light-brand">Kelola</a>
          </div>
          <div class="card-body">
            <?php if (!empty($new_residents)) : ?>
              <?php foreach ($new_residents as $res) : ?>
                <div class="d-flex align-items-center justify-content-between mb-4">
                  <div class="d-flex align-items-center gap-3">
                    <div class="avatar-text bg-gray-200 rounded">
                      <i class="feather-user"></i>
                    </div>
                    <div>
                      <a href="javascript:void(0);" class="fw-bold text-dark d-block"><?= $res['nama_lengkap'] ?></a>
                      <span class="fs-12 text-muted">NIK: <?= $res['nik'] ?></span>
                    </div>
                  </div>
                  <div class="text-end">
                    <span class="badge bg-soft-secondary text-secondary"><?= $res['pekerjaan'] ?></span>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="text-center text-muted py-4">Belum ada data penduduk.</div>
            <?php endif; ?>

            <hr class="border-dashed my-3" />

            <div class="alert alert-soft-info mb-0">
              <div class="d-flex align-items-center gap-2">
                <i class="feather-info fs-4"></i>
                <div>
                  <h6 class="mb-0 fs-13 fw-bold">Info Sistem</h6>
                  <p class="mb-0 fs-11">Sistem menggunakan metode SAW dengan pembobotan ROC.</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once("../templates/views_bottom.php") ?>