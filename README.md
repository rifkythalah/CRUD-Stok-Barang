# Modul CRUD Stok Barang

Aplikasi manajemen inventaris barang berbasis web yang dibangun menggunakan framework CodeIgniter 3, Bootstrap 5, dan DataTables. Modul ini dirancang responsif, interaktif, dan mudah digunakan untuk pengelolaan stok barang.

---

## 📑 Product Requirements Document (PRD)

### 1. Overview
Aplikasi **CRUD Stok Barang** merupakan solusi pengolahan data barang yang memungkinkan pengguna mencatat, memperbarui, mencari, dan menghapus stok barang dalam satu antarmuka terintegrasi secara *real-time*.

### 2. Tech Stack
* **Backend:** PHP 8.x, CodeIgniter 3.1.x
* **Frontend:** HTML5, CSS3, Bootstrap 5.3
* **Library UI & Interaktivitas:** jQuery 3.7, DataTables 1.13
* **Database & Web Server:** MySQL / MariaDB, Apache (via Laragon)

### 3. Kebutuhan Fungsional (Functional Requirements)
* **Create (Tambah Data):** Menambah data barang baru lengkap dengan validasi kode barang unik.
* **Read (Tampil Data):** Menampilkan daftar stok barang dalam tabel interaktif dengan fitur pencarian, pengurutan, dan paginasi otomatis.
* **Update (Ubah Data):** Memperbarui data barang secara dinamis via Modal Pop-up tanpa *reload* halaman berlebih.
* **Delete (Hapus Data):** Menghapus data barang dengan konfirmasi proteksi *pop-up*.
* **Notification System:** Menampilkan *flash message* respon aksi (sukses/gagal) yang otomatis menghilang dalam waktu 3 detik.

---

## Struktur Database

**Nama Database:** `db_inventaris`  
**Nama Tabel:** `tbl_barang`

| Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id_barang` | INT(11) | Primary Key, Auto Increment |
| `kode_barang` | VARCHAR(50) | Unique Key (Misal: BRG-001) |
| `nama_barang` | VARCHAR(100) | Nama item barang |
| `kategori` | VARCHAR(50) | Jenis/kategori barang |
| `stok` | INT(11) | Jumlah fisik barang |
| `harga` | INT(15) | Harga satuan (IDR) |
| `created_at` | DATETIME | Waktu data dibuat |

---

## Cara Menjalankan Project (Local Setup)

Berikut panduan langkah demi langkah untuk menjalankan project di lingkungan lokal menggunakan **Laragon**:

1. **Clone Repository:**
   ```bash
   git clone [https://github.com/rifkythalah/CRUD-Stok-Barang.git](https://github.com/rifkythalah/CRUD-Stok-Barang.git)
   cd CRUD-Stok-Barang
   ```

2. **Jalankan Web Server:**
   * Buka aplikasi **Laragon**, lalu klik **Start All** (memastikan Apache & MySQL aktif).

3. **Setup Database:**
   * Buka **HeidiSQL** / **phpMyAdmin**.
   * Buat database baru bernama `db_inventaris`.
   * Eksekusi perintah SQL berikut untuk membuat tabel dan mengisi data awal:
     ```sql
     CREATE TABLE `tbl_barang` (
       `id_barang` int(11) NOT NULL AUTO_INCREMENT,
       `kode_barang` varchar(50) NOT NULL,
       `nama_barang` varchar(100) NOT NULL,
       `kategori` varchar(50) NOT NULL,
       `stok` int(11) NOT NULL DEFAULT 0,
       `harga` int(15) NOT NULL,
       `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
       PRIMARY KEY (`id_barang`),
       UNIQUE KEY `kode_barang` (`kode_barang`)
     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
     ```

4. **Konfigurasi Aplikasi:**
   * Pastikan konfigurasi database pada `application/config/database.php` sudah sesuai dengan kredensial server lokal Anda:
     * `username` = `root`
     * `password` = `""` (kosong)
     * `database` = `db_inventaris`

5. **Akses Aplikasi:**
   Buka browser dan akses alamat berikut:
   ```text
   http://localhost/CRUD-Stok-Barang/
   ```

---

## Panduan Pengujian (Testing Guide)


### 1. Pengujian Fitur Pencarian & Filter (DataTables)
* **Langkah:** Ketikkan kata kunci (misal: "Kemeja" atau "Elektronik") pada kolom pencarian di kanan atas tabel.
* **Ekspektasi:** Tabel secara otomatis menyaring data sesuai kata kunci tanpa *refresh* halaman.

### 2. Pengujian Tambah Data & Validasi Kode Unik
* **Skenario A (Sukses):** Klik tombol **+ Tambah Barang**, isi form dengan data baru (kode belum pernah ada), lalu klik **Simpan Data**.
  * *Ekspektasi:* Modal tertutup, alert hijau *"Data berhasil ditambahkan."* muncul di atas kartu selama 3 detik lalu hilang, dan data bertambah di tabel.
* **Skenario B (Gagal Validasi Unik):** Klik tombol **+ Tambah Barang**, masukan kode barang yang sudah tersimpan di database (misal: `BRG-001`).
  * *Ekspektasi:* Sistem menolak pendaftaran dan menampilkan alert merah *"Kode barang sudah tersedia, buat kode baru."*.

### 3. Pengujian Edit Data (Update)
* **Langkah:** Klik tombol **Edit** (warna kuning) pada salah satu baris data.
* **Ekspektasi:** Modal Edit terbuka dengan form yang terisi data dari baris tersebut secara otomatis. Ubah stok/harga lalu klik **Update Data**. Alert hijau *"Data berhasil diubah."* akan muncul.

### 4. Pengujian Hapus Data (Delete)
* **Langkah:** Klik tombol **Hapus** (warna merah) pada salah satu baris data.
* **Ekspektasi:** Dialog konfirmasi browser akan muncul. Jika diklik **OK**, data akan terhapus dari tabel dan muncul alert hijau *"Data berhasil dihapus"*.
