<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/index.css">
  
  <title>Práctica 01</title>
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
</head>

<body>
	<h1>Cálculo de dos números usando $_POST</h1>
	<p>En este formulario, calcularé la operación de dos números </p> <br>
	
	<form class="ingreso" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
	 <button type="submit">Enviar</button> 
	  <br>
	</form>
	<br>
	<h3>Salida: </h3> 
	<br>
	
	<div id="result-container">
		<?php require("./almacenar_resultados.php");
			resultados();
		?>
	</div>

	<?php require("./mostrar_resultados.php");
		mostrar_resultados();
	?>

</body>
</html>
