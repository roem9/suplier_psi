<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1><?= $title?></h1>
    <table border=1>
        <thead>
            <th>No</th>
            <th>Tgl. Input</th>
            <th>Tgl. Closing</th>
            <th>Jenis Customer</th>
            <th>Nama Penerima</th>
            <th>Alamat Penerima</th>
            <th>No Telepon</th>
            <th>Kode POS</th>
            <th>Berat</th>
            <th>Transfer</th>
            <th>Nominal COD</th>
            <th>Nama Produk</th>
            <th>Kelurahan</th>
            <th>Quantity</th>
            <th>Warna</th>
            <th>Ukuran</th>
            <th>Nominal Produk</th>
            <th>Catatan</th>
            <th>Dikirim Menggunakan</th>
            <th>Nama CS</th>
            <th>Stok</th>
            <th>Gudang</th>
            <th>Status Pengiriman</th>
        </thead>
        <tbody>
            <?php 
                $no = 1;
                foreach ($closing as $closing) :?>
                <tr>
                    <td><?= $no?></td>
                    <td><?= date("d-m-Y", strtotime($closing['tgl_input']))?></td>
                    <td><?= date("d-m-Y", strtotime($closing['tgl_closing']))?></td>
                    <td><?= $closing['jenis_closing']?></td>
                    <td><?= $closing['nama_closing']?></td>
                    <td><?= $closing['alamat']?></td>
                    <td><?= $closing['no_hp']?></td>
                    <td><?= $closing['kode_pos']?></td>
                    <td>1</td>
                    <?php if($closing['metode_pembayaran'] == "transfer" ):?>
                        <td><?= $closing['nominal_transaksi']?></td>
                        <td></td>
                    <?php else :?>
                        <td></td>
                        <td><?= $closing['nominal_transaksi']?></td>
                    <?php endif;?>
                    <!-- <td><?= $closing['produk']?></td> -->
                    <td><?= produk_closing($closing['id_closing'])?></td>
                    <td><?= $closing['kelurahan']?></td>
                    <td><?= $closing['qty']?></td>
                    <td></td>
                    <td></td>
                    <td><?= $closing['nominal_produk']?></td>
                    <td><?= $closing['catatan']?></td>
                    <td><?= $closing['pengirim']?></td>
                    <td><?= $closing['nama_cs']?></td>
                    <td></td>
                    <td><?= $closing['nama_gudang']?></td>
                    <td><?= $closing['status']?></td>
                </tr>
            <?php 
                $no++;
                endforeach;?>
        </tbody>
    </table>
</body>
</html>