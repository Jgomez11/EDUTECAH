//  FUNCIONES DE CARGA DE DATOS
//  1.  Funcion cargar divs de contenido
function cargarDiv(divID, ruta) {
    $.ajax({
        url: ruta,
        dataType: 'text',
        success: function (respuesta) {
            setTimeout(() => {
                document.getElementById("cargar").innerHTML = '';
                document.getElementById(divID).innerHTML = respuesta;
            }, 100);
        },
        error: function () { }
    });
}

//  1.1 Funcion para vaciar div
function vaciarDiv(div) {
    document.getElementById(div).innerHTML = '';
}

//  2.  Funcion para realizar busqueda mediante api custom (PENDIENTE)
function buscar() {
    query = $("#q").val();
    $.ajax({
        url: 'Acciones/buscar.php',
        dataType: 'text',
        type: 'GET',
        data: 'q=' + query,
        success: function (respuesta) {
            var myObj = JSON.parse(respuesta);
            var content = [];

            for (var i = myObj.length - 1; i >= 0; i--) {
                content.push({
                    title: myObj[i][0],
                    url: 'detalle.php?id=' + myObj[i][1],
                    description: myObj[i][2],
                    price: 'HNL. ' + myObj[i][3]
                });
            }

            $('.ui.search').search({
                source: content,
                minCharacters: 3
            });
        }
    });
}

//  3.  Funcion para cargar municipios
function cargarMun() {
    idDepto = $('#txtIDDepto').val();
    $.ajax({
        url: 'Acciones/cargarMunicipios.php',
        type: 'POST',
        data: 'idd=' + idDepto,
        dataType: 'text',
        success: function (response) {
            document.getElementById('Municipio').innerHTML = response;
        }
    });
}



//  4.  Funcion para listar (cargar) docentes en tablas y gestionar
function cargarUsuarios(consulta) {
    $.ajax({
        url: 'Acciones/busquedaUsuarios.php',
        type: 'POST',
        dataType: 'html',
        data: {
            consulta: consulta
        }
    }).done(function (respuesta) {
        $("#usuarios").html(respuesta);
    });
}


//  4.  Funcion para listar (cargar) Recursos en tablas y gestionar
function cargarRecursos(consulta) {
    $.ajax({
        url: 'Acciones/busquedaRecursos.php',
        type: 'POST',
        dataType: 'html',
        data: {
            consulta: consulta
        }
    }).done(function (respuesta) {
        $("#ListarRecursos").html(respuesta);
    });
}

//  5.  Funcion para listar (cargar) Aulas
function cargarAulas() {
    $.ajax({
        url: 'Acciones/busquedaAulas.php',
        type: 'POST',
        dataType: 'html'
    }).done(function (respuesta) {
        $("#listaAulas").html(respuesta);
    });
}

//  6.  Funcion para listar (cargar) Aulas
function cargarCursos() {
    $.ajax({
        url: 'Acciones/busquedaCursos.php',
        type: 'POST',
        dataType: 'html'
    }).done(function (respuesta) {
        $("#listaCursos").html(respuesta);
    });
}

//  7.  Funcion para listar (cargar) Aulas
function cargarAnuncios() {
    $.ajax({
        url: 'Acciones/busquedaAnuncios.php',
        type: 'POST',
        dataType: 'html'
    }).done(function (respuesta) {
        $("#listaAnuncios").html(respuesta);
    });
}

//  FUNCIONES DE VALIDACION
//  1.  Funcion para validar login de docentes
function validarLogin() {
    correo = $("#txtCorreo").val();
    pass = $("#txtPassword").val();

    $.ajax({
        url: 'Acciones/iniciarSesion.php',
        type: 'POST',
        data: 'correo=' + correo + '&password=' + pass,
        dataType: 'text',
        beforeSend: function () {
            document.getElementById("cargar").innerHTML = '<div class="ui active dimmer"><div class="ui text loader">Cargando</div></div>';
        },
        success: function (response) {
            error = response;
            document.getElementById("cargar").innerHTML = '';
            if (error == 0) {
                window.location.href = "perfil.php";
                return true;
            } else if (error == 1) {
                document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>La contraseña ingresada es incorrecta, por favor intente de nuevo.</p></div>';
                setTimeout("$('.message').transition('fade out');", 2000);
                setTimeout("vaciarDiv('error')", 2300);
                return true;
            } else if (error == 2) {
                document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>El correo ' + correo + ' no está registrado en el sistema, puedes registrarlo siguiendo <a href="registro.php">este enlace</a>.</p></div>';
                return true;
            } else {

            }
        },
        error: function () { }
    });
}

