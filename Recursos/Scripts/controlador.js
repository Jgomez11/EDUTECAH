// Controlador e inicializador
$(document).ready(function () {
    //  Controlador de Paginas
    var pagina = window.location.pathname.split("/")[2];

    switch (pagina) {
        case "index.php":
        case "":
        document.getElementById("cargar").innerHTML = '<div class="ui active dimmer"><div class="ui text loader">Cargando</div></div>';
        cargarDiv("barra", "Contenido/Parciales/barra.php");
        cargarDiv("cuerpo", "Contenido/cuerpoIndex.php");
        setTimeout(() => {
            $('.carrusel').slick(
            {
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                prevArrow: '<button class="circular ui mini teal icon carrusel left button" data-content="Anterior" data-position="right center"><i class="chevron left icon"></i></button>',
                nextArrow: '<button class="circular ui mini teal icon carrusel right button" data-content="Siguiente" data-position="left center"><i class="chevron right icon"></i></button>'
            }
            );

        }, 1000);

        console.log(pagina);
        break;

        case "perfil.php":
        document.getElementById("cargar").innerHTML = '<div class="ui active dimmer"><div class="ui text loader">Cargando</div></div>';
        cargarDiv("barra", "Contenido/Parciales/barra.php");
        cargarDiv("columnaOpciones", "Contenido/Parciales/columnaPerfil.php");
        cargarDiv("columnaContenido", "Contenido/Perfil/moduloAnuncios.php");
        setTimeout(() => {
            cargarDiv('plan', 'Contenido/Parciales/mensajePlan.php');
            cargarAnuncios();
            $('.icon.button').popup();
        }, 250);
        console.log(pagina);
        break;

        case "aula.php":
        document.getElementById("cargar").innerHTML = '<div class="ui active dimmer"><div class="ui text loader">Cargando</div></div>';
        vaciarDiv('modal');
        cargarDiv("barra", "Contenido/Parciales/barra.php");
        cargarDiv("columnaContenido", "Contenido/cuerpoAula.php");
        cargarDiv("modal", "Contenido/modalAgregarRecurso.php");
        console.log(pagina);
        break;
        case "lector.php":
        document.getElementById("cargar").innerHTML = '<div class="ui active dimmer"><div class="ui text loader">Cargando</div></div>';
        cargarDiv("barra", "Contenido/Parciales/barra.php");
        console.log(pagina);
        break;
        case "curso.php":
        document.getElementById("cargar").innerHTML = '<div class="ui active dimmer"><div class="ui text loader">Cargando</div></div>';
        cargarDiv("barra", "Contenido/Parciales/barra.php");
        cargarDiv("cuerpo", "Contenido/aulasDeCursos.php");
        setTimeout(() => {
            cargarAnuncios();
        }, 100);

        setTimeout(() => {
            $('.carrusel').slick(
            {
                infinite: true,
                adaptiveHeight: true,
                prevArrow: '<button class="circular ui mini teal icon carrusel left button" data-content="Anterior" data-position="right center"><i class="chevron left icon"></i></button>',
                nextArrow: '<button class="circular ui mini teal icon carrusel right button" data-content="Siguiente" data-position="left center"><i class="chevron right icon"></i></button>'
            }
            );
        }, 500);
        console.log(pagina);
        break;

        default:
        break;
    }
    // Inicializador de elementos de Semantic
    setTimeout(() => {
        $('.ui.dropdown').dropdown();
        $('.icon.button').popup();
        activadorColumna();
        activadorBotones();
    }, 1000);
});

function activadorBotones() {
    var classname = document.getElementsByClassName("agregar");
    var activador = function () {
        console.log(this.id);

        switch (this.id) {
            case "imagen":
            $('#modalImagen')
            .modal({
                onVisible: function () {
                    $('.dropdown').dropdown();
                },
                onApprove: function () {
                    subirImagen();
                },

                onDeny: function () {
                            $('#attachmentName').removeAttr('name'); // cancel upload file.
                            $('#_attachmentName').val("");
                            $('#previa').removeAttr('src');
                            document.getElementById("ok").classList.add("disabled");
                        }
                    })
            .modal('setting', 'transition', 'fade')
            .modal('show');
            break;

            case "tema":
            $('#modalTema')
            .modal({
                onVisible: function () {
                    $('.dropdown').dropdown();
                },
                onApprove: function () {
                    cambiarColor();
                },

                onDeny: function () {
                    $('.dropdown').dropdown('clear');
                }
            })
            .modal('setting', 'transition', 'fade')
            .modal('show');
            break;

            case "publicar":
            publicar();
            setTimeout(() => {
                cargarAnuncios();
            }, 300);
            break;

            case "titulo":
            $('#txtAnuncio').val(function () {
                return $('#txtAnuncio').val() + '<h4>Insertar un título</h4>';
            });
            break;

            case "negrita":
            $('#txtAnuncio').val(function () {
                return $('#txtAnuncio').val() + '<b>Escribe tu texto aquí</b>';
            });
            break;

            case "cursiva":
            $('#txtAnuncio').val(function () {
                return $('#txtAnuncio').val() + '<i>Escribe tu texto aquí</i>';
            });
            break;

            case "subrayado":
            $('#txtAnuncio').val(function () {
                return $('#txtAnuncio').val() + '<u>Escribe tu texto aquí</u>';
            });
            break;
            case "aula":
            $('#modalAulas')
            .modal({
                onVisible: function () {
                    $('.dropdown').dropdown();
                },
                onApprove: function () {
                    cargarDiv('columnaContenido', 'Contenido/Perfil/moduloAulas.php');
                    $('.dropdown').dropdown('clear');
                    setTimeout(() => {
                        cargarAulas();
                        $('.icon.button').popup();
                        activadorBotones();
                    }, 150);
                }
            })
            .modal('setting', 'transition', 'fade')
            .modal('show');

            $('.second.modal')
            .modal('attach events', '.first.modal .approve.button');
            break;

            case "curso":
            $('#modalCursos')
            .modal(
            {
                onVisible: function () {
                    $('.dropdown').dropdown();
                },
                onDeny: function () {
                    $('.dropdown').dropdown('clear');
                }
            })
            .modal('setting', 'transition', 'fade')
            .modal('show');

            $('.second.modal')
            .modal({
                onApprove: function () {
                    $('.dropdown').dropdown('clear');
                    setTimeout(() => {
                        cargarCursos();
                        $('.icon.button').popup();
                        activadorBotones();
                    }, 150);
                }
            })
            .modal('attach events', '.first.modal .approve.button');
            break;

            default:
            break;
        }
    };

    for (var i = 0; i < classname.length; i++) {
        classname[i].addEventListener('click', activador, false);
    }
}

