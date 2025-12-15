-- Active: 1734576880718@@127.0.0.1@3306@sistem_penerimaan_blt
CREATE TABLE utilities(
  id INT AUTO_INCREMENT PRIMARY KEY,
  logo VARCHAR(50),
  name_web VARCHAR(75),
  keyword TEXT,
  description TEXT,
  author VARCHAR(50)
);

CREATE TABLE auth(
  id INT AUTO_INCREMENT PRIMARY KEY,
  image VARCHAR(50),
  bg VARCHAR(35),
  model INT DEFAULT 2
);

CREATE TABLE user_role(
  id_role INT AUTO_INCREMENT PRIMARY KEY,
  role VARCHAR(35)
);

INSERT INTO
  user_role(role)
VALUES
  ('Administrator'),
  ('Owner'),
  ('Member');

CREATE TABLE user_status(
  id_status INT AUTO_INCREMENT PRIMARY KEY,
  status VARCHAR(35)
);

INSERT INTO
  user_status(status)
VALUES
  ('Active'),
  ('No Active');

CREATE TABLE users(
  id_user INT AUTO_INCREMENT PRIMARY KEY,
  id_role INT,
  id_active INT,
  en_user VARCHAR(75),
  token CHAR(6),
  name VARCHAR(100),
  image VARCHAR(100),
  email VARCHAR(75),
  password VARCHAR(100),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_role) REFERENCES user_role(id_role) ON UPDATE NO ACTION ON DELETE NO ACTION,
  FOREIGN KEY (id_active) REFERENCES user_status(id_active) ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE user_menu(
  id_menu INT AUTO_INCREMENT PRIMARY KEY,
  icon VARCHAR(50),
  menu VARCHAR(50)
);

CREATE TABLE user_sub_menu(
  id_sub_menu INT AUTO_INCREMENT PRIMARY KEY,
  id_menu INT,
  id_active INT,
  title VARCHAR(50),
  url VARCHAR(50),
  FOREIGN KEY (id_menu) REFERENCES user_menu(id_menu) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (id_active) REFERENCES user_status(id_active) ON UPDATE NO ACTION ON DELETE NO ACTION
);

CREATE TABLE user_access_menu(
  id_access_menu INT AUTO_INCREMENT PRIMARY KEY,
  id_role INT,
  id_menu INT,
  FOREIGN KEY (id_role) REFERENCES user_role(id_role) ON UPDATE NO ACTION ON DELETE NO ACTION,
  FOREIGN KEY (id_menu) REFERENCES user_menu(id_menu) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE user_access_sub_menu(
  id_access_sub_menu INT AUTO_INCREMENT PRIMARY KEY,
  id_role INT,
  id_sub_menu INT,
  FOREIGN KEY (id_role) REFERENCES user_role(id_role) ON UPDATE NO ACTION ON DELETE NO ACTION,
  FOREIGN KEY (id_sub_menu) REFERENCES user_sub_menu(id_sub_menu) ON UPDATE CASCADE ON DELETE CASCADE
);

-- In Fitures
CREATE TABLE
  tentang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gambar VARCHAR(255),
    judul VARCHAR(255),
    deskripsi TEXT
  );

CREATE TABLE
  kontak (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100),
    subjek VARCHAR(255),
    pesan TEXT,
    tgl_buat DATETIME DEFAULT CURRENT_TIMESTAMP
  );

CREATE TABLE
  prosedur_seleksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gambar VARCHAR(255),
    link_video VARCHAR(255),
    judul VARCHAR(255),
    deskripsi TEXT
  );

CREATE TABLE
  kriteria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_kriteria VARCHAR(10) NOT NULL,
    nama_kriteria VARCHAR(100) NOT NULL,
    jenis ENUM ('benefit', 'cost') -- Added jenis kriteria
    prioritas INT -- Nilai prioritas kriteria (misal: 1, 2, 3, 4)
    bobot_roc FLOAT -- Nilai bobot kriteria hasil perhitungan ROC
  );

CREATE TABLE
  sub_kriteria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_kriteria INT NOT NULL,
    nama_sub_kriteria VARCHAR(100),
    deskripsi TEXT,
    bobot INT, -- Nilai bobot sub kriteria (misal: 1, 2, 3, 4)
    FOREIGN KEY (id_kriteria) REFERENCES kriteria (id) ON DELETE CASCADE
  );

CREATE TABLE
  alternatif (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(20) NOT NULL UNIQUE, -- Gunakan VARCHAR agar angka 0 di depan tidak hilang
    no_kk VARCHAR(20),
    nama_lengkap VARCHAR(150),
    jenis_kelamin ENUM ('L', 'P'),
    tgl_lahir DATE,
    umur INT,
    status_keluarga VARCHAR(50),
    pekerjaan VARCHAR(100)
  );

CREATE TABLE
  periode (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_periode VARCHAR(100),
    tanggal_mulai DATE,
    status ENUM ('Aktif', 'Selesai', 'Pending'),
    keterangan TEXT
  );

CREATE TABLE
  skor_alternatif (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_periode INT NOT NULL,
    id_alternatif INT NOT NULL,
    id_sub_kriteria INT NOT NULL,
    skor INT, -- Nilai yang diambil dari sub_kriteria atau input manual
    FOREIGN KEY (id_periode) REFERENCES periode (id) ON DELETE CASCADE,
    FOREIGN KEY (id_alternatif) REFERENCES alternatif (id) ON DELETE CASCADE,
    FOREIGN KEY (id_sub_kriteria) REFERENCES sub_kriteria (id) ON DELETE CASCADE
  );

CREATE TABLE
  hasil_akhir (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_periode INT NOT NULL,
    id_alternatif INT NOT NULL,
    skor FLOAT, -- Hasil perhitungan SAW (desimal)
    peringkat INT,
    FOREIGN KEY (id_periode) REFERENCES periode (id) ON DELETE CASCADE,
    FOREIGN KEY (id_alternatif) REFERENCES alternatif (id) ON DELETE CASCADE
  );