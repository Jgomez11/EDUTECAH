<?php
session_start();
?>
<div class="ui first small modal" id="modalImagen">
    <div class="header">Cambiar imagen de perfil</div>
    <div class="scrolling content">
        <div class="row mb-4">
            <div class="col-lg-12">
                <label>Imagen actual:</label>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-4 mx-auto">
                <img style="width: 200px; height: 200px; object-fit: cover" class="ui big circular thumbnail bordered image" id="" alt="" src="<?php echo 'data:image/png;base64,' . base64_encode($_SESSION['Imagen']) ?>">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-12">
                <label>Selecciona una imagen de perfil:</label>
                <div class="ui fluid action input">
                    <input type="text" id="_attachmentName" placeholder="Seleccionar un archivo">
                    <label for="archivoAdjunto" class="ui icon button btn-file">Explorar
                        <i class="paperclip basic icon"></i>
                        <input type="file" id="archivoAdjunto" name="archivoAdjunto" accept=".jpg, .png, .jpeg" onchange="cargarImagen()" style="display: none">
                    </label>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-12">
                <label>Vista pervia:</label>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-4 mx-auto">
                <img style="width: 200px; height: 200px; object-fit: cover" class="ui big circular bordered image" id="previa" alt="">
            </div>
        </div>
        <div id="errorImagen"></div>
    </div>
    <div class="actions">
        <div class="ui disabled approve blue button" id="ok">Aceptar</div>
        <div class="ui cancel red button">Cancelar</div>
    </div>
</div>

<div class="ui second small modal" id="modalImagen2">
    <div class="header">Cambiar imagen de perfil</div>
    <div class="content" id="contenido">Se cambió la imagen de perfil con éxito.</div>
    <div class="actions">
        <div class="ui approve button" onclick="window.location.reload();">Aceptar</div>
    </div>
</div>

<div class="ui first small modal" id="modalTema">
    <div class="header">Cambiar color de aplicación</div>
    <div class="content">
        <label>Seleccionar un color:</label>
        <div class="ui fluid search selection dropdown">
            <input type="hidden" name="country" id="slcColor">
            <i class="dropdown icon"></i>
            <div class="default text">Seleccionar color</div>
            <div class="menu">
                <div class="item" data-value="1"><i class="teal circle icon"></i>Verde azulado (defecto)</div>
                <div class="item" data-value="2"><i class="blue circle icon"></i>Azul</div>
                <div class="item" data-value="3"><i class="orange circle icon"></i>Naranja</div>
                <div class="item" data-value="4"><i class="red circle icon"></i>Rojo</div>
                <div class="item" data-value="5"><i class="brown circle icon"></i>Café</div>
                <div class="item" data-value="6"><i class="green circle icon"></i>Verde</div>
            </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui approve blue button">Aceptar</div>
        <div class="ui cancel red button">Cancelar</div>
    </div>
</div>
<div class="ui second small modal" id="modalTema2">
    <div class="header">Cambiar color del tema</div>
    <div class="content" id="contenido">Se cambió el color del tema con éxito.</div>
    <div class="actions">
        <div class="ui approve button" onclick="window.location.reload();">Aceptar</div>
    </div>
</div>