<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session('role') == 'admin' && session()->get('diskon_nominal')) : ?>
    <div class="alert alert-info text-center">
        📅 Diskon Hari Ini (<?= date('d M Y') ?>): 
        <strong>Rp<?= number_format(session('diskon_nominal'), 0, ',', '.') ?></strong>
    </div>
<?php endif; ?>

<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
<!-- Table with stripped rows -->
<div class="row">
    <?php foreach ($product as $key => $item) : ?>
        <div class="col-lg-6">
            <?= form_open('keranjang') ?>
            <?php
            echo form_hidden('id', $item['id']);
            echo form_hidden('nama', $item['nama']);
            echo form_hidden('harga', $item['harga']);
            echo form_hidden('foto', $item['foto']);
            ?>
            <div class="card">
                <div class="card-body">
                    <img src="<?php echo base_url() . "img/" . $item['foto'] ?>" alt="..." width="300px">
                   <h5 class="card-title">
    <?= esc($item['nama']) ?><br>
    <?php if (isset($item['harga_asli']) && $item['harga_asli'] > $item['harga_setelah_diskon']) : ?>
        <del class="text-muted"><?= number_to_currency($item['harga_asli'], 'IDR') ?></del><br>
        <strong class="text-success"><?= number_to_currency($item['harga_setelah_diskon'], 'IDR') ?></strong>
    <?php else : ?>
        <?= number_to_currency($item['harga'], 'IDR') ?>
    <?php endif; ?>
</h5>
                    <button type="submit" class="btn btn-info rounded-pill">Beli</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    <?php endforeach ?>
</div>
<!-- End Table with stripped rows -->
<?= $this->endSection() ?>