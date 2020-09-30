<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <div class="row">
    	<div class="col-md-8 mt-5">
    		<h1 class="display-4 mt-5 text-light judul">Selamat Datang PT.Kereta API Indonesia</h1>
            <p class="lead text-light judul">Aplikasi website pembelian tiket kereta api sederhana menggunakan codeigniter 3.</p>
    	</div>
    	<div class="col-md-4">
    		<div class="card">
    			<div class="card-header">
    				<h4 class="lead text-muted">Lokasi Tujuan</h4>
    			</div>
    			<div class="card-body">
    				<form action="<?= base_url('tamu/cari_tiket'); ?>" method="post">
    					<div class="form-group">
    						<label for="asal">Stasiun Asal</label>
    						<div class="input-group">
						        <div class="input-group-prepend">
						          <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
						        </div>
						        <select name="asal" id="asal" class="form-control">
    							   <option value="">-- Pilih Stasiun Asal --</option>
                                   <?php foreach($stasiun as $s) : ?>
                                    <option value="<?= $s['id_stasiun']; ?>"><?= $s['nama_stasiun']; ?></option>
                                   <?php endforeach; ?>
    						    </select>
						    </div>
    						
    					</div>
    					<div class="form-group">
    						<label for="tujuan">Stasiun Tujuan</label>
    						<div class="input-group">
						        <div class="input-group-prepend">
						          <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
						        </div>
						        <select name="tujuan" id="tujuan" class="form-control">
    							   <option value="">-- Pilih Stasiun Tujuan --</option>
                                   <?php foreach($stasiun as $s) : ?>
                                    <option value="<?= $s['id_stasiun']; ?>"><?= $s['nama_stasiun']; ?></option>
                                   <?php endforeach; ?>
    						    </select>
						    </div>
    					</div>
    					<div class="form-group">
    						<label for="tgl">Tanggal</label>
    						<div class="input-group">
						        <div class="input-group-prepend">
						          <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
						        </div>
						        <input type="date" name="tgl" id="tgl" class="form-control">
						    </div>
    					</div>
    					<div class="form-group">
    						<label for="penumpang">Jumlah Penumpang</label>
    						<div class="input-group">
						        <div class="input-group-prepend">
						          <div class="input-group-text"><i class="fas fa-users"></i></div>
						        </div>
						        <select name="penumpang" id="penumpang" class="form-control">
    							   <option value="">-- Pilih Jumlah Penumpang --</option>
                                   <?php for($i = 1; $i <= 5; $i++) : ?>
                                    <option value="<?= $i; ?>"><?= $i; ?> Penumpang</option>
                                   <?php endfor; ?>
    						    </select>
						    </div>
    					</div>
    					<div class="form-group">
    						<button type="submit" class="btn btn-dark btn-block"><i class="fas fa-search"></i> Cari Tiket</button>
    					</div>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
  </div>
</div>

<?php if(isset($tiket)) : ?>
<div class="container">
    <div class="row">
        <div class="col-md">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Nama Kereta</th>
                        <th>Tanggal Berangkat</th>
                        <th>Tanggal Sampai</th>
                        <th><i class="fas fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($tiket as $t) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $t['nama_kereta']; ?></td>
                            <td><?= date('d-m-Y', strtotime($t['tgl_berangkat'])); ?></td>
                            <td><?= date('d-m-Y', strtotime($t['tgl_sampai'])); ?></td>
                            <td>
                                <a href="<?= base_url('pesan/') . $t['id_jadwal'] . '?p=' . $penumpang ?>" class="btn btn-primary">Pesan</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <?php if($tiket) : ?>
                    <h6 class="text-muted">Stasiun Asal : <?= $t['Asal']; ?></h6>
                    <h6 class="text-muted">Stasiun Tujuan : <?= $t['Tujuan']; ?></h6>
                    <h6 class="text-muted">Tanggal Berangkat : <?= set_value('tgl'); ?></h6>
                    <?php else : ?>
                        <h6 class="text-muted">Stasiun Asal : <?= set_value('asal'); ?></h6>
                        <h6 class="text-muted">Stasiun Tujuan : <?= set_value('tujuan'); ?></h6>
                        <h6 class="text-muted">Tanggal Berangkat : <?= set_value('tgl'); ?></h6>
                    <?php endif; ?>
                </table>
                    <?php if(empty($tiket)) : ?>
                        <div class="alert alert-danger text-center" role="alert">Jadwal Kereta <strong><?= date('d-m-Y', strtotime(set_value('tgl'))); ?></strong> Tidak Tersedia.</div>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

