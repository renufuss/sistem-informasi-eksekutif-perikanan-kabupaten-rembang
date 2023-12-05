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
                    <select class="form-select form-select-solid required " data-control="select2"
                        data-placeholder="Tahun" data-allow-clear="true" id="year">
                        <option></option>
                        <?php foreach($years as $year) : ?>
                        <option value="<?= $year->year; ?>"><?= $year->year; ?></option>
                        <?php endforeach; ?>
                    </select>
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
                    <div class="input-group mt-5 mb-5">
                        <input type="text" class="form-control form-control-solid" autocomplete="off" id="value" />
                        <span class="input-group-text" id="unit"></span>
                    </div>
                    <div class="mt-5 py-10">
                        <button class="btn btn-primary" style="min-width:100%;">Analisis</button>
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
            getDataByYear($('#year').val());
        });

        $('#variable').change(function (e) {
            e.preventDefault();
            $('#unit').html(getUnitByVariable($('#variable').val()));
        });
    });

    function resetData() {
        $('#pond-area').html('0 Ha');
        $('#productivity').html('0 kw/Ha');
        $('#production').html('0 Ton');
    }

    function getUnitByVariable(variable) {
        if (variable == 1) {
            return 'Ha';
        } else if (variable == 2) {
            return 'kw/Ha';
        } else if (variable == 3) {
            return 'Ton';
        }else{
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
            decimalPlaces: 0,
            decimalCharacter: ',',
            decimalCharacterAlternative: ',',
            currencySymbol: '',
            minimumValue: 0,
            modifyValueOnWheel: false,
            currencySymbolPlacement: AutoNumeric.options.currencySymbolPlacement.prefix,
        });
    }
   
</script>
<?= $this->endSection(); ?>