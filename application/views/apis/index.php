<script type="text/javascript">
    $("#administracion").addClass("active");
</script>

<br>


<div class="container-fluid">
    <div class="col-md-12">
        <!-- Gallery -->
        <div class="row">
            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                <a href="<?php echo site_url(); ?>/usuarios/listarUsuarios">
                    <p>API USUARIOS</p>
                </a>
                <a href=" <?php echo site_url(); ?>/usuarios/listarUsuarios"><img src="<?php echo base_url(); ?>/assets/imagenes/api.png" class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" /></a>


            </div>
            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                <a href="<?php echo site_url(); ?>/disponibilidades/listarDisponibilidades">
                    <p>API DISPONIBILIDAD</p>
                </a>
                <a href=" <?php echo site_url(); ?>/disponibilidades/listarDisponibilidades"><img src="<?php echo base_url(); ?>/assets/imagenes/api.png" class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" /></a>

            </div>
            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                <a href="<?php echo site_url(); ?>/reservas/listarReservas">
                    <p>API TURNOS</p>
                </a>
                <a href=" <?php echo site_url(); ?>/reservas/listarReservas"><img src="<?php echo base_url(); ?>/assets/imagenes/api.png" class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" /></a>

            </div>
            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                <a href="<?php echo site_url(); ?>/servicios/listarServicios">
                    <p>API SERVICIOS</p>
                </a>
                <a href=" <?php echo site_url(); ?>/servicios/listarServicios"><img src="<?php echo base_url(); ?>/assets/imagenes/api.png" class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" /></a>

            </div>
        </div>
        <!-- Gallery -->
    </div>
</div>
<br><br><br><br>


<script type="text/javascript">
    $(document).ready(function() {
        $("#field-hora_inicio_dis").prop("type", "time");
        $("#field-hora_fin_dis").prop("type", "time");
    });
</script>