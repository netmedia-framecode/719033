<?php

require_once("config/Base.php");
require_once("config/Alert.php");

$hasil_pencarian = null;
$nik_cari = "";
$pesan_error = "";

if (isset($_GET['cek_nik'])) {
  $nik_cari = htmlspecialchars($_GET['nik']);
  $q_periode = mysqli_query($conn, "SELECT id, nama_periode FROM periode ORDER BY id DESC LIMIT 1");
  if (mysqli_num_rows($q_periode) > 0) {
    $d_periode = mysqli_fetch_assoc($q_periode);
    $id_periode_aktif = $d_periode['id'];
    $nama_periode = $d_periode['nama_periode'];

    $query = "SELECT h.*, a.nama_lengkap, a.nik, a.pekerjaan 
                  FROM hasil_akhir h 
                  JOIN alternatif a ON h.id_alternatif = a.id 
                  WHERE a.nik = '$nik_cari' AND h.id_periode = '$id_periode_aktif'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      $hasil_pencarian = mysqli_fetch_assoc($result);
    } else {
      $cek_alt = mysqli_query($conn, "SELECT * FROM alternatif WHERE nik = '$nik_cari'");
      if (mysqli_num_rows($cek_alt) > 0) {
        $pesan_error = "Data ditemukan, namun Anda BELUM/TIDAK termasuk dalam rekomendasi periode ini.";
      } else {
        $pesan_error = "Maaf, NIK tidak ditemukan dalam database.";
      }
    }
  } else {
    $pesan_error = "Belum ada periode seleksi aktif.";
  }
}
$q_kriteria = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY prioritas ASC");

$q_tentang = mysqli_query($conn, "SELECT * FROM tentang ORDER BY id DESC LIMIT 1");
$tentang = mysqli_fetch_assoc($q_tentang);
if (!$tentang) {
  $tentang = [
    'judul' => 'Latar Belakang',
    'deskripsi' => 'Data tentang kami belum diisi oleh admin via dashboard.',
    'gambar' => ''
  ];
}

$q_prosedur = mysqli_query($conn, "SELECT * FROM prosedur_seleksi ORDER BY id ASC");

$q_kontak = mysqli_query($conn, "SELECT * FROM kontak ORDER BY id DESC LIMIT 1");
$kontak = mysqli_fetch_assoc($q_kontak);

if (isset($_POST['kirim_pesan'])) {
  $nama = htmlspecialchars($_POST['nama']);
  $email = htmlspecialchars($_POST['email']);
  $subjek = htmlspecialchars($_POST['subjek']);
  $pesan = htmlspecialchars($_POST['pesan']);
  $sql_simpan = "INSERT INTO kontak (nama, email, subjek, pesan) 
                   VALUES ('$nama', '$email', '$subjek', '$pesan')";
  if (mysqli_query($conn, $sql_simpan)) {
    echo "<script>
                alert('Terima kasih! Pesan Anda telah terkirim dan akan kami tinjau.'); 
                window.location.href='kontak';
              </script>";
  } else {
    echo "<script>
                alert('Maaf, Gagal mengirim pesan. Error: " . mysqli_error($conn) . "');
              </script>";
  }
}
