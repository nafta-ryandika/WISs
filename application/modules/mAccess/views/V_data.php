<table id="tableUser" class="table table-bordered table-striped">
  <thead style="text-align: center;">
    <tr>
      <th>Action</th>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Department</th>
      <th>Division</th>
      <th>Level</th>
      <th>Create</th>
    </tr>
  </thead>
  <tbody>

<?php
  $i = 0;
  foreach($data as $row){
    $i++;
    echo '<tr>';
      echo '<td style="text-align: center;">
              <i class="fas fa-edit" style="cursor : pointer;" title="Edit" onclick="editData(\''.$row->user_id.'\')"></i>
              <i class="fas fa-trash" style="cursor : pointer;" title="Delete" onclick="deleteData(\''.$row->user_id.'\')"></i>
            </td>';
      echo '<td style="text-align: center;">'.$row->user_id.'</td>';
      echo '<td>'.$row->user_name.'</td>';
      echo '<td>'.$row->user_email.'</td>';
      echo '<td>'.$row->user_department.'</td>';
      echo '<td>'.$row->user_division.'</td>';
      echo '<td>'.$row->user_level.'</td>';
      echo '<td style="text-align: center;">'.$row->user_created_at.'</td>';
    echo '</tr>';
  }
?>
  </tbody>
</table>