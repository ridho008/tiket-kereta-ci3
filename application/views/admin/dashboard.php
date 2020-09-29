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
                	<h5 class="text-muted"> Daftar Stasiun Kereta API</h5>
                	<div class="row">
                		<div class="col-md-8">
                			<form action="" method="post">
                			  <div class="form-row align-items-center">
                			    <div class="col-auto">
                			      <label class="sr-only" for="inlineFormInput">Name</label>
                			      <input type="text" name="stasiun" class="form-control mb-2" id="inlineFormInput" placeholder="Stasiun...">
                			      <small class="muted text-danger"><?= form_error('stasiun'); ?></small>
                			    </div>
                			    <div class="col-auto">
                			      <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Tambah Stasiun</button>
                			    </div>
                			  </div>
                			</form>
                		</div>
                	</div>
                	<div class="table-responsive">
                		<table class="table table-striped table-bordered text-center">
                			<thead>
                				<tr>
                					<th>No</th>
                					<th>Stasiun</th>
                					<th><i class="fas fa-cogs"></i></th>
                				</tr>
                			</thead>
                			<tbody>
                				<?php $no = 1; foreach($stasiun as $s) : ?>
                				<tr>
                                   <td><?= $no++; ?></td>
                                   <td><?= $s['nama_stasiun']; ?></td>
                                   <td>
                                   	<button type="button" class="btn btn-primary tombolUbahStasiun" data-toggle="modal" data-id="<?= $s['id_stasiun']; ?>" data-target="#formModalUbahStasiun"><i class="fas fa-edit"></i></button>
                                   	<a href="<?= base_url('dashboard/hapus/') . $s['id_stasiun']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
<div class="modal fade" id="formModalUbahStasiun" tabindex="-1" aria-labelledby="formStasiunModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formStasiunModalLabel">Ubah Data Stasiun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?= base_url('dashboard/ubahstasiun'); ?>">
        	<input type="hidden" name="id_stasiun" id="id_stasiun">
        	<div class="form-group">
        		<label for="stasiun">Nama Stasiun</label>
        		<input type="text" name="stasiun" id="stasiun" class="form-control">
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