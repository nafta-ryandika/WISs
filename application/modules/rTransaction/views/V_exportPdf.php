<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title_pdf;?></title>
        <style>
            table {
                border-collapse: collapse;
            }

            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
                background-color: transparent;
            }

            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            }

            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
            }

            .table tbody + tbody {
                border-top: 2px solid #dee2e6;
            }

            .table-bordered {
                border: 1px solid #dee2e6;
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #dee2e6;
            }

            .table-bordered thead th,
            .table-bordered thead td {
                border-bottom-width: 2px;
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid #dee2e6 !important;
            }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, 0.05);
            }

            header{
        position: fixed;
        left: 0px;
        right: 0px;
        height: 60px;
        margin-top: 60px;
      }
        </style>
    </head>
    <body>
        <div style="text-align:center">
            <h3>Report Transaction</h3>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Pekerjaan</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i = 0;
                foreach($data as $row){
                    $i++;
                    $subtotal = ($row->jumlah)*($row->harga);
                    echo '<tr>';
                        echo '<td style="text-align: center;">'.$i.'</td>';
                        echo '<td style="text-align: center;">'.$row->id.'</td>';
                        echo '<td style="text-align: center;">'.$row->name.'</td>';
                        echo '<td style="text-align: center;">'.$row->date.'</td>';
                        echo '<td style="text-align: center;">'.$row->pekerjaan.'</td>';
                        echo '<td style="text-align: center;">'.$row->jumlah.'</td>';
                        echo '<td style="text-align: center;">'.$row->satuan.'</td>';
                        echo '<td style="text-align: right;">'.number_format($row->harga).'</td>';
                        echo '<td style="text-align: right;">'.number_format($subtotal).'</td>';
                    echo '</tr>';
                }
            ?>
            </tbody>
        </table>
    </body>
</html>