//  1.  Funcion para validar login de alumnos
function validarCodigo() {
    pass = $("#txtCodAula").val();
    console.log(pass);
    
    $.ajax({
        url: 'Acciones/entrarCurso.php',
        type: 'POST',
        data: 'password=' + pass,
        dataType: 'text',
        beforeSend: function () {
            document.getElementById("cargar").innerHTML = '<div class="ui active dimmer"><div class="ui text loader">Cargando</div></div>';
        },
        success: function (response) {
            error = response;
            document.getElementById("cargar").innerHTML = '';
            if (error == 0) {
                window.location.href = "curso.php";
                return true;
            } else if (error == 1) {
                document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>El codigo ingresado no es valido.</p></div>';
                setTimeout("$('.message').transition('fade out');", 2000);
                setTimeout("vaciarDiv('error')", 2300);
                return true;
            } else {

            }
        },
        error: function () { }
    });
}

//  2.  Funcion para validar registro de Institutos y Docentes
function registrar(tipo) {
    nombre = $("#txtNombre").val();
    apellido = $("#txtApellido").val();
    correo = $("#txtCorreo").val();
    pass = $("#txtPassword").val();
    cadenaUsuario = 'txtNombre=' + nombre + '&txtApellido=' + apellido + '&txtCorreo=' + correo + '&txtPassword=' + pass;
    if (tipo == "0") {
        codigoI = $("#txtCodInstituto").val();
        nombreI = $("#txtNomInstituto").val();
        depto = $("#txtDepartamento").val();
        municipio = $("#txtMunicipio").val();
        direccion = $("#txtDireccion").val();

        cadenaIns = '&txtCodInstituto=' + codigoI + '&txtNomInstituto=' + nombreI + '&txtDepartamento=' + depto + '&txtMunicipio=' + municipio + '&txtDireccion=' + direccion;

        $.ajax({
            url: 'Acciones/registrarInstituto.php',
            type: 'POST',
            data: cadenaUsuario + cadenaIns,
            dataType: 'text',
            beforeSend: function () {
                document.getElementById("cargar").innerHTML = '<div class="ui active dimmer"><div class="ui text loader">Cargando</div></div>';
            },
            success: function (response) {
                error = response;
                document.getElementById("cargar").innerHTML = '';
                if (error == 1) {
                    document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>El codigo ' + codigoI + ' ya fue utilizado anteriormente para registrar otro instituto. Si crees que se trata de fraude puede reportarlo siguiendo <a href="#">este enlace</a></p></div>';
                    return true;
                } else if (error == 0) {
                    window.location.href = "planes.php";
                    return true;
                } else if (error == 2) {
                    document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>El correo ' + correo + ' ya está registrado en el sistema.</p></div>';
                    setTimeout("$('.message').transition('fade out');listar('')", 2000);
                    setTimeout("vaciarDiv('error')", 2300);
                    return true;
                }
            },
            error: function () { }
        });
    } else {
        pase = $("#txtPase").val();
        $.ajax({
            url: 'Acciones/registrarDocente.php',
            type: 'POST',
            data: cadenaUsuario + '&txtPase=' + pase,
            dataType: 'text',
            beforeSend: function () {
                document.getElementById("cargar").innerHTML = '<div class="ui active dimmer"><div class="ui text loader">Cargando</div></div>';
            },
            success: function (response) {
                error = response;
                document.getElementById("cargar").innerHTML = '';
                if (error == 0) {
                    window.location.href = "perfil.php";
                    return true;
                } else if (error == 1) {
                    document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>El pase virtual ' + pase + ' no existe.</p></div>';
                    setTimeout("$('.message').transition('fade out');listar('')", 2000);
                    setTimeout("vaciarDiv('error')", 2300);
                    return true;
                } else if (error == 2) {
                    document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>El correo ' + correo + ' ya está registrado en el sistema.</p></div>';
                    setTimeout("$('.message').transition('fade out');listar('')", 2000);
                    setTimeout("vaciarDiv('error')", 2300);
                    return true;
                }
            },
            error: function () { }
        });
    }
}

