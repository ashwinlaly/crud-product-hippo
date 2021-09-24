Dropzone.autoDiscover = false;

function formData(form) {
    var data = {};
    $.each($(form).find('input, select, textarea'), function (key, input) {
        data[$(input).attr('name')] = $(input).val();
    });
    return data;
}

function initDropzone(postURL) {
    $('.dropzone').each(function () {
        var dropzoneControl = $(this)[0].dropzone;
        if (dropzoneControl) {
            dropzoneControl.destroy();
        }
    });
    dropzone = new Dropzone("#dropzone", {
        dictDefaultMessage: "Drop files here or click to upload.",
        maxFilesize: 100,
        timeout: 60000,
        autoProcessQueue: false,
        parallelUploads: 1,
        url: postURL,
        headers: {
            "x-csrf-token": "{{csrf_token()}}",
            "x-requested-with": "XMLHttpRequest",
        }
    });
    dropzone.on("complete", function (file) {
        dropzone.removeFile(file);
    });
}

function uploadDocument() {
    dropzone.processQueue();
}