function activadorColumna() {
    var classname = document.getElementsByClassName("opcion");
    var activador = function () {
        var elements = document.getElementsByClassName("active");

        for (let index = 0; index < elements.length; index++) {
            const element = document.getElementById(elements[index].id);
            element.classList.remove("active");
        }

        this.classList.add("active");
        columnaContenido(this.id);
    };

    for (var i = 0; i < classname.length; i++) {
        classname[i].addEventListener('click', activador, false);
    }

}

function columnaContenido(id) {
    switch (id) {
        case "modificar":
        vaciarDiv('modal');
        cargarDiv('modal', 'Contenido/Modales/modalModificar.php');
        cargarDiv("columnaContenido", "Contenido/Perfil/moduloEdicion.php");
        setTimeout("activadorBotones()", 300);
        break;

        case "anuncios":
        vaciarDiv('modal');
        cargarDiv("columnaContenido", "Contenido/Perfil/moduloAnuncios.php");
        setTimeout("cargarAnuncios()", 300);
        setTimeout("$('.icon.button').popup();", 300);
        setTimeout("activadorBotones()", 300);
        break;

        case "aulas":
        vaciarDiv('modal');
        cargarDiv("columnaContenido", "Contenido/Perfil/moduloAulas.php");
        cargarDiv('modal', 'Contenido/Modales/modalAulas.php');
        setTimeout("cargarAulas();", 150);
        setTimeout("$('.icon.button').popup();", 300);
        setTimeout("activadorBotones()", 300);
        break;

        case "cursos":
        vaciarDiv('modal');
        cargarDiv("columnaContenido", "Contenido/Perfil/moduloCursos.php");
        cargarDiv('modal', 'Contenido/Modales/modalCursos.php');
        setTimeout("cargarCursos();", 150);
        setTimeout("$('.icon.button').popup();", 300);
        setTimeout("activadorBotones()", 300);
        break;

        case "docentes":
        vaciarDiv('modal');
        cargarDiv("columnaContenido", "Contenido/Perfil/moduloUsuarios.php");
        cargarDiv('modal', 'Contenido/Modales/modalConfirmarEliminar.php');
        setTimeout("cargarUsuarios('');", 150);
        setTimeout("$('.icon.button').popup();", 300);
        break;

        case "recursos":
        vaciarDiv('modal');
        cargarDiv("columnaContenido", "Contenido/Perfil/moduloRecursos.php");
        cargarDiv('modal', 'Contenido/Modales/modalConfirmarEliminar.php');
        setTimeout(() => {
            cargarRecursos('');
            $('.icon.button').popup();
        }, 150);
        break;

        case "calificaciones":
        vaciarDiv('modal');
        cargarDiv("columnaContenido", "Contenido/Perfil/moduloCalificaciones.php");
        cargarDiv('modal', 'Contenido/Modales/modalConfirmarEliminar.php');
        setTimeout("cargarCalificaciones('');", 150);
        setTimeout("$('.icon.button').popup();", 300);
        break;

        case "soporte":
        vaciarDiv('modal');
        cargarDiv("columnaContenido", "soporte.php");
        cargarDiv('modal', 'Contenido/Modales/modalVideos.php');
        setTimeout("$('.icon.button').popup();", 300);
        break;

        default:
        break;
    }
}

function activadorBotonesModificar() {
    var aceptar = document.getElementsByClassName("aceptar");
    var cancelar = document.getElementsByClassName("cancelar");
    console.log(cancelar);

    var activadorAceptar = function () {
        console.log(this.id);

        switch (this.id) {
            case "aula":
            actualizarAula()
            break;

            case "curso":

            break;

            case "director":
            actualizarDocente();
            break;

            case "ECalificacion":
            actualizarCalificacion();
            break;
            
            case "su":
            actualizarUsuario();
            break;

            default:
            break;
        }
    };

    var activadorCancelar = function () {
        console.log(this.id);

        switch (this.id) {
            case "aula":
            cargarDiv('columnaContenido', 'Contenido/Perfil/ModuloAulas.php');
            setTimeout(() => {
                cargarAulas();
                $('.icon.button').popup();
                activadorBotones();
            }, 150);
            break;

            case "curso":

            break;

            case "director":
            case "su":
            cargarDiv('columnaContenido', 'Contenido/Perfil/moduloUsuarios.php');
            setTimeout('cargarUsuarios("")', 300);
            break;

            default:
            break;
        }
    };

    for (var i = 0; i < aceptar.length; i++) {
        aceptar[i].addEventListener('click', activadorAceptar, false);
    }

    for (var i = 0; i < cancelar.length; i++) {
        cancelar[i].addEventListener('click', activadorCancelar, false);
    }
}