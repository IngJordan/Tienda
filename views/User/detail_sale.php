<?php
    require_once('./views/layouts/body_layout.php');
    require_once('./views/layouts/header_layout.php');
?>

<section class=" container-fluid p-4 l-text2">
    <div class=" border col-md-12 p-3">
        <h1 class="text-center text-black">Productos Comprados</h1>
    </div>
</section>

<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
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
                    foreach ($listPorduct as $value):
                        ?>
                        <tr class="table-row">
                            <td class="column-1">
                                <div class="img img-responsive">
                                    <img src="<?=Assets?>images/<?=$value['route']?>" alt="" width="100">
                                </div>
                            </td>
                            <td class="column-2"><?=$value['name']?></td>
                            <td class="column-2 text-capitalize"><?=$value['characteristic']?></td>
                            <td class="column-3"><?=formatMoney($value['price'])?></td>
                            <td class="column-4"><?=$value['count']?></td>
                            <td class="column-5"><?=formatMoney($value['total'])?></td>
                        </tr>
                        <?php 

                    endforeach;
                    ?>
                </table>
            </div>
        </div>
    </div>
</section>


<?php require_once('./views/layouts/footer_layout.php');?>
