<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Práctica PHP</title>
    <link rel="stylesheet" href="estilos.css" type="text/css">
    <script src="script.js" defer></script>
</head>
<body>
    <div class="group">
        <h2>Formulario de empleados/as</h2>
        <form action="" method="post" onsubmit="return validarFormulario()">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-input" required>
            <span><em>(Obligatorio*)</em></span>
            <br>
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" class="form-input" required>
            <span><em>(Obligatorio*)</em></span>
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-input" required>
            <span><em>(Obligatorio*)</em></span>
            <br>
            
            <div id="message-container">
                <?php
                $mensaje_error = "";
                $mensaje_exito = "";

                if ($_POST) {
                    $nombre = $_POST["nombre"];
                    $apellido = $_POST["apellido"];
                    $email = $_POST["email"];

                    // Conexión con PDO
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "cursosql";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Insertar los datos en la tabla USUARIO
                        $sql = "INSERT INTO USUARIO (NOMBRE, APELLIDO, EMAIL) VALUES (?, ?, ?)";
                        $stmt = $conn->prepare($sql);

                        if ($stmt) {
                            $stmt->bindParam(1, $nombre);
                            $stmt->bindParam(2, $apellido);
                            $stmt->bindParam(3, $email);

                            if ($stmt->execute()) {
                                $mensaje_exito = "¡Te has registrado correctamente! Muchas gracias.";
                            } else {
                                $mensaje_error = "¡Error en el registro! Por favor, verifica tus datos e intentalo nuevamente.";
                            }

                            $stmt->closeCursor();
                        } else {
                            $mensaje_error = "Error al ejecutar la consulta: " . $sql . "<br>" . $conn->errorInfo()[2];
                        }

                        $conn = null;
                    } catch (PDOException $e) {
                        $mensaje_error = "Error de conexión a la base de datos: " . $e->getMessage();
                    }
                }
                ?>

                <?php if (!empty($mensaje_error)) { ?>
                    <div class="error-message">
                        <?php echo $mensaje_error; ?>
                    </div>
                <?php } ?>

                <?php if (!empty($mensaje_exito)) { ?>
                    <div class="success-message">
                        <?php echo $mensaje_exito; ?>
                    </div>
                <?php } ?>
            </div>
            <button type="submit">Enviar registro</button>
        </form>
    </div>
</body>
</html>
