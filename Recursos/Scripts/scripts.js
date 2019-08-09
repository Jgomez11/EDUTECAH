//  FUNCIONES DE CARGA DE DATOS
//  1.  Funcion cargar divs de contenido
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

//  1.1 Funcion para vaciar div
function vaciarDiv(div){
  document.getElementById(div).innerHTML = '';
}

//  2.  Funcion para realizar busqueda mediante api custom (PENDIENTE)
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

//  3.  Funcion para cargar municipios
function cargarMun(){
  idDepto = $('#txtIDDepto').val();
  $.ajax({
    url: 'Acciones/cargarMunicipios.php',
    type: 'POST',
    data: 'idd='+idDepto,
    dataType: 'text',
    success: function (response) {
      document.getElementById('Municipio').innerHTML = response;
    }
  });
}



//  4.  Funcion para listar (cargar) docentes en tablas y gestionar
function listar(consulta){
  $.ajax({
    url:'Acciones/BusquedaUsuarios.php',
    type:'POST',
    dataType:'html',
    data:{consulta: consulta}
  }).done(function(respuesta){
    $("#ListarUsuarios").html(respuesta);
  });
}


//  FUNCIONES DE VALIDACION
//  1.  Funcion para validar login de docentes
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
        window.location.href = "perfil.php";
        return true;
      } else if (error == 1) {
        document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>La contraseña ingresada es incorrecta, por favor intente de nuevo.</p></div>';
        setTimeout ("$('.message').transition('fade out');listar('')", 2000);
        setTimeout ("vaciarDiv('error')", 2300);
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

//  2.  Funcion para validar registro de Institutos y Docentes
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
          setTimeout ("$('.message').transition('fade out');listar('')", 2000);
          setTimeout ("vaciarDiv('error')", 2300);
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
          setTimeout ("$('.message').transition('fade out');listar('')", 2000);
          setTimeout ("vaciarDiv('error')", 2300);
          return true;
        } else if (error == 2) {
          document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>El correo '+correo+' ya está registrado en el sistema.</p></div>'; 
          setTimeout ("$('.message').transition('fade out');listar('')", 2000);
          setTimeout ("vaciarDiv('error')", 2300);
          return true;
        } 
      },
      error: function(){
      }
    });
  }
}

//  3.  Funcion para registrar cursos
function registrarCurso(){
  curso = $('#txtIDCurso').val();
  grado = $('#txtIDGrado').val();
  
  $.ajax({
    url       : 'Acciones/registrarCurso.php',
    type      : 'POST',
    data      : 'txtIDCurso='+curso+'&txtIDGrado='+grado,
    dataType  : 'text',
    success   : function (response) {
      document.getElementById("contenido").innerHTML = 'Se ha creado un nuevo curso de '+grado+' de '+curso+' con el codigo: '+response;
    },
    error: function(){
    }
  });
}

//  3.  Funcion para registrar aulas
function registrarAula(){
  curso = $('#txtIDCurso').val();
  aula = $('#txtAsignatura').val();

  $.ajax({
    url       : 'Acciones/registrarAula.php',
    type      : 'POST',
    data      : 'txtIDCurso='+curso+'&txtAsignatura='+aula,
    dataType  : 'text',
    success   : function (response) {
      document.getElementById("contenido").innerHTML = 'Se ha creado un nuevo aula de '+aula+' para el curso con el codigo: '+curso+' por favor provea el codigo a sus alumnos para que puedan acceder al aula.';
    },
    error: function(){
    }
  });
}



//  FUNCIONES DE MODIFICACION DE DATOS
//  1.  Funcion para modificar datos de docentes visualizados en tablas
function modificar(IDUsuario){
  $.ajax({
    url:'Contenido/modificarDirector.php',
    type: 'POST',
    dataType:'text',
    data:'IDUsuario='+IDUsuario
  }).done(function(res){
    $('#columnaContenido').html(res);
  });
}

