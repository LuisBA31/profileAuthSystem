function validarPin(){

    const form = document.querySelector("pinForm");
    const pin = document.forms["pinForm"]["pin"].value;
    const pinError = document.getElementById("pinError");

    let valid = true;

    if (!/^[0-9]+$/.test(pin)){
        pinError.textContent = "El PIN debe ser numérico";
        valid = false;
    }

    if (pin.length !== 4){
        pinError.textContent = "El PIN debe ser de 4 dígitos";
        valid = false;
    }

    return valid;

}