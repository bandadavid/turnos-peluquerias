<?php




function convertirFechaLetras($fecha)
{
  $numeroDia = intval(date('w', strtotime($fecha)));
  $dia = "**";
  $diaNumerico = $day = date('d', strtotime($fecha));
  $anio = $day = date('Y', strtotime($fecha));
  $mesNumerico = intval($day = date('m', strtotime($fecha)));
  if ($numeroDia == 0) {
    $dia = 'Domingo';
  } else {
    if ($numeroDia == 1) {
      $dia = 'Lunes';
    } else {
      if ($numeroDia == 2) {
        $dia = 'Martes';
      } else {
        if ($numeroDia == 3) {
          $dia = 'Miércoles';
        } else {
          if ($numeroDia == 4) {
            $dia = 'Jueves';
          } else {
            if ($numeroDia == 5) {
              $dia = 'Viernes';
            } else {
              if ($numeroDia == 6) {
                $dia = 'Sábado';
              } else {
                $dia = "**";
              }
            }
          }
        }
      }
    }
  }

  $mes = "mm";
  if ($mesNumerico == 1) {
    $mes = 'enero';
  } else {
    if ($mesNumerico == 2) {
      $mes = 'febrero';
    } else {
      if ($mesNumerico == 3) {
        $mes = 'marzo';
      } else {
        if ($mesNumerico == 4) {
          $mes = 'abril';
        } else {
          if ($mesNumerico == 5) {
            $mes = 'mayo';
          } else {
            if ($mesNumerico == 6) {
              $mes = 'junio';
            } else {
              if ($mesNumerico == 7) {
                $mes = 'julio';
              } else {
                if ($mesNumerico == 8) {
                  $mes = 'agosto';
                } else {
                  if ($mesNumerico == 9) {
                    $mes = 'septiembre';
                  } else {
                    if ($mesNumerico == 10) {
                      $mes = 'octubre';
                    } else {
                      if ($mesNumerico == 11) {
                        $mes = 'noviembre';
                      } else {
                        if ($mesNumerico == 12) {
                          $mes = 'diciembre';
                        } else {
                          $dia = "**";
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }

  return $dia . ', ' . $diaNumerico . ' de ' . $mes . ' del ' . $anio . " a las " . date('H:i', strtotime($fecha)) . " horas ";
}


function obtenerTiempoMaximoReunion()
{
  //tiempo en minutos
  return 30;
}
