<?php
    require_once('./views/layouts/body_layout.php');
    require_once('./views/layouts/header_layout.php');
?>

<section class=" container-fluid p-4 l-text2">
    <div class=" border col-md-12 p-3">
        <h1 class="text-center text-black">Registro / Login</h1>
    </div>
</section>


<div class="container col-md-12 p-4 dis-flex align-content-center justify-content-center">
    <div class="card col-md-6 ">
        <div class="card-body">
            <div class="row text-center align-content-center justify-content-center">
                <div class="col-md-3">
                    <a href="#" id="login-form-link" class="active col-md-3">
                        <h4>Login</h4>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" id="register-form-link" class="col-md-3">
                        <h4>Registro</h4>
                    </a>
                </div>
            </div>
            <form action="<?=URL_BASE?>User/UserCheck&data=<?=Encrip("login");?>" method="post" id="login-form"
                role="form" style="display: block;">
                <div class="form-group col-md-12">
                    <label for="">Correo Electronico</label>
                    <div class="bo4 of-hidden">
                        <input type="text" name="email" class="form-control">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Contraseña</label>
                    <div class="bo4 of-hidden">
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>

                <div class=" form-group">
                    <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                </div>

            </form>
            <form action="<?=URL_BASE?>User/UserCheck&data=<?=Encrip("registro");?>" method="post" id="register-form"
                role="form" style="display: none;">
                <div class="form-group col-md-12">
                    <label for="">Nombre </label>
                    <div class="bo4 of-hidden">
                        <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Apellidos</label>
                    <div class="bo4 of-hidden">
                        <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Correo Electronico</label>
                    <div class="bo4 of-hidden">
                        <input type="email" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Contraseña</label>
                    <div class="bo4 of-hidden">
                        <input type="password" name="" id="" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Confirmar Contraseña</label>
                    <div class="bo4 of-hidden">
                        <input type="password" name="" id="" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Telefono</label>
                    <div class="bo4 of-hidden">
                        <input type="number" name="" id="" class="form-control" placeholder=""
                            aria-describedby="helpId">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Fecha de nacimiento</label>
                    <div class="bo4 of-hidden">
                        <input type="date" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Sexo</label>
                    <div class="bo4 of-hidden">
                        <select class="form-control">
                            <option value="">Hombre</option>
                            <option value="">Mujer</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form-check">
                    <p class="form-check-label text-justify" for="exampleCheck1">Al hacer clic en "Registrarte", aceptas
                        nuestras
                        Condiciones, la Política de datos y la Política de cookies. Es posible que te enviemos
                        notificaciones por SMS, que puedes desactivar cuando quieras.</p>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
            </form>
        </div>
    </div>
</div>



<?php require_once('./views/layouts/footer_layout.php');?>

<script>
$(function() {

    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });

});
</script>