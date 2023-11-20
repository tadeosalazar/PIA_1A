$(document).ready(function () {
    $("#registrationForm").submit(function (event) {
        event.preventDefault();

        // Obtener los datos del formulario
        var nombre = $("#nombre").val();
        var correo = $("#correo").val();
        var contraseña = $("#contraseña").val();

        // Validar los campos (puedes agregar más validaciones según tus necesidades)

        // Simular la lógica de registro en PHP y la base de datos
        // Aquí deberías realizar una petición AJAX para enviar los datos al servidor
        $.ajax({
            type: "POST",
            url: "registro.php",
            data: {
                nombre: nombre,
                correo: correo,
                contraseña: contraseña
            },
            success: function (data) {
                // Mostrar el mensaje de registro exitoso después de un breve retraso
                $("#registroExitoso").removeClass("d-none");
                setTimeout(function () {
                    $("#registroExitoso").addClass("d-none");
                }, 3000); // Ocultar el mensaje después de 3 segundos

                // Redirigir a la página de inicio después del registro exitoso (opcional)
                setTimeout(function () {
                    window.location.href = "index.html";
                }, 3000);
            },
            error: function () {
                // Manejar errores en caso de fallo en la petición AJAX
                console.error("Error en la petición AJAX");
            }
        });
    });
});
