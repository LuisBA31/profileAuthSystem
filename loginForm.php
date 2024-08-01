<?php
session_start();
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$ip = obtenerIp();
$nav = obtenerNavegador($user_agent);
$so = obtenerSO($user_agent);
$token = generarToken();
// Token
$_SESSION["token"] =  $token;
// Obteniendo ip
$_SESSION["ip"] = $ip;
// Obteniendo nav
$_SESSION["nav"] = $nav;
// Obteniendo so
$_SESSION["so"] = $so;
// Fecha
$_SESSION["fecha"] = date("Y-m-d");
// Variables para control de sesión
$_SESSION["valid"] = "No";
// Variable para control de errores
$_SESSION["err"] = "";

// Funciones --------------------------------------------------

#region Obtener ip
function obtenerIp(){
    // servidor
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {   
        $auxip = $_SERVER['HTTP_CLIENT_IP'];   
    }   
    // proxy 
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   
        $auxip = $_SERVER['HTTP_X_FORWARDED_FOR'];   
    }   
    // dirección remota  
    else{   
        $auxip = $_SERVER['REMOTE_ADDR'];
    }
    return $auxip;
}
#endregion

#region Obtener navegador
function obtenerNavegador($user_agent){
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
    elseif (strpos($user_agent, 'Edge')) return 'Edge';
    elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
    elseif (strpos($user_agent, 'Safari')) return 'Safari';
    elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
    return 'Nav Desconocido';
}
#endregion

#region obtener SO
function obtenerSO($user_agent){
    $so_array = array(
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );
    foreach ($so_array as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            return $value;
        }
    }
    return 'SO Desconocido';
}
#endregion

#region Generar token
function generarToken(){
    $token = rand(100000000,900000000);
    return $token;
}
#endregion
?>
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
        <?php echo $_SESSION["token"]; ?>
        <?php echo $_SESSION["fecha"]; ?>
    </form>
    <script src="validacionForm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>