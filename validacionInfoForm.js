function validarInfoForm() {
    const form = document.querySelector("#infoForm");
    const nom = document.forms["infoForm"]["nombre"].value;
    const app = document.forms["infoForm"]["app"].value;
    const apm = document.forms["infoForm"]["apm"].value;
    const tel = document.forms["infoForm"]["tel"].value;
    const email = document.forms["infoForm"]["email"].value;
    const nomError = document.getElementById("nomError");
    const appError = document.getElementById("appError");
    const apmError = document.getElementById("apmError");
    const telError = document.getElementById("telError");
    const emailError = document.getElementById("emailError");
    const imgError = document.getElementById("imgError");

    const mailEx = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const telEx = /^\d{8,15}$/;
    const numEx = /^[0-9]+$/;
    const contNum = /\d/

    nomError.textContent = "";
    appError.textContent = "";
    apmError.textContent = "";
    telError.textContent = "";
    emailError.textContent = "";
    imgError.textContent = "";

    let valid = true;

    // Validación de campos
    
    if (nom === "") {
        nomError.textContent = "Es necesario llenar este campo";
        valid = false;
    } else if (numEx.test(nom)) {
        nomError.textContent = "Los números no son válidos en este campo";
        valid = false;
    }else if(contNum.test(nom)){
        nomError.textContent = "Los números no son válidos en este campo";
        valid = false;
    }

    if (app === "") {
        appError.textContent = "Es necesario llenar este campo";
        valid = false;
    } else if (numEx.test(app)) {
        appError.textContent = "Los números no son válidos en este campo";
        valid = false;
    }else if(contNum.test(app)){
        appError.textContent = "Los números no son válidos en este campo";
        valid = false;
    }

    if (apm === "") {
        apmError.textContent = "Es necesario llenar este campo";
        valid = false;
    } else if (numEx.test(apm)) {
        apmError.textContent = "Los números no son válidos en este campo";
        valid = false;
    }else if(contNum.test(apm)){
        apmError.textContent = "Los números no son válidos en este campo";
        valid = false;
    }

    if (!telEx.test(tel)) {
        telError.textContent = "Número de teléfono no válido";
        valid = false;
    }

    if (!mailEx.test(email)) {
        emailError.textContent = "Email no válido";
        valid = false;
    }

    // Validación de imagen
    const imagen = document.getElementById('img');
    const archivo = imagen.files[0];

    if (archivo) {
        const extensionesValidas = ['jpg', 'jpeg', 'png'];
        const extension = archivo.name.split('.').pop().toLowerCase();

        if (!extensionesValidas.includes(extension)) {
            imgError.textContent = "La extensión de la imagen no es válida, las extensiones válidas son: " + extensionesValidas.join(", ");
            valid = false;
        }
    }

    return valid;
}