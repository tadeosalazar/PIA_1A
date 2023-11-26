$(document).ready(function () {
    $("#registrationForm").submit(function (event) {
        event.preventDefault();

        // Obtener los datos del formulario
        var nom_usuario = $("#nom_usuario").val();
        var correo_usuario = $("#correo_usuario").val();
        var contraseña_usuario = $("#contraseña_usuario").val();

        // Validar los campos (puedes agregar más validaciones según tus necesidades)

        // Simular la lógica de registro en PHP y la base de datos
        // Aquí deberías realizar una petición AJAX para enviar los datos al servidor
        $.ajax({
            type: "POST",
            url: "registro.php",
            data: {
                nom_usuario: nom_usuario,
                correo_usuario: correo_usuario,
                contraseña_usuario: contraseña_usuario
            },
            success: function (data) {
                // Mostrar el mensaje de registro exitoso después de un breve retraso
                $("#registroExitoso").removeClass("d-none");
                setTimeout(function () {
                    $("#registroExitoso").addClass("d-none");
                }, 3000); // Ocultar el mensaje después de 3 segundos

                // Redirigir a la página de inicio después del registro exitoso (opcional)
                setTimeout(function () {
                    window.location.href = "index.php";
                }, 3000);
            },
            error: function () {
                // Manejar errores en caso de fallo en la petición AJAX
                console.error("Error en la petición AJAX");
            }
        });
    });
});
