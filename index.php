<?php
// 1. Koneksi ke Database [cite: 38]
include_once 'koneksi.php';

// 2. Logika Pencarian [cite: 41, 45, 46]
$sql_where = "";
$q = isset($_GET['q']) ? $_GET['q'] : "";
if ($q) {
    $sql_where = " WHERE nama LIKE '%{$q}%'";
}

// 3. Menghitung total data untuk Pagination [cite: 31, 32, 40, 47, 53]
$sql_count = "SELECT COUNT(*) FROM data_barang" . $sql_where;
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_row($result_count);
$count = $row_count[0];

// 4. Pengaturan Pagination [cite: 21, 22, 55, 56, 57]
$per_page = 2; // Menampilkan 2 data per halaman sesuai contoh gambar [cite: 55]
$num_page = ceil($count / $per_page); // Menghitung jumlah halaman [cite: 56]
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $per_page; // Perbaikan logika offset [cite: 62, 65]

// 5. Query data dengan LIMIT dan OFFSET [cite: 23, 70, 71]
$sql = "SELECT * FROM data_barang" . $sql_where . " LIMIT {$offset}, {$per_page}";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Membuat Database Sederhana</title>
    <style>
        /* CSS Gabungan dari Modul [cite: 97-132] */
        body { font-family: sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { width: 90%; margin: 20px auto; background: #fff; padding: 20px; border: 1px solid #ddd; }
        h1 { color: #999; margin-top: 0; }
        
        .main-nav { background-color: #337ab7; padding: 0; display: flex; margin-bottom: 20px; }
        .main-nav a { color: white; text-decoration: none; padding: 10px 20px; font-weight: bold; }
        .main-nav a.active { background-color: #286090; }

        .btn-tambah { background-color: #337ab7; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; display: inline-block; margin-bottom: 20px; }
        
        .table-barang { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table-barang th, .table-barang td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        
        .btn-edit { background: #e7e7e7; border: 1px solid #ccc; padding: 5px 10px; cursor: pointer; }
        .btn-delete { background: #d9534f; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; }

        /* Pagination Styling [cite: 103-121] */
        ul.pagination { display: inline-block; padding: 0; margin: 20px 0; }
        ul.pagination li { display: inline; }
        ul.pagination li a { color: black; float: left; padding: 8px 16px; text-decoration: none; border: 1px solid #ddd; transition: background-color .3s; }
        ul.pagination li.active a { background-color: #428bca; color: white; border: 1px solid #428bca; }
        ul.pagination li a:hover:not(.active) { background-color: #ddd; }
        
        footer { background: #222; color: #fff; padding: 15px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Membuat Database Sederhana</h1>
        
        <nav class="main-nav">
            <a href="#" class="active">Home</a>
            <a href="#">Login</a>
        </nav>

        <a href="tambah.php" class="btn-tambah">Tambah Barang</a>

        <form action="" method="get" style="margin-bottom: 20px;">
            <label>Cari data: </label>
            <input type="text" name="q" value="<?= htmlspecialchars($q) ?>">
            <button type="submit" style="background:#337ab7; color:white; border:none; padding:5px 10px; border-radius:3px; cursor:pointer;">Cari</button>
        </form>

        <table class="table-barang">
            <thead>
                <tr>
                    <th>Gambar</th><th>Nama Barang</th><th>Katagori</th>
                    <th>Harga Jual</th><th>Harga Beli</th><th>Stok</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if($result): ?>
                <?php while($row = mysqli_fetch_array($result)): ?>
                <tr>
                    <td><img src="gambar/<?= $row['gambar'] ?>" width="50" alt="img"></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['kategori'] ?></td>
                    <td><?= number_format($row['harga_jual'], 2, ',', '.') ?></td>
                    <td><?= number_format($row['harga_beli'], 2, ',', '.') ?></td>
                    <td><?= $row['stok'] ?></td>
                    <td>
                        <button class="btn-edit">Edit</button>
                        <button class="btn-delete">Delete</button>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <ul class="pagination">
            <?php 
            $prev = ($page > 1) ? $page - 1 : 1;
            $next = ($page < $num_page) ? $page + 1 : $num_page;
            ?>
            
            <li><a href="?page=<?= $prev ?>&q=<?= $q ?>">&laquo;</a></li>
            
            <?php for($i=1; $i<=$num_page; $i++): ?>
                <?php 
                    $link = "?page={$i}"; 
                    if (!empty($q)) $link .= "&q={$q}"; 
                    $class = ($page == $i) ? 'active' : ''; // Penentuan class active [cite: 90]
                ?>
                <li class="<?= $class ?>">
                    <a href="<?= $link ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            
            <li><a href="?page=<?= $next ?>&q=<?= $q ?>">&raquo;</a></li>
        </ul>

        <footer>
            <p>&copy; 2014 - STT Pelita Bangsa Bekasi</p>
        </footer>
    </div>
</body>
</html>