//  1.  Funcion para modificar datos de usuarios en el modo SU
function modificarSU(IDUsuario){
  $.ajax({
    url:'Contenido/modificarSU.php',
    type: 'POST',
    dataType:'text',
    data:'IDUsuario='+IDUsuario
  }).done(function(res){
    $('#columnaContenido').html(res);
    $('#ddCargo').dropdown().dropdown('set value', $('#txtTipo').val());
  });
}

function actualizarDocente(){
  id=$('#txtIdentificador').val();
  nom=$('#txtNombre').val();
  ap=$('#txtApellido').val();
  ce=$('#txtCedula').val();
  tel=$('#txtTelefono').val();
  corr=$('#txtCorreo').val();

  cadena = 'txtIdentificador='+id+'&txtNombre='+nom+'&txtApellido='+ap+'&txtCedula='+ce+'&txtTelefono='+tel+'&txtCorreo='+corr;

  $.ajax({
    url       : 'Acciones/modificarRegistroDocente.php',
    type      : 'POST',
    data      : cadena,
    dataType  : 'text',
    success   : function (response) {
      document.getElementById("error").innerHTML =    '<div class="row mt-4"><div class="col-md-12"><div class="ui teal icon message"><i class="info circle icon"></i><div class="content"><div class="header">Exito</div><p>El registro se actulizo exitosamente.</p></div></div></div></div>';
      setTimeout ("cargarDiv('columnaContenido', 'Contenido/modificarUsuarios.php'); listar('')", 2000);
    },
    error: function(){
    }
  });

}

function actualizarUsuario(){
  id=$('#txtIdentificador').val();
  nom=$('#txtNombre').val();
  ap=$('#txtApellido').val();
  ce=$('#txtCedula').val();
  tel=$('#txtTelefono').val();
  corr=$('#txtCorreo').val();
  car=$('#slcCargo').val();

  cadena = 'txtIdentificador='+id+'&txtNombre='+nom+'&txtApellido='+ap+'&txtCedula='+ce+'&txtTelefono='+tel+'&txtCorreo='+corr+'&slcCargo='+car;

  $.ajax({
    url       : 'Acciones/modificarRegistrosSU.php',
    type      : 'POST',
    data      : cadena,
    dataType  : 'text',
    success   : function (response) {
      document.getElementById("error").innerHTML =    '<div class="row mt-4"><div class="col-md-12"><div class="ui teal icon message"><i class="info circle icon"></i><div class="content"><div class="header">Exito</div><p>El registro se actulizo exitosamente.</p></div></div></div></div>';
      setTimeout ("cargarDiv('columnaContenido', 'Contenido/modificarUsuarios.php'); listar('')", 2000);

    },
    error: function(){
    }
  });
}

//  FUNCIONES DE ELIMINACION DE DATOS
//  1.  Funcion para ELIMINAR datos de USUARIOS
function eliminar(IDUsuario){
  $.ajax({
    url       : 'Acciones/eliminarDatosUsuarios.php',
    type      : 'POST',
    data      : 'IDUsuario='+IDUsuario,
    dataType  : 'text',
    success   : function (response) {
      document.getElementById("error").innerHTML =    '<div class="row mt-4"><div class="col-md-12"><div class="ui red icon message"><i class="info circle icon"></i><div class="content"><div class="header">Exito</div><p>El registro se elimino exitosamente.</p></div></div></div></div>';
      setTimeout ("$('.message').transition('fade out');listar('')", 2000);
      setTimeout ("vaciarDiv('error')", 2300);
    },
    error: function(){
    }
  });
}

// OTRAS FUNCIONES
function cargarAula(id){
  $.ajax({
    url       : 'Acciones/establecerAula.php',
    type      : 'POST',
    data      : 'ID='+id,
    dataType  : 'text',
    success   : function (response) {
        window.location.href = "aula.php";
    },
    error: function(){
    }
  }); 
}