//  3.  Funcion para registrar cursos
function registrarCurso() {
    curso = $('#txtIDCurso').val();
    grado = $('#txtIDGrado').val();

    $.ajax({
        url: 'Acciones/registrarCurso.php',
        type: 'POST',
        data: 'txtIDCurso=' + curso + '&txtIDGrado=' + grado,
        dataType: 'text',
        success: function (response) {
            document.getElementById("contenido").innerHTML = 'Se ha creado un nuevo curso de ' + grado + ' de ' + curso + ' con el codigo: ' + response;
        },
        error: function () { }
    });
}

//  3.  Funcion para registrar aulas
function registrarAula() {
    curso = $('#txtIDCurso').val();
    aula = $('#txtAsignatura').val();

    $.ajax({
        url: 'Acciones/registrarAula.php',
        type: 'POST',
        data: 'txtIDCurso=' + curso + '&txtAsignatura=' + aula,
        dataType: 'text',
        success: function (response) {
            document.getElementById("contenido").innerHTML = 'Se ha creado un nuevo aula de ' + aula + ' para el curso con el codigo: ' + curso + ' por favor provea el codigo a sus alumnos para que puedan acceder al aula.';
        },
        error: function () { }
    });
}



//  FUNCIONES DE MODIFICACION DE DATOS
//  1.  Funcion para mostrar datos previos a modificar
function modificar(IDUsuario) {
    $.ajax({
        url: 'Contenido/Perfil/modificarDirector.php',
        type: 'POST',
        dataType: 'text',
        data: 'IDUsuario=' + IDUsuario
    }).done(function (res) {
        $('#columnaContenido').html(res);
    });
}

//  2.  Funcion para modificar datos previos a modificar en modo SU
function modificarSU(IDUsuario) {
    $.ajax({
        url: 'Contenido/Perfil/modificarSU.php',
        type: 'POST',
        dataType: 'text',
        data: 'IDUsuario=' + IDUsuario
    }).done(function (res) {
        $('#columnaContenido').html(res);
        $('#ddCargo').dropdown().dropdown('set value', $('#txtTipo').val());
    });
}


//  3.  Funcion para guardar cambios
function actualizarDocente() {
    id = $('#txtIdentificador').val();
    nom = $('#txtNombre').val();
    ap = $('#txtApellido').val();
    ce = $('#txtCedula').val();
    tel = $('#txtTelefono').val();
    corr = $('#txtCorreo').val();

    cadena = 'txtIdentificador=' + id + '&txtNombre=' + nom + '&txtApellido=' + ap + '&txtCedula=' + ce + '&txtTelefono=' + tel + '&txtCorreo=' + corr;

    $.ajax({
        url: 'Acciones/modificarRegistroDocente.php',
        type: 'POST',
        data: cadena,
        dataType: 'text',
        success: function (response) {
            document.getElementById("error").innerHTML = '<div class="row mt-4"><div class="col-md-12"><div class="ui teal icon message"><i class="info circle icon"></i><div class="content"><div class="header">Exito</div><p>El registro se actualizó exitosamente.</p></div></div></div></div>';
            setTimeout("cargarDiv('columnaContenido', 'Contenido/Perfil/moduloUsuarios.php')", 2000);
            setTimeout("cargarUsuarios('')", 2300);
        },
        error: function () { }
    });

}

//  4.  Funcion para guardar cambios modo SU
function actualizarUsuario() {
    id = $('#txtIdentificador').val();
    nom = $('#txtNombre').val();
    ap = $('#txtApellido').val();
    ce = $('#txtCedula').val();
    tel = $('#txtTelefono').val();
    corr = $('#txtCorreo').val();
    car = $('#slcCargo').val();

    cadena = 'txtIdentificador=' + id + '&txtNombre=' + nom + '&txtApellido=' + ap + '&txtCedula=' + ce + '&txtTelefono=' + tel + '&txtCorreo=' + corr + '&slcCargo=' + car;

    $.ajax({
        url: 'Acciones/modificarRegistrosSU.php',
        type: 'POST',
        data: cadena,
        dataType: 'text',
        success: function (response) {
            document.getElementById("error").innerHTML = '<div class="row mt-4"><div class="col-md-12"><div class="ui teal icon message"><i class="info circle icon"></i><div class="content"><div class="header">Exito</div><p>El registro se actualizó exitosamente.</p></div></div></div></div>';
            setTimeout("cargarDiv('columnaContenido', 'Contenido/Perfil/moduloUsuarios.php')", 2000);
            setTimeout("cargarUsuarios('')", 2300);
        },
        error: function () { }
    });
}

