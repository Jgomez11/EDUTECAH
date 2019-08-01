//Funcion cargar contenido mediante ajax
function cargarDiv(divID, ruta) {
  $.ajax({
    url: ruta,
    dataType: 'text',
    beforeSend: function(){
      document.getElementById("cargar").innerHTML = '<div class="ui active dimmer"><div class="ui text loader">Cargando</div></div>';
    },
    success: function (respuesta) {
      document.getElementById("cargar").innerHTML = '';
      document.getElementById(divID).innerHTML = respuesta;
    },
    error: function () {
    }
  });
}

//Funcion para realizar busqueda mediante api custom
function buscar() {
  query = $("#q").val();  
  $.ajax({
    url     : 'Acciones/buscar.php',
    dataType: 'text',
    type    : 'GET',
    data    : 'q='+query,
    success : function(respuesta){
      var myObj = JSON.parse(respuesta);
      var content = [];

      for (var i = myObj.length - 1; i >= 0; i--) {
        content.push({title : myObj[i][0], url: 'detalle.php?id='+myObj[i][1], description: myObj[i][2], price: 'HNL. '+myObj[i][3]});  
      }

      $('.ui.search').search({
          source: content,
          minCharacters : 3
      });
    }
  });
}

//Funcion para validar contraseña mediante ajax
function validarLogin(){
  correo = $("#txtCorreo").val();  
  pass = $("#txtPassword").val();

  $.ajax({
    url       : 'Acciones/iniciarSesion.php',
    type      : 'POST',
    data      : 'correo='+correo+'&password='+pass,
    dataType  : 'text',
    beforeSend: function(){
        document.getElementById("cargar").innerHTML ='<div class="ui active dimmer"><div class="ui text loader">Cargando</div></div>';
    },
    success   : function (response) {
      error = response;
      document.getElementById("cargar").innerHTML ='';
      if (error == 0){
        window.location.href = "index.php";
        return true;
      } else if (error == 1) {
        document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>La contraseña ingresada es incorrecta, por favor intente de nuevo.</p></div>';
        return true;
      } else if (error == 2) {
        document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>El correo '+correo+' no está registrado en el sistema, puedes registrarlo siguiendo <a href="registro.php">este enlace</a>.</p></div>'; 
        return true;
       } else{

      }
    },
    error: function(){
    }
  });
}

// Funcion para validar registro
function registrar(tipo){
  nombre = $("#txtNombre").val();
  apellido = $("#txtApellido").val();
  correo = $("#txtCorreo").val();
  pass = $("#txtPassword").val();
  cadenaUsuario = 'txtNombre='+nombre+'&txtApellido='+apellido+'&txtCorreo='+correo+'&txtPassword='+pass;
  if (tipo == "0") {
    codigoI = $("#txtCodInstituto").val();
    nombreI = $("#txtNomInstituto").val();
    depto = $("#txtDepartamento").val();
    municipio = $("#txtMunicipio").val();
    direccion = $("#txtDireccion").val();

    cadenaIns = '&txtCodInstituto='+codigoI+'&txtNomInstituto='+nombreI+'&txtDepartamento='+depto+'&txtMunicipio='+municipio+'&txtDireccion='+direccion;

    $.ajax({
      url       : 'Acciones/registrarInstituto.php',
      type      : 'POST',
      data      : cadenaUsuario+cadenaIns,
      dataType  : 'text',
      beforeSend: function(){
        document.getElementById("cargar").innerHTML ='<div class="ui active dimmer"><div class="ui text loader">Cargando</div></div>';
      },
      success   : function (response) {
        error = response;
        document.getElementById("cargar").innerHTML ='';
        if (error == 1){
          document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>El codigo '+codigoI+' ya fue utilizado anteriormente para registrar otro instituto. Si crees que se trata de fraude puede reportarlo siguiendo <a href="#">este enlace</a></p></div>';
          return true;
        } else if (error == 0) {
          window.location.href = "planes.php";
          return true;
        } else if (error == 2) {
          document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>El correo '+correo+' ya está registrado en el sistema.</p></div>'; 
          return true;
       } 
      },
      error: function(){
      }
    });
  } else{
    pase = $("#txtPase").val();
    $.ajax({
      url       : 'Acciones/registrarDocente.php',
      type      : 'POST',
      data      : cadenaUsuario+'&txtPase='+pase,
      dataType  : 'text',
      beforeSend: function(){
        document.getElementById("cargar").innerHTML ='<div class="ui active dimmer"><div class="ui text loader">Cargando</div></div>';
      },
      success   : function (response) {
        error = response;
        document.getElementById("cargar").innerHTML ='';
        if (error == 0){
          window.location.href = "perfil.php";
          return true;
        } else if (error == 1) {
          document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>El pase virtual '+pase+' no existe.</p></div>';
          return true;
        } else if (error == 2) {
          document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>El correo '+correo+' ya está registrado en el sistema.</p></div>'; 
          return true;
       } 
      },
      error: function(){
      }
    });
  }
}