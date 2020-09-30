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
                	<h5 class="text-muted"> Daftar Jadwal Stasiun Kereta API</h5>
                	<div class="row">
                		<div class="col-md-8">
                			<button type="button" class="btn btn-primary tombolTambahJadwal mb-2" data-toggle="modal" data-target="#formModalJadwal"><i class="fas fa-plus-circle"></i> Tambah Data Jadwal</button>
                            <?= $this->session->flashdata('pesan'); ?>
                		</div>
                	</div>
                	<div class="table-responsive">
                		<table class="table table-striped table-bordered text-center">
                			<thead>
                				<tr>
                					<th>No</th>
                					<th>Nama Kereta</th>
                                    <th>Asal</th>
                                    <th>Tujuan</th>
                                    <th>Tanggal Berangkat</th>
                                    <th>Tanggal Sampai</th>
                                    <th>Kelas</th>
                					<th><i class="fas fa-cogs"></i></th>
                				</tr>
                			</thead>
                			<tbody>
                				<?php $no = 1; foreach($jadwal as $j) : ?>
                				<tr>
                                   <td><?= $no++; ?></td>
                                   <td><?= $j['nama_kereta']; ?></td>
                                   <td><?= $j['Asal']; ?></td>
                                   <td><?= $j['Tujuan']; ?></td>
                                   <td><?= date('d-m-Y', strtotime($j['tgl_berangkat'])); ?></td>
                                   <td><?= date('d-m-Y', strtotime($j['tgl_sampai'])); ?></td>
                                   <td><?= $j['kelas']; ?></td>
                                   <td>
                                   	<button type="button" class="btn btn-primary tombolUbahJadwal btn-sm" data-toggle="modal" data-id="<?= $j['id_jadwal']; ?>" data-target="#formModalJadwal"><i class="fas fa-edit"></i></button>
                                   	<a href="<?= base_url('jadwal/hapus/') . $j['id_jadwal']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ?')"><i class="fas fa-trash"></i></a>
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