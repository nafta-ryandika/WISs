<table id="tableData" class="table table-bordered table-striped">
  <thead style="text-align: center;">
    <tr>
      <th>Get Data Absensi</th>
      <th>ID</th>
      <th>Name</th>
      <th>Department</th>
      <th>Division</th>
      <th>Date</th>
      <th>Device</th>
    </tr>
  </thead>
  <tbody>

<?php
  $i = 0;
  foreach($data as $row){
    $i++;
    echo '<tr>';
      echo '<td style="text-align: center;">'.$row->data_txt.'</td>';
      echo '<td style="text-align: center;">'.$row->data_user.'</td>';
      echo '<td style="text-align: center;">'.$row->data_name.'</td>';
      echo '<td style="text-align: center;">'.$row->department_name.'</td>';
      echo '<td style="text-align: center;">'.$row->division_name.'</td>';
      echo '<td style="text-align: center;">'.$row->data_date.'</td>';
      echo '<td style="text-align: center;">'.$row->data_address.'</td>';
    echo '</tr>';
  }
?>
  </tbody>
</table>