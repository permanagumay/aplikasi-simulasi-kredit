<?php
ini_set('display_errors', 'On');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Simulasi kredit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


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
            document.getElementById('input' + counter).innerHTML = "<b>Grace Period  : </b><input type='text' placeholder='Dalam jumlah bulan' name='grace' id='grace' class='form-control' value=0>";
            counter++;
        }

    </script>


</head>
<body>
<div class="container">
    <!-- twitter content -->
    <div id="form-content" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Grace Period</h4>
                </div>
                <form class="graceForm">
                    <div class="modal-body">
                        <div class="modal-form">
                            <label class="control-lable">Grace Period :</label>
                        </div>
                        <div class="modal-form">
                            <input type="text" class="form-control" placeholder="Dalam jumlah bulan" name="graceText"
                                   onkeyup="validAngka(this)" value=0>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-success" id="submit">Submit</button>
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>

    <!-- end twitter content-->

    <div class="panel panel-heading">
        <h3 class="section-title"><span>Simulasi Kredit</span></h3>
    </div> <!--end of header-->
    <div class="panel panel-body">
        <form action="#" method="post">
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-lable"><b>Nama Nasabah :</b></label>
                </div>
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Nama" name="nama" onkeyup="ValidateNama()"
                           id="nama" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-lable"><b>Jumlah Pinjaman :</b></label>
                </div>
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Pinjaman" name="jumlah"
                           onkeyup="validAngka(this)" id="jumlah" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-lable"><b>Rate :</b></label>
                </div>
                <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Bunga dalam setahun" name="rate"
                           onkeyup="validAngka(this)" id="rate" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-lable"><b>Lama peminjaman :</b></label>
                </div>
                <div class="col-md-12">
                    <input type="text" name="lama" id="lama" class="form-control" placeholder="Dalam hitungan bulan"
                           onkeyup="validAngka(this)" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-lable"><b>Jenis Bunga :</b></label>
                </div>
                <div class="col-md-6">
                    <select name="jns_bng" id="jns_bng" class="form-control" required>
                        <option value="1">Anuitas</option>
                        <option value="2">Effektif</option>
                        <option value="3">Flat</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <a data-toggle="modal" data-target="#form-content" class="btn btn-primary">Grace Period</a>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input type="submit" name="btn-kalkulasi" class="btn btn-primary btn-flat pull-left"
                           value="Kalkulasi">
                </div>
            </div>
        </form>
        <hr>

    </div> <!--end of body-->
    <div class="panel panel-footer">
    </div>
</div> <!--end of container-->


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