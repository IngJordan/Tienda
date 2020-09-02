<?php
    require_once('./views/layouts/body_layout.php');
    require_once('./views/layouts/header_layout.php');
?>

    
<section class="p-t-70 p-b-100">
	<div class="container">
        <div class="card">
            <div class="card-body"> 
                <div class="form-group col-md-6">
                    <label>Nombre y Apellido</label>
                    <div class="bo4 of-hidden">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Codigo Postal</label>
                    <div class="bo4 of-hidden">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <label>Estado</label>
                        <div class="bo4 of-hidden">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Delegacion / Municipio</label>
                        <div class="bo4 of-hidden">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Colonia / Asentamiento</label>
                    <div class="bo4 of-hidden">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <label>Calle</label>
                        <div class="bo4 of-hidden">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Nº Exterior</label>
                        <div class="bo4 of-hidden">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Nº Interior / Depto(opcional)</label>
                        <div class="bo4 of-hidden">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
               <div class=" form-group col-md-12">
                   <p>¿Entre que calles esta? (opcional)</p>
               </div>
                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <label>Calle 1</label>
                        <div class="bo4 of-hidden">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Calle 2</label>
                        <div class="bo4 of-hidden">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class=" form-group col-md-12">
                   <p>¿Es tu trabajo o casa?</p>
               </div>
               <div class="row form-group col-md-12">
                    <div class="form-group form-check col-md-2">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                    <label class="form-check-label" for="exampleRadios1">
                        Trabajo
                    </label>
                    </div>
                    <div class="form-group form-check col-md-2">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1">
                    <label class="form-check-label" for="exampleRadios1">
                        Casa
                    </label>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Telefono de contacto</label>
                    <div class="bo4 of-hidden">
                        <input type="number" class="form-control" placeholder="Incluye la lada de tu pais">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label>Indicaciones adicionales para entregar tus compras en esta direccion</label>
                    <div class="bo4 of-hidden">
                        <textarea name="" id="" cols="30" rows="10" class=" form-control" placeholder="Descripcion de la fachada, puntos de referencia para encontrarla, indicaciones de seguridad , etc."></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
					<h5 class="m-text20 p-b-24">
						Resivo
					</h5>

					<!--  -->
					<div class="flex-w flex-sb-m p-b-12">
						<span class="s-text18 w-size19 w-full-sm">
							Subtotal:
						</span>

						<span class="m-text21 w-size20 w-full-sm">
							<?= formatMoney($totalProduct) ?>
						</span>
					</div>

					<!--  -->
					<div class="flex-w flex-sb bo10 p-t-15 p-b-20">
						<span class="s-text18 w-size19 w-full-sm">
							Envio:
						</span>

						<div class="w-size20 w-full-sm">
							<p class="s-text8 p-b-23">
								<?php 
								
								if ($totalProduct >= 100) {
								?>
								Gratis
								<?php
								}else{
								echo formatMoney(100);
								}
								
								?>
							</p>
							
						</div>
					</div>

					<!--  -->
					<div class="flex-w flex-sb-m p-t-26 p-b-30">
						<span class="m-text22 w-size19 w-full-sm">
							Total:
						</span>

						<span class="m-text21 w-size20 w-full-sm">
							<?php
							
							if ($totalProduct >= 100) {
								echo formatMoney($totalProduct);
							}else{
								echo formatMoney($totalProduct + 100);
							}
							
							?>
						</span>
                    </div>
                    
                    <div class="flex-w flex-sb-m p-t-26 p-b-30">
                        <img src="<?=Assets?>images/icons/icon-mercadopago.webp" width="" class="img img-fluid">	
					</div>

					<div class="size15 trans-0-4">
						<!-- Button -->
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Pagar
						</button>
					</div>
				</div>
    </div>
</section>


<?php require_once('./views/layouts/footer_layout.php');?>
