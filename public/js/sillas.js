function reservaSilla(silla, selecionado) {
    var sillaid = document.getElementById(silla);
    var link = document.getElementById(sillaid.id + "-link");
    var selectSeats = document.getElementById("selectSeats");

    if (selecionado == true) {
        if (selectSeats.value == "") {
            selectSeats.value = sillaid.id;
        } else {
            selectSeats.value = selectSeats.value + "," + sillaid.id;
        }
        sillaid.style.fill = "#eca72c";
        link.removeAttribute("onclick");
        link.setAttribute(
            "onclick",
            'reservaSilla("' + sillaid.id + '", false)'
        );
    } else {
        if (selectSeats.value.indexOf("," + sillaid.id) !== -1) {
            var removeSeat = selectSeats.value.replace("," + sillaid.id, "");
            selectSeats.value = removeSeat;
            sillaid.style.fill = "#8ac926";
            link.removeAttribute("onclick");
            link.setAttribute(
                "onclick",
                'reservaSilla("' + sillaid.id + '", true)'
            );
        } else if (selectSeats.value.indexOf(sillaid.id) !== -1) {
            var removeSeat = selectSeats.value.replace(sillaid.id, "");
            selectSeats.value = removeSeat;
            sillaid.style.fill = "#8ac926";
            link.removeAttribute("onclick");
            link.setAttribute(
                "onclick",
                'reservaSilla("' + sillaid.id + '", true)'
            );
        } else {
            console.log("asiento no encontrado");
        }
    }
}
