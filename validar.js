document.getElementById('formAlumno').addEventListener('submit', function(e) {
    let nombre = document.getElementById('nombre').value.trim();
    let correo = document.getElementById('correo').value.trim();
    
    // Validar longitud del nombre
    if (nombre.length < 3) {
        alert("Por favor, ingresa un nombre de al menos 3 caracteres.");
        e.preventDefault();
        return;
    }

    // Validar formato de correo básico
    let regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexCorreo.test(correo)) {
        alert("Por favor, ingresa un correo electrónico válido.");
        e.preventDefault();
    }
});