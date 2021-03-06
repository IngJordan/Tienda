<?php
    require_once('./views/layouts/body_layout.php');
    require_once('./views/layouts/header_layout.php'); 
?>
<section class=" container-fluid p-4 l-text2">
    <div class=" border col-md-12 p-3">
        <h1 class="text-center text-black">FORMULARIO DE ENVIO</h1>
    </div>
</section>

<div class=" clearfix"></div>

<form action="<?=URL_BASE?>Sale/Registro" method="post">
    <section class="p-t-70 p-b-100">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="form-group col-md-6">
                        <label>Nombre y Apellido</label>
                        <div class="bo4 of-hidden">
                            <input type="text" class="form-control" name="nombre" value="<?= $_SESSION['USER']['NAME']?>" required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Correo Electronico</label>
                        <div class="bo4 of-hidden">
                            <input type="email" class="form-control" name="email" value="<?= $_SESSION['USER']['EMAIL']?>" required>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Codigo Postal</label>
                        <div class="bo4 of-hidden">
                            <input type="number" class="form-control" name="cp" required>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="form-group col-md-6">
                            <label>Estado</label>
                            <div class="bo4 of-hidden">
                                <input type="text" class="form-control" name="estado" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Delegacion / Municipio</label>
                            <div class="bo4 of-hidden">
                                <input type="text" class="form-control" name="municipio" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Colonia / Asentamiento</label>
                        <div class="bo4 of-hidden">
                            <input type="text" class="form-control" name="colonia" required>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="form-group col-md-6">
                            <label>Calle</label>
                            <div class="bo4 of-hidden">
                                <input type="text" class="form-control" name="calle" required>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nº Exterior</label>
                            <div class="bo4 of-hidden">
                                <input type="number" class="form-control" name="ext" required>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nº Interior / Depto(opcional)</label>
                            <div class="bo4 of-hidden">
                                <input type="number" class="form-control" name="int" >
                            </div>
                        </div>
                    </div>
                    <div class=" form-group col-md-12">
                        <p>¿Entre que calles esta?</p>
                    </div>
                    <div class="row col-md-12">
                        <div class="form-group col-md-6">
                            <label>Calle 1</label>
                            <div class="bo4 of-hidden">
                                <input type="text" class="form-control" name="calle1" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Calle 2</label>
                            <div class="bo4 of-hidden">
                                <input type="text" class="form-control" name="calle2" required>
                            </div>
                        </div>
                    </div>
                    <div class=" form-group col-md-12">
                        <p>¿Es tu trabajo o casa?</p>
                    </div>
                    <div class="row form-group col-md-12">
                        <div class="form-group form-check col-md-2">
                            <input class="form-check-input" type="radio" name="radio" id="exampleRadios1"
                                value="trabajo" required>
                            <label class="form-check-label" for="exampleRadios1">
                                Trabajo
                            </label>
                        </div>
                        <div class="form-group form-check col-md-2">
                            <input class="form-check-input" type="radio" name="radio" id="exampleRadios1"
                                value="casa" required>
                            <label class="form-check-label" for="exampleRadios1">
                                Casa
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Telefono de contacto</label>
                        <div class="bo4 of-hidden">
                            <input type="number" class="form-control" placeholder="Incluye la lada de tu pais"
                                name="telefono" value="<?= $_SESSION['USER']['TELEPHONE']?>" required>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Indicaciones adicionales para entregar tus compras en esta direccion</label>
                        <div class="bo4 of-hidden">
                            <textarea name="referencias" id="" cols="30" rows="10" class=" form-control"
                                placeholder="Descripcion de la fachada, puntos de referencia para encontrarla, indicaciones de seguridad , etc." required></textarea>
                        </div>
                    </div>
                    <div class="form-group size15 trans-0-4 col-md-3">
                        <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">Siguiente</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

<?php require_once('./views/layouts/footer_layout.php');?>