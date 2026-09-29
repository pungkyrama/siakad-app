# Brief Tugas: Sistem Informasi Akademik Kampus (Laravel & Eloquent ORM)

## Deskripsi Tugas
Dalam penugasan ini, Anda ditantang untuk membangun sebuah purwarupa **Sistem Informasi Akademik (SIAKAD)** tingkat universitas berbasis framework Laravel. Sistem ini wajib memanfaatkan ketangguhan **Eloquent ORM** untuk merajut database berskala besar yang terdiri dari lebih dari 12 tabel (Total 14 Tabel). Anda akan mengonstruksi sebuah *Admin Dashboard* terpadu yang memfasilitasi ragam siklus akademik kompleks—mulai dari pendataan program studi, registrasi mahasiswa, penyusunan jadwal kelas, pengisian Kartu Rencana Studi (KRS), penilaian (*grading*), hingga manajemen pelunasan tagihan uang kuliah (UKT). 

---

## Spesifikasi ERD (Entity Relationship Diagram)
Sistem SIAKAD ini disokong oleh **14 tabel** yang saling berkaitan erat. Berikut adalah spesifikasi perancangan kolom dan aturan relasinya:

1. **`users`** (Akun Autentikasi Sistem Terpusat)
   - **Kolom:** `id`, `name`, `email`, `password`, `role` (admin, lecturer, student), `timestamps`
   - **Relasi:** *Has One* Lecturer, *Has One* Student.

2. **`faculties`** (Data Fakultas)
   - **Kolom:** `id`, `name`, `description`, `timestamps`
   - **Relasi:** *Has Many* Departments.

3. **`departments`** (Data Program Studi / Jurusan)
   - **Kolom:** `id`, `faculty_id` (FK), `name`, `degree_level` (S1/D3), `timestamps`
   - **Relasi:** *Belongs To* Faculty, *Has Many* Lecturers, *Has Many* Students, *Has Many* Courses.

4. **`lecturers`** (Profil Detail Dosen)
   - **Kolom:** `id`, `user_id` (FK), `department_id` (FK), `nip`, `phone`, `timestamps`
   - **Relasi:** *Belongs To* User, *Belongs To* Department, *Has Many* Class Schedules.

5. **`students`** (Profil Detail Mahasiswa)
   - **Kolom:** `id`, `user_id` (FK), `department_id` (FK), `nim`, `address`, `timestamps`
   - **Relasi:** *Belongs To* User, *Belongs To* Department, *Has Many* KRS, *Has Many* Invoices.

6. **`academic_years`** (Periode Tahun Ajaran & Semester)
   - **Kolom:** `id`, `name` (cth: 2026/2027), `semester` (Ganjil/Genap), `is_active` (boolean), `timestamps`
   - **Relasi:** *Has Many* Class Schedules, *Has Many* KRS, *Has Many* Invoices.

7. **`courses`** (Daftar Mata Kuliah)
   - **Kolom:** `id`, `department_id` (FK), `code`, `name`, `credits` (Bobot SKS), `timestamps`
   - **Relasi:** *Belongs To* Department, *Has Many* Class Schedules.

8. **`rooms`** (Ruangan Kelas Perkuliahan)
   - **Kolom:** `id`, `name`, `capacity`, `timestamps`
   - **Relasi:** *Has Many* Class Schedules.

9. **`class_schedules`** (Manajemen Jadwal Kelas)
   - **Kolom:** `id`, `course_id` (FK), `lecturer_id` (FK), `academic_year_id` (FK), `room_id` (FK), `day_of_week`, `start_time`, `end_time`, `timestamps`
   - **Relasi:** *Belongs To* Course, Lecturer, Academic Year, Room. *Has Many* KRS Details.

10. **`krs`** (Kop Kartu Rencana Studi Mahasiswa)
    - **Kolom:** `id`, `student_id` (FK), `academic_year_id` (FK), `status` (Draft/Approved), `timestamps`
    - **Relasi:** *Belongs To* Student, *Belongs To* Academic Year, *Has Many* KRS Details.

11. **`krs_details`** (Rincian Mata Kuliah yang Diambil/Dikontrak)
    - **Kolom:** `id`, `krs_id` (FK), `class_schedule_id` (FK), `timestamps`
    - **Relasi:** *Belongs To* KRS, *Belongs To* Class Schedule, *Has One* Grade.

12. **`grades`** (Penilaian Nilai Akhir)
    - **Kolom:** `id`, `krs_detail_id` (FK), `numeric_score`, `letter_grade` (A/B/C/D/E), `timestamps`
    - **Relasi:** *Belongs To* KRS Detail.

