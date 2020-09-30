<style>
    body {
        background-color: #eee;
    }
</style>
<?php if($this->session->flashdata('nomor')) : ?>
    
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 py-3">
            <div class="card">
                <div class="card-header bg-success text-light text-center">
                    <h4>Selamat !</h4> Anda Berhasil Melakukan Pembelian Tiket Kereta API
                </div>
                <div class="card-body text-center">
                    <div class="alert alert-danger mt-0"><strong>Peringatan</strong>, Jangan reload halaman pembayaran ini. secara otomatis akan diarahkan ke halaman utama.</div>
                    <h5 class="card-title">2347562364928</h5>
                    <h6 class="card-subtitle mb-2 text-muted">A/N PT.Kereta Api</h6>
                    <p class="card-text">Mandiri Syariah</p>
                    <p class="lead">Total Pembayaran Rp.<strong><?= number_format($this->session->flashdata('total'), 0, ',', '.'); ?></strong></p>
                    <p class="lead">Kode Pembayaran <strong><?= $this->session->flashdata('nomor'); ?></strong></p>
                    <p>Jika sudah melakukan transfer, segera</p>
                    <p><a href="<?= base_url('tamu/konfirmasi'); ?>" class="btn btn-success">Konfirmasi Pembayaran</a></p>
                    <h4 class="text-muted">Terima Kasih</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else : ?>
    <?php redirect('/'); ?>
<?php endif; ?>
