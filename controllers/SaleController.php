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
        $this->menus = MainMenu();
        $this->cartModal = $this->ModalCart();
        $cantidad = $this->cartModal = $this->ModalCantidad();
        $totalProduct = $this->cartModal = $this->CartTotal(); 


        if(!isset($_SESSION['total-product'])) {
            $_SESSION['total-product'] = array(
                'envio' =>$_POST['envio'],
                'total' =>$_POST['total']
            );
        }else{
            $_SESSION['total-product'] = array(
                'envio' =>$_POST['envio'],
                'total' =>$_POST['total']
            );
        }


        require_once('views/Order/form.php');
    }

    function Registro()
    {

        if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['cp']) && isset($_POST['estado']) && isset($_POST['municipio']) && isset($_POST['colonia']) && isset($_POST['calle']) && isset($_POST['ext']) && isset($_POST['int']) && isset($_POST['calle1']) && isset($_POST['calle2']) && isset($_POST['radio']) && isset($_POST['telefono']) && isset($_POST['referencia'])) {
           
        }else{

            $_SESSION['form-envio'] = array(
                'name' =>$_POST['nombre'],
                'email' =>$_POST['email'],
                'cp' =>$_POST['cp'],
                'estado' =>$_POST['estado'],
                'municipio' =>$_POST['municipio'],
                'colonia' =>$_POST['colonia'],
                'calle' =>$_POST['calle'],
                'ext' =>$_POST['ext'],
                'int' =>$_POST['int'],
                'calle1' =>$_POST['calle1'],
                'calle2' =>$_POST['calle2'],
                'radio' =>$_POST['radio'],
                'telefono' =>$_POST['telefono'],
                'referencias' =>$_POST['referencias']
            );

            header ("Location: ".URL_BASE."Sale/Pago");
        }
    }

    function Pago()
    {
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
            "failure" => "http://www.tu-sitio/failure",
            "pending" => "http://www.tu-sitio/pending"
        );
        
        $datos = array();

        foreach ($_SESSION['carrito'] as $index => $value) {
            // Crea un ítem en la preferencia
            $item = new MercadoPago\Item();
            $item->title = $value['NAME'];
            $item->description = $value['DESCRIPTION'].' '.$value['SIZES'].' '.$value['COLOR'];
            $item->quantity = $value['COUNT'];
            $item->unit_price = $value['PRICE'];
            $datos[] = $item;
        }

        $shipments = new MercadoPago\Shipments();
     
        $shipments->cost = (int) $_SESSION['total-product']['envio'];
        
        $preference->items = $datos;
        $preference->shipments = $shipments;
    
        $preference->save();

        require_once('./views/Order/payment.php');
    }

    function Success()
    {
        $this->menus = MainMenu();
        $this->cartModal = $this->ModalCart();
        $cantidad = $this->cartModal = $this->ModalCantidad();
        $totalProduct = $this->cartModal = $this->CartTotal();


        $envio = $_SESSION['total-product']['envio'];
        $subtotal = $_SESSION['total-product']['total'];

        $total = $envio + $subtotal;


        //insertar tabla sales
        $sales = "null,$total,null,1";

        //recuperamos el ultimo id registrado en sales
        $id_sale = $this->objSuccess->Sale($sales);

        //insertar tabla sends
        $cadena = "INSERT INTO `SENDS`(`id_send`, `name`, `email`, `cp`, `state`, `municipality`, `colony`, `street`, `exterior`, `interior`, `street1`, `street2`, `options`, `telephone`, `referencias`, `fk_id_sale`, `fk_id_status`)
        VALUES(null,'".$_SESSION['form-envio']["name"]."','".$_SESSION['form-envio']["email"]."',".$_SESSION['form-envio']['cp'].",".$_SESSION['form-envio']['estado'].",".$_SESSION['form-envio']['municipio'].",".$_SESSION['form-envio']['colonia'].",".$_SESSION['form-envio']['calle'].",".$_SESSION['form-envio']['ext'].",".$_SESSION['form-envio']['int'].",".$_SESSION['form-envio']['calle1'].",".$_SESSION['form-envio']['calle2'].",'".$_SESSION['form-envio']["radio"]."',".$_SESSION['form-envio']['telefono'].",".$_SESSION['form-envio']['referencias'].",$id_sale,4)";
       
        $this->objSuccess->Sends($cadena);

        //insertar tabla product-sold
        foreach ($_SESSION['carrito'] as $item =>$value ) {
            $cadena = "INSERT INTO `PRODUCTS-SOLD`(`id_sold`, `count`, `price`, `total`, `characteristic`, `fk_id_product`, `fk_id_sale`)
            VALUES(null,".$value['COUNT'].",".$value['PRICE'].",".$value['PRICE']*$value['COUNT'].",'".$value['COLOR'].",".$value['SIZES']."',".$value['ID'].",$id_sale)";
            $this->objSuccess->Product_Sale($cadena);

            $cadena1 = "UPDATE `PRODUCTS` INNER JOIN COLORS INNER JOIN SIZES
            SET COLORS.count = COLORS.count - ".$value['COUNT'].", PRODUCTS.inventorie = PRODUCTS.inventorie - ".$value['COUNT'].", SIZES.count = SIZES.count - ".$value['COUNT']." WHERE COLORS.fk_id_product = ".$value['ID']." and PRODUCTS.id_product = ".$value['ID']." and COLORS.name = '".$value['COLOR']."' and SIZES.name = '".$value['SIZES']."' and SIZES.fk_id_product = ".$value['ID']." ";
            $this->objSuccess->Payments($cadena1);
        }

          //insertar tabla payments
          $cadena = "INSERT INTO `PAYMENTS`(`id_payment`, `fk_id_status`, `fk_id_sale`)
          VALUES(null,5,$id_sale)";
          $this->objSuccess->Payments($cadena);

         $Message_sent = $this->Send($_SESSION['carrito']);

         if ($Message_sent == 'true') {
            require_once('./views/Order/success.php');
         }else{
            header ("Location: ".URL_BASE);
         }

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