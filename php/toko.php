<?php
session_start();

// Buat folder uploads kalau belum ada
$uploadDir = __DIR__ . '/uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Inisialisasi array barang kalau belum ada
if (!isset($_SESSION['daftar'])) {
    $_SESSION['daftar'] = [];
}

// Fungsi cari index by ID
function cariIndexById($id)
{
    foreach ($_SESSION['daftar'] as $index => $barang) {
        if ($barang['id'] == $id) {
            return $index;
        }
    }
    return -1;
}

$pesan = "";
$cariBarang = null;

// Handle tambah
if (isset($_POST['tambah'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    if (cariIndexById($id) != -1) {
        $pesan = "ID sudah digunakan!";
    } else {
        // upload gambar
        $gambarPath = "";
        if (!empty($_FILES['gambar']['name'])) {
            $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $namaFile = uniqid('img_') . '.' . $ext;
            move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadDir . $namaFile);
            $gambarPath = 'uploads/' . $namaFile; // path lokal
        }

        $_SESSION['daftar'][] = [
            'id' => $id,
            'nama' => $nama,
            'harga' => $harga,
            'stok' => $stok,
            'gambar' => $gambarPath
        ];
        $pesan = "Data berhasil ditambahkan!";
    }
}

// Handle hapus
if (isset($_GET['hapus'])) {
    $idHapus = $_GET['hapus'];
    $index = cariIndexById($idHapus);
    if ($index != -1) {
        // hapus file gambar juga
        $gambar = $_SESSION['daftar'][$index]['gambar'];
        if (!empty($gambar) && file_exists(__DIR__ . '/' . $gambar)) {
            unlink(__DIR__ . '/' . $gambar);
        }

        unset($_SESSION['daftar'][$index]);
        $_SESSION['daftar'] = array_values($_SESSION['daftar']); // rapikan index array
        $pesan = "Data berhasil dihapus!";
    }
}

// Handle update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $index = cariIndexById($id);
    if ($index != -1) {
        $_SESSION['daftar'][$index]['nama'] = $nama;
        $_SESSION['daftar'][$index]['harga'] = $harga;
        $_SESSION['daftar'][$index]['stok'] = $stok;

        // update gambar kalau upload baru
        if (!empty($_FILES['gambar']['name'])) {
            // hapus gambar lama
            $gambarLama = $_SESSION['daftar'][$index]['gambar'];
            if (!empty($gambarLama) && file_exists(__DIR__ . '/' . $gambarLama)) {
                unlink(__DIR__ . '/' . $gambarLama);
            }
            $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $namaFile = uniqid('img_') . '.' . $ext;
            move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadDir . $namaFile);
            $_SESSION['daftar'][$index]['gambar'] = 'uploads/' . $namaFile;
        }

        $pesan = "Data berhasil diupdate!";
    } else {
        $pesan = "ID tidak ditemukan untuk update!";
    }
}

// Handle cari barang spesifik
if (isset($_GET['cari'])) {
    $idCari = $_GET['idcari'];
    $idx = cariIndexById($idCari);
    if ($idx != -1) {
        $cariBarang = $_SESSION['daftar'][$idx];
    } else {
        $pesan = "Data dengan ID $idCari tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Toko Elektronik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .message {
            text-align: center;
            padding: 10px;
            margin-bottom: 15px;
            background: #e7f3ff;
            border: 1px solid #b3daff;
            border-radius: 5px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: inline-block;
            width: 80px;
        }

        input {
            width: calc(100% - 100px);
            padding: 5px;
            margin-bottom: 10px;
        }

        button {
            padding: 6px 12px;
            margin-right: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
        }

        button[name="update"] {
            background-color: #2196F3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #2196F3;
            color: white;
        }

        a.hapus {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }

        a.hapus:hover {
            text-decoration: underline;
        }

        img {
            max-width: 80px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Manajemen Barang Elektronik</h2>
        <?php if (!empty($pesan)): ?>
            <div class="message"><?= htmlspecialchars($pesan) ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <label>ID:</label><input type="text" name="id" required><br>
            <label>Nama:</label><input type="text" name="nama" required><br>
            <label>Harga:</label><input type="number" name="harga" required><br>
            <label>Stok:</label><input type="number" name="stok" required><br>
            <label>Gambar:</label><input type="file" name="gambar"><br>
            <button type="submit" name="tambah">Tambah</button>
            <button type="submit" name="update">Update</button>
        </form>

        <h3>Cari Barang Berdasarkan ID</h3>
        <form method="get">
            <label>ID:</label><input type="text" name="idcari" required>
            <button type="submit" name="cari">Cari</button>
        </form>

        <?php if ($cariBarang): ?>
            <h4>Hasil Pencarian</h4>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Gambar</th>
                </tr>
                <tr>
                    <td><?= htmlspecialchars($cariBarang['id']) ?></td>
                    <td><?= htmlspecialchars($cariBarang['nama']) ?></td>
                    <td>Rp <?= number_format($cariBarang['harga'], 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($cariBarang['stok']) ?></td>
                    <td>
                        <?php if (!empty($cariBarang['gambar'])): ?>
                            <img src="<?= htmlspecialchars($cariBarang['gambar']) ?>">
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        <?php endif; ?>

        <h2>Daftar Barang</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
            <?php if (empty($_SESSION['daftar'])): ?>
                <tr>
                    <td colspan="6">Belum ada data nihh</td>
                </tr>
            <?php else: ?>
                <?php foreach ($_SESSION['daftar'] as $barang): ?>
                    <tr>
                        <td><?= htmlspecialchars($barang['id']) ?></td>
                        <td><?= htmlspecialchars($barang['nama']) ?></td>
                        <td>Rp <?= number_format($barang['harga'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($barang['stok']) ?></td>
                        <td>
                            <?php if (!empty($barang['gambar'])): ?>
                                <img src="<?= htmlspecialchars($barang['gambar']) ?>" alt="gambar">
                            <?php endif; ?>
                        </td>
                        <td><a class="hapus" href="?hapus=<?= $barang['id'] ?>">Hapus</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>