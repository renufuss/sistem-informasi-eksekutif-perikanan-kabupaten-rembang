<?= $this->extend('Layouts/index'); ?>

<?= $this->section('content'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.8.1/autoNumeric.min.js"></script>


<div class="row">
    <div class="col-xl-6 col-12 p-5">
        <div class="row">
            <div class="card shadow-sm" style="min-height :440px;">
                <div class="card-header">
                    <h3 class="card-title text-primary">Data Budidaya Perikanan</h3>
                </div>
                <div class="card-body">
                    <select class="form-select form-select-solid required" data-control="select2"
                        data-placeholder="Tahun" data-allow-clear="true" id="year">
                        <option></option>
                        <?php foreach($years as $year) : ?>
                        <option value="<?= $year->year; ?>"><?= $year->year; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        Silakan pilih tahun terlebih dahulu.
                    </div>
                    <hr class="mt-10">

                    <div class="py-3">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 gy-7">
                                <tbody>
                                    <tr>
                                        <td width="30%"><b>Luas Tambak</b></td>
                                        <td width="5%"><b>:</b></td>
                                        <td id="pond-area">0 Ha</td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><b>Produktivitas</b></td>
                                        <td width="5%"><b>:</b></td>
                                        <td id="productivity">0 kw/Ha</td>
                                    </tr>
                                    <tr>
                                        <td width="30%"><b>Produksi</b></td>
                                        <td width="5%"><b>:</b></td>
                                        <td id="production">0 Ton</td>
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
                    <select class="form-select form-select-solid required" data-control="select2"
                        data-placeholder="Variabel yang ingin diubah" data-allow-clear="true" id="variable">
                        <option></option>
                        <option value="1">Luas Tambak</option>
                        <option value="2">Produktivitas</option>
                        <option value="3">Produksi</option>
                    </select>
                    <div class="invalid-feedback">
                        Silakan pilih variabel yang ingin diubah terlebih dahulu.
                    </div>
                    <div class="input-group mt-5 mb-5">
                        <input type="text" class="form-control form-control-solid" autocomplete="off" id="value" />
                        <div class="invalid-feedback">
                            Silakan isi nilai terlebih dahulu.
                        </div>
                        <span class="input-group-text d-none" id="unit"></span>
                    </div>
                    <div class="mt-5 py-10">
                        <button class="btn btn-primary" style="min-width:100%;" id="calculate">Analisis</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row d-none" id="result">
    <div class="card shadow-sm" style="width:100%">
        <div class="card-header">
            <h3 class="card-title text-primary">Hasil</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-6 col-12 p-5">
                    <div class="row">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title text-primary" id="title-1"></h3>
                            </div>
                            <div class="card-body">
                                <div class="py-3">
                                    <div class="table-responsive">
                                        <table class="table table-row-dashed table-row-gray-300 gy-7">
                                            <tbody>
                                                <tr>
                                                    <td width="30%"><b>Luas Tambak</b></td>
                                                    <td width="5%"><b>:</b></td>
                                                    <td id="pond-area-result-1">0 Ha</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%"><b>Produktivitas</b></td>
                                                    <td width="5%"><b>:</b></td>
                                                    <td id="productivity-result-1">0 kw/Ha</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%"><b>Produksi</b></td>
                                                    <td width="5%"><b>:</b></td>
                                                    <td id="production-result-1">0 Ton</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-12 p-5">
                    <div class="row">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <h3 class="card-title text-primary" id="title-2"></h3>
                            </div>
                            <div class="card-body">
                                <div class="py-3">
                                    <div class="table-responsive">
                                        <table class="table table-row-dashed table-row-gray-300 gy-7">
                                            <tbody>
                                                <tr>
                                                    <td width="30%"><b>Luas Tambak</b></td>
                                                    <td width="5%"><b>:</b></td>
                                                    <td id="pond-area-result-2">0 Ha</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%"><b>Produktivitas</b></td>
                                                    <td width="5%"><b>:</b></td>
                                                    <td id="productivity-result-2">0 kw/Ha</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%"><b>Produksi</b></td>
                                                    <td width="5%"><b>:</b></td>
                                                    <td id="production-result-2">0 Ton</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        autoNumeric();

        $('#year').change(function (e) {
            e.preventDefault();
            hideResult();
            $('#year').removeClass('is-invalid');
            getDataByYear($('#year').val());
        });

        $('#variable').change(function (e) {
            e.preventDefault();
            hideResult();
            $('#variable').removeClass('is-invalid');
            $('#value').removeClass('is-invalid');
            $('#unit').html(getUnitByVariable($('#variable').val()));
        });


        $('#calculate').click(function (e) {
            e.preventDefault();
            let variable = $('#variable').val()
            let year = $('#year').val()
            let variableValue = $('#value').val().replace(/[,]/g, '-').replace(/[.]/g, '');

            calculateAnalysis(variable, variableValue, year);
        });
    });

    function resetData() {
        $('#pond-area').html('0 Ha');
        $('#productivity').html('0 kw/Ha');
        $('#production').html('0 Ton');
    }

    function showUnit() {
        $('#unit').removeClass('d-none');
    }

    function hideUnit() {
        $('#unit').addClass('d-none');
    }

    function getUnitByVariable(variable) {
        showUnit();

        if($('#value').hasClass('is-invalid')){
            hideUnit();
        }

        if (!$('#value').hasClass('is-invalid') && variable == 1) {
            return 'Ha';
        } else if (!$('#value').hasClass('is-invalid') && variable == 2) {
            return 'kw/Ha';
        } else if (!$('#value').hasClass('is-invalid') && variable == 3) {
            return 'Ton';
        }else if (!$('#value').hasClass('is-invalid') && variable == '') {
            hideUnit();
            return '';
        }

        
    }

    function getDataByYear(year) {
        if (year == '' || year == null) {
            resetData();
            return;
        }
        $.ajax({
            url: "<?= base_url('what-if/data'); ?>/" + year,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#pond-area').html(data.pond_area + ' Ha');
                $('#productivity').html(data.productivity + ' kw/Ha');
                $('#production').html(data.production + ' Ton');
            }
        });

    }

    function autoNumeric() {
        [value] = AutoNumeric.multiple(['#value'], {
            digitGroupSeparator: '.',
            decimalPlaces: 2,
            decimalCharacter: ',',
            decimalCharacterAlternative: ',',
            currencySymbol: '',
            minimumValue: 0,
            modifyValueOnWheel: false,
            unformat: true,
            currencySymbolPlacement: AutoNumeric.options.currencySymbolPlacement.prefix,
        });
    }

    function validationError(variable, variableValue, year) {
        if (variable == '') {
            $('#variable').addClass('is-invalid');
        } else {
            $('#variable').removeClass('is-invalid');
        }

        if (variableValue == '') {
            $('#value').addClass('is-invalid');
            hideUnit();
        } else {
            $('#value').removeClass('is-invalid');
            showUnit();
        }

        if (year == '') {
            $('#year').addClass('is-invalid');
        } else {
            $('#year').removeClass('is-invalid');
        }
    }

    function hideResult() {
        $('#result').addClass('d-none');
    }

    function showResult() {
        $('#result').removeClass('d-none');
    }

    function calculateAnalysis(variable, variableValue, year) {
        hideResult();
        validationError(variable, variableValue, year);

        $.ajax({
            type: "GET",
            url: "<?= base_url('what-if/analysis'); ?>/" + variable + "/" + variableValue + "/" + year,
            dataType: "JSON",
            success: function (response) {
                $('#result').removeClass('d-none');
                console.log(response[0]);
                $('#title-1').html(response[0].title);
                $('#title-2').html(response[1].title);

                $('#production-result-1').html(response[0].production + ' Ton');
                $('#pond-area-result-1').html(response[0].pond_area + ' Ha');
                $('#productivity-result-1').html(response[0].productivity + ' kw/Ha');

                $('#production-result-2').html(response[1].production + ' Ton');
                $('#pond-area-result-2').html(response[1].pond_area + ' Ha');
                $('#productivity-result-2').html(response[1].productivity + ' kw/Ha');

                showResult();
            }
        });
    }
</script>
<?= $this->endSection(); ?>