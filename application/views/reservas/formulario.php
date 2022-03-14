<script type="text/javascript">
  $("#solicitar").addClass("active");
</script>

<br>
<div class="row">
  <div class="col-md-12 text-center">
    <h3><b>SOLICITAR TURNO</b></h3>
  </div>
</div>
<br>


<?php
$CI = &get_instance();
$CI->load->model('reserva');
$tiempo = obtenerTiempoMaximoReunion();
$turnosDisponibles = array();

if ($disponibilidades) {
  foreach ($disponibilidades->result() as $disponibilidad) {
    //$turnosDisponibles
    $inicioTemporal = date('H:i:s', strtotime($disponibilidad->hora_inicio_dis));
    $finTemporal = date('H:i:s', strtotime($disponibilidad->hora_fin_dis));
    $turnoInicialTemporal = $inicioTemporal;

    //print_r($inicioTemporal);

    while ($turnoInicialTemporal <= date('H:i:s', strtotime($finTemporal . ' -' . $tiempo . ' minutes'))) {
      $fechaHoraTemporal = date('Y-m-d H:i:s', strtotime($disponibilidad->fecha_dis . " " . $turnoInicialTemporal));
      $turnoInicialTemporal = date('H:i:s', strtotime($turnoInicialTemporal . ' +' . $tiempo . ' minutes'));
      array_push($turnosDisponibles, $fechaHoraTemporal);
      // echo "<h3>".$fechaHoraTemporal."</h3>";
    }
    // echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$inicioTemporal."&nbsp;&nbsp;&nbsp;".$finTemporal."<br>";
  }
}

$fechaHoraHoy = date('Y-m-d H:i:s');
sort($turnosDisponibles);
$turnosDisponibles = array_values(array_unique($turnosDisponibles));
?>


<!-- <?php for ($i = 0; $i < sizeof($turnosDisponibles); $i++) { ?>

       <h3><?php echo $turnosDisponibles[$i]; ?></h3>

 <?php } ?> -->



<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">

    <div class="row">
      <div class="col-md-12">
        <div id='calendar' style="height:100% !important;"></div>
      </div>
    </div>

  </div>
</div>


<form id="frm_solicitar_reunion" action="<?php echo site_url("reservas/insertarReserva") ?>" method="post">

  <div id="modalAgendarReunion" class="modal fade" role="dialog">
    <div class="modal-dialog" style="min-width:90% !important;">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> <i class="fa fa-edit"></i> <b>Solicitar Turno</b></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-8 form-group">
                    <input type="hidden" name="fecha_hora_inicio_sol" id="fecha_hora_inicio_sol" value="">
                    <input type="hidden" name="fecha_hora_fin_sol" id="fecha_hora_fin_sol" value="">
                    <label for=""><b>Fecha y Hora del Turno:</b></label><br>
                    <select required class="form-control" name="fecha_hora" id="fecha_hora" disabled>
                      <option value="">--Seleccione--</option>
                      <?php if (sizeof($turnosDisponibles) > 0) : ?>
                        <?php for ($i = 0; $i < sizeof($turnosDisponibles); $i++) { ?>
                          <?php $solicitudExistente = $CI->reserva->obtenerReservaPorFechaHora($turnosDisponibles[$i]); ?>
                          <?php if ($turnosDisponibles[$i] > $fechaHoraHoy && !$solicitudExistente) : ?>
                            <option value="<?php echo $turnosDisponibles[$i]; ?>">
                              <?php
                              echo convertirFechaLetras($turnosDisponibles[$i]);
                              ?>
                            </option>
                          <?php endif; ?>
                        <?php } ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for=""><b>Apellidos:</b></label><br>
                    <input required type="text" name="apellido_sol" id="apellido_sol" value="" class="form-control" placeholder="Ingrese sus apellidos completos">
                  </div>
                  <div class="col-md-6 form-group">
                    <label for=""><b>Nombres:</b></label><br>
                    <input required type="text" name="nombre_sol" id="nombre_sol" value="" class="form-control" placeholder="Ingrese sus nombres completos">
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for=""><b>Celular:</b></label><br>
                    <input min="0" required type="number" name="celular_sol" id="celular_sol" value="" class="form-control" placeholder="Ingrese su número de celular">
                  </div>
                  <div class="col-md-6 form-group">
                    <label for=""><b>Servicio:</b></label><br>
                    <select name="nombre_ser" class="form-control" id="nombre_ser">
                      <option value="" selected disabled hidden>Escoge el servicio que necesite</option>
                      <?php if ($servicios) : ?>
                        <?php foreach ($servicios->result() as $servicio) : ?>
                          <option value="<?php echo $servicio->codigo_ser; ?>"><?php echo $servicio->nombre_ser; ?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>

                <br>
                <center>
                  <button type="submit" id="btn-solicitar" class="btn btn-success" name="button" onsubmit="mostrarCarga();">
                    &nbsp;&nbsp;<i class="fa fa-check"></i> SOLICITAR&nbsp;
                  </button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                    CANCELAR
                  </button>
                </center>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</form>

<script type="text/javascript">
  var listadoEventos = [
    <?php if (sizeof($turnosDisponibles) > 0) { ?>
      <?php for ($i = 0; $i < sizeof($turnosDisponibles); $i++) { ?>
        <?php $solicitudExistente = $CI->reserva->obtenerReservaPorFechaHora($turnosDisponibles[$i]); ?>
        <?php if ($turnosDisponibles[$i] > $fechaHoraHoy || $turnosDisponibles[$i] < $fechaHoraHoy && !$solicitudExistente) : ?>
          <?php $horaFinalAuxiliar = date('Y-m-d H:i:s', strtotime($turnosDisponibles[$i] . ' +' . $tiempo . ' minutes')); ?> {
            id: '<?php echo 1; ?>',
            title: 'Turno Disponible',
            start: '<?php echo $turnosDisponibles[$i]; ?>',
            end: '<?php echo $horaFinalAuxiliar; ?>',
            color: "#3ade57", //#89E882
            eventTextColor: "#FFF",
          },
        <?php endif; ?>
      <?php } ?>
    <?php } else { ?>
    <?php $this->session->set_flashdata("error", "No hay turnos disponibles, intentalo mas tarde.");
    } ?>
  ];

  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listMonth'
    },
    eventRender: function(event, element) {
      //element.find('.fc-title').append("<br/>" + event.title);
    },
    locale: "es-do",
    buttonIcons: true, // show the prev/next text
    //weekNumbers: true,
    navLinks: true, // can click day/week names to navigate views
    //editable: true,
    eventLimit: true, // allow "more" link when too many events
    events: listadoEventos,
    eventClick: function(calEvent, jsEvent, view) {
      $("#modalAgendarReunion").modal("show");
      $("#fecha_hora_inicio_sol").val(calEvent.start._i);
      $("#fecha_hora_fin_sol").val(calEvent.end._i);
      $("#fecha_hora").val(calEvent.start._i);
    },
    dayClick: function(date, allDay, jsEvent, view) {


    },
    selectable: true,
    select: function(info) {

      //alert("dayClick");
    }
  });
</script>

<!-- <?php $resultado = $n1 + $n2; ?> -->

<script type="text/javascript">
  $("#frm_solicitar_reunion").validate({
    rules: {
      apellido_sol: {
        letras: true,
        minlength: 3
      },
      nombre_sol: {
        letras: true,
        minlength: 3
      }
    },
    messages: {
      apellido_sol: {
        minlength: 'Datos inválidos'
      },
      nombre_sol: {
        minlength: 'Datos inválidos'
      }
    },
  });
</script>