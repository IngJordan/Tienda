<?php 
require_once('./helpers/helpers.php');
require_once('./models/UserModel.php');
require_once('./vendor/autoload.php');

use Dompdf\Dompdf;
use Sabberworm\CSS\Value\URL;

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

    function UserCheck()
    {
        if (!isset($_GET['data'])):
            header('Location:'.URL_BASE);
        else:

            $accion = Descript($_GET['data']);

            switch ($accion) {
                case 'login':
                   
                        if (!isset($_POST['email'])):
                            header('Location:'.URL_BASE);
                            elseif(!isset($_POST['password'])):
                            header('Location:'.URL_BASE);
                            else:

                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $password_encript = Encrip($password);

                            $infoUser = $this->objUser->Check($email,$password_encript);

                            if (!empty($infoUser)) {
                                foreach ($infoUser as $value) {
                                    $_SESSION['USER'] = array(
                                        'ID_USER' => $value['id_user'],
                                        'NAME' => $value['name'],
                                        'SURNAME' => $value['surnames'],
                                        'EMAIL' => $value['email'],
                                        'PASSWORD' => $value['password'],
                                        'TELEPHONE' => $value['telephone'],
                                        'DATE_BIRTH' => $value['date_of_birth'],
                                        'SEXO' => $value['sexo'],
                                        'PROFILE' => $value['profile']
                                    );
                                }

                                if ($_SESSION['USER']['PROFILE'] == 'Cliente') {
                                    header('Location: '.URL_BASE);
                                    $_SESSION['Success'] = 'exito';
                                }else{
                                    echo 'ADMIN';
                                }
                            }else{
                                header('Location:'.URL_BASE.'User/Login');
                                $_SESSION['Login'] = "Lo sentimos. Se encontro un error ";
                            }

                        endif;
              
                    break;

                case 'registro':

                    if (!isset($_POST['name'])):
                        header('Location: '.URL_BASE);
                    elseif(!isset($_POST['surnames'])):
                        header('Location: '.URL_BASE);
                    elseif(!isset($_POST['email'])):
                        header('Location: '.URL_BASE);
                    elseif(!isset($_POST['password'])):
                        header('Location: '.URL_BASE);
                    elseif(!isset($_POST['v_password'])):
                        header('Location: '.URL_BASE);
                    elseif(!isset($_POST['telephone'])):
                        header('Location: '.URL_BASE);
                    elseif(!isset($_POST['date'])):
                        header('Location: '.URL_BASE);
                    elseif(!isset($_POST['sexo'])):
                        header('Location: '.URL_BASE);
                    else:
                        
                        $name = $_POST['name'];
                        $surnames = $_POST['surnames'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $password_encript = Encrip($password);
                        $v_password = $_POST['v_password'];
                        $telephone = $_POST['telephone'];
                        $date = $_POST['date'];
                        $sexo = $_POST['sexo'];
                        
                        if ($password == $v_password):
                            $values = 'null,"'.$name.'","'.$surnames.'","'.$email.'","'.$password_encript.'",'.$telephone.',"'.$date.'","'.$sexo.'","Cliente",null';
                            $id_user = $this->objUser->Register($values);

                            if (!empty($id_user)) {
                                $infoUser = $this->objUser->SelectUser($id_user);

                                if (!empty($infoUser)) {

                                    foreach ($infoUser as $value) {
                                        $_SESSION['USER'] = array(
                                            'ID_USER' => $value['id_user'],
                                            'NAME' => $value['name'],
                                            'SURNAME' => $value['surnames'],
                                            'EMAIL' => $value['email'],
                                            'PASSWORD' => $value['password'],
                                            'TELEPHONE' => $value['telephone'],
                                            'DATE_BIRTH' => $value['date_of_birth'],
                                            'SEXO' => $value['sexo'],
                                            'PROFILE' => $value['profile']
                                        );
                                    }

                                    if ($_SESSION['USER']['PROFILE'] == 'Cliente') {
                                        header('Location: '.URL_BASE);
                                        $_SESSION['Success'] = 'exito';
                                    }else{
                                        echo 'ADMIN';
                                    }
                                    
                                    
                                }else{
                                    header('Location:'.URL_BASE.'User/Login');
                                    $_SESSION['Msg'] = "Lo sentimos. Se encontro un error ";
                                }

                            }else{

                                header('Location:'.URL_BASE.'User/Login');
                                $_SESSION['Msg'] = "Lo sentimos. Error al registrar usuario";
                            };

                        else:
                            header('Location:'.URL_BASE.'User/Login');
                            $_SESSION['Error'] = 'Error';
                        endif;

                    endif;

                    break;

                case 'exit':
                        unset($_SESSION['USER']);
                        header('Location: '.URL_BASE);
                    break;
                
                
                default:
                header('Location:'.URL_BASE);
                break;

                }

        endif;
    }

    

    function Myorder(){
        $this->menus = MainMenu();
        $this->cartModal = $this->ModalCart();
        $cantidad = $this->cartModal = $this->ModalCantidad();
        $totalProduct = $this->cartModal = $this->CartTotal();

        $id_user = $_SESSION['USER']['ID_USER'];
        $listOrder = $this->objUser->getListOrder($id_user);

       
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
            $id_user = $_SESSION['USER']['ID_USER'];
            $listPorduct = $this->objUser->getProductSale($id_user,$id_sale);
            
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
                $id_user = $_SESSION['USER']['ID_USER'];

                $listPorduct = $this->objUser->getProductSale($id_user,$id_sale);
                $Address = $this->objUser->getAddress($id_user,$id_sale);

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