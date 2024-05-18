<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "ta_aquaponic";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    echo "Koneksi ke database berhasil!<br>";
}

// Memeriksa apakah parameter yang diperlukan telah diatur dalam array $_GET
if (isset($_GET['tdsValue'], $_GET['suhu'], $_GET['jarakAir'], $_GET['phAir'], $_GET['jarakPakan'])) {
    $var1 = $_GET['tdsValue'];
    $var2 = $_GET['suhu'];
    $var3 = $_GET['jarakAir'];
    $var4 = $_GET['phAir'];
    $var5 = $_GET['jarakPakan'];

    echo "Parameter yang diterima:<br>";
    echo "TDS Value: " . $var1 . "<br>";
    echo "Suhu: " . $var2 . "<br>";
    echo "Jarak Air: " . $var3 . "<br>";
    echo "pH Air: " . $var4 . "<br>";
    echo "Jarak Pakan: " . $var5 . "<br>";

    $result = mysqli_query($conn, "INSERT INTO datasensors (tdsValue, suhu, jarakAir, phAir, jarakPakan) VALUES ('$var1', '$var2', '$var3', '$var4', '$var5')");

    if ($result) {
        echo "Data berhasil disimpan ke database.";
    } else {
        echo "Gagal menyimpan data ke database: " . mysqli_error($conn);
    }
} else {
    echo "Satu atau lebih parameter tidak ada.";
}

// Menutup koneksi
mysqli_close($conn);
