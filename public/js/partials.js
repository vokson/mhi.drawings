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


function clear() {
    $("#search_form").find('input[type="text"], input[type="date"]').val('');
    $("#name").focus();
}

//Проверка на пустой запрос
function is_request_empty() {
    if (
        $("#project").val() === "" &&
        $("#name").val() === "" &&
        $("#revision").val() === "" &&
        $("#part").val() === "" &&
        $("#status").val() === "" &&
        $("#title").val() === "" &&
        $("#date_beg").val() === "" &&
        $("#date_end").val() === "" &&
        $("#transmittal").val() === ""
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

        $.ajax({
            type: "POST",
            url: "documents",
            async: true,
            data: {
                project: $("#project").val(),
                name: $("#name").val(),
                revision: $("#revision").val(),
                part: $("#part").val(),
                status: $("#status").val(),
                title: $("#title").val(),
                date_beg: $("#date_beg").val(),
                date_end: $("#date_end").val(),
                transmittal: $("#transmittal").val(),
                only_last_rev: only_last_rev
            },
            success: function (data) {
                if (data.length > 0)
                    $("#search_results").html(data);
                //Подключаем plugin для сортировки
                $("#docTable").tablesorter({theme: 'blue', sortList: [[2, 0], [3, 0]], widgets: ['zebra']});
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

function zip_drawings(type) {

    var list = createListOfDocumentId();

    if (list.length == 0)
        $("#search_results").html('Document list is empty. Please, find something first.<br/>');
    else if (is_zip_request_in_progress === true)
        $("#search_results").html('Please, wait result of your previous request!<br/>Loading..<br/>');
    else {
        // Запрет на повторный запрос
        is_zip_request_in_progress = true;

        $.ajax({
            type: "POST",
            url: "documents/" + type,
            async: true,
            data: {
                list: JSON.stringify(list),
            },
            success: function (filename) {
                is_zip_request_in_progress = false;

                //$("#search_results").html(filename);

                if (filename != "")
                {
                    window.location.href = 'zip/' + filename;
                } else {
                    alert("Zip archive creation ERROR or count of files = 0 !!!")
                }

            }
        });
    }
}
