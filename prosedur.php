<?php
require_once("controller/visitor.php");
$_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Prosedur Seleksi";
require_once("sections/head.php");
require_once("sections/navbar.php");
?>

<header class="pt-32 pb-12 bg-white border-b border-gray-200">
  <div class="max-w-4xl mx-auto px-4 text-center">
    <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">Prosedur & Alur Seleksi</h1>
    <p class="text-lg text-gray-500">
      Tahapan lengkap mulai dari pendaftaran hingga penetapan penerima bantuan.
    </p>
  </div>
</header>

<main class="flex-grow bg-gray-50">

  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <?php if (mysqli_num_rows($q_prosedur) > 0) : ?>

        <div class="space-y-12">
          <?php
          $no = 1;
          while ($row = mysqli_fetch_assoc($q_prosedur)) :
            $is_even = ($no % 2 == 0);
            $order_class = $is_even ? 'md:order-2' : '';
            $text_align  = $is_even ? 'md:text-right' : 'md:text-left';
            $flex_dir    = $is_even ? 'md:flex-row-reverse' : 'md:flex-row';
          ?>

            <div class="relative flex flex-col <?= $flex_dir ?> items-center gap-8 md:gap-16 group">

              <?php if ($no < mysqli_num_rows($q_prosedur)) : ?>
                <div class="hidden md:block absolute top-full left-1/2 w-0.5 h-12 bg-gray-200 -ml-0.5 -mt-6 z-0"></div>
              <?php endif; ?>

              <div class="w-full md:w-1/2 relative z-10">
                <div class="bg-white p-2 rounded-2xl shadow-lg border border-gray-100 transform transition duration-500 hover:scale-[1.02]">
                  <?php if (!empty($row['gambar']) && file_exists("assets/img/" . $row['gambar'])) : ?>
                    <img src="assets/img/<?= $row['gambar'] ?>"
                      alt="<?= $row['judul'] ?>"
                      class="rounded-xl w-full h-64 object-cover">
                  <?php else : ?>
                    <div class="h-64 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl flex flex-col items-center justify-center text-primary">
                      <span class="text-6xl font-bold opacity-20"><?= str_pad($no, 2, '0', STR_PAD_LEFT) ?></span>
                      <i data-feather="clipboard" class="w-12 h-12 mt-2 opacity-50"></i>
                    </div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="w-full md:w-1/2 <?= $text_align ?>">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary text-white font-bold text-lg mb-4 shadow-lg shadow-blue-500/30">
                  <?= $no ?>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 group-hover:text-primary transition">
                  <?= $row['judul'] ?>
                </h2>
                <div class="prose prose-blue text-gray-600 leading-relaxed">
                  <?= nl2br($row['deskripsi']) ?>
                </div>
              </div>

            </div>
          <?php $no++;
          endwhile; ?>
        </div>

      <?php else : ?>
        <div class="text-center py-20">
          <div class="bg-white p-8 rounded-2xl shadow-sm inline-block">
            <i data-feather="inbox" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
            <h3 class="text-xl font-bold text-gray-900">Belum Ada Data</h3>
            <p class="text-gray-500">Data prosedur belum diinput oleh admin.</p>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </section>

  <section class="py-16 bg-white border-t border-gray-100">
    <div class="max-w-4xl mx-auto px-4 text-center">
      <h2 class="text-2xl font-bold text-gray-900 mb-4">Sudah paham alurnya?</h2>
      <p class="text-gray-500 mb-8">Silakan cek apakah data diri Anda sudah terdaftar dalam sistem penerimaan rekomendasi.</p>
      <a href="index.php#cek-penerima" class="inline-flex items-center gap-2 bg-primary text-white px-8 py-3 rounded-full font-bold hover:bg-secondary transition shadow-lg">
        <i data-feather="search"></i> Cek Penerima
      </a>
    </div>
  </section>

</main>

<?php require_once("sections/footer.php"); ?>