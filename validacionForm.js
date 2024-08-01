function validarForm(){

    const id = document.forms["loginForm"]["idUsr"].value;
    const passw = document.forms["loginForm"]["passwd"].value;
    const idError = document.getElementById("idError");
    const passwError = document.getElementById("passwdError");

    idError.textContent = "";
    passwError.textContent = "";

    let valid = true;

    if (!/^[0-9]+$/.test(id)){
        idError.textContent = "El ID debe ser numérico";
        valid = false;
    }

    if (passw === "" || passw.length < 4){
        passwError.textContent = "La contaseña debe de tener mínimo 4 caracteres";
        valid = false;
    }

    return valid;

}