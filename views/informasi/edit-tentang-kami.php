<?php require_once("../../controller/informasi.php");
if (!isset($_GET["p"])) {
  header("Location: tentang-kami");
  exit();
} else {
  $id = valid($conn, $_GET["p"]);
  $pull_data = "SELECT * FROM tentang WHERE id = '$id'";
  $store_data = mysqli_query($conn, $pull_data);
  $view_data = mysqli_fetch_assoc($store_data);
  $_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Ubah Tentang Kami";
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
          <li class="breadcrumb-item"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] . ' ' . $view_data["judul"]  ?></li>
        </ul>
      </div>
    </div>
    <!-- [ page-header ] end -->

    <!-- [ Main Content ] start -->
    <div class="main-content">
      <div class="row">
        <div class="col-lg-6">
          <div class="card stretch stretch-full">
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $view_data['id'] ?>">
                <input type="hidden" name="gambar_lama" value="<?= $view_data['gambar'] ?>">
                <div class="mb-3">
                  <label for="gambar" class="form-label">Gambar</label>
                  <input type="file" name="gambar" class="form-control" id="gambar" placeholder="Gambar" accept=".jpg, .jpeg, .png">
                </div>
                <div class="mb-3">
                  <label for="judul" class="form-label">Judul</label>
                  <input type="text" name="judul" value="<?= $view_data['judul'] ?>" class="form-control" id="judul" placeholder="Judul" required>
                </div>
                <div class="mb-3">
                  <label for="deskripsi" class="form-label">Deskripsi</label>
                  <textarea name="deskripsi" class="form-control" id="deskripsi"><?= $view_data['deskripsi'] ?></textarea>
                </div>
                <div class="mb-3 hstack gap-2 justify-content-left">
                  <a href="tentang-kami" class="btn btn-success">Kembali</a>
                  <button type="submit" name="edit_tentang" class="btn btn-warning">Ubah</button>
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