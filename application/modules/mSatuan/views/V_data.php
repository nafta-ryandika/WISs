<table id="tableSatuan" class="table table-bordered table-striped">
  <thead style="text-align: center;">
    <tr>
      <th>Action</th>
      <th>Satuan ID</th>
      <th>Satuan Name</th>
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
              <i class="fas fa-edit" style="cursor : pointer;" title="Edit" onclick="editData(\''.$row->satuan_id.'\')"></i>
              <i class="fas fa-trash" style="cursor : pointer;" title="Delete" onclick="deleteData(\''.$row->satuan_id.'\')"></i>
            </td>';
      echo '<td>'.$row->satuan_id.'</td>';
      echo '<td>'.$row->satuan_name.'</td>';
      echo '<td style="text-align: center;">'.$row->satuan_created_by.'</td>';
      echo '<td style="text-align: center;">'.$row->satuan_created_at.'</td>';
    echo '</tr>';
  }
?>
  </tbody>
</table>