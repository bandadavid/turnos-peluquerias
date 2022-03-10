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

        $('.error').closest('tr').css('background-color', '#FFC3C0');
        $('.success').closest('tr').css('background-color', '#7ee19a');
    });
</script>