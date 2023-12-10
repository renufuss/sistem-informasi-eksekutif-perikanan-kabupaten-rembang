<?= $this->extend('Layouts/index'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="card-title"></h4>
                <div class="card-toolbar">
                    <a href="<?= base_url('data'); ?>" class="btn btn-primary btn-sm">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped gy-7 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                <th class="min-w-200px">#</th>
                                <th class="min-w-200px">Jenis</th>
                                <th class="min-w-200px">Produksi (Ton)</th>
                                <th class="min-w-200px">Produksi (Rupiah)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach($tableDatas as $tableData) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $tableData['productionTypeName']; ?></td>
                                <td><?= $tableData['productionAmount']; ?></td>
                                <td><?= $tableData['productionValue']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>