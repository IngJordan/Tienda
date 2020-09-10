<?php
    require_once('./views/layouts/body_layout.php');
    require_once('./views/layouts/header_layout.php');
?>

<section class=" container-fluid p-4 l-text2">
    <div class=" border col-md-12 p-3">
        <h1 class="text-center text-black">MIS PEDIDOS REALIZADOS</h1>
    </div>
</section>


<div class="container col-md-6 p-5">
    <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($listOrder as $value):
                    ?>

                    <tr>
                        <td><?=$count?></td>
                        <td><?=formatMoney($value['total'])?></td>
                        <td><?=$value['date']?></td>
                        <?php

                        if ($value['name'] == "pagado"):
                            ?>
                                <td class="text-success"><?=$value['name']?></td>
                            <?php
                        else:
                            ?>
                                <td class=" text-warning"><?=$value['name']?></td>
                            <?php
                        endif;
                        ?>
                        <td>
                            <a href="<?=URL_BASE?>User/DetailOrder&data=<?=Encrip($value['id_sale'])?>"> Detalle </a>
                            <a href="<?=URL_BASE?>User/Pdf&data=<?=Encrip($value['id_sale'])?>" target="_blank"> Resivo (PDF) </a>
                        </td>
                    </tr>

                    <?php
                    $count ++;
                endforeach;
                
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
    </table>
</div>



<?php require_once('./views/layouts/footer_layout.php');?>
