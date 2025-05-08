## <p align="center" style="margin-top: 0;">SISTEM RESERVASI HOTEL</p>

<p align="center">
  <img src="/public/LogoUnsulbar.png" width="300" alt="LogoUnsulbar" />
</p>

### <p align="center">A.ADE INDAWAN</p>

### <p align="center">D022032</p></br>

### <p align="center">FRAMEWORK WEB BASED</p>

### <p align="center">2025</p>

## 🧑‍🤝‍🧑 Role dan Hak Akses

| Role         | Akses                                                                              |
|--------------|-----------------------------------------------------------------------------------|
| *Admin*      | Mengelola semua data (user, kamar, tipe kamar, reservasi, pembayaran, laporan), menambah/mengedit/menghapus data, melihat laporan keuangan, mengatur hak akses user |
| *Staff*      | Mengelola reservasi (konfirmasi, check-in, check-out, pembatalan), melihat daftar kamar dan statusnya, melihat data customer |
| *Customer*   | Melihat daftar kamar, melakukan reservasi, mengelola reservasi milik sendiri, mengedit profil |

---

## 🗃 Struktur Database

### 1. Tabel users

| Field          | Tipe Data        | Keterangan                                |
|----------------|------------------|-------------------------------------------|
| id             | bigint (PK)      | ID unik                                   |
| name           | varchar          | Nama lengkap user                         |
| email          | varchar (unique) | Alamat email                              |
| password       | varchar          | Password terenkripsi                      |
| role           | enum             | admin, staff, customer (default: customer)|
| phone          | varchar          | Nomor telepon (opsional)                  |
| address        | text             | Alamat lengkap (opsional)                 |
| remember_token | varchar          | Token untuk remember me                   |
| created_at     | timestamp        | Tanggal dibuat                            |
| updated_at     | timestamp        | Tanggal update                            |

### 2. Tabel room_types

| Field       | Tipe Data   | Keterangan                     |
|-------------|-------------|--------------------------------|
| id          | bigint (PK) | ID tipe kamar                  |
| name        | varchar     | Nama tipe (Suite, Deluxe)      |
| slug        | varchar     | URL-friendly version           |
| description | text        | Deskripsi fasilitas            |
| base_price  | decimal     | Harga dasar (2 digit desimal)  |
| capacity    | integer     | Kapasitas maksimal tamu        |
| created_at  | timestamp   | Tanggal dibuat                 |
| updated_at  | timestamp   | Tanggal update                 |

### 3. Tabel rooms

| Field        | Tipe Data   | Keterangan                     |
|--------------|-------------|--------------------------------|
| id           | bigint (PK) | ID kamar                       |
| room_type_id | bigint (FK) | Relasi ke room_types           |
| room_number  | varchar     | Nomor kamar unik               |
| status       | enum        | available/occupied/maintenance |
| features     | text        | Fitur tambahan kamar           |
| created_at   | timestamp   | Tanggal dibuat                 |
| updated_at   | timestamp   | Tanggal update                 |

### 4. Tabel reservations

| Field            | Tipe Data   | Keterangan                     |
|------------------|-------------|--------------------------------|
| id               | bigint (PK) | ID reservasi                   |
| user_id          | bigint (FK) | Relasi ke users                |
| room_id          | bigint (FK) | Relasi ke rooms                |
| check_in_date    | date        | Tanggal check-in               |
| check_out_date   | date        | Tanggal check-out              |
| adults           | integer     | Jumlah orang dewasa            |
| children         | integer     | Jumlah anak-anak               |
| total_price      | decimal     | Total harga reservasi          |
| status           | enum        | Status reservasi               |
| special_requests | text        | Permintaan khusus tamu         |
| created_at       | timestamp   | Tanggal dibuat                 |
| updated_at       | timestamp   | Tanggal update                 |

---

## 🔗 Relasi Antar Tabel

| Tabel Asal  | Tabel Tujuan | Relasi      | Penjelasan                                  |
|-------------|--------------|-------------|----------------------------------------------|
| users       | reservations | one-to-many | Satu user bisa memiliki banyak reservasi     |
| room_types  | rooms        | one-to-many | Satu tipe kamar bisa memiliki banyak kamar   |
| rooms       | reservations | one-to-many | Satu kamar bisa memiliki banyak reservasi   |