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
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nama</th>
                                <th>Identitas</th>
                                <th>Gerbong</th>
                                <th>Bagian</th>
                                <th>Kursi</th>
                            </tr>
                            <?php foreach($detail as $d) : ?>
                            <tr>
                                <td><?= $d['nama_penumpang']; ?></td>
                                <td><?= $d['no_identitas']; ?></td>
                                <td>
                                    <?php if(empty($d['gerbong'])) : ?>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pilihGerbong<?= $d['id_penumpang']; ?>">Pilih</button>
                                    <?php else : ?>
                                        <button type="button" class="btn btn-info btn-sm tombolGerbong" data-toggle="modal" data-target="#gantiGerbong<?= $d['id_penumpang']; ?>">Ganti</button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(empty($d['bagian'])) : ?>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pilihGerbong<?= $d['id_penumpang']; ?>">Pilih</button>
                                    <?php else : ?>
                                        <button type="button" class="btn btn-info btn-sm tombolGantiGerbong" data-toggle="modal" data-target="#gantiGerbong<?= $d['id_penumpang']; ?>">Ganti</button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(empty($d['kursi'])) : ?>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pilihGerbong<?= $d['id_penumpang']; ?>">Pilih</button>
                                    <?php else : ?>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#gantiGerbong<?= $d['id_penumpang']; ?>">Ganti</button>
                                    <?php endif; ?>
                                </td>
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
                                    <form action="" method="post">
                                        <input type="text" value="<?= $d['id_penumpang']; ?>">
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
                                                <?php for($i = 1; $i <= 29; $i++) : ?>
                                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select name="kursi" class="form-control bagianB">
                                                <option value="" id="judulBagianB"></option>
                                                <?php for($i = 1; $i <= 20; $i++) : ?>
                                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- Modal Ganti -->
                            <div class="modal fade" id="gantiGerbong<?= $d['id_penumpang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pilih Gerbong</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="" method="post">
                                        <input type="text" value="<?= $d['id_penumpang']; ?>">
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
                                                    if($d['bagian'] == $i) : 
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
                                                    if($d['kursi'] == $i) : 
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
                                                    if($d['kursi'] == $i) : 
                                                        $select = "selected";
                                                    else :
                                                        $select = "";
                                                    ?>
                                                    <?php endif; ?>
                                                <option <?= $select; ?> value="<?= $i; ?>"><?= $i; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php endforeach; ?>
                        </table>
                        <p class="float-right">Total Pembayaran : <strong>Rp.<?= number_format($noTiket['total_pembayaran'], 0, ',', '.'); ?></strong></p>
                        <?php if($noTiket['status'] == 0) : ?>
                        <?= form_open_multipart('kirimKonfirmasi'); ?>
                        <!-- <img src="" class="img-fluid img-thumbnail" id="gambar-gerbong">
                        <div class="form-group">
                            <select name="gerbong" id="pilih-gerbong" class="form-control">
                                <option value="">-- Pilih Gerbong --</option>
                                <option value="1">Gerbong 1</option>
                                <option value="2">Gerbong 2</option>
                                <option value="3">Gerbong 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="bagian" id="bagian" class="form-control">
                                <option value="">-- Pilih Bagian --</option>
                                <option value="a">A</option>
                                <option value="b">B</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="kursi" id="bagianA" class="form-control">
                                <option value="" id="judulBagianA"></option>
                                <?php for($i = 1; $i <= 29; $i++) : ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="kursi" id="bagianB" class="form-control">
                                <option value="" id="judulBagianB"></option>
                                <?php for($i = 1; $i <= 20; $i++) : ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div> -->
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


