<?= $this->extend('Layouts/index'); ?>

<?= $this->section('content'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


<div class="row">
    <div class="col-xl-6 col-12 p-5">
        <div class="row">
            <div class="card shadow-sm" style="min-height :440px;">
                <div class="card-header">
                    <h3 class="card-title text-primary">Data Budidaya Perikanan</h3>
                </div>
                <div class="card-body">
                    <select class="form-select form-select-solid mb-3 required " data-control="select2"
                        data-placeholder="Tahun" data-allow-clear="true" id="year">
                        <option></option>
                        <?php foreach($years as $year) : ?>
                        <option value="<?= $year->year_id; ?>"><?= $year->year; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <hr>

                    <div class="py-3">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 gy-7">
                                <tbody>
                                    <tr>
                                        <td width="30%"><b>Luas Tambak</b></td>
                                        <td width="5%"><b>:</b></td>
                                        <td id="pond-area">0</td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><b>Produktivitas</b></td>
                                        <td width="5%"><b>:</b></td>
                                        <td id="productivity">0</td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><b>Produksi</b></td>
                                        <td width="5%"><b>:</b></td>
                                        <td id="production">0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-12 p-5 h-150px">
        <div class="row">
            <div class="card shadow-sm" style="min-height :440px;">
                <div class="card-header">
                    <h3 class="card-title text-primary">Data Analisis What If</h3>
                </div>
                <div class="card-body">
                    <select class="form-select mb-5 required form-select-solid" data-control="select2"
                        data-placeholder="Variabel yang ingin diubah" data-allow-clear="true" id="variable">
                        <option></option>
                        <option value="1">1</option>
                    </select>
                    <div class="mb-5">
                        <label for="exampleFormControlInput1" class="required form-label">Nilai</label>
                        <input type="text" class="form-control form-control-solid" id="value" />
                    </div>
                    <div class="mt-5 py-10">
                        <button class="btn btn-primary" style="min-width:100%;">Analyze</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        $('#year').change(function (e) {
            e.preventDefault();
            console.log($('#year').val());
        });
    });
</script>
<?= $this->endSection(); ?>