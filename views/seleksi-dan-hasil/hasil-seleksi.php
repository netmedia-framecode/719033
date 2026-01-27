<?php require_once("../../controller/metode-saw.php");
$_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Hasil Seleksi";
require_once("../../templates/views_top.php");
?>

<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<div class="nxl-content" style="height: 100vh;">

  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10">Hasil Perangkingan</h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Seleksi dan Hasil</li>
        <li class="breadcrumb-item active">Hasil Seleksi</li>
      </ul>
    </div>

    <div class="page-header-right ms-auto">
      <form action="" method="GET" class="d-flex align-items-center gap-2">
        <label class="fw-bold text-muted mb-0">Periode:</label>
        <select name="periode" class="form-select form-select-sm fw-bold border-primary text-primary"
          onchange="this.form.submit()" style="width: 150px;">
          <?php
          $q_periode = mysqli_query($conn, "SELECT * FROM periode ORDER BY id DESC");
          while ($per = mysqli_fetch_assoc($q_periode)) {
            $selected = ($per['id'] == $id_periode_aktif) ? 'selected' : '';
            echo "<option value='$per[id]' $selected>$per[nama_periode]</option>";
          }
          ?>
        </select>
      </form>
    </div>
  </div>
  <div class="main-content">
    <div class="row">

      <?php if (!empty($data_ranking)) : $juara = $data_ranking[0]; ?>
        <div class="col-lg-12 mb-4">
          <div class="card bg-primary text-white stretch stretch-full border-0 shadow-sm">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <p class="mb-1 opacity-75">Rekomendasi Penerima Terbaik</p>
                  <h3 class="text-white mb-0 fw-bold"><?= $juara['nama'] ?></h3>
                  <p class="mb-0 mt-1 fs-12">NIK: <?= $juara['nik'] ?></p>
                </div>
                <div class="text-end">
                  <h1 class="text-white mb-0"><?= number_format($juara['nilai_akhir'], 4) ?></h1>
                  <span class="badge bg-warning text-dark"><i class="feather-award me-1"></i> Peringkat 1</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="col-lg-12">
        <div class="card stretch stretch-full shadow-sm border-0">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title fw-bold">Tabel Peringkat Akhir</h5>

            <div class="d-flex gap-2">

              <!-- <button type="button" class="btn btn-sm btn-info text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#modalPenjelasan">
                <i class="feather-help-circle me-2"></i> Info Metode
              </button> -->

              <form action="" method="POST">
                <button type="submit" name="simpan_permanen" class="btn btn-sm btn-success shadow-sm">
                  <i class="feather-save me-2"></i> Simpan Hasil
                </button>
              </form>

              <a href="cetak-hasil.php?periode=<?= $id_periode_aktif ?>" target="_blank" class="btn btn-sm btn-secondary shadow-sm">
                <i class="feather-printer me-2"></i> Cetak
              </a>
            </div>
          </div>

          <div class="card-body">
            <?php
            $cek_db = mysqli_query($conn, "SELECT COUNT(*) as total FROM hasil_akhir WHERE id_periode = '$id_periode_aktif'");
            $status_db = mysqli_fetch_assoc($cek_db);
            if ($status_db['total'] > 0) {
              echo '<div class="alert alert-soft-success py-2 px-3 mb-3 fs-12 border-success border-opacity-25"><i class="feather-check-circle me-2"></i> Data periode ini sudah tersimpan di database.</div>';
            } else {
              echo '<div class="alert alert-soft-warning py-2 px-3 mb-3 fs-12 border-warning border-opacity-25"><i class="feather-alert-triangle me-2"></i> Data ini masih hasil perhitungan sementara. Klik "Simpan Hasil" untuk menyimpan permanen.</div>';
            }
            ?>

            <div class="table-responsive">
              <table class="table table-hover table-striped align-middle">
                <thead class="bg-light text-uppercase fs-11 fw-bold text-muted">
                  <tr>
                    <th width="80" class="text-center">Rank</th>
                    <th>NIK</th>
                    <th>Nama Penduduk</th>
                    <th class="text-center">Nilai Preferensi</th>
                    <th class="text-center">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if (!empty($data_ranking)) {
                    $rank = 1;
                    foreach ($data_ranking as $row) {
                      $badge_rank = ($rank == 1) ? "bg-warning text-dark" : "bg-light text-muted border";
                      if ($rank == 2) $badge_rank = "bg-secondary text-white";
                      if ($rank == 3) $badge_rank = "bg-white border-warning text-warning border";
                      $is_layak = ($row['nilai_akhir'] >= 0.5);
                      $status_badge = $is_layak ? '<span class="badge bg-soft-success text-success">Layak</span>' : '<span class="badge bg-soft-danger text-danger">Tidak Layak</span>';
                  ?>
                      <tr class="<?= ($rank == 1) ? 'fw-bold' : '' ?>">
                        <td class="text-center">
                          <span class="badge rounded-pill <?= $badge_rank ?>" style="min-width: 30px;">#<?= $rank ?></span>
                        </td>
                        <td><?= $row['nik'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td class="text-center fs-16 text-primary font-monospace"><?= number_format($row['nilai_akhir'], 4) ?></td>
                        <td class="text-center"><?= $status_badge ?></td>
                      </tr>
                    <?php $rank++;
                    }
                  } else { ?>
                    <tr>
                      <td colspan="5" class="text-center py-5">Belum ada hasil perhitungan.</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPenjelasan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title text-white"><i class="feather-book-open me-2"></i> Alur Logika Metode SAW</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-light">

        <div class="alert alert-white border shadow-sm mb-4">
          <p class="mb-0 text-muted">
            <strong>Simple Additive Weighting (SAW)</strong> sering disebut metode "Penjumlahan Terbobot".
            Konsep dasarnya adalah mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif (penduduk) pada semua atribut (kriteria).
          </p>
        </div>

        <div class="card mb-3 border-0 shadow-sm">
          <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
            <h6 class="fw-bold text-primary"><span class="badge bg-primary me-2">Langkah 1</span> Penentuan Bobot (W)</h6>
          </div>
          <div class="card-body pt-2">
            <p class="fs-13 text-muted">
              Sistem menggunakan metode <strong>ROC (Rank Order Centroid)</strong> untuk menentukan bobot.
              Artinya, kriteria yang Anda beri <strong>Ranking 1</strong> akan otomatis mendapatkan persentase bobot terbesar, dan ranking terakhir mendapatkan bobot terkecil.
            </p>
            <div class="d-flex align-items-center gap-2 fs-12 text-muted bg-light p-2 rounded border">
              <i class="feather-info text-info"></i>
              <span>Contoh: Jika "Penghasilan" adalah Ranking 1, maka ia akan sangat mempengaruhi hasil akhir seleksi.</span>
            </div>
          </div>
        </div>

        <div class="card mb-3 border-0 shadow-sm">
          <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
            <h6 class="fw-bold text-primary"><span class="badge bg-primary me-2">Langkah 2</span> Normalisasi Matriks (R)</h6>
          </div>
          <div class="card-body pt-2">
            <p class="fs-13 text-muted">
              Nilai asli (Rupiah, Umur, Jumlah Tanggungan) diubah menjadi skala <strong>0 sampai 1</strong> agar bisa dibandingkan. Rumusnya berbeda tergantung sifat kriteria:
            </p>

            <div class="row g-3">
              <div class="col-md-6">
                <div class="p-3 border rounded bg-soft-success h-100">
                  <div class="d-flex align-items-center mb-2">
                    <i class="feather-trending-up text-success me-2"></i>
                    <strong class="text-success">Atribut Benefit (Keuntungan)</strong>
                  </div>
                  <p class="fs-11 text-muted mb-2">
                    Digunakan jika <strong>nilai semakin besar semakin bagus</strong>.
                    <br><em>Contoh: Jumlah Tanggungan, Usia Lansia.</em>
                  </p>
                  <div class="bg-white p-2 rounded text-center border">
                    $$R_{ij} = \frac{\text{Nilai Peserta}}{\text{Nilai Tertinggi}}$$
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="p-3 border rounded bg-soft-danger h-100">
                  <div class="d-flex align-items-center mb-2">
                    <i class="feather-trending-down text-danger me-2"></i>
                    <strong class="text-danger">Atribut Cost (Biaya)</strong>
                  </div>
                  <p class="fs-11 text-muted mb-2">
                    Digunakan jika <strong>nilai semakin kecil semakin bagus</strong>.
                    <br><em>Contoh: Penghasilan (Makin kecil makin layak dibantu).</em>
                  </p>
                  <div class="bg-white p-2 rounded text-center border">
                    $$R_{ij} = \frac{\text{Nilai Terendah}}{\text{Nilai Peserta}}$$
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card mb-3 border-0 shadow-sm">
          <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
            <h6 class="fw-bold text-primary"><span class="badge bg-primary me-2">Langkah 3</span> Perangkingan (Nilai V)</h6>
          </div>
          <div class="card-body pt-2">
            <p class="fs-13 text-muted">
              Nilai Akhir (V) didapatkan dengan mengalikan <strong>Bobot (W)</strong> dengan <strong>Nilai Normalisasi (R)</strong>, lalu dijumlahkan untuk semua kriteria.
            </p>

            <div class="alert alert-primary text-center py-3 mb-2">
              <h4 class="mb-0 text-primary">$$V_i = \sum (W_j \times R_{ij})$$</h4>
            </div>

            <div class="d-flex align-items-center gap-3 mt-3">
              <div class="text-center">
                <h2 class="mb-0 text-success fw-bold">V &#8593;</h2>
                <small class="text-muted fw-bold">Nilai Tinggi</small>
              </div>
              <div class="flex-grow-1 border-top border-2 border-dashed text-center text-muted fs-11 pt-1">
                Semakin besar nilai V, semakin tinggi prioritas penerima bantuan
              </div>
              <div class="text-center">
                <h2 class="mb-0 text-warning fw-bold">#1</h2>
                <small class="text-muted fw-bold">Juara</small>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer bg-white">
        <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Tutup Penjelasan</button>
      </div>
    </div>
  </div>
</div>

<?php require_once("../../templates/views_bottom.php") ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.modal').appendTo("body");
  });
</script>