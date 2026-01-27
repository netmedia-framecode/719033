<?php
// Panggil Controller
require_once("../../controller/metode-saw.php");

// 1. AMBIL PERIODE AKTIF
if (isset($_GET['periode'])) {
  $id_periode = $_GET['periode'];
} else {
  $q_last = mysqli_query($conn, "SELECT id FROM periode ORDER BY id DESC LIMIT 1");
  $id_periode = (mysqli_num_rows($q_last) > 0) ? mysqli_fetch_assoc($q_last)['id'] : 1;
}

// Ambil Nama Periode
$q_nama_per = mysqli_query($conn, "SELECT nama_periode FROM periode WHERE id = '$id_periode'");
$nama_periode = mysqli_fetch_assoc($q_nama_per)['nama_periode'];

// 2. AMBIL DATA RANKING
$data_ranking = [];
$q_hasil = mysqli_query($conn, "SELECT h.*, a.nama_lengkap, a.nik, a.no_kk, a.pekerjaan 
                                FROM hasil_akhir h 
                                JOIN alternatif a ON h.id_alternatif = a.id 
                                WHERE h.id_periode = '$id_periode' 
                                ORDER BY h.peringkat ASC");

if (mysqli_num_rows($q_hasil) > 0) {
  while ($row = mysqli_fetch_assoc($q_hasil)) {
    $data_ranking[] = $row;
  }
} else {
  $data_ranking = hitung_ranking_saw($conn, $id_periode);
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Cetak Hasil Seleksi BLT - Desa Golo Kantar</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

  <style>
    /* RESET */
    * {
      box-sizing: border-box;
    }

    body {
      font-family: "Times New Roman", Times, serif;
      font-size: 12pt;
      line-height: 1.3;
      /* Sedikit dirapatkan agar muat banyak */
      background-color: #eee;
      /* Warna latar belakang layar (bukan kertas) */
    }

    /* TAMPILAN KERTAS DI LAYAR (PREVIEW) */
    .page {
      width: 210mm;
      min-height: 297mm;
      padding: 2cm;
      /* Margin 2cm rata semua sisi */
      margin: 10mm auto;
      background: white;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    /* PENGATURAN SAAT PRINT (PENTING AGAR HALAMAN BARU KONSISTEN) */
    @media print {
      body {
        background: white;
        font-size: 12pt;
      }

      .page {
        margin: 0;
        padding: 0;
        /* Padding di-nol-kan karena margin diatur oleh @page */
        border: none;
        box-shadow: none;
        width: 100%;
        min-height: auto;
      }

      /* INI KUNCINYA: Memaksa margin fisik printer 2cm di SETIAP halaman */
      @page {
        size: A4;
        margin: 2cm;
      }

      .no-print {
        display: none !important;
      }

      /* Paksa background header tabel tercetak */
      th {
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }
    }

    /* --- KOP SURAT --- */
    .header {
      display: flex;
      align-items: center;
      justify-content: center;
      border-bottom: 3px double #000;
      padding-bottom: 10px;
      margin-bottom: 20px;
      text-align: center;
    }

    .logo {
      width: 80px;
      height: auto;
      margin-right: 15px;
    }

    /* Logo sedikit diperkecil agar header tidak terlalu tinggi */
    .header-text h3 {
      margin: 0;
      font-size: 14pt;
      text-transform: uppercase;
      font-weight: normal;
      letter-spacing: 1px;
    }

    .header-text h2 {
      margin: 5px 0;
      font-size: 16pt;
      font-weight: bold;
      letter-spacing: 1px;
    }

    .header-text p {
      margin: 0;
      font-size: 11pt;
      font-style: italic;
    }

    /* --- ISI DOKUMEN --- */
    .title-doc {
      text-align: center;
      margin-bottom: 20px;
    }

    .title-doc h4 {
      text-decoration: underline;
      margin: 0;
      font-size: 14pt;
      font-weight: bold;
      text-transform: uppercase;
    }

    .title-doc span {
      font-size: 12pt;
      display: block;
      margin-top: 5px;
    }

    p {
      text-align: justify;
      margin-bottom: 15px;
    }

    /* --- TABEL --- */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table,
    th,
    td {
      border: 1px solid #000;
    }

    th {
      background-color: #e0e0e0 !important;
      padding: 10px 5px;
      font-weight: bold;
      font-size: 11pt;
    }

    td {
      padding: 6px 5px;
      vertical-align: middle;
      font-size: 11pt;
    }

    /* Agar baris tabel tidak terpotong (baris utuh pindah ke halaman baru) */
    tr {
      page-break-inside: avoid;
    }

    .text-center {
      text-align: center;
    }

    .font-bold {
      font-weight: bold;
    }

    /* --- TANDA TANGAN --- */
    .signature-section {
      display: flex;
      justify-content: flex-end;
      margin-top: 30px;

      /* Pastikan tanda tangan tidak terpotong */
      page-break-inside: avoid;
      break-inside: avoid;
    }

    .signature-box {
      width: 280px;
      text-align: center;
    }

    .signature-box .jabatan {
      font-weight: bold;
      margin-bottom: 80px;
      text-transform: uppercase;
    }

    .signature-box .nama {
      font-weight: bold;
      text-decoration: underline;
      text-transform: uppercase;
    }

    /* TOMBOL CETAK */
    .btn-print {
      position: fixed;
      top: 20px;
      right: 20px;
      background: #2563eb;
      color: #fff;
      padding: 12px 24px;
      border-radius: 8px;
      text-decoration: none;
      font-family: sans-serif;
      font-weight: bold;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      border: none;
      z-index: 9999;
    }

    .btn-print:hover {
      background: #1d4ed8;
    }
  </style>
</head>

<body>

  <button onclick="window.print()" class="btn-print no-print">🖨️ Cetak / Simpan PDF</button>

  <div class="page">

    <div class="header">
      <img src="../../assets/img/logo-desa.png" alt="Logo" class="logo">
      <div class="header-text">
        <h3>PEMERINTAH KABUPATEN MANGGARAI TIMUR</h3>
        <h3>KECAMATAN KOTA KOMBA</h3>
        <h2>DESA GOLO KANTAR</h2>
        <p>Alamat: Jl. Raya Golo Kantar, Kec. Kota Komba, Kab. Manggarai Timur, Flores - NTT</p>
      </div>
    </div>

    <div class="title-doc">
      <h4>BERITA ACARA HASIL SELEKSI PENERIMA BLT</h4>
      <span>Nomor: 400 / DGK / <?= date('m') ?> / <?= date('Y') ?></span>
    </div>

    <p>
      Berdasarkan hasil verifikasi data dan perhitungan menggunakan metode <em>Simple Additive Weighting (SAW)</em>
      pada Sistem Pendukung Keputusan, berikut adalah daftar nama warga Desa Golo Kantar yang direkomendasikan
      sebagai penerima Bantuan Langsung Tunai (BLT) untuk periode <strong><?= $nama_periode ?></strong>:
    </p>

    <table>
      <thead>
        <tr>
          <th width="30">No</th>
          <th width="80">Peringkat</th>
          <th>NIK</th>
          <th>Nama Penduduk</th>
          <th>Pekerjaan</th>
          <th width="70">Skor</th>
          <th width="100">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (!empty($data_ranking)) {
          $no = 1;
          foreach ($data_ranking as $row) {
            $skor = isset($row['skor']) ? $row['skor'] : $row['nilai_akhir'];
            $status = ($skor >= 0.5) ? "LAYAK" : "DIPERTIMBANGKAN";
        ?>
            <tr>
              <td class="text-center"><?= $no++ ?></td>
              <td class="text-center">#<?= isset($row['peringkat']) ? $row['peringkat'] : $no - 1 ?></td>
              <td class="text-center"><?= $row['nik'] ?></td>
              <td style="padding-left: 8px;"><?= strtoupper($row['nama_lengkap']) ?></td>
              <td class="text-center"><?= $row['pekerjaan'] ?></td>
              <td class="text-center"><?= number_format($skor, 4) ?></td>
              <td class="text-center font-bold">
                <?= $status ?>
              </td>
            </tr>
        <?php
          }
        } else {
          echo '<tr><td colspan="7" class="text-center" style="padding:20px;">Data hasil seleksi belum tersedia.</td></tr>';
        }
        ?>
      </tbody>
    </table>

    <p>Demikian berita acara ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>

    <div class="signature-section">
      <div class="signature-box">
        <div class="place-date">
          Golo Kantar, <?= date('d F Y') ?>
        </div>
        <div class="jabatan">
          KEPALA DESA GOLO KANTAR
        </div>
        <br><br>
        <div class="nama">
          NAMA KEPALA DESA
        </div>
      </div>
    </div>

  </div>

</body>

</html>