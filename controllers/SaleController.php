<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('./helpers/helpers.php');
// SDK de Mercado Pago
require('./vendor/autoload.php');

require_once('./models/SuccessModel.php');


//ViewError();

//vendedor
//id 638025510
//usuario TETE1344796
//contraseña qatest5120
//email test_user_26895227@testuser.com

//comprador 
//id 638025895
//usuario TESTRCLYN301
//contraseña qatest9215
//email test_user_9125454@testuser.com

//5031 7557 3453 0604
//11/25
//123
//APRO

class SaleController
{
    var $cartModal = "";
    var $menus = "";
    var $objCart = "";
    var $objSuccess = "";
    

    public function __construct()
    {
       $this->objCart = new CartController();
       $this->objSuccess = new SucessModel();
    }

    function Formulario()
    {
        if (isset($_SESSION['carrito'])):
            $this->menus = MainMenu();
            $this->cartModal = $this->ModalCart();
            $cantidad = $this->cartModal = $this->ModalCantidad();
            $totalProduct = $this->cartModal = $this->CartTotal(); 

            if(!isset($_SESSION['total-product'])):
                $_SESSION['total-product'] = array(
                    'envio' =>$_POST['envio'],
                    'total' =>$_POST['total']
                );

            else:
                $_SESSION['total-product'] = array(
                    'envio' =>$_POST['envio'],
                    'total' =>$_POST['total']
                );
            endif;
            
            require_once('views/Order/form.php');
        else:

            header('Location: '.URL_BASE);

        endif;
    }

    function Registro()
    {
        if (isset($_SESSION['carrito'])):

            if(!isset($_POST['nombre']) ? $_POST['nombre'] : null):
                header('Location: '.URL_BASE.' Sale/Formulario');
            elseif(!isset($_POST['email']) ? $_POST['email'] : null):
                header('Location: '.URL_BASE.' Sale/Formulario');
            elseif(!isset($_POST['cp']) ? $_POST['cp'] : null):
                header('Location: '.URL_BASE.' Sale/Formulario');
            elseif(!isset($_POST['estado']) ? $_POST['estado'] : null):
                header('Location: '.URL_BASE.' Sale/Formulario');
            elseif(!isset($_POST['municipio']) ? $_POST['municipio'] : null):
                header('Location: '.URL_BASE.' Sale/Formulario');
            elseif(!isset($_POST['colonia']) ? $_POST['colonia'] : null):
                header('Location: '.URL_BASE.' Sale/Formulario');
            elseif(!isset($_POST['calle']) ? $_POST['calle'] : null):
                header('Location: '.URL_BASE.' Sale/Formulario');
            elseif(!isset($_POST['ext']) ? $_POST['ext'] : null):
                header('Location: '.URL_BASE.' Sale/Formulario');
            elseif(!isset($_POST['int']) ? $_POST['int'] : null):
                header('Location: '.URL_BASE.' Sale/Formulario');
            elseif(!isset($_POST['calle1']) ? $_POST['calle1'] : null):
                header('Location: '.URL_BASE.' Sale/Formulario');
            elseif(!isset($_POST['calle2']) ? $_POST['calle2'] : null):
                header('Location: '.URL_BASE.' Sale/Formulario');
            elseif(!isset($_POST['radio']) ? $_POST['radio'] : null):
                header('Location: '.URL_BASE.' Sale/Formulario');
            elseif(!isset($_POST['telefono']) ? $_POST['telefono'] : null):
                header('Location: '.URL_BASE.' Sale/Formulario');
            elseif(!isset($_POST['referencias']) ? $_POST['referencias'] : null):
                header('Location: '.URL_BASE.' Sale/Formulario');
            else:

                $_SESSION['form-envio'] = array(
                    'name' =>   CleanString($_POST['nombre']),
                    'email' =>  CleanString($_POST['email']),
                    'cp' =>     CleanString($_POST['cp']) ,
                    'estado' => CleanString($_POST['estado']),
                    'municipio' => CleanString($_POST['municipio']) ,
                    'colonia' => CleanString($_POST['colonia']),
                    'calle' => CleanString($_POST['calle']),
                    'ext' => CleanString($_POST['ext']),
                    'int' => CleanString($_POST['int']),
                    'calle1' => CleanString($_POST['calle1']),
                    'calle2' => CleanString($_POST['calle2']),
                    'radio' => CleanString($_POST['radio']),
                    'telefono' => CleanString($_POST['telefono']),
                    'referencias' => CleanString($_POST['referencias'])
                );

                header ("Location: ".URL_BASE."Sale/Pago");

            endif;

        else:
            header ("Location: ".URL_BASE);
        endif;
    }

    function Pago()
    {
        if (isset($_SESSION['carrito'])):
            $this->menus = MainMenu();
            $this->cartModal = $this->ModalCart();
            $cantidad = $this->cartModal = $this->ModalCantidad();
            $totalProduct = $this->cartModal = $this->CartTotal();

            // Agrega credenciales //vendedor
            MercadoPago\SDK::setAccessToken('TEST-6674804345396962-090319-656db01b6de286e8bd3251f0525af531-638025510');
            // Crea un objeto de preferencia
            $preference = new MercadoPago\Preference();

            $preference->back_urls = array(
                "success" => URL_BASE."Sale/Success",
                "failure" => URL_BASE."Sale/failure",
                "pending" => URL_BASE."Sale/pending"
            );

            $preference->auto_return = "approved";

            $datos = array();

            foreach ($_SESSION['carrito'] as $value):
                // Crea un ítem en la preferencia
                $item = new MercadoPago\Item();
                $item->title = $value['NAME'];
                $item->description = $value['DESCRIPTION'].' '.$value['SIZES'].' '.$value['COLOR'];
                $item->quantity = $value['COUNT'];
                $item->unit_price = $value['PRICE'];
                $datos[] = $item;
                
            endforeach;

            $shipments = new MercadoPago\Shipments();
        
            $shipments->cost = (int) $_SESSION['total-product']['envio'];
            
            $preference->items = $datos;
            $preference->shipments = $shipments;
        
            $preference->save();

            require_once('./views/Order/payment.php');
        else:
            header('Location: '.URL_BASE);
        endif;
        
    }

