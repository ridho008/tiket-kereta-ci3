<style>
    body {
        background-color: #eee;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 py-3">
            <?= $this->session->flashdata('pesan'); ?>
            <?php if(!$this->input->post('bukti')) : ?>
                <?php else : ?>
                    <?= $error; ?>
            <?php endif; ?>
            <div class="card">
                <div class="card-header bg-danger text-light text-center">
                    Formulir Pembayaran
                </div>
                <div class="card-body">
                    <form action="<?= base_url('cekKonfirmasi'); ?>" method="post">
                        <div class="form-group">
                            <label for="kode_boking">Kode Booking</label>
                            <input type="text" name="kode_boking" id="kode_boking" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Cek Kode Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if($this->input->get('kode')) : ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    Detail Pembayaran
                </div>
                <div class="card-body">
                    <?php if($noTiket['status'] == 0) : ?>
                        <div class="alert alert-warning" role="alert"><i class="fas fa-info-circle"></i> Belum Dibayar !</div>
                        <?php else : ?>
                        <div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Sudah Lunas !</div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nama</th>
                                <th>Identitas</th>
                            </tr>
                            <?php foreach($detail as $d) : ?>
                            <tr>
                                <td><?= $d['nama_penumpang']; ?></td>
                                <td><?= $d['no_identitas']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                        <p class="float-right">Total Pembayaran : <strong>Rp.<?= number_format($noTiket['total_pembayaran'], 0, ',', '.'); ?></strong></p>
                        <?= form_open_multipart('kirimKonfirmasi'); ?>
                        <div class="form-group">
                            <input type="hidden" name="kode" value="<?= $_GET['kode']; ?>">
                            <label for="bukti">Upload Bukti</label>
                            <input type="file" class="form-control-file" id="bukti" name="bukti">
                            <button type="submit" name="bukti" class="btn btn-dark btn-block"><i class="fas fa-upload"></i> Bukti Pembayaran</button>
                        </div>
                        <?php form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>