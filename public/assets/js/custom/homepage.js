var myState = {
    pdf: null,
    currentPage: 1,
    zoom: 1
}
$(function () {
    $("#delete").hide();
    const document_id = localStorage.getItem('document_id');
    if (document_id != undefined)
    {
        if ($(`#${document_id}`).length)
        {
            loadPDF(document_id)
        }
    }

})
$("#logout").on('click', function (e) {
    e.preventDefault();
    if (confirm('Do you wish to logout?'))
    {
        localStorage.removeItem('document_id')
        const url = $(this).attr('href')
        window.location.replace(url)
    }
});
$("#delete").on('click', function (e) {
    e.preventDefault();
    if (confirm('Do you wish to delete this document?'))
    {
        const id = $(this).attr("data-id");
        localStorage.removeItem('document_id')
        window.location.replace('http://127.0.0.1:8000/delete/' + id)
    }
});
$(".pdf_link").on('click', function () {
    const pdf_url = $(this).attr("data-url");
    if (pdf_url != undefined)
    {
        const document_title = $(this).attr("data-title");
        const document_id = $(this).attr("data-id");
        $("#document_title").text(document_title);
        $("#delete").attr("data-id", document_id);
        $("#delete").show();
        localStorage.setItem('document_id', document_id)
        pdfjsLib.getDocument(pdf_url).then((pdf) => {

            myState.pdf = pdf;
            render();

        });
    } else
    {
        $(this).removeClass('active')
        toastr["error"]("Access denied.")
    }
});

//load a pdf file
function loadPDF(document_id) {
    const pdf_url = $(`#${document_id}`).attr("data-url");
    const document_title = $(`#${document_id}`).attr("data-title");
    $("#document_title").text(document_title);
    $(`#${document_id}`).addClass("active")
    $("#delete").attr("data-id", document_id);
    $("#delete").show();
    pdfjsLib.getDocument(pdf_url).then((pdf) => {

        myState.pdf = pdf;
        render();

    });
}
//render pdf file to canvas
function render() {
    myState.pdf.getPage(myState.currentPage).then((page) => {

        var canvas = document.getElementById("pdf_renderer");
        var ctx = canvas.getContext('2d');

        var viewport = page.getViewport(myState.zoom);

        canvas.width = viewport.width;
        canvas.height = viewport.height;

        page.render({
            canvasContext: ctx,
            viewport: viewport
        });
    });
}