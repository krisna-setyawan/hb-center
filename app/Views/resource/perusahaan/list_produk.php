<?= $this->extend('MyLayout/template') ?>

<?= $this->section('content') ?>


<main class="p-md-3 p-2">

    <div class="d-flex mb-0">
        <div class="me-auto mb-1">
            <h3 style="color: #566573;">Data Produk <?= $perusahaan['nama'] ?></h3>
        </div>
        <div class="me-2 mb-1">
            <a class="btn btn-sm btn-outline-dark" href="<?= site_url() ?>data-master">
                <i class="fa-fw fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="mb-1">
            <a class="btn btn-sm btn-outline-secondary mb-3" id="tombolTambah">
                <i class="fa-fw fa-solid fa-plus"></i> Tambah Produk
            </a>
        </div>
    </div>

    <hr class="mt-0 mb-4">

    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered" width="100%" id="tabel">
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th class="text-center" width="30%">Nama</th>
                    <th class="text-center" width="10%">Tipe</th>
                    <th class="text-center" width="15%">Harga Beli</th>
                    <th class="text-center" width="15%">Harga Jual</th>
                    <th class="text-center" width="10%">Stok</th>
                    <th class="text-center" width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

</main>

<?= $this->include('MyLayout/js') ?>
<?= $this->endSection() ?>