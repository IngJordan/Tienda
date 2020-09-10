<?php
    require_once('./views/layouts/body_layout.php');
    require_once('./views/layouts/header_layout.php'); 
?>


<section class=" container-fluid p-4 l-text2">
    <div class=" border col-md-12 p-3">
        <h1 class="text-center text-black">REALIZAR PAGO</h1>
    </div>
</section>

<form action="" method="post">
    <section class="container p-3">
        <div class="row col-md-12">
            <div class="col-md-6 border">
                <div class="modal-dialog">
                    <div class=" modal-header">
                    <h5> Revisar Carrito </h5>
                    </div>
                    <div class="modal-body">
                        <?php
                        $TOTAL = 0;
                        foreach ($_SESSION['carrito'] as $item => $value):
                            $TOTAL = $value['PRICE'] * $value['COUNT'];
                            ?>
                                <li class="header-cart-item">

                                    <div class="img img-fluid text-center">
                                        <img src="<?=Assets?>images/<?=$value['IMG']?>" width="100">
                                    </div>
                                                
                                    <div class="header-cart-item-txt text-center">
                                        
                                        <span class="header-cart-item-info">
                                            Nombre: <?=$value['NAME'];?>
                                        </span>

                                        <span class="header-cart-item-info text-capitalize">
                                            Color: <?=$value['COLOR'];?>
                                        </span>

                                        <span class="header-cart-item-info">
                                            Talla: <?=$value['SIZES'];?>
                                        </span>
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
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                <div class="border">
                    <div class=" modal-dialog">
                        <div class=" modal-header">
                            <h5>Pago / Mercado Pago</h5>
                        </div>
                        <div class=" modal-body">
                            <img src="<?=Assets?>images/icons/icon-mercadopago.webp" width="400" class="img img-fluid col-md-12">
                            <div class="form-group size15 trans-0-4 col-md-5 p-3">
                                <a class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4 p-4" href="<?php echo $preference->init_point; ?>">Pagar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
</form>


<?php require_once('./views/layouts/footer_layout.php');?>