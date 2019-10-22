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
                $('.icon.button').popup();
            }, 300);

            console.log(pagina);
            break;

        case "perfil.php":
            document.getElementById("cargar").innerHTML = '<div class="ui active dimmer"><div class="ui text loader">Cargando</div></div>';
            vaciarDiv('modal');
            cargarDiv("barra", "Contenido/Parciales/barra.php");
            cargarDiv("columnaOpciones", "Contenido/Parciales/columnaPerfil.php");
            cargarDiv("columnaContenido", "Contenido/Perfil/moduloAulas.php");
            cargarDiv('modal', 'Contenido/Modales/modalAulas.php');
            setTimeout(() => {
                cargarDiv('plan', 'Contenido/Parciales/mensajePlan.php');
                cargarAulas();
                $('.icon.button').popup();
                activadorBotones();
            }, 250);
            console.log(pagina);
            break;

        default:
            break;
    }
    // Inicializador de elementos de Semantic
    setTimeout("$('.ui.dropdown').dropdown();", 300);
    setTimeout("activadorColumna();", 300);
});
function activadorBotones() {
    var classname = document.getElementsByClassName("agregar");
    var activador = function () {
        console.log(this.id);

        switch (this.id) {
            case "aula":
                $('#modalAulas')
                    .modal({
                        onVisible: function () {
                            $('.dropdown').dropdown();
                        },
                        onApprove: function () {
                            cargarDiv('columnaContenido', 'Contenido/Perfil/moduloAulas.php');
                            $('.dropdown').dropdown('clear');
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
                            cargarDiv('columnaContenido', 'Contenido/Perfil/moduloCursos.php');
                            $('.dropdown').dropdown('clear');
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