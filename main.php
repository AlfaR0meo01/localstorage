<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="localstorage.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <main>
        <section>
            <form action="" id="formulario" opcion="agregar">
                <input type="text" id="num_tarea" name="num_tarea" placeholder="Id Tarea" />
                <input type="text" id="name_tarea" name="name_tarea" placeholder="Nombre de Tarea" />
                <input type="text" id="time" name="time" placeholder="Tiempo requerido" />
                <input type="date" id="date" name="date" />
                <div>
                    <button id="agregar" class="agregar" >Agregar <i class="fa fa-plus" aria-hidden="true"></i> </button>
                    <button id="editar" style="display:none" >Editar <i class="fa fa-pencil" aria-hidden="true"></i></button>
                </div>
            </form>
        </section>
        <section id="datos"></section>
        <section id="table_data">
            <table>
                <thead>
                    <tr>
                        <th>Numero de Tarea</th>
                        <th>Nombre de Tarea</th>
                        <th>Tiempo</th>
                        <th>Fecha Limite</th>
                        <th>Tiempo Restante</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="json_data">
                </tbody>
            </table>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script>
        var json = JSON.parse(localStorage.getItem("proyecto"));
        document.getElementById("num_tarea").style.display = "none";
        //function de guadrar datos en localstorage
        function almacenar(event) {
            var form = document.getElementById("formulario");
            var elements = form.elements;
            var attr = form.getAttribute('opcion');
            event.preventDefault();
            if (json == null) {
                json = [];
            }
            var json_obj = {
                "name_tarea": elements.name_tarea.value,
                "time": elements.time.value,
                "date": elements.date.value
            }
            if (attr == 'agregar') {
                json.push(json_obj);
            } else {
                json[elements.num_tarea.value] = json_obj;
            }
            localStorage.setItem("proyecto", JSON.stringify(json));
            document.getElementById("formulario").reset();
            location.reload();
        }
        //get data para modificar data
       /* function get_data(event) {
            var row_data = document.getElementsByClassName("editar").elements;
            var t_id = event.getAttribute("t_id");
            document.getElementById("num_tarea").value = t_id;
            document.getElementById("name_tarea").value = json[t_id].name_tarea;
            document.getElementById("time").value = json[t_id].time;
            document.getElementById("date").value = json[t_id].date;
            document.getElementById("num_tarea").disabled = true;
            document.getElementById("editar").style.display = "block";
            document.getElementById("num_tarea").style.display = "block";
            document.getElementById("agregar").style.display = "none";
            document.getElementById("formulario").setAttribute("opcion", "editar");
        }
        //function de eliminar datos en localstorage
        function eliminar(event) {
            var row_data = document.getElementsByClassName("eliminar").elements;
            var t_id = event.getAttribute("t_id");
            var json = JSON.parse(localStorage.getItem("proyecto"));
            json.splice(t_id, 1);
            console.log(json);
            localStorage.setItem("proyecto", JSON.stringify(json));
            imprime(json);
        }*/
        //mostrar data de localstorage
        function imprime(json) {
            document.getElementById('json_data').innerHTML = "";
            var date_actual = new Date();
            json.forEach((data, index) => {
                var date_entrega = new Date(data.date);
                var date_faltante = date_entrega - date_actual;
                date_faltante = Math.ceil(date_faltante / (1000 * 3600 * 24));
                document.querySelector("#json_data").insertAdjacentHTML(
                    'beforeend', `<tr t_id=${index} class='data_row'>
                    <td>${index}</td>
                    <td>${data.name_tarea}</td>
                    <td>${data.time}</td>
                    <td>${data.date}</td>
                    <td>${date_faltante + " dias restantes"}</td>
                    <td>
                        <button class='editar' t_id=${index} onclick='get_data(this)'><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        <button class='eliminar' t_id=${index} onclick='eliminar(this)'><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        <button class='eliminar completado' t_id=${index} onclick='eliminar(this)'><i class="fa fa-check-square-o" aria-hidden="true"></i></button>
                    </td>
                </tr>`)
            });
        }
        var DATOS = JSON.parse(localStorage.getItem("proyecto"));
        imprime(DATOS);

        function agregar_datos(event){
            if(navigator.onLine){
                
            }
        }
    </script>
</body>

</html>