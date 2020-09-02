<?php

    require_once('./views/layouts/body_layout.php');
    require_once('./views/layouts/header_layout.php');
?>

	<!-- Title Page
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m">
		<h2 class="l-text2 t-center" style="color:black;">
			Women
		</h2>
		<p class="m-text13 t-center" style="color:black;">
			New Arrivals Women Collection 2018
		</p>
	</section>
	-->

	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
				</div>
				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<div class="row">
						<?php
						if ($this->products):
							foreach ($this->products as $product):
								?>
									<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
										<div class="block2">
											<div class="block2-img wrap-pic-w of-hidden pos-relative">
												<img src="<?=Assets?>images/<?=$product['url_image'];?>" alt="IMG-PRODUCT">
	
												<div class="block2-overlay trans-0-4">
													<div class="block2-btn-addcart w-size1 trans-0-4">
													
														<!-- <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
															<i class="fa fa-cart-plus"><span> Agregar</span></i>
														</button> -->
													</div>
												</div>
											</div>
	
											<div class="block2-txt p-t-20">
												<a href="<?=URL_BASE?>product/DetailProduct&data=<?= Encrip($product['id_product'])?>" class="block2-name dis-block s-text3 p-b-5">
													<?=$product['name']?>
												</a>
	
												<span class="block2-price m-text6 p-r-5">
												<?= formatMoney($product['price']);?>
												</span>
											</div>
										</div>
									</div>
								<?php
							endforeach;
						else:
							?>
								<div class="col-sm-12 col-md-6 col-lg-6 p-b-50">
									<h1 class="text-center offset-3">No hay productos..</h1>
								</div>
							<?php
						endif;

						?>
					</div>
				</div>
			</div>
		</div>
	</section>







<?php require_once('./views/layouts/footer_layout.php');?>
