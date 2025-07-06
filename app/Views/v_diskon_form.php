<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <?= isset($diskon) ? 'Edit Diskon' : 'Tambah Diskon' ?>
            </h4>
        </div>
        <div class="card-body">

            <?php if (isset($diskon['id'])): ?>
    <input type="hidden" name="id" value="<?= $diskon['id'] ?>">
<?php endif; ?>

            <form action="<?= isset($diskon) ? base_url('diskon/update/' . $diskon['id']) : base_url('diskon/store') ?>" method="POST">
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control"
                        value="<?= isset($diskon) ? esc($diskon['tanggal']) : '' ?>" required>
                </div>

                <div class="mb-4">
                    <label for="nominal" class="form-label">Nominal</label>
                    <input type="number" name="nominal" id="nominal" class="form-control"
                        value="<?= isset($diskon) ? esc($diskon['nominal']) : '' ?>" required>
                </div>

                <button type="submit" class="btn btn-success">
                    <?= isset($diskon) ? 'Update' : 'Simpan' ?>
                </button>
                <a href="<?= base_url('diskon') ?>" class="btn btn-secondary">Batal</a>
            </form>

        </div>
    </div>
</div>

<?= $this->endSection() ?>