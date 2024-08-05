<?php
session_start();

date_default_timezone_set('America/Mexico_City');

$user_agent = $_SERVER['HTTP_USER_AGENT'];
// Token
$_SESSION["token"] =  generarToken();
// Obteniendo ip
$_SESSION["ip"] = obtenerIp();
// Obteniendo nav
$_SESSION["nav"] = obtenerNavegador($user_agent);
// Obteniendo so
$_SESSION["so"] = obtenerSO($user_agent);
// Fecha
$_SESSION["fecha"] = obtenerFecha();
// Variables para control de errores
// $_SESSION["control"] = "No";
if (!isset($_SESSION["err"])){
    $_SESSION["err"]="";
}

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
    elseif (strpos($user_agent, 'Brave')) return 'Brave';
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

#region obtener fecha
function obtenerFecha(){
    $fecha = date('d-m-Y');
    return $fecha;
}
#endregion

#region Generar token
function generarToken(){
    $token = bin2hex(openssl_random_pseudo_bytes(16));
    return $token;
}
#endregion

#region Validar dominio
function domValid() {
    $host = $_SERVER['HTTP_HOST'];
    return $host === 'localhost' || $host === '127.0.0.1';
}
#endregion
?>