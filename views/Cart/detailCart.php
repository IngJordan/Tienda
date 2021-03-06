<?php
    require_once('./views/layouts/body_layout.php');
    require_once('./views/layouts/header_layout.php');
?>

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<form action="<?=URL_BASE?>Sale/Formulario" method="post">
			<div class="container">
				<!-- Cart item -->
				<div class="container-table-cart pos-relative">
					<div class="wrap-table-shopping-cart bgwhite">
						<table class="table-shopping-cart">
							<tr class="table-head">
								<th class="column-1">Imagen</th>
								<th class="column-2">Producto</th>
								<th class="column-2">Descripcion</th>
								<th class="column-4">Precio</th>
								<th class="column-4">Cantidad</th>
								<th class="column-4">Total</th>                         
							</tr>
						
								<?php                        
								if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])):
									$TOTAL = 0;
									foreach ($_SESSION['carrito'] as $index =>$value):
										$TOTAL = $value['PRICE'] * $value['COUNT'];
										?>
										<tr class="table-row">
											<td class="column-1">
												<a href="<?=URL_BASE?>cart/DeleteCart&id=<?=$value['ID']?>&sizes=<?=$value['SIZES']?>&color=<?=$value['COLOR']?>">
													<div class="cart-img-product b-rad-4 o-f-hidden">
														<img src="<?=Assets?>images/<?=$value['IMG']?>" alt="IMG-PRODUCT">
													</div>
												</a>
											</td>
											<td class="column-2"><?=$value['NAME']?></td>
											<td class="column-2 text-capitalize"><?=$value['COLOR']?>,<?=$value['SIZES']?></td>
											<td class="column-4"><?=formatMoney($value['PRICE'])?></td>
											<td class="column-4">
												<div class="">
												<?php
												if ($value['COUNT'] == 0):
													?>
														<a href="<?=URL_BASE?>cart/DeleteCart&id=<?=$value['ID']?>&sizes=<?=$value['SIZES']?>&color=<?=$value['COLOR']?>">
															<i class="fa fa-minus"></i>
														</a>
													<?php
												else:
													?>
														<a href="<?=URL_BASE?>cart/Descriment&id=<?=$value['ID']?>&sizes=<?=$value['SIZES']?>&color=<?=$value['COLOR']?>">
															<i class="fa fa-minus"></i>
														</a> 

													<?php
												endif;
												?>
													<input class="size8 m-text18 t-center num-product" type="number" name="num-product" min="1" value="<?=$value['COUNT']?>" disabled>
													
													<a href="<?=URL_BASE?>cart/Aument&id=<?=$value['ID']?>&sizes=<?=$value['SIZES']?>&color=<?=$value['COLOR']?>">
														<i class="fa fa-plus"></i>
													</a>

												</div>
											</td>
											
											<td class="column-4"><?=formatMoney($TOTAL)?></td>
											
										</tr>
										<?php
									endforeach;
								else:
									
								endif;
								?>
							
						</table>
					</div>
				</div>

				<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
					<div class="flex-w flex-m w-full-sm">
						<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">							
						</div>
					</div>

					<div class="size12 trans-0-4 m-t-10 m-b-10">
						<!-- Button -->
						<a href="<?=URL_BASE?>" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Seguir Comprando
						</a>
					</div>
				</div>

				<!-- Total -->
				<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
					<h5 class="m-text20 p-b-24">
						Carrito
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
									if ($totalProduct >= 100):
									?>
									<input type="text" name="envio" value="0" hidden>
									Gratis
									<?php
									else:
									?>
									<input type="text" name="envio" value="100" hidden>
									<?php
									echo formatMoney(100);
									endif;
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
							if ($totalProduct >= 100):
								echo formatMoney($totalProduct);
							else:
								echo formatMoney($totalProduct + 100);
							endif;
							?>
							
							<input type="text" value="<?=$totalProduct?>" name="total" hidden>
						</span>
					</div>

					<div class="size15 trans-0-4">
						<!-- Button -->
						<?php
							if (isset($_SESSION['USER'])):
								if (isset($_SESSION['carrito'])):
									?>
									<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
										Siguiente
									</button>
									<?php
								else:
									?>
									<button class="flex-c-m sizefull bg1 bo-rad-23  s-text1 trans-0-4" disabled>
										Siguiente
									</button>
									<?php
								endif;

							else:
								?>
									<a href="<?=URL_BASE?>/User/Login">Iniciar sesion</a>
								<?php
							endif;
						?>
					</div>
				</div>
			</div>
		</form>
	</section>


<?php require_once('./views/layouts/footer_layout.php');?>
	
