<?php
  $xyz = date('YmmddHis');

  if ($data == 'user') {
    ?>
      <script src="<?php echo base_url();?>assets/javascript/user/User.js?version=<?php echo $xyz;?>"></script>
    <?php
  }
  else if ($data == 'mSatuan'){
    ?>
      <script src="<?php echo base_url();?>assets/javascript/mSatuan/mSatuan.js?version=<?php echo $xyz;?>"></script>
    <?php
  }
  else if ($data == 'mKerja'){
    ?>
      <script src="<?php echo base_url();?>assets/javascript/mKerja/mKerja.js?version=<?php echo $xyz;?>"></script>
    <?php
  }
  else if ($data == 'mCardKerja'){
    ?>
      <script src="<?php echo base_url();?>assets/javascript/mCardKerja/mCardKerja.js?version=<?php echo $xyz;?>"></script>
    <?php
  }
  else if ($data == 'transaction'){
    ?>
      <script src="<?php echo base_url();?>assets/javascript/transaction/transaction.js?version=<?php echo $xyz;?>"></script>
    <?php
  }
  else if ($data == 'recTransaction'){
    ?>
      <script src="<?php echo base_url();?>assets/javascript/recTransaction/recTransaction.js?version=<?php echo $xyz;?>"></script>
    <?php
  }
  else if ($data == 'rTransaction'){
    ?>
      <script src="<?php echo base_url();?>assets/javascript/rTransaction/rTransaction.js?version=<?php echo $xyz;?>"></script>
    <?php
  }
  else if ($data == 'menu'){
    ?>
      <script src="<?php echo base_url();?>assets/javascript/mMenu/mMenu.js?version=<?php echo $xyz;?>"></script>
    <?php
  }
?>