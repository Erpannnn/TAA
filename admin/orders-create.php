<?php
include ('includes/header.php');
?>
<div class="modal fade" id="addCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pelanggan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Masukkan Nama Customer</label>
                    <input type="text" id="c_name" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Masukkan Kelas Pelanggan</label>
                    <input type="text" id="c_class" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Masukkan Nomor Telepon Pelanggan</label>
                    <input type="number" id="c_phone" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Masukkan Email Pelanggan (optional)</label>
                    <input type="text" id="c_email" class="form-control">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary saveCustomer">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="mb-0 text-center">Tambahkan Order
                    <a href="customers.php" class="btn btn-danger float-end"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </h4>
            </div>
            <div class="card-body">
                <?php alertMessage(); ?>
                <form action="orders-code.php" method="POST">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="">Pilih Produk</label>
                            <select name="product_id" class="form-select mySelect2">
                                <option value="">-- Pilih Produk --</option>
                                <?php
                                $products = getAll('products');
                                if ($products) {
                                    if (mysqli_num_rows($products) > 0) {
                                        foreach ($products as $prodItem) {
                                            ?>
                                            <option value="<?= $prodItem['id'] ?>"><?= $prodItem['name'] ?></option>
                                            <?php
                                        }
                                    } else {
                                        echo '<option value="">Produk tidak ditemukan!</option>';
                                    }
                                } else {
                                    echo '<option value="">Ada sesuatu yang salah!</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="">Kuantitas</label>
                            <input type="number" name="quantity" value="1" required class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <br>
                            <button type="submit" name="addItem" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Item</button>
                        </div>
                </form>
                <form action="orders-code.php" method="POST">
                    <div class="col-md-4 mb-3">
                        <label for="">Scan Barcode</label>
                        <input type="text" name="product_code" id="barcode-input" class="form-control">
                        <input type="hidden" name="quantity" value="1">
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-4">
            <div class="card-header text-center">
                <h4 class="mb-0">Produk</h4>
            </div>
            <div class="card-body" id="productArea">
                <?php
                if (isset($_SESSION['productItems'])) {
                    $sessionProducts = $_SESSION['productItems'];
                    if (empty($sessionProducts)) {
                        unset($_SESSION['productItemIds']);
                        unset($_SESSION['productItems']);
                    }
                    ?>
                    <div class="table-responsive mb-3" id="productContent">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Kuantitas</th>
                                    <th>Total Harga</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($sessionProducts as $key => $item):
                                    ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td>
                                            <?= $item['name']; ?>
                                            <p>Rp. <?= number_format($item['price'], 0, ',', '.'); ?></p>
                                        </td>
                                        <td>
                                            <div class="input-group qtyBox">
                                                <input type="hidden" value="<?= $item['product_id']; ?>" class="prodId">
                                                <button class="input-group-text decrement">-</button>
                                                <input type="text" value="<?= $item['quantity']; ?>" class="qty quantityInput">
                                                <button class="input-group-text increment">+</button>
                                            </div>
                                        </td>
                                        <td>Rp. <?= number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></td>
                                        <td>
                                            <a class="noselect button" href="orders-item-delete.php?index=<?= $key; ?>"><span class="text">Delete</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path></svg></span></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Tutor 15 -->
                    <div class="mt-2">
                        <div class="row">
                            <hr>
                            <div class="col-md-4">
                                <label for="">Pilih Metode Pembayaran</label>
                                <select id="payment_mode" class="form-select">
                                    <option value="">-- Pilih Metode Pembayaran --</option>
                                    <option value="Cash Payment">Uang Tunai</option>
                                    <option value="Online Payment">Bayar Online</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Masukan Nomor Telpon Pelanggan</label>
                                <input type="number" id="cphone" class="form-control" value="">
                            </div>
                            <div class="col-md-4">
                                <br>
                                <button type="button" class="btn btn-warning w-100 proceedToPlace">Lanjutkan untuk melakukan pemasanan <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Tutor 15 -->
                    <?php
                } else {
                    echo '<h5>Tidak ada yang ditambah</h5>';
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('barcode-input').addEventListener('keydown', function(event) {
            if (event.key === '') {
                event.preventDefault();
                this.select(); // Keeps the text selected
            }
        });
    </script>

<?php include ('includes/footer.php'); ?>