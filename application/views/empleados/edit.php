<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="container">
<br>
<br>

<p class="h3">Edicion</p>


<?php echo form_open('cempleados/edit'); ?>
<input type="hidden" name="id" value="<?php echo $empleado['id']; ?>"/>
  <div class="form-row">
    <div class="form-group col-md-6">
        <label for="input1">nombres</label>
        <input type="text" class="form-control" id="input1" placeholder="nombres" name="nombres" value="<?php echo $empleado['nombres']; ?>">
        <small class="text-danger"><?php echo form_error('nombres'); ?></small>
    </div>
    <div class="form-group col-md-6">
      <label for="input2">apellidos</label>
      <input type="text" class="form-control" id="input2" placeholder="apellidos" name="apellidos" value="<?php echo $empleado['apellidos']; ?>">
      <small class="text-danger"><?php echo form_error('apellidos'); ?></small>
    </div>
  </div>

  <div class="form-group">
    <label for="email">email</label>
    <input type="email" class="form-control" id="email" placeholder="cocos @ cocos" name="correo"  value="<?php echo $empleado['correo']; ?>" >
    <small class="text-danger"><?php echo form_error('correo'); ?></small>
  </div>
</div>
<button type="submit" class="btn btn-primary">editar</button>

<?php echo form_close();?>       