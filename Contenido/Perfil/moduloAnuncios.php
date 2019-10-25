<?php
session_start();
?>

<div class="container">
    <h1 style="text-align: center;">
        Anuncios
    </h1>

    <div id="error"></div>

    <label>
        Crear un anuncio
    </label>

    <div class="row">
        <div class="col-md-12">
            <div class="ui fluid form">
                <div class="field">
                    <textarea style="height: 17px;" placeholder="Escribe un anuncio" id="txtAnuncio"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 ml-auto">
        <button class="circular agregar orange ui right floated icon button" id="titulo" data-content="Agregar título"><i class="text height icon"></i> </button>
        <button class="circular agregar olive ui right floated icon button" id="negrita" data-content="Agregar texto en negrita"><i class="bold icon"></i> </button>
        <button class="circular agregar olive ui right floated icon button" id="cursiva" data-content="Agregar texto en cursiva"><i class="italic icon"></i> </button>
        <button class="circular agregar olive ui right floated icon button" id="subrayado" data-content="Agregar texto subraydo"><i class="underline icon"></i> </button>
        <div class="col-md-1 ml-auto">
            <button class="circular agregar blue ui right floated icon button" id="publicar" data-content="Publicar"><i class="paper plane icon"></i> </button>
        </div>
    </div>
    <hr>
    <div id="listaAnuncios" class="container my-4"></div>
</div>