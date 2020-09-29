<style>
    body {
        background-color: #eee;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 py-5">
        	<?= $this->session->flashdata('pesan'); ?>
            <div class="card">
                <div class="card-header bg-dark text-light text-center">
                    Selamat Datang <?= $admin['username']; ?>
                </div>
                <div class="card-body">
                	
                </div>
            </div>
        </div>
    </div>
</div>
