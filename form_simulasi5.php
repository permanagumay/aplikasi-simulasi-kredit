<?php
ini_set('display_errors', 'Off');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Simulai Kredit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>-->

    <style>
        .zebra-table {
            box-shadow: 0 2px 3px 1px #ddd;
            overflow: hidden;
            border: 10px solid #fff;
            border-collapse: collapse;
        }

        .zebra-table td {
            vertical-align: top;
            padding: 8px 5px;
            font-size: smaller;
            margin: 0;
        }

        .zebra-table th {
            vertical-align: top;
            padding: 8px 5px;
            text-align: center;
            margin: 0;
            font-size: smaller;
        }

        .zebra-table tbody th {
            background: #34495E;
            color: #fff;
        }

        .zebra-table tbody tr:nth-child(odd) {
            background: #DADFE1;
        }
    </style>
    <script type="text/javascript" language="JavaScript">
        function ValidateNama() {
            var characterOnly = document.getElementById('nama').value;
            if (characterOnly.search(/^[a-zA-Z]/) === -1) {
                alert("Inputan hanya huruf!!");
                document.getElementById('nama').value = "";
            }

        }

        function cetak() {
            print();
        }

        function validAngka(a) {
            if (!/^[0-9.]+$/.test(a.value)) {
                a.value = a.value.substring(0, a.value.length - 1000);
            }
        }

        function printDiv(elementId) {
            var y = document.getElementById('print-area1').value;
            var x = document.getElementById(elementId).innerHTML;
            window.frames["print_frame"].document.title = document.title;
            window.frames["print_frame"].document.body.innerHTML = '<style>' + y + '</style>' + x;
            window.frames["print_frame"].window.focus();
            window.frames["print_frame"].window.print();

        }

        counter = 0;
        function tambahField() {
            counterNext = counter + 1;
            document.getElementById('input' + counter).innerHTML = "<b>Grace Period  : </b><input type='text' onkeyup='validAngka(this)' placeholder='Dalam jumlah bulan' name='grace' id='grace' class='form-control' value=0 >";
            counter++;
        }

    </script>

</head>
<body>
<?php
function buatrp($angka)
{
    $jadi = number_format($angka, 2, ',', '.');
    return $jadi;
}

function buat($angka)
{
    $rp = "Rp. " . number_format($angka, 2, ',', '.');
    return $rp;
}

?>

