<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "arkatama";

    $connect = new mysqli($host, $username, $password, $dbname);

    if ($connect->connect_error) {
        die("Sambungan gagal". $connect->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = $_POST["data"];

        list($nama, $umur, $kota) = preg_split('/(\d+)/', $data, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $nama = strtoupper(trim($nama));
        $kota = strtoupper(trim($kota));
        $kota = preg_replace('/\s*(?:tahun|thn|th)\s*/i', '', $kota);
        $query = "INSERT INTO users (name, age, city) VALUES ('$nama', '$umur', '$kota')";

        if ($connect->query($query) == TRUE) {
            echo "Data berhasil dikirimkan";
        } else {
            echo "Error: ". $query . "<br>" . $connect->error;
        }

        $connect->close();
    }
?>