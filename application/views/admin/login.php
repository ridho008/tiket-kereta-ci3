<style>
    body {
        background-color: #eee;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 py-5">
            <div class="card">
                <div class="card-header bg-dark text-light text-center">
                    Login Kereta API Indonesia
                </div>
                <div class="card-body">
        		<?= $this->session->flashdata('pesan'); ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" autofocus="on" placeholder="Masukan username anda">
                            <small class="muted text-danger"><?= form_error('username'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukan password anda">
                            <small class="muted text-danger"><?= form_error('password'); ?></small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark"><i class="fas fa-sign-in-alt"></i> Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
