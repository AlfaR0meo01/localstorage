<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!--link rel="stylesheet" href="localstorage.css"-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="manifest" href="manifest.json">
</head>

<body>

    <!-- Button trigger modal -->
    <div class="col-6">
        <a href="#modal" class="agregar btn btn-primary mb-3 pull-right" data-toggle="modal" data-target="#modal">Agregar</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>nombre</th>
                <th>apellidos</th>
                <th>correo</th>
                <th>edad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="json_data">
        </tbody>
    </table>
    <!--modal para agregar/editar-->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="formulario" form="agregar">
                        <input type="text" id="nombre" name="nombre" placeholder="nombre" />
                        <input type="text" id="apellidos" name="apellidos" placeholder="apellidos" />
                        <input type="text" id="correo" name="correo" placeholder="correo" />
                        <input type="number" id="edad" name="edad" placeholder="edad" />
                        <div>
                            <button id="agregar" class="agregar">Agregar <i class="fa fa-plus" aria-hidden="true"></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="pwabuilder-sw.js"></script>
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="ajax.js"></script>
    <script>
        /******************pwa***********************/
        // This is the service worker with the Cache-first networks
        // Add this below content to your HTML page, or add the js file to your page at the very top to register service worker
        // Check compatibility for the browser we're running this in
        if ("serviceWorker" in navigator) {
            if (navigator.serviceWorker.controller) {
                console.log("[PWA Builder] active service worker found, no need to register");
            } else {
                // Register the service worker
                navigator.serviceWorker
                    .register("pwabuilder-sw.js", {
                        scope: "./"
                    })
                    .then(function(reg) {
                        console.log("[PWA Builder] Service worker has been registered for scope: " + reg.scope);
                    });
            }
        }
        /********************************************************************/
        /******************functiones de localstorage***********************/
        function obtienejson() {
            var json = JSON.parse(localStorage.getItem("proyecto"));
            if (json == null) json = [];
            return json;
        }

        function almacenar() {
            var json = obtienejson();
            var form = document.getElementById("formulario");
            var attr = form.getAttribute('form');
            if (attr == 'agregar') {
                json.push(json_obj);
            } else {
                json[elements.num_tarea.value] = json_obj;
            }
            localStorage.setItem("proyecto", JSON.stringify(json));
        }

        function eliminar(event) {
            var row_data = document.getElementsByClassName("eliminar").elements;
            var t_id = event.getAttribute("t_id");
            var json = JSON.parse(localStorage.getItem("proyecto"));
            json.splice(t_id, 1);
            console.log(json);
            localStorage.setItem("proyecto", JSON.stringify(json));
            imprime(json);
        }
        
        function imprime(json) {
            document.getElementById('json_data').innerHTML = "";
            var date_actual = new Date();
            json.forEach((data, index) => {
                document.querySelector("#json_data").insertAdjacentHTML(
                    'beforeend', `<tr t_id=${index} class='data_row id'>
                    <td >${data.nombre}</td>
                    <td>${data.apellidos}</td>
                    <td>${data.correo}</td>
                    <td>${data.edad}</td>
                    <td>
                        <a href="#modal" t_id=${index} class='btn btn-primary editar' data-toggle="modal" data-target="#modal">editar</a>
                        <button class='eliminar btn btn-danger' t_id=${index} onclick='eliminar(this)'>eliminar</button>
                    </td>
                </tr>`)
            });
        }
        /********************************************************************/
        var DATOS = obtienejson();
        imprime(DATOS);
    </script>



</body>

</html>