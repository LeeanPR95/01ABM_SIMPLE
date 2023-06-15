<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/index.css">
  <style>
  @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono&display=swap');
</style>
  <title>Práctica 01</title>
</head>

<body>
	<h1>Cálculo de dos números usando $_GET</h1>
	<p>En este formulario, calcularé la operación de dos números </p> <br>
	
	<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	  <label for="num1">Ingrese el primer número</label>
	  <input required type="number" name="num1" id="num1"> <br>
	  <label for="num2">Ingrese el segundo número</label>
	  <input required type="number" name="num2" id="num2"> <br>
	  <label for="operador">Seleccione la operacion a realizar:</label>
	  <select name="operador" id="operador">
	    <option value="suma">Sumar</option>
	    <option value="resta">Restar</option>
	    <option value="multiplica">Multiplicar</option>
	    <option value="divide">Dividir</option>
	  </select>
	  <br>
	 <button type="submit">[Enviar]</button> 
	  <br>
	</form>
	<br>
	<h3>Salida: </h3> <br>
	<?php 
	if (isset($_GET["num1"]) && isset($_GET["num2"]) && isset($_GET["operador"])) {
	    $num1 = $_GET["num1"];
	    $num2 = $_GET["num2"];
	    $operador = $_GET["operador"];
	    switch ($operador) {
	     case 'suma':
	       sumar($num1,$num2);
	       break;
	     case 'resta':
	       restar($num1,$num2);
	       break;
	     case 'multiplica':
	       multiplicar($num1,$num2);
	       break;
	     case 'divide':
	       dividir($num1,$num2);
	       break;
	     default:
	       break;
	    }
	}
	
	function sumar($num1, $num2) {
	  $resultado = $num1 + $num2;
	  print("El resultado de la suma es " . $resultado);
	  return $resultado;
	}
	
	function restar($num1, $num2) {
	  $resultado = $num1 - $num2;
	  print("El resultado de la resta es " . $resultado);
	  return $resultado;
	}
	
function multiplicar($num1, $num2) {
	  $resultado = $num1 * $num2;
	  print("El resultado de la multiplicación es " . $resultado);
	  return $resultado;
	}
	
	function dividir($num1, $num2) {
	  $resultado = 0;
	  if($num2 == 0) {
	    print "no se puede dividir por cero";
	  } else {
	    $resultado = $num1 / $num2;
	    print("El resultado de la división es " . $resultado);
	  }
	  return $resultado;
	}
	
	echo "<br> <br>";
  $userAgent = $_SERVER['HTTP_USER_AGENT'];
  echo "Tu user agent es: <br>";
  echo $userAgent;
	?>
	<script src="./js/index.js"></script>
</body>
</html>
