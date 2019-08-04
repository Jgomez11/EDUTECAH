function listar(consulta){
  $.ajax({
    url:'Acciones/BusquedaDocentes.php',
    type:'POST',
    dataType:'html',
    data:{consulta: consulta}
  }).done(function(respuesta){
    $("#Docente").html(respuesta);
  });
}

function modificar(IDUsuario){
  $.ajax({
    url:'Contenido/modificarDatosDocente.php',
    type: 'POST',
    dataType:'text',
    data:'IDUsuario='+IDUsuario
  }).done(function(res){
    $('#zonaContenido').html(res);
  });
}

function cargarDiv(divID, ruta) {
  $.ajax({
    url: ruta,
    dataType: 'text',
    success: function (respuesta) {
      document.getElementById(divID).innerHTML = respuesta;
      listar('');
      $.getScript('Estilos/js/script.js');
      mostrarResultados();
    },
    error: function () {
    },
  });
}

