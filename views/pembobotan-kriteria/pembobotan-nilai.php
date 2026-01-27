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
        <li class="breadcrumb-item">Penilaian Bobot</li>
        <li class="breadcrumb-item"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></li>
      </ul>
    </div>
  </div>
  <div class="main-content">
    <div class="row">

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
    </div>
  </div>
</div>

<?php require_once("../../templates/views_bottom.php") ?>