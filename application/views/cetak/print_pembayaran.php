<div class="container">
	<div class="row">
		<div class="col-md">
			<div class="card">
				<div class="card-header">
					<h4 class="text-center">Kereta Api Indonesia</h4>
				</div>
				<div class="card-header">
					<div class="row mt-4">
						<div class="col-md-6">
							<table class="table">
								<tr>
									<th>Nama Pemesan</th>
									<td><?= $detail['nama_pemesan']; ?></td>
								</tr>
							</table>
						</div>
						<div class="col-md-6">
							<table class="table">
								<tr>
									<th>Tanggal</th>
									<?php $tgl = date_create($detail['tanggal']); ?>
									<td><?= date_format($tgl, "d F Y"); ?></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="table-responsive">
								<table class="table">
									<tr>
									    <th>Jumlah Penumpang</th>
									    <td><?= $jmlPenumpang; ?></td>
								    </tr>
								    <tr>
								    	<th>Harga / Tiket</th>
								    	<td>Rp.<?= number_format($detail['harga'], 0, ',', '.'); ?></td>
								    </tr>
								    <tr>
								    	<th>Total Pembayaran</th>
								    	<td>Rp.<?= number_format($detail['harga'] * $jmlPenumpang, 0, ',', '.'); ?></td>
								    </tr>
								    <tr>
								    	<th>Status</th>
								    	<td>Lunas</td>
								    </tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="table-responsive">
								<table class="table">
									<tr>
										<th>Nama Kereta</th>
										<td><?= $detail['nama_kereta']; ?></td>
									</tr>
									<tr>
										<th>Berangkat</th>
										<?php $tglBerangkat = date_create($detail['tgl_berangkat']); ?>
										<td><?= date_format($tglBerangkat, "d F Y"); ?></td>
									</tr>
									<tr>
										<th>Sampai</th>
										<?php $tglSampai = date_create($detail['tgl_sampai']); ?>
										<td><?= date_format($tglSampai, "d F Y"); ?></td>
									</tr>
									<tr>
										<th>Kelas</th>
										<td><?= $detail['kelas']; ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 offset-md-4">
							Rute : <strong><?= $detail['Asal']; ?> - <?= $detail['Tujuan']; ?></strong>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	window.print();
</script>