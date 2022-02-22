<div class="container-fluid">
  <br>
  <div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
      <br>
      <div class="" style="border:2px solid #1D1A49; padding-left:40px; padding-right:40px; border-radius:10px;">
        <br>
        <form class="" action="<?php echo site_url('security/ingresar'); ?>" method="post">
            <center>
              <b style="font-size:20px;">INGRESAR AL SISTEMA <br></b> <br>
            </center>
            <div class="row form-group">
                <div class="col-md-12">
                    <b>USUARIO: </b> <br>
                    <input type="text" class="form-control" name="usuario_usu" id="usuario_usu"
                    placeholder="Ingrese su usuario" required>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <b>CONTRASEÑA: </b> <br>
                    <input type="password" class="form-control" name="password_usu" id="password_usu"
                    placeholder="Ingrese su contraseña" required>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" name="button" class="btn btn-primary">
                      <i class="fa fa-check"></i> INGRESAR
                    </button>
                    &nbsp;&nbsp;&nbsp;
                    <a href="<?php echo site_url(); ?>" class="btn btn-danger">
                      <i class="fa fa-times"></i> CANCELAR
                    </a>
                </div>
            </div>
        </form>
        <br>
      </div>
    </div>
  </div>

</div>
 <br>


<script type="text/javascript">
   

    <?php if ($this->session->flashdata("usuario")): ?>
      $("#usuario_usu").val("<?php echo $this->session->flashdata("usuario"); ?>");
      $("#password_usu").focus();
    <?php else: ?>
      $("#usuario_usu").focus();
    <?php endif; ?>
</script>
<br>
<br>
