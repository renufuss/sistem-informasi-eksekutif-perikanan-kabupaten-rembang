<?= $this->extend('Layouts/index'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body" style="min-height:500px">
                <img src="<?= base_url(); ?>/assets/media/logos/logo-wide.png" width="300" alt="">
                <p class="mt-3">
                    Sistem Informasi Eksekutif (SIE) yang dikembangkan oleh Kelompok 12 untuk mata kuliah Sistem
                    Informasi Eksekutif pada prodi Sistem Informasi di UPN Veteran Jawa Timur merupakan solusi yang
                    berfokus pada analisis data
                    Banyaknya Pembudidaya Perikanan Tambak, Luasan, Produksi, dan Nilai Produksi di Kabupaten Rembang
                    dalam rentang waktu 2016-2022. Sistem ini dirancang dengan tujuan memberikan informasi yang relevan
                    dan akurat kepada para eksekutif terkait kebijakan dan pengambilan keputusan di sektor perikanan.
                    Melalui antarmuka yang intuitif, SIE ini memungkinkan pengguna untuk mengakses dan memvisualisasikan
                    data secara efisien, mengeksplorasi tren waktu, dan menganalisis kinerja pembudidaya perikanan
                    tambak.</p>
                <br>
                <h5>Anggota Kelompok 12</h5>
                <ul>
                    <li>Renanda Auzan Firdaus</li>
                    <li>Alif Ramadhani</li>
                    <li>Apriliana Pramesinta K.</li>
                    <li>Debrina Octrisya Hajjar</li>
                </ul>
                <br>
                <h6>Sumber Data</h6>
                <ul>
                    <li>
                        <a href="https://rembangkab.bps.go.id/statictable/2023/06/25/815/banyaknya-pembudidaya-perikanan-tambak-luasan-produksi-dan-nilai-produksi-di-kabupaten-rembang-2016-2020.html" target="_blank">Data 2016 - 2020</a>
                    </li>
                    <li>
                        <a href="https://rembangkab.bps.go.id/statictable/2023/06/25/816/banyaknya-pembudidaya-perikanan-tambak-luasan-produksi-dan-nilai-produksi-di-kabupaten-rembang-2021-2022.html" target="_blank">Data 2021 - 2022</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>