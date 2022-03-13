<script type="text/javascript">
    $("#administracion").addClass("active");
</script>

<?php
foreach ($css_files as $file) : ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />

<?php endforeach; ?>

<?php foreach ($js_files as $file) : ?>

    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<br>
<div class="container-fluid">
    <div class="col-md-12">
        <h3 class="text-center" style="color:#1D1A49;">
            <i class="fa fa-users"></i>
            GESTIÓN DE TURNOS
        </h3>
        <br>
        <?php echo $output; ?>
    </div>
</div>
<br><br><br><br>


<script type="text/javascript">
    $(document).ready(function() {
        $("#field-hora_inicio_dis").prop("type", "time");
        $("#field-hora_fin_dis").prop("type", "time");
    });
</script>

<style>
    .bg-danger {
        color: white !important;
        font-weight: bold;
        background-color: #e85759 !important;
        border-radius: 10px 10px 0px 0px;
    }

    .bg-success {
        color: white !important;
        font-weight: bold;
        background-color: #008c4d !important;
        border-radius: 10px 10px 0px 0px;
    }

    .whatsapp {
        text-align: center;
    }

    .fab {
        font-size: 22px;
        color: #3ade57;
    }
</style>