//  5. Funcion para modificar datos previo a guardar
function modificarAula(IDAula) {
    $.ajax({
        url: 'Contenido/Perfil/modificarAula.php',
        type: 'POST',
        dataType: 'text',
        data: 'IDAula=' + IDAula,
        success: function (response) {
            $('#columnaContenido').html(response);
            $('#ddCurso').dropdown().dropdown('set value', $('#txtIDCurso').val());
            $('#ddEstado').dropdown().dropdown('set value', $('#txtIDEstado').val());
            $('#ddDocente').dropdown().dropdown('set value', $('#txtIDDocente').val());
        }
    });
}

//  6. Guardar los datos(Aun no funcional)
function actualizarAula() {
    id = $('#txtIdentificador').val();
    curso = $('#txtNuevoCurso').val();
    asignatura = $('#txtAsignatura').val();
    estado = $('#txtEstado').val();
    docente = $('#txtDocente').val();

    cadena = 'IDAula=' + id + '&IDCurso=' + curso + '&Asignatura=' + asignatura + '&IDDocente=' + docente + '&IDEstado=' + estado;

    $.ajax({
        url: 'Acciones/modificarAula.php',
        type: 'POST',
        data: cadena,
        dataType: 'text',
        success: function (response) {
            document.getElementById("error").innerHTML = '<div class="row mt-4"><div class="col-md-12"><div class="ui teal icon message"><i class="info circle icon"></i><div class="content"><div class="header">Exito</div><p>El registro se actualizó exitosamente.</p></div></div></div></div>';
            setTimeout("cargarDiv('columnaContenido', 'Contenido/Perfil/moduloAulas.php');", 2000);
            setTimeout(() => {
                cargarAulas();
                $('.icon.button').popup();
                activadorBotones();
            }, 2150);
        },
        error: function () { }
    });
}

//  FUNCIONES DE ELIMINACION DE DATOS
//  1.  Funcion para ELIMINAR datos de USUARIOS
function eliminar(IDUsuario) {
    $.ajax({
        url: 'Acciones/eliminarDatosUsuarios.php',
        type: 'POST',
        data: 'IDUsuario=' + IDUsuario,
        dataType: 'text',
        success: function (response) {
            document.getElementById("error").innerHTML = '<div class="row mt-4"><div class="col-md-12"><div class="ui blue icon message"><i class="info circle icon"></i><div class="content"><div class="header">Exito</div><p>El registro se elimino exitosamente.</p></div></div></div></div>';
            setTimeout("$('.message').transition('fade out');listar('')", 2000);
            setTimeout("vaciarDiv('error')", 2300);
        },
        error: function () { }
    });
}


//  1.  Funcion para ELIMINAR Recursos
function eliminarRecurso(IDRecurso, Identificador) {
    $.ajax({
        url: 'Acciones/eliminarRecursos.php',
        type: 'POST',
        data: 'IDRecurso=' + IDRecurso,
        dataType: 'text',
        success: function (response) {
            if (Identificador == 1) {
                cargarDiv('columnaContenido', 'Contenido/cuerpoAula.php');
                setTimeout("document.getElementById(\"info\").innerHTML = '<div class=\"row mt-4\"><div class=\"col-md-12\"><div class=\"ui blue icon message\"><i class=\"info circle icon\"></i><div class=\"content\"><div class=\"header\">Exito</div><p>El registro se elimino exitosamente.</p></div></div></div></div>';", 200)
                setTimeout("$('.blue.icon.message').transition('fade out');", 3000);

                setTimeout("vaciarDiv('info')", 3300);
            } else {
                cargarRecursos('');
                setTimeout("document.getElementById(\"error\").innerHTML = '<div class=\"row mt-4\"><div class=\"col-md-12\"><div class=\"ui blue icon message\"><i class=\"info circle icon\"></i><div class=\"content\"><div class=\"header\">Exito</div><p>El registro se elimino exitosamente.</p></div></div></div></div>';", 200)
                setTimeout("$('.blue.icon.message').transition('fade out');", 3000);

                setTimeout("vaciarDiv('error')", 3300);
            }
        },
        error: function () { }
    });
}

