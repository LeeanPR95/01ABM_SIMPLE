<?php
function resultados() {
  # Este if se asegura que todo esté correctamente puesto en el formulario:
  if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["num1"]) && isset($_POST["num2"]) && isset($_POST["operador"])) { # si el servidor obtiene post como método y están seteados los campos entonces

  // Asignación de valores obtenidos con $_POST
  $num1 = $_POST["num1"];
  $num2 = $_POST["num2"];
  $operador = $_POST["operador"];
  
  // Comprueba el operador a usar
  switch ($operador) {
    case 'suma':
      sumar($num1, $num2);
      break;
    case 'resta':
      restar($num1, $num2);
      break;
    case 'multiplica':
      multiplicar($num1, $num2);
      break;
    case 'divide':
      dividir($num1, $num2);
      break;
    case 'modulo':
      modulo($num1, $num2);
      break;
    default:
      break;
  }
}
$db = new SQLite3('operaciones.db'); //antes del if conectamos a la base de datos
// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["eliminar"])) {
    foreach ($_POST["eliminar"] as $id) {
        $db->exec("DELETE FROM operaciones WHERE id = $id");
    }
}
}

/**
 * Funciones que controlan las operaciones a realizar
 * al evaluar el valor de $operador
*/

function sumar($num1, $num2) {
  $resultado = $num1 + $num2;
  echo "El resultado de la suma de $num1 más $num2 es " . $resultado;
  almacenarOperacion($num1, $num2, 'suma', $resultado);
}

function restar($num1, $num2) {
  $resultado = $num1 - $num2;
  echo "El resultado de la resta de $num1 menos $num2 es " . $resultado;
  almacenarOperacion($num1, $num2, 'resta', $resultado);
}

function multiplicar($num1, $num2) {
  $resultado = $num1 * $num2;
  echo "El resultado de la multiplicación de $num1 por $num2 es " . $resultado;
  almacenarOperacion($num1, $num2, 'multiplica', $resultado);
}

function dividir($num1, $num2) {
  $resultado = 0;
  if ($num2 == 0) {
    echo "No se puede dividir por cero.";
  } else {
    $resultado = $num1 / $num2;
    echo "El resultado de la división de $num1 sobre $num2 es " . $resultado;
  }
  almacenarOperacion($num1, $num2, 'divide', $resultado);
}

function modulo($num1, $num2) {
  $resultado = 0;
  if ($num2 == 0) {
    echo "No se puede dividir por cero.";
  } else {
    $resultado = $num1 % $num2;
    echo "El resto de la división de $num1 sobre $num2 es " . $resultado;
  }
  almacenarOperacion($num1, $num2, 'modulo', $resultado);
}
// fin de las funciones que realizan operaciones

/**
* Funcion que almacenará las operaciones en la base de datos,
* tomando como parámetros los números, el operador y el resultado.
* 
*/
function almacenarOperacion($num1, $num2, $operador, $resultado) {
  // Conexión a la base de datos
  

  // Insertar la operación en la tabla
  $db = new SQLite3('operaciones.db');
  $query = "INSERT INTO operaciones (num1, num2, operador, resultado) VALUES ($num1, $num2, '$operador', $resultado)";

  $db->exec($query);

  // Cerrar la conexión a la base de datos
  $db->close();
}
// fin de la funcion
