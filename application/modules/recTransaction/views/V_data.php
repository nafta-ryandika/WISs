<table id="tableRecTransaction" class="table table-bordered table-striped" style="font-size: 21px">
  <thead style="text-align: center;">
    <tr>
      <th>No</th>
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
  $total = 0;
  if($data) {
    foreach($data as $row){
      $i++;
      $subtotal = ($row->jumlah)*($row->harga);
      echo '<tr>';
        echo '<td style="text-align: center;">'.$i.'</td>';
        echo '<td style="text-align: center;">'.$row->pekerjaan.'</td>';
        echo '<td style="text-align: center;">'.$row->jumlah.'</td>';
        echo '<td style="text-align: center;">'.$row->satuan.'</td>';
        echo '<td style="text-align: right;">'.number_format($row->harga).'</td>';
        echo '<td style="text-align: right;">'.number_format($subtotal).'</td>';
      echo '</tr>';

      $total = $total + $subtotal;
    }
  }
?>
  </tbody>
  <tfoot style="text-align: center; font-size: 25px">
    <tr>
      <th colspan="5">Total</th>
      <th style="text-align: right;"><?=number_format($total)?></th>
    </tr>
  </tfoot>
</table>