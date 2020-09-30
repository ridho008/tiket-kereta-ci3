<style>
    body {
        background-color: #eee;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 py-5">
            <div class="card">
                <div class="card-header bg-primary text-light text-center font-weight-bold">
                    Informasi Perjalanan
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Nama Kereta</th>
                            <td><?= $info['nama_kereta']; ?></td>
                        </tr>
                        <tr>
                            <th>Stasiun Asal</th>
                            <td><?= $info['Asal']; ?></td>
                        </tr>
                        <tr>
                            <th>Stasiun Tujuan</th>
                            <td><?= $info['Tujuan']; ?></td>
                        </tr>
                        <tr>
                            <th>Waktu Berangkat</th>
                            <td><?= date('d-m-Y', strtotime($info['tgl_berangkat'])); ?></td>
                        </tr>
                        <tr>
                            <th>Waktu Tiba</th>
                            <td><?= date('d-m-Y', strtotime($info['tgl_sampai'])); ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td><span><?= $_GET['p']; ?> Penumpang</span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <form action="<?= base_url('pesanTiket'); ?>" method="post">
            <input type="text" name="penumpang" value="<?= $_GET['p']; ?>">
            <input type="text" name="id_jadwal" value="<?= $info['id_jadwal']; ?>">
            <div class="card">
                <div class="card-header bg-primary text-light text-center font-weight-bold">
                    Detail Penumpang
                </div>
                <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>>= 17 Tahun ID(KTP, SIM, PASSPORT)</th>
                            </tr>
                            <?php $no = 1; for($i = 1; $i <= $_GET['p']; $i++) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <input type="text" name="nama<?= $i; ?>" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="no_identitas<?= $i; ?>" class="form-control">
                                </td>   
                            </tr>
                            <?php endfor; ?>
                        </table>
                </div>
                <div class="card">
                    <div class="card-header bg-primary text-light text-center font-weight-bold">
                        Detail Pemesan
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nama_pemesan">Nama Pemesan</label>
                                    <input type="text" name="nama_pemesan" id="nama_pemesan" class="form-control">
                                    <small class="muted text-danger"><?= form_error('nama_pemesan'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control">
                                    <small class="muted text-danger"><?= form_error('email'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="no_telp">No.Telepon</label>
                                    <input type="text" name="no_telp" id="no_telp" class="form-control">
                                    <small class="muted text-danger"><?= form_error('no_telp'); ?></small>
                                </div>
                            </div>
                            <div class="col-md">
                               <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                                    <small class="muted text-danger"><?= form_error('alamat'); ?></small>
                                </div> 
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right">Simpan & Lanjutkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>