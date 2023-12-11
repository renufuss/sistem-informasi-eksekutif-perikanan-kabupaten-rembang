
# Sistem Informasi Eksekutif Perikanan Kabupaten Rembang



![Logo](https://i.postimg.cc/Dyp9HhY7/logo-wide.png)

Sistem Informasi Eksekutif (SIE) yang dikembangkan oleh Kelompok 12 untuk mata kuliah Sistem Informasi Eksekutif pada prodi Sistem Informasi di UPN Veteran Jawa Timur merupakan solusi yang berfokus pada analisis data Banyaknya Pembudidaya Perikanan Tambak, Luasan, Produksi, dan Nilai Produksi di Kabupaten Rembang dalam rentang waktu 2016-2022. Sistem ini dirancang dengan tujuan memberikan informasi yang relevan dan akurat kepada para eksekutif terkait kebijakan dan pengambilan keputusan di sektor perikanan. Melalui antarmuka yang intuitif, SIE ini memungkinkan pengguna untuk mengakses dan memvisualisasikan data secara efisien, mengeksplorasi tren waktu, dan menganalisis kinerja pembudidaya perikanan tambak.

## Anggota Kelompok 12

- [Renanda Auzan Firdaus](https://www.github.com/renufuss)
- [Alif Ramadhani](#)
- [Apriliana Pramesinta K.](#)
- [Debrina Octrisya Hajjar](#)


## Sumber Data

 - [Data 2016 - 2020](https://rembangkab.bps.go.id/statictable/2023/06/25/815/banyaknya-pembudidaya-perikanan-tambak-luasan-produksi-dan-nilai-produksi-di-kabupaten-rembang-2016-2020.html)
 - [Data 2021 - 2022](https://rembangkab.bps.go.id/statictable/2023/06/25/816/banyaknya-pembudidaya-perikanan-tambak-luasan-produksi-dan-nilai-produksi-di-kabupaten-rembang-2021-2022.html)



## Instalasi

### Yang dibutuhkan

- Aplikasi ini memerlukan [Composer](https://getcomposer.org/), dan Aplikasi server lokal seperti [XAMPP](https://www.apachefriends.org/) atau [WAMPP](https://www.wampserver.com/en/)
- Aplikasi ini memerlukan PHP dengan versi minimal 7.4

### Cara Instalasi

1. Nyalakan Server Apache dan MySQL
2. Buat database
![Create Database](https://i.postimg.cc/SRNF9xjz/image.png)
3. Clone Repository
```
  git clone https://github.com/renufuss/sistem-informasi-eksekutif-perikanan-kabupaten-rembang
```
![Clone Repository](https://i.postimg.cc/JhwfqqG8/image.png)

![Clone Repository Success](https://i.postimg.cc/wvqbfbzC/image.png)

4. Masuk ke dalam folder
```
cd sistem-informasi-eksekutif-perikanan-kabupaten-rembang
```
![Go to folder](https://i.postimg.cc/k51hHv5D/image.png)

![Go to folder success](https://i.postimg.cc/bNhL3BR3/image.png)

5. Install autoload composer pada project
```
composer install
```
![composer install](https://i.postimg.cc/9QxpXFHn/image.png)

![composer install success](https://i.postimg.cc/j5fQhHwp/image.png)

6. Jalankan server
```
php spark serve
```
![run the server](https://i.postimg.cc/SxK6PFY7/image.png)

![server running](https://i.postimg.cc/bv71dZC3/image.png)

- Server berjalan di http://localhost:8080

7. Rename file env menjadi .env
- Sebelum

![env default](https://i.postimg.cc/VsTDnNSQ/image.png)
- Sesudah

![renamed env](https://i.postimg.cc/cCKh2pbb/image.png)

8. Sesuaikan base url dengan url server yang sedang berjalan pada file .env
- Contoh
```
app.baseURL = 'http://localhost:8080'
```
- Sebelum

![default base url](https://i.postimg.cc/9Qz9pdsL/image.png)
- Sesudah

![set base url](https://i.postimg.cc/G2j9rtZB/image.png)

9. Sesuaikan database sesuai dengan nama database yang sudah dibuat sebelumnya
 - Contoh
 ```
    database.default.hostname = localhost
    database.default.database = dbsie
    database.default.username = root
    database.default.password = 
    database.default.DBDriver = MySQLi
    database.default.DBPrefix =
    database.default.port = 3306
 ```
```
Default for XAMPP and WAMPP
username = root
password = (no need password)
```
 - Sebelum

![default databse env](https://i.postimg.cc/qqVfmxmy/image.png)
- Sesudah

![set database env](https://i.postimg.cc/bwY7FJRC/image.png)

10. Jalankan migration untuk membuat tabel pada database
```
php spark migrate
```
![run migration](https://i.postimg.cc/zGJytnMs/image.png)

![run migration success](https://i.postimg.cc/ryxzqnL6/image.png)

11. Jalankan seeder untuk memasukkan data ke dalam tabel di database
```
php spark db:seed RunSeeder
```
![run migration success](https://i.postimg.cc/MTyxJLfd/image.png)

![run migration success](https://i.postimg.cc/X72WWdXS/image.png)

12. Silakan buka website pada url server yang sedang berjalan
![running website](https://i.postimg.cc/GtL0wmCm/image.png)