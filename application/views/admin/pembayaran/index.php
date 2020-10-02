<style>
    body {
        background-color: #eee;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 py-5">
            <div class="card">
                <div class="card-header bg-dark text-light text-center">
                    Selamat Datang <?= $admin['username']; ?>
                </div>
                <div class="card-body">
                	<h5 class="text-muted"> Daftar <?= $title; ?> Kereta API</h5>
                	<div class="table-responsive">
                		<table class="table table-striped table-bordered text-center">
                			<thead>
                				<tr>
                					<th>No.Pembayaran</th>
                					<th>No.Tiket</th>
                                    <th>Total Pembayaran</th>
                                    <th>Bukti</th>
                					<th><i class="fas fa-cogs"></i></th>
                				</tr>
                			</thead>
                			<tbody>
                				<?php foreach($pembayaran as $p) : ?>
                				<tr>
                                   <td><?= $p['no_pembayaran']; ?></td>
                                   <td><?= $p['no_tiket']; ?></td>
                                   <td><?= number_format($p['total_pembayaran'], 0, ',', '.'); ?></td>
                                   <td>
                                       <a href="<?= base_url('assets/img/bukti/') . $p['foto_bukti']; ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat</a>
                                   </td>
                                   <td>
                                   	<a href="<?= base_url('admin/verifikasi/') . $p['id_pembayaran']; ?>" class="btn btn-info btn-sm" onclick="return confirm('Yakin Konfirmasi Nomor Pembayaran <?= $p['no_pembayaran']; ?> ?')"><i class="fas fa-check"></i></a>
                                   </td>
                                </tr>
                				<?php endforeach; ?>
                			</tbody>
                		</table>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formModalJadwal" tabindex="-1" aria-labelledby="formJadwalModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formJadwalModalLabel">Ubah Data Stasiun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
        	<input type="text" name="id_jadwal" id="id_jadwal">
        	<div class="form-group">
        		<label for="nama">Nama Kereta</label>
        		<input type="text" name="nama" id="nama" class="form-control">
                <small class="muted text-danger"><?= form_error('nama'); ?></small>
        	</div>
            <div class="form-group">
                <label for="asal">Stasiun Asal</label>
                <select name="asal" id="asal" class="form-control">
                    <option value="">-- Pilih Stasiun Asal</option>
                    <?php foreach($stasiun as $s) : ?>
                        <option value="<?= $s['id_stasiun']; ?>"><?= $s['nama_stasiun']; ?></option>
                    <?php endforeach; ?>
                </select>
                <small class="muted text-danger"><?= form_error('asal'); ?></small>
            </div>
            <div class="form-group">
                <label for="tujuan">Stasiun Tujuan</label>
                <select name="tujuan" id="tujuan" class="form-control">
                    <option value="">-- Pilih Stasiun Tujuan</option>
                    <?php foreach($stasiun as $s) : ?>
                        <option value="<?= $s['id_stasiun']; ?>"><?= $s['nama_stasiun']; ?></option>
                    <?php endforeach; ?>
                </select>
                <small class="muted text-danger"><?= form_error('tujuan'); ?></small>
            </div>
            <div class="form-group">
                <label for="tgl_berangkat">Tanggal Berangkat</label>
                <input type="date" name="tgl_berangkat" id="tgl_berangkat" class="form-control">
                <small class="muted text-danger"><?= form_error('tgl_berangkat'); ?></small>
            </div>
            <div class="form-group">
                <label for="tgl_sampai">Tanggal Sampai</label>
                <input type="date" name="tgl_sampai" id="tgl_sampai" class="form-control">
                <small class="muted text-danger"><?= form_error('tgl_sampai'); ?></small>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <select name="kelas" id="kelas" class="form-control">
                    <option value="">-- Pilih Kelas</option>
                    <option value="Bisnis">Bisnis</option>
                    <option value="Ekonomi">Ekonomi</option>
                    <option value="Eksekutif">Eksekutif</option>
                </select>
                <small class="muted text-danger"><?= form_error('kelas'); ?></small>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control">
                <small class="muted text-danger"><?= form_error('harga'); ?></small>
            </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Ubah</button>
		      </div>
        </form>
      </div>
    </div>
  </div>
</div>