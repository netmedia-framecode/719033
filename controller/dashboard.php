<?php

require_once("../config/Base.php");
require_once("../config/Auth.php");
require_once("../config/Alert.php");

$q_alt = mysqli_query($conn, "SELECT COUNT(*) as total FROM alternatif");
$total_penduduk = mysqli_fetch_assoc($q_alt)['total'];

// Total Kriteria
$q_krit = mysqli_query($conn, "SELECT COUNT(*) as total FROM kriteria");
$total_kriteria = mysqli_fetch_assoc($q_krit)['total'];

// 2. PERIODE AKTIF TERAKHIR
$q_periode = mysqli_query($conn, "SELECT * FROM periode ORDER BY id DESC LIMIT 1");
if (mysqli_num_rows($q_periode) > 0) {
  $d_periode = mysqli_fetch_assoc($q_periode);
  $id_periode_aktif = $d_periode['id'];
  $nama_periode_aktif = $d_periode['nama_periode'];
} else {
  $id_periode_aktif = 0;
  $nama_periode_aktif = "Belum Ada Periode";
}

// 3. STATISTIK PENILAIAN & HASIL
// Jumlah yang sudah dinilai (masuk hasil akhir) pada periode ini
$q_hasil = mysqli_query($conn, "SELECT COUNT(*) as total FROM hasil_akhir WHERE id_periode = '$id_periode_aktif'");
$total_seleksi = mysqli_fetch_assoc($q_hasil)['total'];

// Persentase Progress (Total Seleksi / Total Penduduk * 100)
$progress_persen = ($total_penduduk > 0) ? round(($total_seleksi / $total_penduduk) * 100) : 0;

// 4. TOP 5 REKOMENDASI PENERIMA (Juara)
$top_candidates = [];
if ($id_periode_aktif > 0) {
  $q_top = mysqli_query($conn, "SELECT h.*, a.nama_lengkap, a.nik, a.pekerjaan 
                                  FROM hasil_akhir h 
                                  JOIN alternatif a ON h.id_alternatif = a.id 
                                  WHERE h.id_periode = '$id_periode_aktif' 
                                  ORDER BY h.skor DESC LIMIT 5");
  while ($row = mysqli_fetch_assoc($q_top)) {
    $top_candidates[] = $row;
  }
}

// 5. PENDUDUK TERBARU (5 Data Terakhir)
$new_residents = [];
$q_new = mysqli_query($conn, "SELECT * FROM alternatif ORDER BY id DESC LIMIT 5");
while ($row = mysqli_fetch_assoc($q_new)) {
  $new_residents[] = $row;
}
