$(document).ready(function () {


    $("#button_clear").click(function (s) {
        s.preventDefault();
        clear();
    });

    $("#search_form").submit(function (s) {
        s.preventDefault();
        search();
    });

    $("#button_service").click(function (s) {
        s.preventDefault();
        window.location.href = "/service";
    });

    $("#button_unf_status").click(function (s) {
        s.preventDefault();
        window.location.href = "/status/unf";
    });

    $("#button_download_all_pdf").click(function (s) {
        s.preventDefault();
        zip_drawings('pdf');
    });

    $("#button_download_all_dwg").click(function (s) {
        s.preventDefault();
        zip_drawings('dwg');
    });

    is_search_request_in_progress = false;
    is_zip_request_in_progress = false;

    //$.ajaxSetup({
    //    headers: {
    //        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //    }
    //});

});