    function Success($pending = 0)
    {
       if (isset($_SESSION['carrito'])):

            $this->menus = MainMenu();
            $this->cartModal = $this->ModalCart();
            $cantidad = $this->cartModal = $this->ModalCantidad();
            $totalProduct = $this->cartModal = $this->CartTotal();

            $envio = $_SESSION['total-product']['envio'];
            $subtotal = $_SESSION['total-product']['total'];

            //campturamos el total de la venta con el envio
            $total = $envio + $subtotal;

            //recuperamos el ultimo id registrado en sales
            $id_sale = $this->objSuccess->Sale("null,$total,null,1");

            if (!empty($id_sale)):
                //insert tabla sends
                $id_sends = $this->objSuccess->Sends("null,'".$_SESSION['form-envio']["name"]."','".$_SESSION['form-envio']["email"]."',".$_SESSION['form-envio']['cp'].",".$_SESSION['form-envio']['estado'].",".$_SESSION['form-envio']['municipio'].",".$_SESSION['form-envio']['colonia'].",".$_SESSION['form-envio']['calle'].",".$_SESSION['form-envio']['ext'].",".$_SESSION['form-envio']['int'].",".$_SESSION['form-envio']['calle1'].",".$_SESSION['form-envio']['calle2'].",'".$_SESSION['form-envio']["radio"]."',".$_SESSION['form-envio']['telefono'].",".$_SESSION['form-envio']['referencias'].",$id_sale,4");

                if (!empty($id_sends)):
                    //insertar y actualizar productos vendidos y restar el inventario
                    $id_productSale = $this->objSuccess->Product_Sale($id_sale);

                    if (!empty($id_productSale)):
                        //insertar tabla payments 
                        if ($pending == 0):
                             $id_payment = $this->objSuccess->Payments("null,5,$id_sale");
                             if (!empty($id_payment)):
                                $Message_sent = $this->Send($_SESSION['carrito']);
                                if ($Message_sent == 'true'):
                                    unset($_SESSION['carrito']);
                                    unset($_SESSION['total-product']);
                                    unset($_SESSION['form-envio']);
                                    require_once('./views/Order/success.php');
                                else:
                                    header ("Location: ".URL_BASE);
                                endif;
                            else:
                                header('Location: '.URL_BASE);
                            endif;
                        else:
                            $id_payment = $this->objSuccess->Payments("null,6,$id_sale");
                            if (!empty($id_payment)):
                                unset($_SESSION['carrito']);
                                unset($_SESSION['total-product']);
                                unset($_SESSION['form-envio']);
                            else:
                                header('Location: '.URL_BASE);
                            endif;
                        endif;
                    else:
                        header('Location: '.URL_BASE);
                    endif;

                else:
                    header('Location: '.URL_BASE);
                endif;

            else:
                header('Location: '.URL_BASE);
            endif;

        else:
            header('Location: '.URL_BASE);
        endif;
    }

    function failure()
    {
        $this->menus = MainMenu();
        $this->cartModal = $this->ModalCart();
        $cantidad = $this->cartModal = $this->ModalCantidad();
        $totalProduct = $this->cartModal = $this->CartTotal();

        require_once('./views/Error/failure.php');
    }

    function pending()
    {
        $this->menus = MainMenu();
        $this->cartModal = $this->ModalCart();
        $cantidad = $this->cartModal = $this->ModalCantidad();
        $totalProduct = $this->cartModal = $this->CartTotal();

        $pending = 6;

        $this->Success($pending);

        require_once('./views/Error/pending.php');
    }

    function Send(array $sesion)
    {
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;  
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            //datos personales del dueño
            $mail->Username   = 'jordanmeza438@gmail.com';                     // SMTP username
            $mail->Password   = 'djsjordixx1';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('jordanmeza438@gmail.com', 'Tienda Online');
            $mail->addAddress('jordanmeza438@gmail.com', '');     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Compra realizada';
            $mail->Body    = '<center><h1>Productos vendidos</h1></center>'; 
           
            $mail->Body    .= 
            '
            <html> 
            <body>  
            <table>
                <tr>
                <th>Producto</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                </tr>
                <tbody>
                    '
                    ;
                

                $TOTAL = 0;
                foreach ($sesion as $value) {
                   
                    $TOTAL += $value['PRICE'] * $value['COUNT']; 

                    $mail->Body .= '<tr><td>'.$value['NAME'].'</td>';
                    $mail->Body .= '<td>'.$value['COLOR'].', '.$value['SIZES'].'</td>';
                    $mail->Body .= '<td>'.$value['PRICE'].'</td>';
                    $mail->Body .= '<td>'.$value['COUNT'].'</td>';
                    $mail->Body .= '<td>'.$value['PRICE'] * $value['COUNT'].'</td></tr>';
                    
                }

               
                
                      $mail->Body .= '
                
                      </tbody></table>';

                $mail->Body .= '<h2>Total: $'.(int)$TOTAL.' MXN </h2></body></html>';
                $mail->Body .= '<h2>Envio: $'.(int) $_SESSION['total-product']['envio'].' MXN </h2></body></html>';

             $mail->send();

             return 'true';
            

        } catch (Exception $e) {
            return 'false';
        }

        
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