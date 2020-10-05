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
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="kode_boking">Kode Booking</label>
                            <input type="text" name="kode_boking" id="kode_boking" class="form-control" autofocus="on">
                            <small class="muted text-danger"><?= form_error('kode_boking'); ?></small>
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
                    Detail Pembayaran Kode Booking <strong><?= $noTiket['no_pembayaran']; ?></strong>
                </div>
                <div class="card-body">
                    <?php if($noTiket['status'] == 0) { ?>
                        <div class="alert alert-warning" role="alert"><i class="fas fa-info-circle"></i> Belum Dibayar !</div>
                        <?php } else if($noTiket['status'] == 1) { ?>
                        <div class="alert alert-warning" role="alert"><i class="fas fa-info-circle"></i> Tunggu 24 jam untuk konfirmasi oleh admin!</div>
                        <?php } else { ?>
                        <div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Sudah Lunas !</div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center">
                            <tr>
                                <th>Nama</th>
                                <th>Identitas</th>
                                <th>Gerbong</th>
                                <th>Bagian</th>
                                <th>Kursi</th>
                                <?php if($noTiket['status'] != 2) : ?>
                                <th><i class="fas fa-cogs"></i></th>
                                <?php else : ?>
                                    <th class="d-none"><i class="fas fa-cogs"></i></th>
                                <?php endif; ?>
                            </tr>
                            <?php foreach($detail as $d) : ?>
                            <tr>
                                <td><?= $d['nama_penumpang']; ?></td>
                                <td><?= $d['no_identitas']; ?></td>
                                <td>
                                    <?php if(empty($d['gerbong'])) : ?>
                                        <span class="badge badge-warning" data-toggle="tooltip" data-placement="bottom" title="Pilih Gerbong">Pilih</span>
                                    <?php else : ?>
                                        <?= $d['gerbong']; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(empty($d['bagian'])) : ?>
                                        <span class="badge badge-warning" data-toggle="tooltip" data-placement="bottom" title="Pilih Bagian">Pilih</span>
                                    <?php else : ?>
                                        <?= strtoupper($d['bagian']); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(empty($d['kursi'])) : ?>
                                        <span class="badge badge-warning" data-toggle="tooltip" data-placement="bottom" title="Pilih Kursi">Pilih</span>
                                    <?php else : ?>
                                        <?= $d['kursi']; ?>
                                    <?php endif; ?>
                                </td>
                                <?php if($noTiket['status'] != 2) : ?>
                                <td>
                                    <?php if(empty($d['kursi']) && empty($d['gerbong']) && empty($d['bagian'])) : ?>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pilihGerbong<?= $d['id_penumpang']; ?>"><i class="fas fa-hand-pointer"></i></button>
                                        <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#gantiGerbong<?= $d['id_penumpang']; ?>"><i class="fas fa-pen-square"></i></button> -->
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <!-- Modal Pilih -->
                            <div class="modal fade" id="pilihGerbong<?= $d['id_penumpang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pilih Gerbong</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="<?= base_url('tamu/pilihgerbong'); ?>" method="post">
                                        <input type="text" name="kode" value="<?= $_GET['kode']; ?>">
                                        <input type="text" name="no_tiket" value="<?= $d['no_tiket']; ?>">
                                        <input type="text" name="id_penumpang" value="<?= $d['id_penumpang']; ?>">
                                        <img src="" class="img-fluid img-thumbnail gambar-gerbong">
                                        <div class="form-group">
                                            <select name="gerbong" class="form-control pilih-gerbong">
                                                <option value="">-- Pilih Gerbong --</option>
                                                <option value="1">Gerbong 1</option>
                                                <option value="2">Gerbong 2</option>
                                                <option value="3">Gerbong 3</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="bagian" class="form-control bagian">
                                                <option value="">-- Pilih Bagian --</option>
                                                <option value="a">A</option>
                                                <option value="b">B</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="kursi" class="form-control bagianA">
                                                <option value="" id="judulBagianA"></option>
                                                <?php foreach($bagianA as $bA) : ?>
                                                    <option value="<?= $bA['id_kursi']; ?>"><?= $bA['Kursi']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="kursi" class="form-control bagianB">
                                                <option value="" id="judulBagianB"></option>
                                                <?php foreach($bagianB as $bB) : ?>
                                                    <option value="<?= $bB['id_kursi']; ?>"><?= $bB['Kursi']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Pilih Gerbong</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- Modal Ganti -->
                            <!-- <div class="modal fade" id="gantiGerbong<?= $d['id_penumpang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pilih Gerbong</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="<?= base_url('tamu/ubahgerbong'); ?>" method="post">
                                        <input type="text" name="id_penumpang" value="<?= $d['id_penumpang']; ?>">
                                        <input type="text" name="kode" value="<?= $_GET['kode']; ?>">
                                        <img src="" class="img-fluid img-thumbnail gambar-gerbong">
                                        <div class="form-group">
                                            <select name="gerbong" class="form-control pilih-gerbong">
                                                <option value="">-- Pilih Gerbong --</option>
                                                <?php for($i = 1; $i <= 3; $i++) : ?>
                                                    <?php 
                                                    if($d['gerbong'] == $i) : 
                                                        $select = "selected";
                                                    else :
                                                        $select = "";
                                                    ?>
                                                    <?php endif; ?>
                                                <option <?= $select; ?> value="<?= $i; ?>">Gerbong <?= $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="bagian" class="form-control bagian">
                                                <option value="">-- Pilih Bagian --</option>
                                                <?php for($i = 'a'; $i <= 'b'; $i++) : ?>
                                                    <?php 
                                                    if($d['bagian'] === $i) : 
                                                        $select = "selected";
                                                    else :
                                                        $select = "";
                                                    ?>
                                                    <?php endif; ?>
                                                <option <?= $select; ?> value="<?= $i; ?>">Bagian <?= strtoupper($i); ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="kursi" class="form-control bagianA">
                                                <option value="" id="judulBagianA"></option>
                                                <?php for($i = 1; $i <= 29; $i++) : ?>
                                                    <?php 
                                                    if($d['kursi'] === $i) : 
                                                        $select = "selected";
                                                    else :
                                                        $select = "";
                                                    ?>
                                                    <?php endif; ?>
                                                <option <?= $select; ?> value="<?= $i; ?>"><?= $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="kursi" class="form-control bagianB">
                                                <option value="" id="judulBagianB"></option>
                                                <?php for($i = 1; $i <= 20; $i++) : ?>
                                                    <?php 
                                                    if($d['kursi'] === $i) : 
                                                        $select = "selected";
                                                    else :
                                                        $select = "";
                                                    ?>
                                                    <?php endif; ?>
                                                <option <?= $select; ?> value="<?= $i; ?>"><?= $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Ganti Gerbong</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div> -->
                            <?php endforeach; ?>
                        </table>
                        <p class="float-right">Total Pembayaran : <strong>Rp.<?= number_format($noTiket['total_pembayaran'], 0, ',', '.'); ?></strong></p>
                        <?php if($noTiket['status'] == 2) : ?>
                        <form action="<?= base_url('tamu/cetak'); ?>" method="post" target="_blank">
                            <input type="hidden" name="no_tiket" value="<?= $noTiket['no_tiket']; ?>">
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-print"></i> Cetak</button>
                        </form>
                        <?php endif; ?>
                        <?php if($noTiket['status'] == 0) : ?>
                        <?= form_open_multipart('kirimKonfirmasi'); ?>
                        <div class="form-group">
                            <input type="hidden" name="kode" value="<?= $_GET['kode']; ?>">
                            <input type="hidden" name="noTiket" value="<?= $noTiket['no_tiket']; ?>">
                            <label for="bukti">Upload Bukti</label>
                            <input type="file" class="form-control-file" id="bukti" name="bukti">
                            <span class="text-monospace text-danger">Bukti Foto Wajib Di Upload!</span>
                            <button type="submit" name="bukti" class="btn btn-dark btn-block"><i class="fas fa-upload"></i> Bukti Pembayaran</button>
                        </div>
                        <?php form_close(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


