<?php
require_once("../../controller/metode-roc.php");
$_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Pembobotan Nilai";
require_once("../../templates/views_top.php");
?>

<div class="nxl-content">

  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Metode ROC</li>
        <li class="breadcrumb-item"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></li>
      </ul>
    </div>
  </div>
  <div class="main-content">
    <div class="row">

      <div class="col-lg-12">
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
          <div class="d-flex align-items-center">
            <i class="feather-info fs-3 me-3"></i>
            <div>
              <h6 class="alert-heading fw-bold mb-1">Panduan Metode ROC (Rank Order Centroid)</h6>
              <p class="mb-0 fs-12">
                Metode ROC menghitung bobot berdasarkan urutan prioritas. Kriteria ranking 1 akan mendapat bobot terbesar, dan ranking terakhir mendapat bobot terkecil.
              </p>
            </div>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>

      <div class="col-lg-12 mb-4">
        <div class="card stretch stretch-full">
          <div class="card-header">
            <h5 class="card-title">Tabel Prioritas Kriteria</h5>
          </div>

          <div class="card-body">
            <form action="" method="POST">
              <div class="table-responsive">
                <table class="table table-hover table-bordered">
                  <thead class="bg-light">
                    <tr>
                      <th class="text-center" width="50">No</th>
                      <th width="100">Kode</th>
                      <th>Nama Kriteria</th>
                      <th>Jenis Atribut</th>
                      <th width="150" class="text-center">Input Prioritas</th>
                      <th width="200" class="text-center bg-light">Hasil Bobot (ROC)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (isset($views_kriteria) && mysqli_num_rows($views_kriteria) > 0) {
                      $no = 1;
                      while ($row = mysqli_fetch_assoc($views_kriteria)) {
                        $badge_class = ($row['jenis'] == 'Benefit') ? 'bg-success' : 'bg-danger';
                        $val_prioritas = isset($row['prioritas']) ? $row['prioritas'] : '';
                        $val_bobot = isset($row['bobot_roc']) ? number_format($row['bobot_roc'], 4) : '-';
                    ?>
                        <tr>
                          <td class="text-center align-middle"><?= $no++ ?></td>
                          <td class="align-middle fw-bold"><?= $row['kode_kriteria'] ?></td>
                          <td class="align-middle"><?= $row['nama_kriteria'] ?></td>
                          <td class="align-middle"><span class="badge <?= $badge_class ?>"><?= $row['jenis'] ?></span></td>
                          <td class="text-center">
                            <input type="number" name="prioritas[<?= $row['id'] ?>]" class="form-control text-center fw-bold border-primary" value="<?= $val_prioritas ?>" min="1" required placeholder="Rank">
                          </td>
                          <td class="text-center align-middle bg-light fw-bold text-dark"><?= $val_bobot ?></td>
                        </tr>
                      <?php }
                    } else { ?>
                      <tr>
                        <td colspan="6" class="text-center text-muted py-4">Data kriteria belum tersedia.</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="d-flex justify-content-end mt-4 gap-2">
                <button type="reset" class="btn btn-secondary"><i class="feather-refresh-cw me-2"></i> Reset</button>
                <button type="submit" name="hitung_roc" class="btn btn-primary"><i class="feather-check-circle me-2"></i> Simpan & Hitung Bobot</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="card">
          <div class="card-header bg-soft-primary">
            <h5 class="card-title fw-bold text-primary"><i class="feather-book-open me-2"></i> Penjelasan Perhitungan Manual ROC</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 border-end">
                <h6 class="fw-bold mb-3">Rumus Dasar</h6>
                <div class="alert alert-light border text-center p-4 mb-3">
                  <h3 class="mb-0" style="font-family: 'Times New Roman', serif;">
                    W<sub>j</sub> =
                    <span style="font-size: 0.8em;">1/k</span>
                    &sum;<span style="display:inline-block; font-size: 0.6em; position:relative; top:-5px;">k</span><span style="display:inline-block; font-size: 0.6em; position:relative; bottom:-5px; margin-left:-8px;">i=j</span>
                    <span style="font-size: 0.8em;">(1/i)</span>
                  </h3>
                  <div class="mt-3 text-start small">
                    <strong>Keterangan:</strong><br>
                    <ul>
                      <li><strong>W<sub>j</sub></strong> : Bobot kriteria ke-j</li>
                      <li><strong>k</strong> : Jumlah total kriteria</li>
                      <li><strong>j</strong> : Urutan prioritas kriteria yang dihitung</li>
                      <li><strong>i</strong> : Variabel pengulang (looping)</li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-md-6 ps-md-4">
                <h6 class="fw-bold mb-3">Contoh Simulasi (Misal Total k = 3)</h6>
                <div class="table-responsive">
                  <table class="table table-sm table-bordered">
                    <thead class="table-light">
                      <tr>
                        <th>Rank (j)</th>
                        <th>Penjabaran Rumus</th>
                        <th>Hasil (W<sub>j</sub>)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center fw-bold">1</td>
                        <td>1/3 &times; (1/1 + 1/2 + 1/3)</td>
                        <td class="fw-bold text-primary">0.6111</td>
                      </tr>
                      <tr>
                        <td class="text-center fw-bold">2</td>
                        <td>1/3 &times; (0 + 1/2 + 1/3)</td>
                        <td class="fw-bold text-primary">0.2778</td>
                      </tr>
                      <tr>
                        <td class="text-center fw-bold">3</td>
                        <td>1/3 &times; (0 + 0 + 1/3)</td>
                        <td class="fw-bold text-primary">0.1111</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once("../../templates/views_bottom.php") ?>