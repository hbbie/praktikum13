# praktikum13
Pemrograman Web Pertemuan 15

# Nama    : Dhani Naufal Habibie
# Kelas   : TI.24.a4
# NIM     : 312410300

![Uploading image.png…]()


# Page 1
<img width="1784" height="557" alt="image" src="https://github.com/user-attachments/assets/286b8584-1884-4d28-aef6-d5c7911869f5" />

# Page 2
<img width="1786" height="403" alt="image" src="https://github.com/user-attachments/assets/84d492f0-f7a7-4947-9064-2f6ea300e313" />

Aplikasi ini memiliki struktur file yang terorganisir untuk memisahkan fungsi logika, koneksi, dan penyimpanan aset:

    koneksi.php: Berisi konfigurasi untuk menghubungkan skrip PHP dengan database MySQL.

    index.php: Halaman utama yang berfungsi menampilkan tabel data barang, formulir pencarian, dan navigasi pagination.

    tambah.php: Halaman khusus untuk menginputkan data barang baru ke dalam database.

    Folder gambar/: Direktori fisik untuk menyimpan file gambar barang agar dapat dipanggil oleh browser.

# 1. Fitur Utama dan Penjelasan Logika
A. Logika Pencarian (Search)

Program menggunakan metode GET untuk menangkap kata kunci dari pengguna. Jika terdapat input pada kolom pencarian, sistem akan menambahkan perintah WHERE nama LIKE ... pada query SQL untuk memfilter data berdasarkan nama barang.

B. Sistem Pagination

Pagination digunakan agar data tidak menumpuk dalam satu halaman, yang diatur dengan variabel $per_page = 2.

    Offset: Dihitung dengan rumus ($page - 1) * $per_page untuk menentukan urutan data yang akan ditarik dari database.

    Limit: Query SQL menggunakan klausa LIMIT {$offset}, {$per_page} untuk membatasi jumlah baris yang ditampilkan per halaman.

C. Pengolahan Gambar

Sistem menampilkan gambar dengan memanggil nama file yang tersimpan di database dan menggabungkannya dengan path folder lokal (gambar/). Penggunaan properti CSS object-fit: cover memastikan gambar tetap proporsional dan tidak terdistorsi (gepeng) meskipun ukuran aslinya bervariasi.
D. Antarmuka Pengguna (UI)

Desain menggunakan CSS modern dengan fitur:

    Responsif: Menggunakan lebar kontainer 90% agar fleksibel di berbagai layar.

    Interaktif: Navigasi menggunakan warna biru (#337ab7) dengan efek hover untuk memudahkan pengalaman pengguna.

# 2. Kesimpulan

Program ini berhasil mengintegrasikan manipulasi database MySQL dengan tampilan web dinamis. Fitur pagination dan pencarian yang diterapkan memastikan aplikasi tetap efisien dan mudah digunakan meskipun jumlah data barang bertambah banyak.
