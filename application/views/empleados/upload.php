<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="container">
  <!-- Content here -->
  <h2>InterwapTest</h2>
  <?php echo form_open_multipart('cempleados/add');?>

  <div class="form-group">
    <label for="exampleFormControlFile1">Cargar archivo</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="carga">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">enviar</button>

<?php echo form_close();?>

</div>


c