// OTRAS FUNCIONES
//  1.  Funcion de carga de aulas
function cargarAula(id) {
    $.ajax({
        url: 'Acciones/establecerAula.php',
        type: 'POST',
        data: 'ID=' + id,
        dataType: 'text',
        success: function (response) {
            window.location.href = "aula.php";
        },
        error: function () { }
    });
}

// Funcion de carga de archivos
function cargarElemento() {
    var fileExtentionRange = '.pdf .doc .docx .xls .xlsx .ppt .pptx';
    var MAX_SIZE = 30; // MB

    $(document).on('change', '.btn-file :file', function () {
        var input = $(this);

        if (navigator.appVersion.indexOf("MSIE") != -1) { // IE
            var label = input.val();

            input.trigger('fileselect', [1, label, 0]);
        } else {
            var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            var numFiles = input.get(0).files ? input.get(0).files.length : 1;
            var size = input.get(0).files[0].size;

            input.trigger('fileselect', [numFiles, label, size]);
        }
    });

    $('.btn-file :file').on('fileselect', function (event, numFiles, label, size) {
        $('#archivoAdjunto').attr('name', 'archivoAdjunto'); // allow upload.

        var postfix = label.substr(label.lastIndexOf('.'));
        if (fileExtentionRange.indexOf(postfix.toLowerCase()) > -1) {
            if (size > 1024 * 1024 * MAX_SIZE) {
                document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>Solo se permiten archivos de ' + MAX_SIZE + ' MB o menos.</p></div>';
                setTimeout("$('.message').transition('fade out');listar('')", 2000);
                setTimeout("vaciarDiv('error')", 2300);
                $('#attachmentName').removeAttr('name'); // cancel upload file.
            } else {
                $('#_attachmentName').val(label);
            }
        } else {
            document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>Solo se permiten archivos con las extensiones: ' + fileExtentionRange + '.</p></div>';
            setTimeout("$('.message').transition('fade out');listar('')", 2000);
            setTimeout("vaciarDiv('error')", 2300);
            $('#attachmentName').removeAttr('name'); // cancel upload file.
        }
    });
}

