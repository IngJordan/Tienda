<?php
    require_once('layouts/body_layout.php');
    require_once('layouts/header_layout.php');
?>

<!-- Slider -->
<section class="slide1">
    <div class="wrap-slick1">
        <div class="slick1">
            <?php
                foreach ($this->slider as $value):
                    ?>
                        <div class="item-slick1 item1-slick1" style="background-image: url('<?=Assets?>images/<?=$value['route']?>');">
                            <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                                <h2 class="caption1-slide1 xl-text3 t-center bo15 p-b-3 animated visible-false m-b-25" data-appear="fadeInUp">
                                    <?=$value['name']?>
                                </h2>

                                <span class="caption2-slide1 m-text27 t-center animated visible-false m-b-30" data-appear="fadeInDown">
                                    <?=$value['description']?>
                                </span>

                            </div>
                        </div>
                    <?php
                endforeach;
            ?>
        </div>
    </div>
</section>

<!-- Banner -->
<section class="banner bgwhite p-t-40 p-b-40">
    <div class="container">
        <div class="row">
           <?php
           
           foreach ($this->categories as $categorie):
               ?>
                     <div class="col-sm-10 col-md-8 col-lg-4 m-l-r-auto">
                        <!-- block1 -->
                        <div class="block1 hov-img-zoom pos-relative m-b-30 border">
                            <img src="<?=Assets?>images/<?=$categorie['route'];?>" alt="IMG-BENNER">

                            <div class="block1-wrapbtn w-size2">
                                <a href="<?=URL_BASE?>product/index&data=<?=Encrip($categorie['id_categorie']);?>" class="flex-c-m size2 m-text2 bg3 hov1 trans-0-4">
                                    <?=$categorie['name'];?>
                                </a>
                            </div>
                        </div>
                    </div>
               <?php
            endforeach;
           ?>
        </div>
    </div>
</section>

	<!-- Oferts -->
	<section class="newproduct bgwhite p-t-45 p-b-105">
		<div class="container">
			<div class="sec-title p-b-60">
				<h3 class="m-text5 t-center">
					Ofertas
				</h3>
            </div>
            
			<div class="wrap-slick2">
				<div class="slick2">
                    <?php
                    foreach ($this->ofert as $product) {
                        ?>
                            <div class="item-slick2 p-l-15 p-r-15">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-img wrap-pic-w of-hidden pos-relative <?=$product['description'];?>">
                                        <img src="<?=Assets?>images/<?=$product['route_image'];?>" alt="IMG-PRODUCT">
                                        <div class="block2-overlay trans-0-4">
                                            <div class="block2-btn-addcart w-size1 trans-0-4">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="block2-txt p-t-20">
                                        <a href="<?=URL_BASE?>product/DetailProduct&data=<?= Encrip($product['id_product'])?>" class="block2-name dis-block s-text3 p-b-5">
                                            <?=$product['prodduct_name']?>
                                        </a>

                                        <?php
                                        
                                        if ($product['discount'] == 0) {
                                            ?>
                                                <span class="block2-price m-text6 p-r-5">
                                                <?=formatMoney($product['product_price']);?>
                                                </span>
                                            <?php
                                        }else{
                                            ?>
                                                <span class="block2-oldprice m-text7 p-r-5">
                                                    <?=formatMoney($product['product_price']);?>
                                                </span>

                                                <span class="block2-newprice m-text8 p-r-5">
                                                <?php
                                                
                                                $decial = $product['discount'] / 100;
                                                $descount = $product['product_price'] * $decial;
                                                $newtotal = $product['product_price'] - $descount;

                                                echo formatMoney($newtotal);
                                                ?>
                                                </span>
                                            <?php
                                        }
                                        
                                        ?>
                                    </div>
                                </div>
                            </div>
                        
                        <?php
                    }
                    ?>            
				</div>
			</div>

		</div>
    </section>
    
    <!-- Products -->
    <section class="bgwhite p-t-45 p-b-58">
        <div class=" container">
            <div class="sec-title p-b-22">
                <h3 class="m-text5 t-center">
                    Catalogo
                </h3>
            </div>

            <div class="tab01">
                <div class="p-3">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <button class="nav-link filter-button" data-filter="all">All</button>
                        </li>
                        <?php 
                            foreach ($this->categories as $categorie):
                                ?>
                                <li class="nav-item">
                                    <button class="nav-link btn-default filter-button text-capitalize"
                                    data-filter="<?=$categorie['name'];?>"><?=$categorie['name'];?></button>
                                </li>
                                <?php
                            endforeach;
                        ?>
                    </ul>
                </div>
                <div class="tab-pane">
                    <div class="row align-content-start">
                        <?php
                            foreach ($this->products as $product):
                                ?>
                                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-50 filter <?=$product['name_categori'];?>">
                                        <div class="block2 ">
                                            <div class="block2-img wrap-pic-w of-hidden pos-relative <?=$product['description'];?>">
                                                <img src="<?=Assets?>images/<?=$product['route_image'];?>" alt="IMG-PRODUCT">
                                                <div class="block2-overlay trans-0-4">
                                                    <div class="block2-btn-addcart w-size1 trans-0-4">
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div class="block2-txt p-t-20">
                                                <a href="<?=URL_BASE?>product/DetailProduct&data=<?= Encrip($product['id_product'])?>" class="block2-name dis-block s-text3 p-b-5">
                                                    <?=$product['prodduct_name']?>
                                                </a>

                                                <?php
                                                
                                                if ($product['discount'] == 0) {
                                                    ?>
                                                        <span class="block2-price m-text6 p-r-5">
                                                        <?=formatMoney($product['product_price']);?>
                                                        </span>
                                                    <?php
                                                }else{
                                                    ?>
                                                        <span class="block2-oldprice m-text7 p-r-5">
                                                            <?=formatMoney($product['product_price']);?>
                                                        </span>

                                                        <span class="block2-newprice m-text8 p-r-5">
                                                        <?php
                                                        
                                                        $decial = $product['discount'] / 100;
                                                        $descount = $product['product_price'] * $decial;
                                                        $newtotal = $product['product_price'] - $descount;

                                                        echo formatMoney($newtotal);
                                                        ?>
                                                        </span>
                                                    <?php
                                                }
                                                
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php
                            endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shipping bgwhite p-t-62 p-b-46">
        <div class="flex-w p-l-15 p-r-15">
            <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
                <h4 class="m-text12 t-center">
                    Entrega gratuita en todo el mundo
                </h4>

                <a href="#" class="s-text11 t-center">
                    Haga clic aquí para más información
                </a>
            </div>

            <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 bo2 respon2">
                <h4 class="m-text12 t-center">
                    Devolución de 30 días
                </h4>

                <span class="s-text11 t-center">
                    Simplemente devuélvalo dentro de los 30 días para cambiarlo.
                </span>
            </div>

            <div class="flex-col-c w-size5 p-l-15 p-r-15 p-t-16 p-b-15 respon1">
                <h4 class="m-text12 t-center">
                    Apertura de tienda
                </h4>

                <span class="s-text11 t-center">
                    Tienda abierta de lunes a domingo
                </span>
            </div>
        </div>
    </section>

<?php require_once('layouts/footer_layout.php');?>

    <?php
        if (isset($_SESSION['Success'])) {
            ?>
                <script type="text/javascript">
                    alertify.success("Bienvenido");
                </script>
            <?php
        };

        unset($_SESSION['Success']);
    ?>

