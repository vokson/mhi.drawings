//аналог функции var_dump в PHP
function var_dump(obj) {
    var out = "";
    if (obj && typeof (obj) == "object") {
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }
    } else {
        out = obj;
    }
    alert(out);
}

$(document).ready(function () {

    $("#search_form").submit(function (s) {
        s.preventDefault();
        search();
    });

    is_search_request_in_progress = false;

});

//Проверка на пустой запрос
function is_request_empty() {
    if (
        $("#name").val() === "" &&
        $("#revision").val() === "" &&
        $("#title").val() === "" &&
        $("#approvedByDI").val() === "" &&
        $("#approvedBySAC").val() === "" &&
        $("#letterFromDI").val() === "" &&
        $("#letterFromSAC").val() === ""
    )
        return true;
    else
        return false;
}

function search() {

//Проверка на пустой запрос
    if (is_request_empty() === true)
        $("#search_results").html('Empty request is restricted. Please, add search condition.<br/>');
    else if (is_search_request_in_progress === true)
        $("#search_results").html('Please, wait result of your previous request!<br/>Loading..<br/>');
    else {
        //Запрет на повторный запрос
        is_search_request_in_progress = true;
        $("#search_results").html('Loading..<br/>');
        $("#search_results").html('INSIDE SEARCH..<br/>');

        var only_last_rev = 0;
        if ($('input#only_last_rev').prop('checked')) {
            only_last_rev = 1;
        }

        var approvedByDI = null;
        if ($("#approvedByDI").val() == "YES") {
            approvedByDI = 1;
        } else if ($("#approvedByDI").val() == "NO") {
            approvedByDI = 0;
        }

        var approvedBySAC = null;
        if ($("#approvedBySAC").val() == "YES") {
            approvedBySAC = 1;
        } else if ($("#approvedBySAC").val() == "NO") {
            approvedByDI = 0;
        }

        $.ajax({
            type: "POST",
            url: "unf/search",
            async: true,
            data: {
                name: $("#name").val(),
                revision: $("#revision").val(),
                title: $("#title").val(),
                approvedByDI: approvedByDI,
                approvedBySAC: approvedBySAC,
                letterFromDI: $("#letterFromDI").val(),
                letterFromSAC: $("#letterFromSAC").val(),
                only_last_rev: only_last_rev
            },
            success: function (data) {
                if (data.length > 0)
                    $("#search_results").html(data);
                //Подключаем plugin для сортировки
                $("#docTable").tablesorter({theme: 'blue', sortList: [[1, 0], [2, 0]], widgets: ['zebra']});
                //Разрешение на следующий запрос
                is_search_request_in_progress = false;
            }
        });
    }

}

//создает список найденных чертежей
function createListOfDocumentId() {
    var list = [];

    $('.document').each(function () {
        list.push($(this).attr('id'));
    });

    return list;
}