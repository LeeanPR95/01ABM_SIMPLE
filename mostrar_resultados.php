<?php
// Mostrar las operaciones almacenadas en una tabla
function mostrar_resultados() {
  // Conexión a la base de datos PRIMERO
  $db = new SQLite3('operaciones.db');

  // Consulta para obtener las operaciones almacenadas
  $query = "SELECT * FROM operaciones";
  $result = $db->query($query);

  if ($result->numColumns() > 0) {
    echo "<h3>Operaciones almacenadas:</h3>";
    echo "<form method='post'>";
    echo "<table>";
    echo "<tr> 
								<th>ID</th> 
								<th>Número 1</th> 
								<th>Número 2</th> 
								<th>Operador</th> 
								<th>Resultado</th> 
								<th>Eliminar</th> 
							</tr>";
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
      echo "<tr>";
      echo "<td>{$row['id']}</td>";
      echo "<td>{$row['num1']}</td>";
      echo "<td>{$row['num2']}</td>";
      echo "<td>{$row['operador']}</td>";
      echo "<td>{$row['resultado']}</td>";
      echo "<td><input type='checkbox' name='eliminar[]' value='{$row['id']}'></td>";
      echo "</tr>";
    }
    echo "</table>";
    echo "<button type='submit'>Eliminar Seleccionados</button>";
    echo "</form>";
  }

  // Cerrar la conexión a la base de datos
  $db->close();
}
?>