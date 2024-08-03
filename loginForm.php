<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body style="display: flex; justify-content: center; margin-top: 5%; align-items: center;">
    <form id="loginForm" action="validacionForm.php" onSubmit="return validarForm()" class="loginForm" method="post">
        <h2 style="text-align: center">Iniciar Sesión</h2>
        <div class="col-12">
            <label for="idUsr" class="form-label">Id Usuario</label>
            <input type="text" class="form-control" id="idUsr" name="idUsr" placeholder="ID" required>
            <span id="idError" class="error-message"></span>
        </div>
        <br>
        <div class="col-12">
            <label for="passwd" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Contraseña" required>
            <span id="passwdError" class="error-message"></span>
        </div>
        <br>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" class="btn btn-dark">Iniciar sesión</button>
        </div>
        <br>
    </form>
    <?php // echo "Error: " . $_SESSION["err"]; ?>
    <script src="validacionForm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>