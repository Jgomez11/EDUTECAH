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

    <div class="row mt-2">
        <div class="col-md-1 ml-auto">
            <button class="circular agregar blue ui icon button" id="publicar" title="Publicar"><i class="edit icon"></i> </button>
        </div>
    </div>
    <hr>
    <div id="listaAnuncios" class="my-4"></div>
</div>