<?= $this->extend('Layouts/index'); ?>

<?= $this->section('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped gy-7 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                <th class="min-w-200px">#</th>
                                <th class="min-w-200px">Tahun</th>
                                <th class="min-w-200px">Luas (Ha)</th>
                                <th class="min-w-200px">Produksi (Ton)</th>
                                <th class="min-w-200px">Produktivitas (kw/Ha)</th>
                                <th class="min-w-200px">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach($tableDatas as $tableData) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $tableData['year']; ?></td>
                                <td><?= $tableData['pondArea']; ?></td>
                                <td><?= $tableData['production']; ?></td>
                                <td><?= $tableData['productivity']; ?></td>
                                <td><a href="<?= base_url('data/'.$tableData['year']); ?>" class="btn btn-info btn-sm">Detail</a></td>
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