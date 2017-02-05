$(document).ready(function () {


    $("#button_clear").click(function (s) {
        s.preventDefault();
        clear();
    });

    $("#search_form").submit(function (s) {
        s.preventDefault();
        search();
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