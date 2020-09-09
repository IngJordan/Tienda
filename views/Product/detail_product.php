<?php
    require_once('./views/layouts/body_layout.php');
    require_once('./views/layouts/header_layout.php');
?>
<form action="<?=URL_BASE?>Cart/AddCart" method="post">
	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">
			<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>
					<div class="slick3">
						<?php
						foreach ($this->images as $image):
							?>
								<div class="item-slick3" data-thumb="<?=Assets?>images/<?=$image['url_image']?>">
									<div class="wrap-pic-w">
										<img src="<?=Assets?>images/<?=$image['url_image']?>" alt="IMG-PRODUCT">
									</div>
								</div>
							<?php
						endforeach;
						?>
					</div>
				</div>
			</div>

			
			<?php 
			foreach ($this->oneProduct as $product):
				?>
					<div class="w-size14 p-t-30 respon5">
						
						<!--ID DEL PRODUCTO-->
						<input name="id" type="text" value="<?=$product['id_product']?>" hidden>

						<h4 class="product-detail-name m-text16 p-b-13">
							<?=$product['name'];?>
						</h4>

						<?php
                                            
						if ($product['discount'] == 0) {
							?>
								<span class="m-text17">
									<?=formatMoney($product['price']);?>
								</span>
							<?php
						}else{
							?>
								<span class="block2-oldprice m-text7 p-r-5">
									<?=formatMoney($product['price']);?>
								</span>

								<span class="block2-newprice m-text17 p-r-5 text-danger">
								<?php
								
									$decial = $product['discount'] / 100;
									$descount = $product['price'] * $decial;
									$newtotal = $product['price'] - $descount;

									echo formatMoney($newtotal);
								?>
								</span>
							<?php
						}
						
						?>

						<div class="p-t-33 p-b-60">

							<div class="flex-m flex-w p-b-10">
								<div class="s-text15 w-size15 t-center">
									Talla
								</div>

								<div class="col-md-6">
									<select class="selectpicker" data-live-search="true" name="sizes">
										<?php 
										foreach ($this->sizes as $size):
											?>
												<option value="<?=$size['name']?>" data-tokens="<?=$size['name']?>"><?= ucfirst($size['name']);?></option>
											<?php
										endforeach;
										?>
									</select>
								</div>
							</div>

							<div class="flex-m flex-w">
								<div class="s-text15 w-size15 t-center">
									Color
								</div>

								<div class="col-md-6">
									<select class="selectpicker text-capitalize" data-live-search="true" name="color">
										<?php 
										foreach ($this->colors as $color):
											?>
												<option value="<?=$color['name']?>" data-tokens="<?=$color['name']?>"><?= ucfirst($color['name']);?></option>
											<?php
										endforeach;
										?>
									</select>
								</div>
							</div>

							<div class="flex-m flex-w">
								<div class="s-text15 w-size15 t-center">
								</div>
								<div class="col-md-6">
									<?php 
										foreach ($this->colors as $color):
											?>
												<input type="color" value="<?=$color['codigo']?>" disabled title="<?=ucfirst($color['name']);?>">
											<?php
										endforeach;
									?>
								</div>
							</div>

							<div class="flex-r-m flex-w p-t-10">
								<div class="w-size16 flex-m flex-w">
									<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
										<input class="size8 m-text18 t-center num-product col-" type="text" name="num-product" value="1" hidden> 
									</div>

									 <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
										<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
											Agregar
										</button>
									</div> 
								</div>
							</div>
						</div>

						
						<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
							<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
								Descripcion
								<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
								<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
							</h5>

							<div class="dropdown-content dis-none p-t-15 p-b-23">
								<p class="s-text8">
									<?=$product['description']?>
								</p>
							</div>
						</div>

					</div>
				<?php	
			endforeach;
			?>
			
		</div>
	</div>
	</form>
	<!--Comentarios del producto-->
	<div class="container">
		<div class="fb-comments" data-href="<?=URL_BASE?><?=$this->commets?>" data-numposts="20" data-width="100%"></div>
	</div>

<?php require_once('./views/layouts/footer_layout.php');?>