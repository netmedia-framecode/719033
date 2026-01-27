<?php
require_once("controller/visitor.php");
$_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Tentang";
require_once("sections/head.php");
require_once("sections/navbar.php");
?>

<header class="pt-32 pb-12 bg-white border-b border-gray-200">
  <div class="max-w-4xl mx-auto px-4 text-center">
    <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">Tentang Penelitian</h1>
    <p class="text-lg text-gray-500">
      Sistem pendukung keputusan penerimaan BLT</span>.
    </p>
  </div>
</header>

<main class="flex-grow">

  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid md:grid-cols-2 gap-12 items-center">

        <div>
          <?php if (!empty($tentang['gambar']) && file_exists("assets/img/" . $tentang['gambar'])) : ?>
            <img src="assets/img/<?= $tentang['gambar'] ?>"
              alt="<?= $tentang['judul'] ?>"
              class="rounded-2xl shadow-2xl border border-gray-100 object-cover w-full h-auto max-h-[500px]">
          <?php else : ?>
            <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
              alt="Default Image"
              class="rounded-2xl shadow-2xl border border-gray-100">
          <?php endif; ?>
        </div>

        <div>
          <h2 class="text-2xl font-bold text-gray-900 mb-4"><?= $tentang['judul'] ?></h2>

          <div class="text-gray-600 leading-relaxed mb-6 text-justify">
            <?= nl2br($tentang['deskripsi']) ?>
          </div>

          <div class="flex gap-4 mt-6">
            <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 w-1/2">
              <h4 class="font-bold text-primary mb-1">Objektif</h4>
              <p class="text-xs text-gray-500">Keputusan berbasis data riil.</p>
            </div>
            <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 w-1/2">
              <h4 class="font-bold text-primary mb-1">Transparan</h4>
              <p class="text-xs text-gray-500">Hasil dapat dipertanggungjawabkan.</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</main>

<?php require_once("sections/footer.php"); ?>