<?php include ('includes/header.php'); ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <h1 class="mt-4">Dashboard</h1>
                    <?php alertMessage(); ?>
                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-c-blue order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Total Kategori</h6>
                                    <h2 class="text-right"><i
                                            class="fa fa-fw fas fa-box-open f-left"></i><span><?= getCount('categories'); ?></span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-c-green order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Total Products</h6>
                                    <h2 class="text-right"><i
                                            class="fa fa-fw fa-cube f-left"></i><span><?= getCount('products'); ?></span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-c-yellow order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Total Admin</h6>
                                    <h2 class="text-right"><i
                                            class="fa fa-fw fa-user-tie f-left"></i><span><?= getCount('admin'); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-c-pink order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Total Customers</h6>
                                    <h2 class="text-right"><i
                                            class="fa fa-fw fa-user f-left"></i><span><?= getCount('customers'); ?></span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <hr>
                            <h4>Orders</h4>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-primary order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Today Orders</h6>
                                    <h2 class="text-right"><i class="fa fa-fw fa-clock f-left"></i><span>
                                            <?php
                                            $todayDate = date('Y-m-d');
                                            $todayOrders = mysqli_query($conn, "SELECT * FROM orders WHERE order_date='$todayDate' ");
                                            if ($todayOrders) {
                                                $totalCountOrders = mysqli_num_rows($todayOrders);
                                                echo $totalCountOrders;
                                            } else {
                                                echo "0";
                                            }
                                            ?>
                                        </span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="card bg-primary order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Total Orders</h6>
                                    <h2 class="text-right"><i
                                            class="fa fa-fw fa-archive f-left"></i><span><?= getCount('orders'); ?></span>
                                    </h2>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h3 class="text-center">Total Penjualan Hari Ini</h3>
                </div>

                <div class="card-body">
                    <?php
                    // Mendapatkan data total penjualan hari ini dari database
                    date_default_timezone_set('Asia/Jakarta');
                    $todayDate = date('Y-m-d');
                    $todaySalesQuery = mysqli_query($conn, "SELECT product_id, SUM(quantity) AS total_sold FROM order_items WHERE DATE(order_date)='$todayDate' GROUP BY product_id");
                    $totalSalesToday = 0;

                    // Memeriksa apakah ada penjualan hari ini
                    if ($todaySalesQuery && mysqli_num_rows($todaySalesQuery) > 0) {
                        ?>
                        <table class="table table-striped table-bordered align-items-center justify-content-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Terjual Hari Ini</th>
                                    <th>Total Penjualan Hari Ini</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($todaySalesQuery)) {
                                    // Dapatkan nama produk
                                    $productId = $row['product_id'];
                                    $productQuery = mysqli_query($conn, "SELECT * FROM products WHERE id=$productId");
                                    $product = mysqli_fetch_assoc($productQuery);
                                    $productName = $product['name'];

                                    // Hitung total penjualan hari ini untuk produk ini
                                    $totalSoldToday = $row['total_sold'];
                                    $totalSalesProductToday = $totalSoldToday * $product['price'];
                                    $totalSalesToday += $totalSalesProductToday;
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $productName ?></td>
                                        <td><?= $totalSoldToday ?></td>
                                        <td>Rp. <?= number_format($totalSalesProductToday, 0, ',', '.') ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="3" class="text-end"><b>Total Penghasilan Hari Ini:</b></td>
                                    <td><b>Rp. <?= number_format($totalSalesToday, 0, ',', '.') ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p class="text-center">Tidak ada penjualan hari ini</p>
                    <?php } ?>
                </div>


            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h3 class="text-center">Total Penjualan Seluruh Produk</h3>
                </div>

                <div class="card-body">
                    <?php
                    // Query untuk mengambil total terjual dan total harga setiap produk
                    $query = "SELECT product_id, SUM(quantity) AS total_sold, price AS total_price FROM order_items GROUP BY product_id";
                    $result = mysqli_query($conn, $query);

                    // Array untuk menyimpan data produk
                    $productsData = [];
                    $totalIncome = 0; // Inisialisasi variabel untuk menyimpan total penghasilan
                    
                    // Memproses hasil query
                    while ($row = mysqli_fetch_assoc($result)) {
                        $productId = $row['product_id'];

                        // Jika produk belum ditambahkan ke array, tambahkan data produk ke array
                        if (!isset($productsData[$productId])) {
                            $productsData[$productId] = [
                                'total_sold' => $row['total_sold'],
                                'total_price' => $row['total_price']
                            ];
                        }

                        // Hitung total harga produk berdasarkan jumlah yang terjual
                        $totalProductPrice = $row['total_price'] * $row['total_sold'];
                        $totalIncome += $totalProductPrice; // Menambahkan total harga produk ke total penghasilan
                    }

                    // Tampilkan data produk dalam tabel
                    ?>
                    <table class="table table-striped table-bordered align-items-center justify-content-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk</th>
                                <th>Terjual</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($productsData as $productId => $productData) {
                                // Ambil data produk berdasarkan ID produk
                                $productQuery = mysqli_query($conn, "SELECT * FROM products WHERE id = $productId");
                                $product = mysqli_fetch_assoc($productQuery);

                                // Hitung total harga produk berdasarkan jumlah yang terjual
                                $totalProductPrice = $productData['total_price'] * $productData['total_sold'];
                                ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $product['name'] ?></td>
                                    <td><?= $productData['total_sold'] ?></td>
                                    <td>Rp. <?= number_format($totalProductPrice, 0, ',', '.'); ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3" class="text-end"><b>Total Penghasilan:</b></td>
                                <td><b>Rp. <?= number_format($totalIncome, 0, ',', '.') ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>

<?php include ('includes/footer.php'); ?>