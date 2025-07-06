<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Data Diskon</h3>
       <a href="<?= base_url('diskon/create') ?>" class="btn btn-primary">+ Tambah Data</a>
    </div>

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success">
            🎉 Diskon Hari Ini: <strong><?= session()->getFlashdata('pesan'); ?></strong>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-primary">
                <tr class="text-center">
                    <th>No</th> 
                    <th>Nominal</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($diskon as $i => $row): ?>
    <tr>
        <td><?= $i + 1 ?></td>
        <td>Rp<?= number_format($row['nominal'], 0, ',', '.') ?></td>
        <td><?= date('d-m-Y', strtotime($row['created_at'])) ?></td> <!-- format tanggal -->
        <td>
            <a href="<?= base_url('diskon/edit/' . $row['id']) ?>" class="btn btn-success">Ubah</a>
            <a href="<?= base_url('diskon/delete/' . $row['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
<?php endforeach ?>
</tbody>

        </table>
    </div>
</div>

<?= $this->endSection() ?>
