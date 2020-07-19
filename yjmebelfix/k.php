<?php
    $host = "localhost"; // Nama hostnya
    $user = "root"; // Username
    $pass = ""; // Password (Isi jika menggunakan password)
    $connect = mysqli_connect($host, $user, $pass, "yj-mebel"); // Koneksi ke MySQL


     //Kode penjualan
     function kodepenjualan(){
        global $connect;

        $query = mysqli_query($connect, "select max(id_penjualan) as maxkode from transaksi_penjualan ");
        $data = mysqli_fetch_array($query);
        $kodepenjualan = $data['maxkode'];
        $nourut = (int)substr($kodepenjualan,3, 3);
        $nourut++;
        $char = "PJ";
        $kodepenjualan = $char.sprintf("%03s", $nourut);
        return $kodepenjualan;
    }

    function query($query_kedua){
        global $connect;

        $result = mysqli_query($connect, $query_kedua);
        $rows = [];
        while ($data = mysqli_fetch_assoc($result)) {
            $rows[] = $data;
        }
        return $rows;
    }



    //Edit Akun Pengawas
    function editproduk($data){
        global $connect;

        $id_barang = $data['id_barang'];
        $id_kategori = $data['id_kategori'];
        $gambar = $data['gambar']; 
        $nama_barang = $data['nama_barang'];
        $harga = $data['harga'];        
        $keterangan = $data['keterangan'];

        //update data user
        $query = "UPDATE produk SET
            id_kategori = '$id_kategori',
            nama_barang = '$nama_barang',
            keterangan = '$keterangan',
            harga = '$harga',
            gambar = '$gambar'
            WHERE id_barang = '$id_barang' ";

        mysqli_query($connect, $query);
        return mysqli_affected_rows($connect);
    }

?>

