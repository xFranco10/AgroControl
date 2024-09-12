document.addEventListener("DOMContentLoaded", function() {
    // Esta función se ejecutará una vez que el DOM esté completamente cargado

    // Función para obtener la hora actual
    function obtenerHoraActual() {
        var fechaHora = new Date();
        var horas = fechaHora.getHours();
        var minutos = fechaHora.getMinutes();
        var segundos = fechaHora.getSeconds();

        // Formatea la hora para asegurarte de que siempre tenga dos dígitos
        horas = (horas < 10) ? "0" + horas : horas;
        minutos = (minutos < 10) ? "0" + minutos : minutos;
        segundos = (segundos < 10) ? "0" + segundos : segundos;

        // Construye la cadena de tiempo
        var horaActual = horas + ":" + minutos + ":" + segundos;

        // Actualiza el contenido del elemento con id "horaActual"
        document.getElementById("horaActual").innerHTML = "HORA ACTUAL - " + horaActual;
    }

    // Llama a la función inicialmente
    obtenerHoraActual();

    // Actualiza la hora cada segundo (1000 milisegundos)
    setInterval(obtenerHoraActual, 1000);
});
