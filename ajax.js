$(document).ready(function() {
    /******************** envia datos a formulario*********************/
    $("#formulario").submit(function(event) {
        event.preventDefault();
        var formdata = new FormData(this);
        var nombre = $("#nombre").val();
        var apellidos = $("#apellidos").val();
        var correo = $("#correo").val();
        var edad = $("#edad").val();
        json_obj = {
            'nombre': nombre,
            'apellidos': apellidos,
            'correo': correo,
            'edad': edad,
            'estado': 0
        }
        if (!navigator.onLine) {
            almacenar(json_obj);
            alert('hijo de puta');
            return 0;
        }
        $.ajax({
            url: "datos_usr.php",
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data == 0) {
                    console.log('mal');
                } else {
                    console.log('bien');
                }
                almacenar(data);
            }
        });
    });
});