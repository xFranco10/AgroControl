$(document).ready(function () {
    let carrito = [];
    let idAsignacion = document.getElementById('idAsignacion').textContent;
    let estado_Asignacion = document.getElementById('estado_Asignacion').textContent;
    let id_maquinaria = document.getElementById('id_maquinaria').textContent;

    // Manejar clics en el botón "USAR"
    $('.btn-add-cart').on('click', function () {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,

        });

        let fila = $(this).closest('tr');
        let codigoRepuesto = fila.find('td:eq(0) .idrepuesto').text();
        

        // Verificar si el repuesto ya está en el carrito
        let repuestoExistente = carrito.find(function (elemento) {
            return elemento.codigo === codigoRepuesto;
        });

        if (!repuestoExistente) {
        let repuesto = {
            asignacion: idAsignacion,
            codigo: codigoRepuesto,
            estado_asignacion: estado_Asignacion,
            id_maquinaria: id_maquinaria,
            nombre: fila.find('td:eq(1)').text(),
            cantidad: fila.find('td:eq(3) .cant').text(),
        };

        console.log(repuesto.codigo);
        console.log(repuesto.asignacion);
        console.log(repuesto.estado_asignacion);
        console.log(repuesto.cantidad);

        carrito.push(repuesto);

        actualizarCarrito();

        Toast.fire({
            icon: "success",
            title: "El repuesto se agrego correctamente a la lista"
        });

        } else {
        Toast.fire({
            icon: "warning",
            title: "El repuesto ya esta agregado en la lista de repuestos"
        });
        }
    });

    // Función para actualizar la vista del carrito
    // Función para actualizar la vista del carrito
    function actualizarCarrito() {
        let carritoHtml = '<div class="container">';
        for (let i = 0; i < carrito.length; i++) {
            carritoHtml += '<section class="mt-2 py-2">';
            carritoHtml += '<h4>' + carrito[i].nombre + " - " + carrito[i].codigo + '</h4>';
            carritoHtml += '<br>';
            carritoHtml += '<label class="form-label">Cantidad a utilizar</label>';
            carritoHtml += '<div class="input-group mb-2">';
            carritoHtml += '<input type="number" value="' + carrito[i].cantidad + '" class="cantidad-input form-control" required>';
            carritoHtml += '<button class="btn btn-warning btn-remove" data-index="' + i + '">REMOVER</button>';
            carritoHtml += '</div>';
            carritoHtml += '</section>';
        }
        carritoHtml += '</div>';

        // Mostrar el carrito en un elemento con el ID 'carrito-container'
        $('#carrito-container').html(carritoHtml);


        // Manejar clics en el botón "Quitar"
        $('.btn-remove').on('click', function () {
            let index = $(this).data('index');
            carrito.splice(index, 1);
            actualizarCarrito();
        });

        // Manejar cambios en la cantidad
            $('.cantidad-input').on('change', function () {
            let index = $(this).closest('section').index();
            carrito[index].cantidad = $(this).val();
        });
        console.log(carrito);
    }


    $('#enviar-carrito').on('click', function () {
        $.ajax({
            type: 'POST',
            url: 'http://localhost/AgroControl/index.php/empleados/asignaciones/AsignacionesController/UsarRepuestosMantenimiento/',
            data: { carrito: carrito },
            success: function (response) {
                //En esta funcion se confirma la llegada de la lista desde ajax al controlador

                responseData = response;
                console.log(responseData);

                // Desestructura el objeto para obtener variables separadas
                let datos = JSON.parse(responseData);
                let { status, mesagge } = datos;
                console.log(status); 
                console.log(mesagge);  

                if (status == true) {
                Swal.fire({
                    icon: 'success',
                    title: 'REPUESTOS AGREGADOS',
                    text: 'SE UTILIZARON CORRECTAMENTE LOS REPUESTOS Y LA ASIGNACION A CAMBIADO EL ESTADO A "EN PROGRESO"',
                })
                setTimeout(function() {
                    window.location.href = "http://localhost/AgroControl/index.php/empleados/Dashboard/Asignaciones";
                }, 3000);
                }

                if (status === "cantidad") {
                Swal.fire({
                    icon: 'warning',
                    title: 'CANTIDAD INVALIDA',
                    text: 'LA CANTIDAD A UTILIZAR NO ES VALIDA',
                })
                }

                if (status === "negativo") {
                Swal.fire({
                    icon: 'error',
                    title: 'CANTIDAD NO VALIDA',
                    text: 'EL NUMERO INGRESADO NO ES VALIDO',
                })
                }

                if (status == false) {
                Swal.fire({
                    icon: 'error',
                    title: 'LISTA VACIA',
                    text: 'NO SE ENVIARON REPUESTOS',
                })
                }

                if (status === "EmptyData") {
                    Swal.fire({
                        icon: 'error',
                        title: 'DATOS VACIOS',
                        text: 'HA INGRESADO DATOS VACIOS',
                    })
                }

            },
            error: function () {
                //En esta funcion se confirma que NO llego lista desde ajax al controlador

                Swal.fire({
                icon: 'error',
                title: 'ERROR INESPERADO',
                text: 'NO SE PUDO ENVIAR LA LISTA',
                })
            }
        });

    });
});