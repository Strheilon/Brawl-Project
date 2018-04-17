document.addEventListener("DOMContentLoaded", function () {

    console.log("[DOM] Loaded")


    function picture(e) {
        e.preventDefault();
        document.addEventListener('click', function (picture) {
            window.location = "index.php"
        })
    }

    var buttons = document.querySelectorAll(".picture")

    buttons.forEach(function (click) {
        click.addEventListener("click", picture)
    })

    function pict(e) {
        e.preventDefault();
        document.addEventListener('click', function (pict) {
            window.location = "index.php"
        })
    }

    var buttons = document.querySelectorAll(".pict")

    buttons.forEach(function (click) {
        click.addEventListener("click", pict)
    })

})
