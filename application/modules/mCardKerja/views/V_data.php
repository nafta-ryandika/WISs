<table id="tableCardKerja" class="table table-bordered table-striped">
  <thead style="text-align: center;">
    <tr>
      <th><input type="checkbox" id="markAll"></th>
      <th>ID Card</th>
      <th>Pekerjaan</th>
      <th>Status</th>
      <th>Start Date</th>
      <th>End Date</th>
    </tr>
  </thead>
  <tbody>

<?php
  $i = 0;
  foreach($data as $row){
    $i++;
    $card_status = $row->card_status;

    echo '<tr>';
      echo '<td style="text-align: center;"><input type="checkbox" value="'.$row->id.'"></td>';
      echo '<td style="text-align: center;">'.$row->id.'</td>';
      echo '<td style="text-align : center;">'.$row->kerja_name.'</td>';
      echo '<td style="text-align : center;">';
        if ($card_status == 0) {
          echo '<text style="color: red; font-weight: bold;">Inactive</text>';
        }
        else if ($card_status == 1) {
          echo '<text style="color: green; font-weight: bold;">Active</text>';
        }
        else if ($card_status == 2) {
          echo '<text style="color: orange; font-weight: bold;">Used</text>';
        }
      echo '</td>';
      echo '<td style="text-align : center;">'.$row->card_start_date.'</td>';
      echo '<td style="text-align : center;">'.$row->card_end_date.'</td>';
    echo '</tr>';
  }
?>
  </tbody>
</table>