<div class="container">
    <h2 class="section-title"><span>Simulasi Kredit</span></h2>
    <form action="" method="POST">
        <b>Nama Nasabah : </b>
        <input name="nama" class="form-control" id="nama" value="<?php echo $nama; ?>" onkeyup="ValidateNama()"
               placeholder="Nama Nasabah" required>

        <b>Jumlah Pinjaman : </b>
        <input name="jumlah" id="jumlah" class="form-control" value="<?php echo $jumlah ?>" onkeyup="validAngka(this)"
               placeholder="Pinjaman" required>

        <b>Rate : </b>
        <input name="rate" id="rate" class="form-control" value="<?php echo $rate ?>" onkeyup="validAngka(this)"
               placeholder="Bunga dalam setahun" required>

        <b>Lama Peminjaman : </b>
        <input name="lama" id="lama" class="form-control" value="<?php echo $lama ?>" onkeyup="validAngka(this)"
               placeholder="Jumlah Bulan" required>

        <b>Tipe Jenis Bunga : </b>
        <select name="jns_bng" id="jns_bng" class="form-control">
            <option value="1">Anuitas</option>
            <option value="2">Effektif</option>
            <option value="3">Flat</option>
        </select><br>

        <div id="input0"></div>
        <a href="javascript:tambahField();">Grace Period</a><br>

        <input type="submit" name="btn-kalkulasi" class="btn btn-primary" value="Kalkulasi">

    </form>
    <hr>

    <div id="print-area1">
        <?php
        if (isset($_POST['btn-kalkulasi'])) {
        $jumlah_pinjaman = $_POST['jumlah'];
        $lama_pinjaman = $_POST['lama'];
        $nama = $_POST['nama'];
        $rate = $_POST['rate'];
        $jns_bng = $_POST['jns_bng'];
        $bulan = 12;
        $grace = $_POST['grace'];

        if(empty($_POST['grace'])){
            $grace = 0;

        }


        if ($jns_bng == 3 && $rate != 0 && $lama_pinjaman != 0) {
            $bunga_perbulan = $rate / 12;
            $bunga_rp = $jumlah_pinjaman / $rate;
            $angsuran_bunga = ($jumlah_pinjaman * $bunga_perbulan) / 100;
            $angsuran_pokok = $jumlah_pinjaman / $lama_pinjaman;
            $jumlah = $angsuran_pokok + $angsuran_bunga;
            $type = 'Flat';

            ?>

            <?php
            echo "<pre>";
            echo "Nama Nasabah             = " . "<b>" . $nama . "</b>" . "<br>";
            echo "Outstanding              = " . "<b>" . buat($jumlah_pinjaman) . "</b>" . "<br>";
            echo "Lama Pinjaman            = " . "<b>" . $lama_pinjaman . " Bulan" . "</b>" . "<br>";
            echo "Bunga per tahun          = " . "<b>" . $rate . ' %' . "</b>" . "<br>";
            echo "Jenis Bunga              = " . "<b>" . $type . "</b>" . '<br>';
            echo "<br>";
            //echo "Angsuran Pokok Per Bulan = "."<b>".buatrp($angsuran_pokok)."</b>"."<br>";
            //echo "Angsuran Bunga Per Bulan = "."<b>".buatrp($angsuran_bunga)."</b>"."<br>";
            //echo "                           _____________________ ( + )<br>";
            //echo "Total Angsuran Per Bulan = "."<b>".buatrp($jumlah)."</b>";
            echo "</pre>";

            $row = $jumlah_pinjaman;
            $no = 1;
            ?>
            <table class="table zebra-table" id="ell">
                <tr>
                    <th></th>
                    <th></th>
                    <th>Tabel Simulasi Kredit</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>Angsuran ke -</th>
                    <th>Principal</th>
                    <th>Interest</th>
                    <th>Total Payment</th>
                    <th>Outstanding</th>
                </tr>
                <tr>
                    <td align="center">0</td>
                    <td align="right">0</td>
                    <td align="right">0</td>
                    <td align="right">0</td>
                    <td align="right"><?php echo buatrp($jumlah_pinjaman); ?></td>
                </tr>

                <?php while ($row > 1) {
                    $row = $row - $angsuran_pokok;
                    if ($row < 0) {
                        $totdong = 0;
                    } else {
                        $totdong = $row;
                    }
                    ?>

                    <tr>
                        <td align="center"><?php echo $no++; ?></td>
                        <td align="right"><?php echo buatrp($angsuran_pokok); ?></td>
                        <td align="right"><?php echo buatrp($angsuran_bunga); ?></td>
                        <td align="right"><?php echo buatrp($jumlah); ?></td>
                        <td align="right"><?php echo buatrp($totdong); ?></td>
                    </tr>

                <?php } //end of while
                $tot_ang_pokok = $angsuran_pokok * $lama_pinjaman;
                $tot_ang_bunga = $angsuran_bunga * $lama_pinjaman;
                $tot_jumlah = $jumlah * $lama_pinjaman;
                ?>
                <tr>
                    <td></td>
                    <td align="right"><b><?php echo buatrp($tot_ang_pokok); ?></b></td>
                    <td align="right"><b><?php echo buatrp($tot_ang_bunga); ?></b></td>
                    <td align="right"><b><?php echo buatrp($tot_jumlah); ?></b></td>
                    <td></td>
                </tr>
            </table>

            <?php

        } else if ($jns_bng == 2 && $rate != 0 && $lama_pinjaman != 0) {
            $totbung = 0;
            $angsuran_bunga = (($jumlah_pinjaman * $rate) / 100) * (30 / 360);
            $angsuran_pokok = $jumlah_pinjaman / $lama_pinjaman;
            //$jumlah = $angsuran_pokok+$angsuran_bunga;
            $type = 'Efektif';


            echo "<pre>";
            echo "Nama Nasabah             = " . "<b>" . $nama . "</b>" . "<br>";
            echo "Outstanding              = " . "<b>" . buat($jumlah_pinjaman) . "</b>" . "<br>";
            echo "Lama Pinjaman            = " . "<b>" . $lama_pinjaman . " Bulan" . "</b>" . "<br>";
            echo "Bunga per tahun          = " . "<b>" . $rate . ' %' . "</b>" . "<br>";
            echo "Jenis Bunga              = " . "<b>" . $type . "</b>" . '<br>';
            echo "<br>";
            //echo "Angsuran Pokok Per Bulan = "."<b>".buatrp($angsuran_pokok)."</b>"."<br>";
            //echo "Angsuran Bunga Per Bulan = "."<b>".buatrp($angsuran_bunga)."</b>"."<br>";
            //echo "                           _____________________ ( + )<br>";
            //echo "Total Angsuran Per Bulan = "."<b>".buatrp($jumlah)."</b>";
            echo "</pre>";

            $row = $jumlah_pinjaman;
            $no = 1;
            $flower = $angsuran_bunga;
            ?>

            <table class="table zebra-table" id="ell">
                <tr>
                    <th></th>
                    <th></th>
                    <th>Tabel Simulasi Kredit</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>Angsuran ke -</th>
                    <th>Principal</th>
                    <th>Interest</th>
                    <th>Total Payment</th>
                    <th>Outstanding</th>
                </tr>
                <tr>
                    <td align="center">0</td>
                    <td align="right">0</td>
                    <td align="right">0</td>
                    <td align="right">0</td>
                    <td align="right"><?php echo buatrp($jumlah_pinjaman); ?></td>
                    <!--<td align="right"><?php echo buatrp($jumlah_pinjaman); ?></td>-->
                </tr>

                <?php while ($row > 1) {

                    if ($row == $jumlah_pinjaman) {
                        $flower = $angsuran_bunga;
                        $jumlah = $angsuran_pokok + $angsuran_bunga;
                    } else {
                        $flower = (($row * $rate) / 100) / 12;
                        $jumlah = $angsuran_pokok + $flower;
                    }
                    $row = $row - $angsuran_pokok;
                    $totbung = $totbung + $flower;


                    if ($row < 0) {
                        $totdong = 0;
                    } else {
                        $totdong = $row;
                    }
                    ?>

                    <tr>
                        <td align="center"><?php echo $no++; ?></td>
                        <td align="right"><?php echo buatrp($angsuran_pokok); ?></td>
                        <td align="right"><?php echo buatrp($flower); ?></td>
                        <td align="right"><?php echo buatrp($jumlah); ?></td>
                        <td align="right"><?php echo buatrp($totdong); ?></td>
                    </tr>

                <?php } //end of while

                $tot_ang_pokok = $angsuran_pokok * $lama_pinjaman;
                $tot_ang_bunga = $totbung;
                $tot_jumlah = $tot_ang_bunga + $tot_ang_pokok;
                ?>
                <tr>
                    <td></td>
                    <td align="right"><b><?php echo buatrp($tot_ang_pokok); ?></b></td>
                    <td align="right"><b><?php echo buatrp($tot_ang_bunga); ?></b></td>
                    <td align="right"><b><?php echo buatrp($tot_jumlah); ?></b></td>
                    <td></td>
                </tr>
            </table>
            <?php
        } else if ($jns_bng == 1 && $rate != 0 && $lama_pinjaman != 0) {
            $tampok = 0;
            $totbung = 0;
            $a = $jumlah_pinjaman * (($rate / 100) / 12);
            $b = 1 - 1 / (exp(($lama_pinjaman-$grace) * log(1 + (($rate / 100) / 12))));
            $anuitas = $a / $b;

            $angsuran_bunga = ($jumlah_pinjaman * ($rate / 100)) / 12;
            $type = 'Anuitas';


            echo "<pre>";
            echo "Nama Nasabah             = " . "<b>" . $nama . "</b>" . "<br>";
            echo "Outstanding              = " . "<b>" . buat($jumlah_pinjaman) . "</b>" . "<br>";
            echo "Lama Pinjaman            = " . "<b>" . $lama_pinjaman . " Bulan" . "</b>" . "<br>";
            echo "Bunga per tahun          = " . "<b>" . $rate . ' %' . "</b>" . "<br>";
            echo "Angsuran                 = " . "<b>" . buat($anuitas) . "</b>" . "<br>";
            echo "Jenis Bunga              = " . "<b>" . $type . "</b>" . "<br>";
            echo "Grace Period             = " . "<b>" . $grace . " Bulan" . "</b>" . "<br>";
            echo "<br>";
            echo "</pre>";

            $row = $jumlah_pinjaman;
            $no = 1;
            $tenggang = 0;
            $periode = $grace;
            ?>
            <table class="table zebra-table" id="ell">
                <tr>
                    <th></th>
                    <th></th>
                    <th>Tabel Simulasi Kredit</th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>Angsuran ke -</th>
                    <th>Principal</th>
                    <th>Interest</th>
                    <th>Total Payment</th>
                    <th>Outstanding</th>
                </tr>
                <tr>
                    <td align="center">0</td>
                    <td align="right">0</td>
                    <td align="right">0</td>
                    <td align="right">0</td>
                    <td align="right"><?php echo buatrp($jumlah_pinjaman); ?></td>
                </tr>

                <?php

                while ($row > 1) {
                    if ($grace == 0) {
                        if ($row == $jumlah_pinjaman) {
                            $flower = $angsuran_bunga;
                            $angsuran_pokok = $anuitas - $angsuran_bunga;
                            $jumlah = $angsuran_pokok + $angsuran_bunga;

                        } else {
                            $flower = (($row * $rate) / 100) / 12;
                            $angsuran_pokok = $anuitas - $flower;
                            $jumlah = $angsuran_pokok + $flower;
                        }

                        $row = $row - $angsuran_pokok;
                        $tampok = $tampok + $angsuran_pokok;
                        $totbung = $totbung + $flower;

                        if ($row <= 0) {
                            $totdong = 0;
                        } else {
                            $totdong = $row;
                        }
                        ?>
                        <tr>
                            <td align="center"><?php echo $no++; ?></td>
                            <td align="right"><?php echo buatrp($angsuran_pokok); ?></td>
                            <td align="right"><?php echo buatrp($flower); ?></td>
                            <td align="right"><?php echo buatrp($anuitas); ?></td>
                            <td align="right"><?php echo buatrp($totdong); ?></td>
                        </tr>
                        <?php
                    }else{
                        if ($row == $jumlah_pinjaman ) {
                            $flower = $angsuran_bunga;
                            $angsuran_pokok = $anuitas - $angsuran_bunga;
                            $jumlah = $angsuran_pokok + $angsuran_bunga;

                        } else {

                            $flower = (($row * $rate) / 100) / 12;
                            $angsuran_pokok = $anuitas - $flower;
                            $jumlah = $angsuran_pokok + $flower;
                        }

                        $row = $row - $angsuran_pokok;
                        $tampok = $tampok + $angsuran_pokok;
                        $totbung = $totbung + $flower;

                        if ($row <= 0) {
                            $totdong = 0;
                        } else {
                            $totdong = $row;
                        }


                        while($tenggang < $grace){
                            $tenggang++;

                            ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td align="right"><?php echo buatrp(0); ?></td>
                                <td align="right"><?php echo buatrp($flower); ?></td>
                                <td align="right"><?php echo buatrp($flower); ?></td>
                                <td align="right"><?php echo buatrp($jumlah_pinjaman); ?></td>
                            </tr>
                            <?php
                            $nourut = $no;
                            $nextflower = $nextflower + $flower;

                        }
                        ?>
                        <tr>
                            <td align="center"><?php echo $nourut++; ?></td>
                            <td align="right"><?php echo buatrp($angsuran_pokok); ?></td>
                            <td align="right"><?php echo buatrp($flower); ?></td>
                            <td align="right"><?php echo buatrp($anuitas); ?></td>
                            <td align="right"><?php echo buatrp($totdong); ?></td>
                        </tr>
                        <?php
                    }//end of else
                } //end of while

                $tot_ang_pokok = $tampok;
                $tot_ang_bunga = $totbung + $nextflower;
                $tot_jumlah = $tot_ang_pokok + $tot_ang_bunga;


                ?>
                <tr>
                    <td></td>
                    <td align="right"><b><?php echo buatrp($tot_ang_pokok); ?></b></td>
                    <td align="right"><b><?php echo buatrp($tot_ang_bunga); ?></b></td>
                    <td align="right"><b><?php echo buatrp($tot_jumlah); ?></b></td>
                    <td align="right"></td>
                </tr>
            </table>

            <?php
        }//end of else
        ?>
        <a class="no-print btn btn-sm btn-warning" id="tombolExport"><span class="glyphicon glyphicon-download"></span></a>
        <a class="no-print btn btn-sm btn-warning" href="javascript:printDiv('print-area1')"><span
                class="glyphicon glyphicon-print"></span></a>
        <iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
    </div>
</div>

    <div class="container"><br></div>
<?php } ?> <!--end of isset -->

<script src="js/jquery-2.0.1.min.js"></script>
<script src="js/jquery.base64.js"></script>
<script src="js/jquery.btechco.excelexport.js"></script>
<script>
    $(document).ready(function () {
        $("#tombolExport").click(function () {
            $("#ell").btechco_excelexport({
                containerid: "ell"
                , datatype: $datatype.Table
            });
        });
    });
</script>

</body>
</html>
