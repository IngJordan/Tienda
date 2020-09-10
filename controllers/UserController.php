<?php 
require_once('./helpers/helpers.php');
require_once('./models/UserModel.php');
require_once('./vendor/autoload.php');

use Dompdf\Dompdf;

ViewError();


class UserController{

    var $cartModal = "";
    var $menus = "";
    var $objCart = "";
    var $objUser = "";


    public function __construct()
    {
       $this->objCart = new CartController();
       $this->objUser = new UserModel();

    }

    function Login()
    {
        $this->menus = MainMenu();
        $this->cartModal = $this->ModalCart();
        $cantidad = $this->cartModal = $this->ModalCantidad();
        $totalProduct = $this->cartModal = $this->CartTotal();

        require_once('./views/User/login.php');
    }
    

    function Myorder(){
        $this->menus = MainMenu();
        $this->cartModal = $this->ModalCart();
        $cantidad = $this->cartModal = $this->ModalCantidad();
        $totalProduct = $this->cartModal = $this->CartTotal();

        $listOrder = $this->objUser->getListOrder(1);

       
        require_once('./views/User/my_order.php');
    }


    function DetailOrder()
    {
        if (isset($_GET['data'])):
            $this->menus = MainMenu();
            $this->cartModal = $this->ModalCart();
            $cantidad = $this->cartModal = $this->ModalCantidad();
            $totalProduct = $this->cartModal = $this->CartTotal();
            $id_sale = Descript($_GET['data']);

            $listPorduct = $this->objUser->getProductSale(1,$id_sale);
            
            require_once('./views/User/detail_sale.php');

        else:
            header('Location: '.URL_BASE);
        endif;

    }

    function Pdf()
    {
            if (isset($_GET['data'])):

            

                $dompdf = new Dompdf();

                $id_sale = Descript($_GET['data']);
                $listPorduct = $this->objUser->getProductSale(1,$id_sale);
                $Address = $this->objUser->getAddress(1,$id_sale);

                $thml = "";

                $thml .=" <style>
                .odd th,
                .odd td {
                    background: #eee;
                }
        
                table {
                    width: 100%;
        
                }
        
                th,
                td {
                    width: 25%;
                    text-align: center;
                    vertical-align: top;
        
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;
                }
        
                caption {
                    padding: 0.3em;
                    color: #fff;
                    background: #000;
                }
        
                th {
                    background: #eee;
                }
            </style>";

            $thml .= '<h1 style="text-align: center;">Tienda Online</h1>';
            $thml .= '<h2>Detalle de envio</h2>';

            foreach ($Address as $value) {
                $thml .= ' <p>Cliente: '.$value['name'].'</p>';
                $thml .= ' <p>Email: '.$value['email'].'</p>';
                $thml .= ' <p>Dirreccion: Calle '.$value['street'].'  #'.$value['exterior'].'  Col.'.$value['colony'].'  '.$value['municipality'].'  '.$value['state'].'</p>';
                $thml .= ' <p>Referencia: '.$value['referencias'].'</p>';
                $thml .= ' <p>Telefono: '.$value['telephone'].'</p>';
                $thml .= ' <p>Fecha: '.$value['date'].'</p>';
            }

            $thml .= '
            <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Caracteristicas</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
        ';

        $total = 1;
        foreach ($listPorduct as $value) {
            $thml .= '<tr><td>'.$total.'</td>';
            $thml .= '<td>'.$value['name'].'</td>';
            $thml .= '<td>'.$value['characteristic'].'</td>';
            $thml .= '<td>'.$value['price'].'</td>';
            $thml .= '<td>'.$value['count'].'</td>';
            $thml .= '<td>'.$value['total'].'</td></tr>';
            $total ++;
        }

        $thml .= '
            </tbody>
        </table>';

        $total = 0;
        foreach ($listPorduct as $value) {
            $total += $value['price'] * $value['count']; 
        
        }

            if($total >= 100){
                $thml .= '<h3>Sub Total: '.formatMoney($total).'</h3>';
                $thml .= '<h3>Envio: Gratis</h3>';

                $thml .= '<h3>Total: '.formatMoney($total).'  </h3>';

            }else{
                $thml .= '<h3>Sub total: '.formatMoney($total).'</h3>';
                $thml .= '<h3>Envio: '.formatMoney(100).' </h3>';
                $thml .= '<h3>Total: '.(formatMoney($total+100)).'  </h3>';

            }
            
            $thml .= '    <h1 style="text-align: center;  font-family: cursive;">Gracias por la compra</h1>        ';



                $dompdf->loadHtml($thml);

                
                $dompdf->render();
                
                
                $dompdf->stream();
            

            else:
                header('Location: '.URL_BASE);
            endif;

    }

    //Modal Carrito
    function ModalCart()
    {
        $cart = $this->objCart->AddCart();
        return $cart;
    }

    function CartTotal()
    {
        $total = $this->objCart->Total();
        return $total;
    }

    function ModalCantidad()
    {
        $cantidad = $this->objCart->Cantidad();
        return $cantidad;
    }




}










?>