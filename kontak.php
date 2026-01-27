<?php
require_once("controller/visitor.php");
$_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Hubungi Kami";

require_once("sections/head.php");
require_once("sections/navbar.php");
?>

<header class="pt-32 pb-12 bg-white border-b border-gray-200">
  <div class="max-w-4xl mx-auto px-4 text-center">
    <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">Hubungi Kami</h1>
    <p class="text-lg text-gray-500">
      Punya pertanyaan seputar seleksi BLT? Silakan hubungi kami melalui saluran di bawah ini.
    </p>
  </div>
</header>

<main class="flex-grow bg-gray-50">
  <section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <div class="grid lg:grid-cols-2 gap-12">

        <div class="space-y-8">

          <div class="grid sm:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center text-center hover:border-blue-300 transition">
              <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-primary mb-4">
                <i data-feather="map-pin"></i>
              </div>
              <h4 class="font-bold text-gray-900 mb-2">Alamat Kantor</h4>
              <p class="text-sm text-gray-500">
                Jl. Eltari No. 1, Oebobo<br>
                Kota Kupang, NTT
              </p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center text-center hover:border-green-300 transition">
              <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-4">
                <i data-feather="phone"></i>
              </div>
              <h4 class="font-bold text-gray-900 mb-2">Telepon / WA</h4>
              <p class="text-sm text-gray-500">
                +62 812-3456-7890<br>
                (Respon Cepat)
              </p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center text-center hover:border-yellow-300 transition">
              <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-600 mb-4">
                <i data-feather="mail"></i>
              </div>
              <h4 class="font-bold text-gray-900 mb-2">Email Resmi</h4>
              <p class="text-sm text-gray-500">
                info@blt-kupang.go.id<br>
                pengaduan@blt-kupang.go.id
              </p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center text-center hover:border-purple-300 transition">
              <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mb-4">
                <i data-feather="clock"></i>
              </div>
              <h4 class="font-bold text-gray-900 mb-2">Jam Layanan</h4>
              <p class="text-sm text-gray-500">
                Senin - Jumat<br>
                08:00 - 16:00 WITA
              </p>
            </div>
          </div>

          <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126305.80554586326!2d123.50720420757754!3d-10.176465384157125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c569c766b2b694d%3A0xc3c945147570415d!2sKota%20Kupang%2C%20Nusa%20Tenggara%20Tim.%2C%20Indonesia!5e0!3m2!1sid!2sid!4v1679000000000!5m2!1sid!2sid"
              width="100%" height="300" style="border:0; border-radius: 12px;"
              allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>

        </div>

        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8 lg:p-10">
          <h3 class="text-2xl font-bold text-gray-900 mb-2">Kirim Pesan / Pengaduan</h3>
          <p class="text-gray-500 mb-8 text-sm">Pesan Anda akan tersimpan di sistem dan dibaca oleh admin.</p>

          <form action="" method="POST" class="space-y-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i data-feather="user" class="h-5 w-5 text-gray-400"></i>
                </div>
                <input type="text" name="nama" required class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition" placeholder="Nama Anda">
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i data-feather="at-sign" class="h-5 w-5 text-gray-400"></i>
                </div>
                <input type="email" name="email" required class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition" placeholder="email@contoh.com">
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Subjek Pesan</label>
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <i data-feather="tag" class="h-5 w-5 text-gray-400"></i>
                </div>
                <input type="text" name="subjek" required class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition" placeholder="Topik pesan...">
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Isi Pesan</label>
              <textarea name="pesan" rows="4" required class="w-full p-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 focus:border-primary transition" placeholder="Tuliskan pertanyaan atau pengaduan Anda di sini..."></textarea>
            </div>

            <button type="submit" name="kirim_pesan" class="w-full bg-gray-900 text-white font-bold py-4 rounded-xl hover:bg-primary transition shadow-lg shadow-gray-900/20 flex items-center justify-center gap-2">
              <i data-feather="send"></i> Kirim Pesan Sekarang
            </button>
          </form>
        </div>

      </div>
    </div>
  </section>
</main>

<?php require_once("sections/footer.php"); ?>