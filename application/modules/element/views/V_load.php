<?php
  $xyz = date('YmmddHis');

  if ($data == 'user') {
    ?>
      <script src="<?php echo base_url();?>assets/javascript/user/User.js?version=<?php echo $xyz;?>"></script>
    <?php
  }
  else if ($data == 'getDataAbsensi'){
    ?>
      <script src="<?php echo base_url();?>assets/javascript/getDataAbsensi/getDataAbsensi.js?version=<?php echo $xyz;?>"></script>
    <?php
  }
  else if ($data == 'menu'){
    ?>
      <script src="<?php echo base_url();?>assets/javascript/mMenu/mMenu.js?version=<?php echo $xyz;?>"></script>
    <?php
  }
?>