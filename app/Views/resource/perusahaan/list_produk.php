<?= $this->extend('MyLayout/template') ?>

<?= $this->section('content') ?>


<main class="p-md-3 p-2">

    <div class="d-flex mb-0">
        <div class="me-auto mb-1">
            <h3 style="color: #566573;">Data Produk <?= $perusahaan['nama'] ?></h3>
        </div>
        <div class="me-2 mb-1">
            <a class="btn btn-sm btn-outline-dark" href="<?= site_url() ?>resource-perusahaan">
                <i class="fa-fw fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <hr class="mt-0 mb-4">

    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered" width="100%" id="tabel">
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th class="text-center" width="15%">SKU</th>
                    <th class="text-center" width="40%">Nama Produk</th>
                    <th class="text-center" width="15%">Jenis</th>
                    <th class="text-center" width="15%">Harga</th>
                    <th class="text-center" width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($produk as $pr) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $pr['sku'] ?></td>
                        <td><?= $pr['produk'] ?></td>
                        <td><?= $pr['jenis'] ?></td>
                        <td>Rp. <?= number_format($pr['harga_jual'], 0, ',', '.') ?></td>
                        <td class="text-center">
                            <a title="Copy Produk" class="px-2 py-0 btn btn-sm btn-outline-danger" onclick="copyProduk('<?= $pr['sku'] ?>')">
                                <i class="fa-fw fa-solid fa-circle-chevron-down"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</main>


<!-- Modal -->
<div class="modal fade" id="my-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="judulModal">Tambah Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="isiForm">

                <form autocomplete="off" class="row g-3 mt-2" action="<?= site_url() ?>resource-produk" method="POST" id="form">

                    <?= csrf_field() ?>

                    <div class="row mb-3">
                        <label for="nama" class="col-sm-3 col-form-label">Nama Produk</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="form-nama" name="nama" autofocus>
                            <div class="invalid-feedback error-nama"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="sku" class="col-sm-3 col-form-label">SKU</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="form-sku" name="sku" autofocus>
                            <div class="invalid-feedback error-sku"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_kategori" class="col-sm-3 col-form-label">Kategori</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="id_kategori" id="form-id_kategori">
                                <?php foreach ($kategori as $kt) : ?>
                                    <option value="<?= $kt['id'] ?>-krisna-<?= $kt['nama'] ?>"><?= $kt['nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback error-id_kategori"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="hs_code" class="col-sm-3 col-form-label">HS Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="form-hs_code" name="hs_code" autofocus>
                            <div class="invalid-feedback error-hs_code"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="satuan" class="col-sm-3 col-form-label">Satuan</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="satuan" id="form-satuan">
                                <option value=""></option>
                                <option value="Unit">Unit</option>
                                <option value="Pcs">Pcs</option>
                            </select>
                            <div class="invalid-feedback error-satuan"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tipe" class="col-sm-3 col-form-label">Tipe</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="tipe" id="form-tipe">
                                <option value=""></option>
                                <option value="SET">SET</option>
                                <option value="SINGLE">SINGLE</option>
                                <option value="ECER">ECER</option>
                            </select>
                            <div class="invalid-feedback error-tipe"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jenis" class="col-sm-3 col-form-label">Jenis Produk</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="jenis" id="form-jenis">
                                <option value=""></option>
                                <option value="Produk Fisik">Produk Fisik</option>
                                <option value="Produk Digital">Produk Digital</option>
                            </select>
                            <div class="invalid-feedback error-jenis"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="harga_beli" class="col-sm-3 col-form-label">Harga Beli</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="form-control" id="form-harga_beli" name="harga_beli">
                                <div class="invalid-feedback error-harga_beli"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="harga_jual" class="col-sm-3 col-form-label">Harga Jual</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="form-control" id="form-harga_jual" name="harga_jual">
                                <div class="invalid-feedback error-harga_jual"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="stok" class="col-sm-3 col-form-label">Stok Awal</label>
                        <div class="col-sm-9">
                            <input type="number" min="0" class="form-control" id="form-stok" name="stok" value="0">
                            <div class="invalid-feedback error-stok"></div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="berat" class="col-sm-3 col-form-label">Berat</label>
                        <div class="col-sm-9">
                            <input type="number" min="0" class="form-control" id="form-berat" name="berat">
                            <div class="invalid-feedback error-berat"></div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label">Ukuran</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <span class="input-group-text">P</span>
                                <input type="number" min="0" class="form-control" id="form-panjang" name="panjang">
                                <div class="invalid-feedback error-panjang"></div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <span class="input-group-text">L</span>
                                <input type="number" min="0" class="form-control" id="form-lebar" name="lebar">
                                <div class="invalid-feedback error-lebar"></div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <span class="input-group-text">T</span>
                                <input type="number" min="0" class="form-control" id="form-tinggi" name="tinggi">
                                <div class="invalid-feedback error-tinggi"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 offset-3 mb-3">
                        <button id="tombolSimpan" class="btn px-5 btn-outline-primary" type="submit">Simpan <i class="fa-fw fa-solid fa-check"></i></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Modal -->


<?= $this->include('MyLayout/js') ?>


<script>
    $(document).ready(function() {
        $('#tabel').dataTable();
    })

    function copyProduk(sku) {

        cekExistProduk('hbc-produk1', function(result) {
            console.log(result);
        });

        // if (cekExistProduk('hbc-produk1') === 'produk ada') {
        //     alert('ada')
        // } else {
        //     alert('tidak')
        //     // cekExistProduk('hbc-produk1')
        // }

        // var apiUrl = '<?= $perusahaan['url'] ?>/hbapi-get-produk/' + sku;

        // $.ajax({
        //     url: apiUrl,
        //     method: 'GET',
        //     success: function(response) {
        //         if (response.message === 'success') {
        //             var product = response.product;
        //             $('#form-nama').val(product.nama);
        //             $('#form-nama').val(product.nama);
        //         } else {
        //             console.log('Gagal mengambil data produk.');
        //         }
        //     },
        //     error: function() {
        //         console.log('Terjadi kesalahan saat mengambil data produk.');
        //     }
        // });
    }

    function cekExistProduk(sku, callback) {
        $.ajax({
            url: '<?= site_url() ?>resource-cek-exist-produk/hbc-produk1',
            method: 'GET',
            success: function(response) {
                if (response.produk === true) {
                    callback('produk ada');
                } else {
                    callback('produk tidak ada');
                }
            },
            error: function() {
                console.log('Terjadi kesalahan saat ajax cek produk.');
            }
        });
    }
</script>


<?= $this->endSection() ?>