13. **`invoices`** (Daftar Tagihan UKT/SPP)
    - **Kolom:** `id`, `student_id` (FK), `academic_year_id` (FK), `amount`, `status` (Unpaid/Paid), `timestamps`
    - **Relasi:** *Belongs To* Student, *Belongs To* Academic Year, *Has Many* Payments.

14. **`payments`** (Riwayat/Struk Pembayaran UKT)
    - **Kolom:** `id`, `invoice_id` (FK), `amount`, `payment_date`, `payment_method`, `timestamps`
    - **Relasi:** *Belongs To* Invoice.

---

## Tahapan Pengerjaan Bagian 1: Instalasi & Konfigurasi Basis Data

### 1. Install Laravel Project
- Jalankan terminal dan eksekusi perintah: `composer create-project laravel/laravel siakad-app`.

### 2. Koneksi Database
- Buat database baru bernama `db_siakad` melalui terminal MySQL, phpMyAdmin, atau DBeaver.
- Sesuaikan kredensial koneksi di dalam file konfigurasi `.env`.

### 3. Pembuatan Migration
- Jalankan *artisan command* untuk membuat file migration ke-14 tabel secara berurutan.
- **Penting:** Tabel-tabel yang tidak menumpang *Foreign Key* (seperti `users`, `faculties`, `rooms`, dan `academic_years`) wajib di-*migrate* paling awal untuk menghindari galat (*error constraint*).
- Atur seluruh relasi parameter *Foreign Key* agar menggunakan fitur `onDelete('cascade')`.

### 4. Pembuatan Model Eloquent
- Buat seluruh kelas Model untuk 14 entitas di atas (cth: `Faculty`, `Student`, `KrsDetail`, dll).
- Amankan dari ancaman *Mass Assignment Vulnerability* dengan merinci daftar kolom di dalam array `$fillable`.
- Deklarasikan *Methods* relasi ORM (`hasOne`, `hasMany`, `belongsTo`) antar model secara matematis dan tepat.

### 5. Seeder (Pengisian Data Dummy)
- Tulis *DatabaseSeeder* untuk menyuntikkan data operasional mentah agar sistem dapat diuji-coba oleh pengguna UI.
- Syarat Minimal Populasi: 3 Fakultas, 10 Program Studi, 2 Tahun Ajaran, 5 Ruang Kelas, 15 Mata Kuliah, 10 Dosen, dan 30 Mahasiswa, disertai simulasi 5 jadwal kelas yang telah diambil oleh mahasiswa (lengkap dengan data nilainya) beserta riwayat tagihan UKT.

---

## Tahapan Pengerjaan Bagian 2: Perancangan Fitur CRUD Dashboard
Sistem ini memproyeksikan sebuah Dashboard Admin komprehensif. Anda diwajibkan menerapkan kaidah *Route Resource* pada file `routes/web.php` dan merangkai logika *Controller* beserta tahapan operasi antarmuka *View* (Read, Create, Edit, Show, Delete) sesuai rincian modul-modul di bawah ini.

### Tahapan Persiapan Layout Dasar UI
- **View Master:** Buat struktur global di `resources/views/layouts/app.blade.php`. Terapkan *library* CSS eksternal (Bootstrap/Tailwind).
- **Navbar:** Rancang menu navigasi di sisi atas (*header*) guna beralih secara dinamis antar ke-5 modul operasional di bawah ini. Pastikan halaman-halaman View (*index, create, show*) merentangkan kode `@extends('layouts.app')`.

### Modul 1: Manajemen Master Data Akademik
- **Target Tabel:** `faculties`, `departments`, `academic_years`, `rooms`, `courses`.
- **Langkah Kerja CRUD:**
  - Buat ke-5 Controller terkait menggunakan CLI `php artisan make:controller NameController --resource`.
  - **View Read (Index):** Tampilkan ke-5 entitas ini pada 5 halaman tabel *index* yang terpisah. Terapkan strategi Eager Loading secara mutlak. (Misal: Pada fungsi index `DepartmentController`, muat data dengan kueri `Department::with('faculty')->get()` agar nama fakultas ter-*load* cepat tanpa *N+1 query problem*).
  - **View Create, Store, Edit, Update, Delete:** Buat antarmuka formulir reguler. Pada Controller, lakukan validasi data via `$request->validate()` sebelum menembakkan fungsi `$model->update()` atau pemusnahan model via `$model->delete()`.

