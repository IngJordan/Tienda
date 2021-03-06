	<!-- Header -->
	<header class="header1">
	    <!-- Header desktop -->
	    <div class="container-menu-header">
	        <div class="topbar">
	            <div class="topbar-social">
	                <a href="#" class="topbar-social-item fa fa-facebook"></a>
	                <a href="#" class="topbar-social-item fa fa-instagram"></a>
	                <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
	            </div>

	            <span class="topbar-child1">
	                Envío gratis para pedidos superiores a $100.00 MXN
	            </span>
	        </div>

	        <div class="wrap_header">
	            <!-- Logo -->
	            <a href="<?=URL_BASE?>" class="logo">
	                <img src="<?=Assets?>images/icons/logo.png" alt="IMG-LOGO">
	            </a>


	            <div class="wrap_menu">
	                <nav class="menu text-capitalize">
						<!--se imprime el menu -->
						<?= $this->menus ?>	
	                </nav>
	            </div>

	            <!-- Header Icon -->
	            <div class="header-icons">

					
	                <div class="header-wrapicon2">
						
	                    <img src="<?=Assets?>images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown"
	                        alt="ICON">
					   <?php
					  	if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])):
							  ?>
							 	 <span class="header-icons-noti"><?=$cantidad?></span> 
							  <?php
						  else:
							  ?>
							 	 <span class="header-icons-noti">0</span>  
							  <?php
						  endif;
					   ?>

	                    <!-- Header cart noti -->
	                    <div class="header-cart header-dropdown">
	                        <ul class="header-cart-wrapitem">
							<?php 
								if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])):
									$TOTAL = 0;
									foreach ($_SESSION['carrito'] as $indice => $value):
										$TOTAL = $value['PRICE'] * $value['COUNT'];
										?>
										<li class="header-cart-item">
											
											<a href="<?=URL_BASE?>cart/DeleteCart&id=<?=$value['ID']?>&sizes=<?=$value['SIZES']?>&color=<?=$value['COLOR']?>">
												<div class="header-cart-item-img">
													<img src="<?=Assets?>images/<?=$value['IMG']?>" alt="IMG">
												</div>
											</a>
											
											<div class="header-cart-item-txt">
												<a href="<?=URL_BASE?>product/DetailProduct&data=<?= Encrip($value['ID'])?>" class="header-cart-item-name">
													<?=$value['NAME'];?>
												</a>

												<span class="header-cart-item-info">
													Precio: <?=formatMoney($value['PRICE']);?>
												</span>

												<span class="header-cart-item-info">
													Cantidad: <?=$value['COUNT'];?>
												</span>

												<span class="header-cart-item-info">
													Total: <?=formatMoney($TOTAL)?>
												</span>

											</div>
	                            		</li>
										<?php
									endforeach;

								else:
									?>
									<li class="header-cart-item">
										Carrito Vacio
									</li>
									<?php
								endif;
							?>
	                            
	                        </ul>

	                        <div class="header-cart-total">
	                            Total: <?=formatMoney($totalProduct)?>
	                        </div>

	                        <div class="header-cart-buttons">
	                            <div class="header-cart-wrapbtn">
	                            </div>

	                            <div class="header-cart-wrapbtn">
	                                <!-- Button -->
	                                <a href="<?=URL_BASE?>Cart/DetailCart" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										Ver Carrito
	                                </a>
	                            </div>
	                        </div>
						</div>
						
					</div>

					<span class="linedivide1"></span>

					<div class="header-wrapicon2">
						
	                    <img src="<?=Assets?>images/icons/icon-header-01.png" class="header-icon1 js-show-header-dropdown"
	                        alt="ICON">

	                    <!-- Header user -->
	                    <div class="header-cart header-dropdown">
							<?php
							
							if (isset($_SESSION['USER'])) {
								if ($_SESSION['USER']['PROFILE'] == 'Cliente') {
									?>
									<ul class="header-cart-wrapitem">
										<li><a><?='Hola '.$_SESSION['USER']['NAME'];?></a></li>
										<li>
										<a href="">Mi cuenta</a>
										</li>
										<li>
										<a href="<?=URL_BASE?>User/Myorder">Mis pedidos</a>
										</li>
										<li>
										<a href="<?=URL_BASE?>User/UserCheck&data=<?=Encrip('exit')?>">Cerrar Session</a>
										</li>
									</ul>
									<?php
								}
							}else{
								?>
								<ul class="header-cart-wrapitem">
									<li class="header-cart-item">
										<a href="<?=URL_BASE?>User/Login">Login / Registro</a>
									</li>
								</ul>
								<?php
							}
							
							?>	                       
						</div>
	                </div>
	            </div>
	        </div>
	    </div>

	    <!-- Header Mobile -->
	    <div class="wrap_header_mobile">
	        <!-- Logo moblie -->
	        <a href="index.html" class="logo-mobile">
	            <img src="<?=Assets?>images/icons/logo.png" alt="IMG-LOGO">
	        </a>

	        <!-- Button show menu -->
	        <div class="btn-show-menu">
	            <!-- Header Icon mobile -->
	            <div class="header-icons-mobile">
	                <a href="#" class="header-wrapicon1 dis-block">
	                    <img src="<?=Assets?>images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
	                </a>

	                <span class="linedivide2"></span>

	                <div class="header-wrapicon2">
	                    <img src="<?=Assets?>images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown"
	                        alt="ICON">
	                    <span class="header-icons-noti">0</span>

	                    <!-- Header cart noti -->
	                    <div class="header-cart header-dropdown">
	                        <ul class="header-cart-wrapitem">
	                            <li class="header-cart-item">
	                                <div class="header-cart-item-img">
	                                    <img src="<?=Assets?>images/item-cart-01.jpg" alt="IMG">
	                                </div>

	                                <div class="header-cart-item-txt">
	                                    <a href="#" class="header-cart-item-name">
	                                        White Shirt With Pleat Detail Back
	                                    </a>

	                                    <span class="header-cart-item-info">
	                                        1 x $19.00CDSCDSCD
	                                    </span>
	                                </div>
	                            </li>

	                            <li class="header-cart-item">
	                                <div class="header-cart-item-img">
	                                    <img src="<?=Assets?>images/item-cart-02.jpg" alt="IMG">
	                                </div>

	                                <div class="header-cart-item-txt">
	                                    <a href="#" class="header-cart-item-name">
	                                        Converse All Star Hi Black Canvas
	                                    </a>

	                                    <span class="header-cart-item-info">
	                                        1 x $39.00
	                                    </span>
	                                </div>
	                            </li>

	                            <li class="header-cart-item">
	                                <div class="header-cart-item-img">
	                                    <img src="<?=Assets?>images/item-cart-03.jpg" alt="IMG">
	                                </div>

	                                <div class="header-cart-item-txt">
	                                    <a href="#" class="header-cart-item-name">
	                                        Nixon Porter Leather Watch In Tan
	                                    </a>

	                                    <span class="header-cart-item-info">
	                                        1 x $17.00
	                                    </span>
	                                </div>
	                            </li>
	                        </ul>

	                        <div class="header-cart-total">
	                            Total: $75.00
	                        </div>

	                        <div class="header-cart-buttons">
	                            <div class="header-cart-wrapbtn">
	                                <!-- Button -->
	                                <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
	                                    View Cart
	                                </a>
	                            </div>

	                            <div class="header-cart-wrapbtn">
	                                <!-- Button -->
	                                <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
	                                    Check Out
	                                </a>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>

	            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
	                <span class="hamburger-box">
	                    <span class="hamburger-inner"></span>
	                </span>
	            </div>
	        </div>
	    </div>

	    <!-- Menu Mobile -->
	    <div class="wrap-side-menu">
	        <nav class="side-menu">
	            <ul class="main-menu">
	                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
	                    <span class="topbar-child1">
	                        Envío gratis para pedidos estándar superiores a $100.00 MXN
	                    </span>
	                </li>

	                <li class="item-topbar-mobile p-l-10">
	                    <div class="topbar-social-mobile">
	                        <a href="#" class="topbar-social-item fa fa-facebook"></a>
	                        <a href="#" class="topbar-social-item fa fa-instagram"></a>
	                        <a href="#" class="topbar-social-item fa fa-youtube-play"></a>
	                    </div>
	                </li>
	                <li class="item-menu-mobile">
						<a href="<?=URL_BASE?>">Inicio
					</a>
	                </li>
	            </ul>
	        </nav>
		</div>
		
	</header>


	