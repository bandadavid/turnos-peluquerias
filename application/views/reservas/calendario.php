<script type="text/javascript">
  $("#calendario").addClass("active");
</script>

<br>
<div class="row">
  <div class="col-md-12 text-center">
    <h3><b>TURNOS AGENDADOS</b></h3>
  </div>
</div>
<br>

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

<div id="modalDetalleReunion" class="modal fade" role="dialog">
  <div class="modal-dialog" style="min-width:90% !important;">

    <!-- Modal content-->
    <form id="frm_editar_convenio" method="post" action="<?php echo site_url(); ?>/calendarios/finalizar/" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"> <i class="fa fa-eye"></i> <b>Detalle del Turno</b></h4>
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
                    <input type="text" name="" id="fecha_hora" value="" readonly class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input required type="hidden" name="codigo_res" id="codigo_res" class="form-control">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for=""><b>Apellidos:</b></label><br>
                    <input required type="text" name="apellido_sol" readonly id="apellido_sol" value="" class="form-control" placeholder="Ingrese sus apellidos completos">
                  </div>
                  <div class="col-md-6 form-group">
                    <label for=""><b>Nombres:</b></label><br>
                    <input required type="text" name="nombre_sol" readonly id="nombre_sol" value="" class="form-control" placeholder="Ingrese sus nombres completos">
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for=""><b>Celular:</b></label><br>
                    <input required type="number" name="celular_sol" readonly id="celular_sol" value="" class="form-control" placeholder="Ingrese su número de celular">
                  </div>
                  <div class="col-md-6 form-group">
                    <label for=""><b>Servicio:</b></label><br>
                    <input required type="text" name="nombre_ser" readonly id="nombre_ser" value="" class="form-control" placeholder="Ingrese sus nombres completos">
                  </div>
                </div>

                <?php if ($this->session->userdata("Conectad0")) : ?>
                  <center>
                    <button type="submit" class="btn btn-danger">
                      <i class="fa fa-window-close"></i>
                      FINALIZAR TURNO
                    </button>
                  </center>
                <?php endif; ?>

                <br>
                <center>
                  <button type="button" class="btn btn-success" data-dismiss="modal">
                    <i class="fa fa-check"></i>
                    CERRAR
                  </button>
                </center>

              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  var listadoEventos = [
    <?php if ($solicitudes) : ?>
      <?php foreach ($solicitudes->result() as $solicitud) : ?>
        <?php if ($solicitud->estado_res == "ACTIVO") : ?> {
            id: '<?php echo $solicitud->codigo_res; ?>',
            title: 'Turno agendado por <?php echo $solicitud->apellido_res; ?> <?php echo $solicitud->nombre_res; ?>',
            start: '<?php echo $solicitud->fecha_hora_inicio_res; ?>',
            end: '<?php echo $solicitud->fecha_hora_inicio_res; ?>',
            color: "#9f1815",
            eventTextColor: "#FFF"
          },
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>
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

      $.ajax({
        url: "<?php echo site_url('reservas/obtenerSolicitudPorCodigoJSON'); ?>/" + calEvent.id,
        success: function(data) {
          $("#btn-enlace").html("");
          var objeto = JSON.parse(data);
          $("#codigo_res").val(objeto.codigo_res);
          $("#fecha_hora").val(objeto.fecha);
          $("#apellido_sol").val(objeto.apellido_res);
          $("#nombre_sol").val(objeto.nombre_res);
          $("#celular_sol").val(objeto.celular_res);
          $("#nombre_ser").val(objeto.nombre_ser);
        }
      });
      $("#modalDetalleReunion").modal("show");
    },
    dayClick: function(date, allDay, jsEvent, view) {


    },
    selectable: true,
    select: function(info) {

      //alert("dayClick");
    }



  });
</script>