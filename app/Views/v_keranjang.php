<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
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
<?php echo form_open('keranjang/edit') ?>
<!-- Table with stripped rows -->
<table class="table datatable">
    <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Foto</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
       <?php $i = 1; foreach ($items as $item): ?>
<tr>
    <td><?= esc($item['name']) ?></td>
    <td><img src="<?= base_url('img/' . $item['options']['foto']) ?>" width="100"></td>

    <!-- Harga -->
    <td>
        <?php if (session('diskon_nominal') && session('diskon_nominal') > 0): ?>
            <del class="text-muted"><?= number_to_currency($item['price'] + session('diskon_nominal'), 'IDR') ?></del><br>
            <strong class="text-success"><?= number_to_currency($item['price'], 'IDR') ?></strong>
        <?php else: ?>
            <?= number_to_currency($item['price'], 'IDR') ?>
        <?php endif; ?>
    </td>

    <!-- Jumlah -->
    <td>
        <input type="number" class="form-control" name="qty<?= $i ?>" value="<?= $item['qty'] ?>" min="1">
    </td>

    <!-- Subtotal -->
    <td><?= number_to_currency($item['subtotal'], 'IDR') ?></td>

    <!-- Aksi -->
    <td>
        <a href="<?= base_url('transaksi/cart_delete/' . $item['rowid']) ?>" class="btn btn-danger">
            <i class="bi bi-trash"></i>
        </a>
    </td>
</tr>
<?php $i++; endforeach; ?>
    </tbody>
</table>
<!-- End Table with stripped rows -->
<div class="alert alert-info">
    <?php echo "Total = " . number_to_currency($total, 'IDR') ?>
</div>

<button type="submit" class="btn btn-primary">Perbarui Keranjang</button>
<a class="btn btn-warning" href="<?php echo base_url() ?>keranjang/clear">Kosongkan Keranjang</a>
<?php if (!empty($items)) : ?>
    <a class="btn btn-success" href="<?php echo base_url() ?>checkout">Selesai Belanja</a>
<?php endif; ?>
<?php if (session()->get('diskon_nominal')) : ?>
    <div style="color: green;">
        Diskon Hari Ini: Rp<?= number_format(session()->get('diskon_nominal'), 0, ',', '.') ?>
    </div>
<?php endif; ?>

<?php echo form_close() ?>
<?= $this->endSection() ?>