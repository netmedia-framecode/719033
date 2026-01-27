<?php require_once("controller/visitor.php");
$_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Beranda";
require_once("sections/head.php");
require_once("sections/navbar.php");
?>

<section id="beranda" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-white">
  <div class="absolute inset-0 hero-pattern opacity-[0.05] -z-10"></div>
  <div class="max-w-7xl mx-auto px-4 text-center">
    <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 mb-20 leading-tight">
      Penyaluran Bantuan Langsung Tunai <br>
      <span class="text-blue-600">Transparan & Tepat Sasaran</span>
    </h1>
    <a href="#cek-penerima" class="bg-primary text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-secondary transition shadow-lg shadow-blue-500/30">
      Cek Status Penerima
    </a>
  </div>
</section>

<section id="cek-penerima" class="py-20 bg-blue-600 text-white relative overflow-hidden">
  <div class="max-w-4xl mx-auto px-4 relative z-10 text-center">
    <h2 class="text-3xl font-bold mb-4">Cek Status Penerimaan BLT</h2>
    <p class="mb-8 text-blue-100">Masukkan Nomor Induk Kependudukan (NIK) Anda.</p>

    <form action="#cek-penerima" method="GET" class="flex flex-col md:flex-row gap-4 justify-center">
      <input type="text" name="nik" value="<?= $nik_cari ?>" placeholder="16 Digit NIK" class="w-full md:w-96 px-6 py-4 rounded-full text-gray-900 font-semibold focus:outline-none" required minlength="16" maxlength="16">
      <button type="submit" name="cek_nik" class="bg-gray-900 hover:bg-gray-800 text-white px-8 py-4 rounded-full font-bold transition flex items-center justify-center gap-2">
        <i data-feather="search"></i> Cari
      </button>
    </form>

    <?php if ($hasil_pencarian): ?>
      <div class="mt-10 bg-white text-gray-800 rounded-2xl p-8 shadow-2xl text-left max-w-2xl mx-auto border-l-8 border-green-500">
        <div class="flex items-center gap-4 mb-4">
          <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600"><i data-feather="check"></i></div>
          <div>
            <h3 class="text-xl font-bold text-green-700">Selamat! Terdaftar Penerima.</h3>
            <p class="text-sm text-gray-500">Periode: <?= $nama_periode ?></p>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-4 text-sm mt-4">
          <div><span class="block text-gray-400">Nama</span><span class="font-bold text-lg"><?= $hasil_pencarian['nama_lengkap'] ?></span></div>
          <div><span class="block text-gray-400">NIK</span><span class="font-bold text-lg"><?= $hasil_pencarian['nik'] ?></span></div>
          <div><span class="block text-gray-400">Rank</span><span class="font-bold text-lg">#<?= $hasil_pencarian['peringkat'] ?></span></div>
          <div><span class="block text-gray-400">Skor</span><span class="font-bold text-lg"><?= number_format($hasil_pencarian['skor'], 4) ?></span></div>
        </div>
      </div>
    <?php elseif (isset($_GET['cek_nik'])): ?>
      <div class="mt-10 bg-white text-gray-800 rounded-2xl p-6 shadow-xl max-w-xl mx-auto border-l-8 border-red-500">
        <h3 class="font-bold text-red-600 flex items-center gap-2"><i data-feather="alert-circle"></i> Tidak Ditemukan</h3>
        <p class="mt-2 text-gray-600"><?= $pesan_error ?></p>
      </div>
    <?php endif; ?>
  </div>
</section>

<section id="kriteria" class="py-20 bg-white">
  <div class="max-w-5xl mx-auto px-4">
    <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Kriteria Penilaian</h2>
    <div class="overflow-x-auto shadow-lg rounded-xl border border-gray-100">
      <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 text-gray-600 uppercase text-sm">
          <tr>
            <th class="py-4 px-6">Prioritas</th>
            <th class="py-4 px-6">Nama Kriteria</th>
            <th class="py-4 px-6 text-center">Sifat</th>
            <th class="py-4 px-6 text-center">Bobot</th>
          </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
          <?php
          if (mysqli_num_rows($q_kriteria) > 0) {
            $rank = 1;
            while ($row = mysqli_fetch_assoc($q_kriteria)) {
              $badge = ($row['jenis'] == 'benefit') ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
              echo "<tr class='border-b hover:bg-gray-50'>
                                <td class='py-4 px-6 text-center font-bold'>#$rank</td>
                                <td class='py-4 px-6'>$row[nama_kriteria]</td>
                                <td class='py-4 px-6 text-center'><span class='$badge py-1 px-3 rounded-full text-xs font-bold'>$row[jenis]</span></td>
                                <td class='py-4 px-6 text-center font-mono text-primary'>" . number_format($row['bobot_roc'], 4) . "</td>
                            </tr>";
              $rank++;
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<section id="prosedur" class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 text-center">
    <h2 class="text-3xl font-bold text-gray-900 mb-16">Prosedur Seleksi</h2>
    <div class="grid md:grid-cols-4 gap-6">
      <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-blue-500">
        <div class="font-bold text-5xl text-gray-100 mb-2">01</div>
        <h4 class="font-bold text-lg">Pendataan</h4>
      </div>
      <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-blue-500">
        <div class="font-bold text-5xl text-gray-100 mb-2">02</div>
        <h4 class="font-bold text-lg">Pembobotan Kriteria</h4>
      </div>
      <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-blue-500">
        <div class="font-bold text-5xl text-gray-100 mb-2">03</div>
        <h4 class="font-bold text-lg">Seleksi Calon Penerima BLT</h4>
      </div>
      <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-green-500 transform scale-105">
        <div class="font-bold text-5xl text-gray-100 mb-2">04</div>
        <h4 class="font-bold text-lg text-green-600">Pengumuman</h4>
      </div>
    </div>
  </div>
</section>

<section id="kontak" class="py-20 bg-white">
  <div class="max-w-4xl mx-auto px-4 text-center">
    <h2 class="text-3xl font-bold text-gray-900 mb-8">Pusat Informasi</h2>
    <div class="grid md:grid-cols-3 gap-8">
      <div class="p-6 bg-gray-50 rounded-2xl border"><i data-feather="map-pin" class="mx-auto text-primary mb-2"></i>
        <h4 class="font-bold">Alamat</h4>
        <p class="text-sm text-gray-500">Kupang, NTT</p>
      </div>
      <div class="p-6 bg-gray-50 rounded-2xl border"><i data-feather="phone" class="mx-auto text-primary mb-2"></i>
        <h4 class="font-bold">Telepon</h4>
        <p class="text-sm text-gray-500">0812-xxxx-xxxx</p>
      </div>
      <div class="p-6 bg-gray-50 rounded-2xl border"><i data-feather="mail" class="mx-auto text-primary mb-2"></i>
        <h4 class="font-bold">Email</h4>
        <p class="text-sm text-gray-500">info@blt.go.id</p>
      </div>
    </div>
  </div>
</section>

<?php require_once("sections/footer.php"); ?>