//  3.  Funcion para subir los recursos
function subirRecurso() {
    const inputFile = document.querySelector("#archivoAdjunto");
    if (inputFile.files.length > 0) {
        if (navigator.appVersion.indexOf("MSIE") != -1) { // IE
            var label = $("#archivoAdjunto").val();
        } else {
            var label = $("#archivoAdjunto").val().replace(/\\/g, '/').replace(/.*\//, '');
        }

        var postfix = label.substr(label.lastIndexOf('.'));

        if ($("#txtTitulo").val() == '' || $("#txtCat").val() == '') {
            document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>Por favor llene todos los campos.</p></div>';
            setTimeout("$('.message').transition('fade out');listar('')", 2000);
            setTimeout("vaciarDiv('error')", 2300);
        } else {
            let formData = new FormData();
            formData.append("Archivo", inputFile.files[0]); // En la posición 0; es decir, el primer elemento
            formData.append("Extension", postfix);
            formData.append("Titulo", $("#txtTitulo").val());
            formData.append("Categorias", $("#txtCat").val());
            fetch("Acciones/subirRecurso.php", {
                method: 'POST',
                body: formData,
            })
                .then(respuesta => respuesta.text())
                .then(decodificado => {
                    console.log(decodificado);
                });

            $('#modalRecursos').modal('hide');
            $('.second.modal').modal('show');
        }

    } else {
        // El usuario no ha seleccionado archivos
        document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>Por favor seleccione un archivo.</p></div>';
        setTimeout("$('.message').transition('fade out');listar('')", 2000);
        setTimeout("vaciarDiv('error')", 2300);
    }
}

//  .  Funcion de carga de PDF
function leerPDF(id) {
    $.ajax({
        url: 'Acciones/establecerPDF.php',
        type: 'POST',
        data: 'ID=' + id,
        dataType: 'text',
        success: function (response) {
            window.location.href = "lector.php";
        },
        error: function () { }
    });
}

// Funcion de carga de imagenes
function cargarImagen() {
    var fileExtentionRange = '.jpg .png .jpeg';
    var MAX_SIZE = 5; // MB
    const inputFile = document.querySelector("#archivoAdjunto");

    console.log(inputFile.files);


    $(document).on('change', '.btn-file :file', function () {
        var input = $(this);

        if (navigator.appVersion.indexOf("MSIE") != -1) { // IE
            var label = input.val();

            input.trigger('fileselect', [1, label, 0]);
        } else {
            var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            var numFiles = input.get(0).files ? input.get(0).files.length : 1;
            var size = input.get(0).files[0].size;

            input.trigger('fileselect', [numFiles, label, size]);
        }
    });

    $('.btn-file :file').on('fileselect', function (event, numFiles, label, size) {
        $('#archivoAdjunto').attr('name', 'archivoAdjunto'); // allow upload.
        var postfix = label.substr(label.lastIndexOf('.'));
        if (fileExtentionRange.indexOf(postfix.toLowerCase()) > -1) {
            if (size > 1024 * 1024 * MAX_SIZE) {
                document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>Solo se permiten archivos de ' + MAX_SIZE + ' MB o menos.</p></div>';
                document.getElementById("ok").classList.add("disabled");
                setTimeout("$('.message').transition('fade out');listar('')", 2000);
                setTimeout("vaciarDiv('error')", 2300);
                $('#attachmentName').removeAttr('name'); // cancel upload file.
                $('#_attachmentName').val("");
            } else {
                if (inputFile.files && inputFile.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#previa').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(inputFile.files[0]);
                }
                $('#_attachmentName').val(label);
                document.getElementById("ok").classList.remove("disabled");
            }
        } else {
            document.getElementById("errorImagen").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>Solo se permiten archivos con las extensiones: ' + fileExtentionRange + '.</p></div>';
            setTimeout("$('.message').transition('fade out');", 2000);
            document.getElementById("ok").classList.add("disabled");
            setTimeout("vaciarDiv('errorImagen')", 2300);
            $('#attachmentName').removeAttr('name'); // cancel upload file.
            $('#_attachmentName').val("");
        }
    });
}

function subirImagen() {
    const inputFile = document.querySelector("#archivoAdjunto");
    if (inputFile.files.length > 0) {
        if (navigator.appVersion.indexOf("MSIE") != -1) { // IE
            var label = $("#archivoAdjunto").val();
        } else {
            var label = $("#archivoAdjunto").val().replace(/\\/g, '/').replace(/.*\//, '');
        }

        var postfix = label.substr(label.lastIndexOf('.'));

        let formData = new FormData();
        formData.append("Archivo", inputFile.files[0]); // En la posición 0; es decir, el primer elemento
        formData.append("Extension", postfix);
        fetch("Acciones/subirImagenUsuario.php", {
            method: 'POST',
            body: formData,
        })
            .then(respuesta => respuesta.text())
            .then(decodificado => {
                console.log(decodificado);
            });

        $('#modalImagen').modal('hide');
        $('#modalImagen2').modal('show');

    } else {
        // El usuario no ha seleccionado archivos
        document.getElementById("error").innerHTML = '<div class="ui error message mb-3"><div class="header">Error:</div><p>Por favor seleccione un archivo.</p></div>';
        setTimeout("$('.message').transition('fade out');listar('')", 2000);
        setTimeout("vaciarDiv('error')", 2300);
    }
}

function cambiarColor() {
    color = $('#slcColor').val();
    $.ajax({
        url: 'Acciones/cambiarColor.php',
        type: 'POST',
        data: 'color=' + color,
        dataType: 'text',

        success: function (response) {
            console.log(response);
            console.log(color);

            $('#modalTema').modal('hide');
            $('#modalTema2').modal('show');
        },
        error: function () { }
    });
}

function publicar() {
    publi = $('#txtAnuncio').val();
    $('#txtAnuncio').val("");
    $.ajax({
        url: 'Acciones/publicar.php',
        type: 'POST',
        data: 'publi=' + publi,
        dataType: 'text',

        success: function (response) {
            console.log(response);
        },
        error: function () { }
    });
}