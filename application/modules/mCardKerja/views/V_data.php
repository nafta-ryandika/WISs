<table id="tableCardKerja" class="table table-bordered table-striped">
  <thead style="text-align: center;">
    <tr>
      <!-- <th>Action</th> -->
      <th>ID Card</th>
      <th>Pekerjaan</th>
    </tr>
  </thead>
  <tbody>

<?php
  $i = 0;
  foreach($data as $row){
    $i++;
    echo '<tr>';
      // echo '<td style="text-align: center;">
      //         <i class="fas fa-edit" style="cursor : pointer;" title="Edit" onclick="editData(\''.$row->id.'\')"></i>
      //         <i class="fas fa-trash" style="cursor : pointer;" title="Delete" onclick="deleteData(\''.$row->id.'\')"></i>
      //       </td>';
      echo '<td style="text-align: center;">'.$row->id.'</td>';
      echo '<td style="text-align : center;">'.$row->kerja_name.'</td>';
    echo '</tr>';
  }
?>
  </tbody>
</table>