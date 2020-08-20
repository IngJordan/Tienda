<?php
//funcion para llamar o incluir todos los controladores automaticamente
function controllers_autoload($classname){
	include 'controllers/' . $classname . '.php';
}

/*Me permite registrar multiples funciones
o métodos estáticos de su propia clase de carga automática */
spl_autoload_register('controllers_autoload');