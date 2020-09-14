<?php

    require_once('./views/layouts/body_layout.php');
    require_once('./views/layouts/header_layout.php');
?>
<div class="bgwhite p-t-55">
    <div class="container ">
        <div class="dis-flex align-content-center justify-content-center">
            <div class="row col-md-12">
                <?php
                                if ($this->products):
                                ?>
                <?php
                                foreach ($this->products as $product):
                                ?>
                <div class="col-sm-12 col-md-6 col-lg-3 p-b-50">
                    <div class="block2">
                        <div class="block2-img wrap-pic-w of-hidden pos-relative <?=$product['description'];?>">
                            <img src="<?=Assets?>images/<?=$product['url_image'];?>" alt="IMG-PRODUCT">

                            <div class="block2-overlay trans-0-4">
                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                </div>
                            </div>
                        </div>

                        <div class="block2-txt p-t-20">
                            <a href="<?=URL_BASE?>product/DetailProduct&data=<?= Encrip($product['id_product'])?>"
                                class="block2-name dis-block s-text3 p-b-5">
                                <?=$product['name']?>
                            </a>

                            <?php
                                                            
                                                                    if ($product['discount'] == 0):
                                                                        ?>
                            <span class="block2-price m-text6 p-r-5">
                                <?=formatMoney($product['price']);?>
                            </span>
                            <?php
                                                                    else:
                                                                        ?>
                            <span class="block2-oldprice m-text7 p-r-5">
                                <?=formatMoney($product['price']);?>
                            </span>

                            <span class="block2-newprice m-text8 p-r-5">
                                <?php
                                                                            
                                                                            $decial = $product['discount'] / 100;
                                                                            $descount = $product['price'] * $decial;
                                                                            $newtotal = $product['price'] - $descount;

                                                                            echo formatMoney($newtotal);
                                                                            ?>
                            </span>
                            <?php
                                                                    endif;
                                                            
                                                                ?>
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
    <div class="container col-md-12 p-4 dis-flex align-content-center justify-content-center">
        <a class="flex-c-m sizefull bg1 bo-rad-23  s-text1 trans-0-4 col-md-3 p-3"
            href="<?=URL_BASE?>product/index&limit=<?=Encrip(2)?>">Cargar Mas</a>
    </div>
</div>

<?php require_once('./views/layouts/footer_layout.php');?>