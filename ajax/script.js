$(document).ready(function () {

    $("#add_form").on("submit", function (event) {
        event.preventDefault();

        $.ajax({
            url: "/ajax/add_task.php",
            method: "post",
            data:  $( "#add_form" ).serialize(),

        }).done(function (data) {
            // Успешное получение ответа
            console.log(data);
            event.target.reset();

            $('.table tbody').replaceWith(data);
        });
    })

    $("#edit_form").on("submit", function (event) {
        event.preventDefault();

        $.ajax({
            url: "/ajax/edit_task.php",
            method: "post",
            data:  $( "#edit_form" ).serialize(),

        }).done(function (data) {
            // Успешное получение ответа
            window.location.href = '/';
        });
    })
});