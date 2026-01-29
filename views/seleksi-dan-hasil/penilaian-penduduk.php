<?php require_once("../../controller/metode-saw.php");
$_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Penilaian Penduduk";
require_once("../../templates/views_top.php");
?>

<style>
  .table-hover tbody tr:hover {
    background-color: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .05);
    transition: all 0.3s ease;
  }

  .progress {
    height: 1.5rem;
    font-size: 0.85rem;
    font-weight: bold;
    border-radius: 1rem;
    background-color: #e9ecef;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
  }

  .progress-bar {
    border-radius: 1rem;
    transition: width 0.6s ease;
  }

  .user-avatar {
    width: 40px;
    height: 40px;
    background-color: #e2e6ea;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1.2rem;
  }
</style>

<div class="nxl-content">

  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10">Daftar Penilaian Penduduk</h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">Seleksi dan Hasil</li>
        <li class="breadcrumb-item active">Penilaian Penduduk</li>
      </ul>
    </div>
  </div>

  <div class="main-content mb-3">
    <div class="row">
      <div class="col-lg-12">

        <div class="card stretch stretch-full border-0 shadow-sm">
          <div class="card-body p-4">
            <div class="table-responsive">
              <table class="table table-hover align-middle text-nowrap">
                <thead class="bg-light text-uppercase fs-11 fw-bold text-muted">
                  <tr>
                    <th width="50" class="text-center ps-4">No</th>
                    <th>Identitas Penduduk</th>
                    <th width="35%">Progres</th>
                    <?php if ($id_role == 4) { ?>
                      <th width="150" class="text-center pe-4">Aksi</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody class="border-top-0">
                  <?php
                  $q_total_krit = mysqli_query($conn, "SELECT COUNT(*) as total FROM kriteria");
                  $d_total_krit = mysqli_fetch_assoc($q_total_krit);
                  $total_kriteria = $d_total_krit['total'];
                  $query_alt = mysqli_query($conn, "SELECT * FROM alternatif ORDER BY id ASC");
                  if (mysqli_num_rows($query_alt) > 0) {
                    $no = 1;
                    $kode_alternatif = 'A' . str_pad(1, 2, '0', STR_PAD_LEFT);
                    while ($alt = mysqli_fetch_assoc($query_alt)) :
                      $q_filled = mysqli_query($conn, "SELECT COUNT(*) as total FROM skor_alternatif WHERE id_alternatif = '$alt[id]'");
                      $d_filled = mysqli_fetch_assoc($q_filled);
                      $filled_count = $d_filled['total'];
                      $percentage = ($total_kriteria > 0) ? round(($filled_count / $total_kriteria) * 100) : 0;
                      if ($percentage == 100) {
                        $btn_class = "btn-success";
                        $btn_icon = "feather-check-square";
                        $btn_label = "Lihat / Ubah";
                        $progress_bg = "bg-success";
                        $status_text = "Lengkap";
                      } elseif ($percentage > 0) {
                        $btn_class = "btn-warning text-dark";
                        $btn_icon = "feather-edit-2";
                        $btn_label = "Lanjutkan";
                        $progress_bg = "bg-warning";
                        $status_text = "Proses";
                      } else {
                        $btn_class = "btn-primary";
                        $btn_icon = "feather-play";
                        $btn_label = "Mulai Nilai";
                        $progress_bg = "bg-secondary";
                        $status_text = "Belum Mulai";
                      }
                  ?>
                      <tr>
                        <td class="text-center ps-4 fw-bold text-muted"><?= $no++ ?></td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="user-avatar me-3">
                              <i class="feather-user"></i>
                            </div>
                            <div>
                              <h6 class="fw-bold mb-0 text-dark"><?= $kode_alternatif++ ?> - <?= $alt['nama_lengkap'] ?></h6>
                              <small class="text-muted fs-11">NIK: <?= $alt['nik'] ?></small>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="fs-11 fw-bold text-muted"><?= $status_text ?></span>
                            <span class="fs-11 fw-bold text-muted"><?= $percentage ?>%</span>
                          </div>
                          <div class="progress shadow-sm" style="height: 10px;">
                            <div class="progress-bar <?= $progress_bg ?>" role="progressbar" style="width: <?= $percentage ?>%;"></div>
                          </div>
                        </td>
                        <?php if ($id_role == 4) { ?>
                          <td class="text-center pe-4">
                            <button type="button" class="btn btn-sm <?= $btn_class ?> w-100 fw-bold shadow-sm"
                              data-bs-toggle="modal"
                              data-bs-target="#modalNilai<?= $alt['id'] ?>">
                              <i class="<?= $btn_icon ?> me-2"></i> <?= $btn_label ?>
                            </button>
                          </td>
                        <?php } ?>
                      </tr>
                  <?php
                    endwhile;
                  } else {
                    echo '<tr><td colspan="4" class="text-center py-5">Belum ada data penduduk.</td></tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
if (mysqli_num_rows($query_alt) > 0) {
  mysqli_data_seek($query_alt, 0);
  $kode_alternatif_form = 'A' . str_pad(1, 2, '0', STR_PAD_LEFT);
  while ($alt = mysqli_fetch_assoc($query_alt)) :
?>
    <div class="modal fade" id="modalNilai<?= $alt['id'] ?>" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title text-white">
              <i class="feather-clipboard me-2"></i> Form Penilaian
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="POST">
            <input type="hidden" name="id_alternatif" value="<?= $alt['id'] ?>">
            <input type="hidden" name="id_periode" value="<?= $id_periode ?>">
            <div class="modal-body bg-light">
              <div class="d-flex align-items-center mb-4 p-3 bg-white rounded shadow-sm border">
                <div class="user-avatar me-3 bg-primary text-white">
                  <i class="feather-user"></i>
                </div>
                <div>
                  <h5 class="fw-bold mb-0"><?= $kode_alternatif_form++ ?> - <?= $alt['nama_lengkap'] ?></h5>
                  <small class="text-muted">NIK: <?= $alt['nik'] ?></small>
                </div>
              </div>
              <div class="row g-3">
                <?php
                $q_kriteria = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY prioritas ASC, kode_kriteria ASC");
                while ($krit = mysqli_fetch_assoc($q_kriteria)) {
                  $q_existing = mysqli_query($conn, "SELECT id_sub_kriteria FROM skor_alternatif 
                                                                WHERE id_alternatif = '$alt[id]' 
                                                                AND id_sub_kriteria IN (SELECT id FROM sub_kriteria WHERE id_kriteria = '$krit[id]')");
                  $existing = mysqli_fetch_assoc($q_existing);
                  $selected_id = isset($existing['id_sub_kriteria']) ? $existing['id_sub_kriteria'] : '';
                ?>
                  <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100">
                      <div class="card-body p-3">
                        <label class="form-label fw-bold text-dark mb-2 d-block">
                          <span class="badge bg-soft-primary text-primary me-1"><?= $krit['kode_kriteria'] ?></span>
                          <?= $krit['nama_kriteria'] ?>
                        </label>

                        <select name="nilai[<?= $krit['id'] ?>]" class="form-select shadow-sm border" required>
                          <option value="">-- Pilih Kondisi --</option>
                          <?php
                          $q_sub = mysqli_query($conn, "SELECT * FROM sub_kriteria WHERE id_kriteria = '$krit[id]' ORDER BY bobot DESC");
                          while ($sub = mysqli_fetch_assoc($q_sub)) {
                            $is_selected = ($sub['id'] == $selected_id) ? 'selected' : '';
                            echo "<option value='$sub[id]' $is_selected>$sub[nama_sub_kriteria]</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
            <div class="modal-footer bg-white py-3">
              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" name="simpan_nilai" class="btn btn-primary fw-bold px-4">
                <i class="feather-save me-2"></i> Simpan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php
  endwhile;
}
?>

<?php require_once("../../templates/views_bottom.php") ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.modal').appendTo("body");
  });
</script>