### Modul 2: Registrasi Civitas Akademika (Multi-Tabel Insert)
- **Target Tabel:** `users`, `lecturers`, `students`.
- **Langkah Kerja CRUD:**
  - Siapkan `LecturerController` dan `StudentController`.
  - **View Create:** Desain antarmuka formulir satu pintu yang menggabungkan elemen input akun (Nama Lengkap, Email, Password) dan atribut akademik (Contoh khusus mahasiswa: input NIM, Alamat, serta pilihan menu *Dropdown* Program Studi).
  - **Store Controller (Proses Berantai):** 
    1. Sisipkan kueri registrasi login: `$user = User::create(['name'=>..., 'email'=>..., 'password'=>Hash::make(...)])`.
    2. Tangkap ID yang dilemparkan database dari pembuatan user tersebut, kemudian simpan data akademik pelengkap ke dalam tabel profilnya: `Student::create(['user_id' => $user->id, 'nim' => ..., 'department_id' => ...])`.
  - **View Update & Delete:** Berlaku prinsip relasional; jika akun `User` ditekan hapus (`$user->delete()`), tabel turunan mahasiswanya (`students`) akan otomatis terhapus tanpa menyisakan *orphan data*.

### Modul 3: Manajemen Penjadwalan Perkuliahan
- **Target Tabel:** `class_schedules`.
- **Langkah Kerja CRUD:**
  - Inisialisasi `ClassScheduleController`.
  - **View Create:** Halaman formulir ini adalah poros operasional. Buat elemen *Dropdown Select* yang menggabungkan berbagai tabel pendukung secara masif: Anda harus menyediakan *dropdown* Mata Kuliah, Dosen Pengajar, Ruang Kelas, dan Periode Tahun Ajaran, sekaligus *field* pengaturan Hari, Jam Mulai, serta Jam Selesai.
  - **View Read (Index):** Formulasikan sebuah tabel jadwal yang bersih. Karena modul ini merepresentasikan keterikatan dengan 4 buah entitas, Anda harus memastikan relasi *Eager Loading* dimuat berlapis, misalnya `ClassSchedule::with(['course', 'lecturer.user', 'room', 'academicYear'])->get()`.

### Modul 4: Pengisian KRS & Penilaian Akhir (Transaksi Bertingkat)
- **Target Tabel:** `krs`, `krs_details`, `grades`.
- **Langkah Kerja CRUD:**
  - **Pengajuan KRS (Create & Store):** 
    - Melalui `KrsController`, buat halaman "Kontrak Kuliah". Tampilkan seluruh jadwal kelas (`class_schedules`) yang aktif.
    - Sediakan fitur relasi iteratif (seperti antarmuka *Multi-Select* atau deretan kotak *Checkboxes*) sehingga Mahasiswa bisa menyeleksi 5 hingga 8 jadwal mata kuliah sekaligus di dalam satu formulir.
    - Pada method `store`, Controller pertama-tama menciptakan berkas identitas di tabel `krs` (status: 'Approved'). Lanjutkan dengan perulangan kode (*looping*) pada opsi kelas yang diceklis, lalu muntahkan masukan ke tabel `krs_details` secara berulang.
  - **Penilaian Indeks Prestasi (Grades):**
    - Sediakan halaman khusus (contoh: `GradeController`) di mana sosok Dosen bisa mengklik salah satu jadwal kelas yang diajarnya.
    - Tampilkan antarmuka barisan mahasiswa (berdasarkan rentetan join tabel `krs_details` di kelas bersangkutan). 
    - Dosen menginput nilai kuantitatif, lalu controller langsung mengarahkan transaksi modifikasi ke tabel `grades` (menyimpan rekaman nilai angka dan terjemahan otomatis nilai mutunya, yakni rentang A, B, C, D, atau E).

### Modul 5: Modul Keuangan & Pembayaran UKT
- **Target Tabel:** `invoices`, `payments`.
- **Langkah Kerja CRUD:**
  - **Manajemen Tagihan (Create Invoices):** Di halaman *View Create*, Admin memilih *Dropdown* nama mahasiswa, rentang Tahun Ajaran aktif, serta angka nominal UKT yang harus dibayarkan. Controller mencetak tagihan berstatus "Unpaid" ke tabel `invoices`.
  - **Mekanisme Pelunasan (Create Payments):** 
    - Masuk ke *View Show* sebuah entitas Tagihan, klik tombol aksi "Bayar".
    - Hadirkan formulir yang menerima *input* nominal dan opsi kanal pelunasan (*payment_method*).
    - Proses krusial di Controller: Buat catatan struk pembayaran ke tabel `payments`. Lakukan kalkulasi menjumlah seluruh nominal cicilan di dalam tabel `payments` milik tagihan (`invoice`) terkait. Apabila sumasi angka bayar sudah mencapai atau melampaui tarif nominal `invoices`, jalankan algoritma *update* instan yang mengonversi atribut status tagihan di tabel `invoices` berubah mutlak menjadi "Paid" (Lunas).
