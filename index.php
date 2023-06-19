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
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
</head>

<body>
	<h1>Cálculo de dos números usando $_POST</h1>
	<p>En este formulario, calcularé la operación de dos números </p> <br>
	
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	  <label for="num1">Ingrese el primer número</label>
	  <input required type="number" name="num1" id="num1"> <br>
	  <label for="num2">Ingrese el segundo número</label>
	  <input required type="number" name="num2" id="num2"> <br>
	  <label for="operador">Seleccione la operación a realizar:</label>
	  <br>
	  <select name="operador" id="operador">
	    <option value="suma">Sumar</option>
	    <option value="resta">Restar</option>
	    <option value="multiplica">Multiplicar</option>
	    <option value="divide">Dividir</option>
	    <option value="modulo">Resto</option>
	  </select>
	  <br>
	 <button type="submit">[Enviar]</button> 
	  <br>
	</form>
	<br>
	<h3>Salida: </h3> 
	<br>
	<div id="result-container">
		<?php 
		if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["num1"]) && isset($_POST["num2"]) && isset($_POST["operador"])) {
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

		function almacenarOperacion($num1, $num2, $operador, $resultado) {
		  // Conexión a la base de datos
		  $db = new SQLite3('operaciones.db');

		  // Insertar la operación en la tabla
		  $query = "INSERT INTO operaciones (num1, num2, operador, resultado) VALUES ($num1, $num2, '$operador', $resultado)";
		  $db->exec($query);

		  // Cerrar la conexión a la base de datos
		  $db->close();
		}
		?>
	</div>
	
	<?php
	// Mostrar las operaciones almacenadas en una tabla
	// Conexión a la base de datos
	$db = new SQLite3('operaciones.db');

	// Consulta para obtener las operaciones almacenadas
	$query = "SELECT * FROM operaciones";
	$result = $db->query($query);
	
	if ($result->numColumns() > 0) {
	  echo "<h3>Operaciones almacenadas:</h3>";
	  echo "<table>";
	  echo "<tr><th>ID</th><th>Número 1</th><th>Número 2</th><th>Operador</th><th>Resultado</th></tr>";
	  while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
	    echo "<tr>";
	    echo "<td>{$row['id']}</td>";
	    echo "<td>{$row['num1']}</td>";
	    echo "<td>{$row['num2']}</td>";
	    echo "<td>{$row['operador']}</td>";
	    echo "<td>{$row['resultado']}</td>";
	    echo "</tr>";
	  }
	  echo "</table>";
	}

	// Cerrar la conexión a la base de datos
	$db->close();
	?>
</body>
</html>
