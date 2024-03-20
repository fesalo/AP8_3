<?php
class Model extends Connection
{
    public function getAllProductos()
    {
        $query = 'SELECT * From PRODUCTO';
        $result = mysqli_query($this->conn, $query);
        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
        $result->close();
        return $productos;
    }/*  -> que devolverá todos las filas de la tabla productos en un array asociativo */
    public function showAllProductos()
    {
        $productos = $this->getAllProductos();
        $table = '<div class="divTable blueTable">';
        $table .= '<div class="divTableHeading">';
        $table .= '<div class="divTableRow">';
        $table .= '<div class="divTableHead">Nº Producto</div>';
        $table .= '<div class="divTableHead">Descripción</div>';
        $table .= '</div>';
        $table .= '</div>';
        $table .= '<div class="divTableBody">';

        foreach ($productos as $producto) {
            $table .= '<div class="divTableRow">';
            $table .= '<div class="divTableCell">' . $producto['PROD_NUM'] . '</div>';
            $table .= '<div class="divTableCell">' . $producto['DESCRIPCION'] . '</div>';
            $table .= '</div>';
        }

        $table .= '</div>';
        $table .= '</div>';
        echo $table;
    } /* -> que construirá una tabla con los valores de la tabla productos */

    public function getAllEmp()
    {
        $query = 'SELECT EMP_NO, APELLIDOS, DEPT_NO, SALARIO From EMP';
        $result = mysqli_query($this->conn, $query);
        $empleados = [];
        while ($row = $result->fetch_assoc()) {
            $empleados[] = $row;
        }
        $result->close();
        return $empleados;
    }/* -> que devolverá todos las filas de la tabla emp en un 
    array asociativo, seleccionando solo los campos EMP_NO, APELLIDOS, DEPT_NO y SALARIO */

    public function showAllEmp()
    {
        $empleados = $this->getAllEmp();
        $table = '<div class="divTable blueTable">';
        $table .= '<div class="divTableHeading">';
        $table .= '<div class="divTableRow">';
        $table .= '<div class="divTableHead">Nº Empleado</div>';
        $table .= '<div class="divTableHead">Apellido</div>';
        $table .= '<div class="divTableHead">Nº Departamento</div>';
        $table .= '<div class="divTableHead">Salario</div>';
        $table .= '</div>';
        $table .= '</div>';
        $table .= '<div class="divTableBody">';

        foreach ($empleados as $empleado) {
            $table .= '<div class="divTableRow">';
            $table .= '<div class="divTableCell">' . $empleado['EMP_NO'] . '</div>';
            $table .= '<div class="divTableCell">' . $empleado['APELLIDOS'] . '</div>';
            switch ($empleado['DEPT_NO']) {
                case 10:
                    $table .= '<div class="divTableCell"><img src="img/amarillo.jpg" width="25"></div>';
                    break;
                case 20:
                    $table .= '<div class="divTableCell"><img src="img/azul.jpg" width="25"></div>';
                    break;
                case 30:
                    $table .= '<div class="divTableCell"><img src="img/rojo.jpg" width="25"></div>';
                    break;
            }
            $table .= '<div class="divTableCell">' . number_format($empleado['SALARIO'], 2, "'", ".") . '€</div>';
            $table .= '</div>';
        }

        $table .= '</div>';
        $table .= '</div>';
        echo $table;
    } /* ->que construirá una tabla con los valores de la tabla EMP seleccionados desde
    el anterior método. El valor del salario debe ser formateado como moneda euro, y la fecha como
    dia/mes/año. Además, el número de departamento no debe aparecer, en su lugar, debemos rellenar 
    en un color diferente según el id de departamento, la celda de la tabla correspondiente */

    public function getAllCliente($order)
    {
        $query = "SELECT CLIENTE_COD, NOMBRE, CIUDAD From CLIENTE ORDER BY NOMBRE $order";
        $result = mysqli_query($this->conn, $query);
        $empleados = [];
        while ($row = $result->fetch_assoc()) {
            $empleados[] = $row;
        }
        $result->close();
        return $empleados;
    } /* -> que devolverá todos los clientes, en el orden por NOMBRE que especifiquemos
     en el parámetro de entrada, que podrá ser un string "ASC" o "DESC". Selecciona exclusivamente
      CLIENTE_COD, NOMBRE y CIUDAD */

      public function showAllCliente($order)
      {
        $clientes = $this->getAllCliente($order);
        $table = '<div class="divTable blueTable">';
        $table .= '<div class="divTableHeading">';
        $table .= '<div class="divTableRow">';
        $table .= '<div class="divTableHead">Código cliente</div>';
        $table .= '<div class="divTableHead">Nombre <a href="Clientes.php?Order=ASC">Ascendente</a> <a href="Clientes.php?Order=DESC">Descendente</a> </div>';
        $table .= '<div class="divTableHead">Ciudad</div>';
        $table .= '</div>';
        $table .= '</div>';
        $table .= '<div class="divTableBody">';

        foreach ($clientes as $cliente) {
            $table .= '<div class="divTableRow">';
            $table .= '<div class="divTableCell">' . $cliente['CLIENTE_COD'] . '</div>';
            $table .= '<div class="divTableCell">' . $cliente['NOMBRE'] . '</div>';
            $table .= '<div class="divTableCell">' . $cliente['CIUDAD'] . '</div>';
            $table .= '</div>';
        }

        $table .= '</div>';
        $table .= '</div>';
        echo $table;
      } /* -> que construirá una tabla con los valores de la tabla Cliente
       seleccionados desde el método anterior. */
}
