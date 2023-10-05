<table id="tableKerja" class="table table-bordered table-striped">
  <thead style="text-align: center;">
    <tr>
      <th>Action</th>
      <th>ID Pekerjaan</th>
      <th>Pekerjaan</th>
      <th>Harga</th>
      <th>Satuan</th>
      <th>Created By</th>
      <th>Created At</th>
    </tr>
  </thead>
  <tbody>

<?php
  $i = 0;
  foreach($data as $row){
    $i++;
    echo '<tr>';
      echo '<td style="text-align: center;">
              <i class="fas fa-edit" style="cursor : pointer;" title="Edit" onclick="editData(\''.$row->kerja_id.'\')"></i>
              <i class="fas fa-trash" style="cursor : pointer;" title="Delete" onclick="deleteData(\''.$row->kerja_id.'\')"></i>
            </td>';
      echo '<td>'.$row->kerja_id.'</td>';
      echo '<td>'.$row->kerja_name.'</td>';
      echo '<td>'.$row->kerja_price.'</td>';
      echo '<td>'.$row->kerja_satuan_id.'</td>';
      echo '<td style="text-align: center;">'.$row->kerja_created_by.'</td>';
      echo '<td style="text-align: center;">'.$row->kerja_created_at.'</td>';
    echo '</tr>';
  }
?>
  </tbody>
</table>