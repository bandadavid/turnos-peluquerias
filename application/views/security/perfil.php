<br>

<div class="container-fluid">
  <br>
  <div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
      <br>
      <div class="" style="border:2px solid #1D1A49; padding-left:40px; padding-right:40px; border-radius:10px;">
        <br>
        <form id="frm_cambiar_password" class=""
        action="<?php echo site_url('security/cambiarPassword'); ?>" method="post">
            <center>
              <b style="font-size:20px;">CAMBIAR CONTRASEÑA <br></b> <br>
            </center>
            <div class="row form-group">
                <div class="col-md-12">
                    <b>USUARIO: </b> <br>
                    <input type="text" class="form-control" name="usuario_usu" id="usuario_usu"
                    placeholder="Ingrese su usuario" required disabled
                    value="<?php echo $this->session->userdata("Conectad0")->usuario_usu; ?>">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <b>CONTRASEÑA ACTUAL: </b> <br>
                    <input type="password" class="form-control" name="password_actual" id="password_actual"
                    placeholder="Ingrese su contraseña actual" required>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <b>CONTRASEÑA NUEVA: </b> <br>
                    <input type="password" class="form-control" name="password_nueva" id="password_nueva"
                    placeholder="Ingrese su contraseña nueva" required>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <b>CONFIRME SU CONTRASEÑA NUEVA: </b> <br>
                    <input type="password" class="form-control" name="password_confirmada" id="password_confirmada"
                    placeholder="Confirme su contraseña nueva" required>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" name="button" class="btn btn-primary">
                      <i class="fa fa-pen"></i> ACTUALIZAR
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
<br><br><br>


<script type="text/javascript">
  $("#frm_cambiar_password").validate({
    rules:{
      password_actual:{
        required:true
      },
      password_nueva:{
        required:true,
        minlength:6,
      },
      password_confirmada:{
        required:true,
        equalTo:"#password_nueva"
      }
    },
    messages:{
      password_actual:{

      },
      password_nueva:{

      },
      password_confirmada:{
        equalTo:"La nueva contraseña ingresada no coincide"
      }
    }
  });

</script>
