<?php require_once("../../controller/master-data.php");
$_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Periode";
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
    <div class="page-header-right ms-auto">
      <div class="page-header-right-items">
        <div class="d-flex d-md-none">
          <a href="javascript:void(0)" class="page-header-right-close-toggle">
            <i class="feather-arrow-left me-2"></i>
            <span>Back</span>
          </a>
        </div>
        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
          <a href="add-periode" class="btn btn-primary">
            <i class="feather-plus me-2"></i>
            <span>Tambah</span>
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
    <div class="row">
      <div class="col-lg-12">
        <div class="card stretch stretch-full">
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover" id="dataTable">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Periode</th>
                    <th class="text-center">Tanggal Mulai</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($views_periode as $key => $data) { ?>
                    <tr class="single-item">
                      <td class="text-center"><?= $key + 1 ?></td>
                      <td><?= $data['nama_periode'] ?></td>
                      <td class="text-center"><?= date("d M Y", strtotime($data['tanggal_mulai'])) ?></td>
                      <td class="text-center">
                        <?php if ($data['status'] == 'Aktif') { ?>
                          <span class="badge bg-success">Aktif</span>
                        <?php } else if ($data['status'] == 'Selesai') { ?>
                          <span class="badge bg-secondary">Selesai</span>
                        <?php } else { ?>
                          <span class="badge bg-secondary">Pending</span>
                        <?php } ?>
                      </td>
                      <td><?= $data['keterangan'] ?></td>
                      <td>
                        <div class="hstack gap-2 justify-content-center">
                          <a href="edit-periode?p=<?= $data['id'] ?>" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                          </a>
                          <form action="" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <input type="hidden" name="nama_periode" value="<?= $data['nama_periode'] ?>">
                            <button type="submit" name="delete_periode" class="btn btn-danger btn-sm">
                              <i class="bi bi-trash"></i>
                            </button>
                          </form>
                        </div>
                      </td>
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
  <!-- [ Main Content ] end -->

</div>

<?php require_once("../../templates/views_bottom.php") ?>