<style>
    body {
        background-color: #eee;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 py-5">
        	<?= $this->session->flashdata('pesan'); ?>
            <div class="card">
                <div class="card-header bg-dark text-light text-center">
                    Selamat Datang <?= $admin['username']; ?>
                </div>
                <div class="card-body">
                	<h5 class="text-muted"> Daftar Kursi Kereta API</h5>
                    <div class="alert alert-danger" role="alert"><i class="fas fa-info-circle"></i> <strong>Perhatian !</strong> Jika Klik <strong>Tombol Hapus Semua Gerbong</strong> Data Akan Terhapus Semua Secara Total !!!</div>
                	<div class="row">
                		<div class="col-md-6">
                			<button type="button" class="btn btn-primary mb-2 tombolTambahKursi" data-toggle="modal" data-target="#formModalKursi"><i class="fas fa-plus-circle"></i> Tambah Kursi</button>
                            <a href="<?= base_url('hapus/semua/kursi'); ?>" class="btn btn-danger mb-2" onclick="return confirm('Yakin ?')" data-toggle="tooltip" data-placement="bottom" title="Hapus Semua Data Gerbong ?"><i class="fas fa-trash-alt"></i></a>
                		</div>
                	</div>
                	<div class="table-responsive">
                		<table class="table table-striped table-bordered text-center">
                			<thead>
                				<tr>
                					<th>No</th>
                					<th>Kereta</th>
                                    <th>Kursi</th>
                                    <th>Bagian</th>
                					<th><i class="fas fa-cogs"></i></th>
                				</tr>
                			</thead>
                			<tbody>
                				<?php $no = 1; foreach($kursi as $k) : ?>
                				<tr>
                                   <td><?= $no++; ?></td>
                                   <td><?= $k['nama_kereta']; ?></td>
                                   <td><?= $k['kursi']; ?></td>
                                   <td><?= strtoupper($k['bagian_kursi']); ?></td>
                                   <td>
                                   	<a href="<?= base_url('admin/hapusKursi/') . $k['id_kursi']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                   </td>
                                </tr>
                				<?php endforeach; ?>
                			</tbody>
                		</table>
                	</div>
                </div>
                <div class="row">
                    <div class="col-md-6 offset-md-4">
                        <?= $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formModalKursi" tabindex="-1" aria-labelledby="formStasiunModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formStasiunModalLabel">Tambah Data Kursi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url('admin/tambahKursi'); ?>">
        	<input type="hidden" name="id_stasiun" id="id_stasiun">
            <div class="form-group">
                <label for="jadwal">Jadwal</label>
                <select class="form-control" name="jadwal" id="jadwal">
                    <option value="">-- Pilih Bagian --</option>      
                    <?php foreach($jadwal as $j) : ?>
                        <option value="<?= $j['id_jadwal']; ?>"><?= $j['nama_kereta']; ?></option>
                    <?php endforeach; ?>      
                </select>
            </div>
        	<div class="form-group">
        		<label for="bagian">Bagian</label>
        		<select class="form-control" name="bagian" id="bagian">
                    <option value="">-- Pilih Bagian --</option>      
                    <option value="a">Bagian A</option>      
                    <option value="b">Bagian B</option>      
                </select>
        	</div>
            <div class="form-group">
                <label for="kursi">Kursi</label>
                <input type="number" name="kursi" id="jumlah" class="form-control">
            </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Tambah</button>
		      </div>
        </form>
      </div>
    </div>
  </div>
</div>