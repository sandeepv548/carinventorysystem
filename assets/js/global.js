
function ajaxHttpRequest(event, buttonSelector, pathName) {
    var files_list = [];
    $("form " + buttonSelector).on(event, function (e) {
        var initialHtmlSubmitVal = $(buttonSelector).html();
        var formId = $(buttonSelector).parents("form").attr('id');
        e.preventDefault();
        var formData = new FormData();
        var other_data = $('#' + formId).serializeArray();
        $.each(other_data, function (key, input) {
            formData.append(input.name, input.value);
        });

        var havefile = $('#' + formId + ' input[type="file"]').length;
        //Multiple upload
        if (havefile > 0) {
            var files_selected = $('#car_imgs')[0].files;
            for (var j = 0; j < files_selected.length; j++) {
                files_list.push(files_selected[j]);
            }
            var i = 0, len = files_list.length, file;
            for (i = 0; i < len; i++) {
                file = files_list[i];
                formData.append("car_imgs[]", file);
            }
        }

        //formData.append('car_imgs', $('#car_imgs')[0].files[0]);
        loaderOpen(buttonSelector);
        $.ajax({
            type: 'POST',
            url: base_url() + pathName,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (resData) {
                loaderClose(buttonSelector, initialHtmlSubmitVal);
                alertMsg(resData);
                console.log(resData);
                if (resData.response.message == 'Car model deleted successfully') {
                    setTimeout("window.location.href='viewinventory';", 5000);
                }
            },
            error: function (error) {
                loaderClose(buttonSelector, initialHtmlSubmitVal);
                alertErrMsg(error);
            }
        });
    });
}
function base_url() {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/');
    } else {
        var url = location.origin;
    }
    return url;
}
function loaderOpen(buttonSelector) {
    $(buttonSelector).html('Loading..');
    $(buttonSelector).addClass('disabled');
}
function loaderClose(buttonSelector, initialHtmlSubmitVal) {
    $(buttonSelector).html(initialHtmlSubmitVal);
    $(buttonSelector).removeClass('disabled');
}
function alertMsg(resData) {
    var errorMsg = '';
    var headMsg = '';
    var alertType = '';
    if (resData.response.status == 200) {
        alertType = "success";
    } else {
        alertType = "danger";
        if (resData.response.data) {
            errorMsg = resData.response.data;
        }
    }
    headMsg = resData.response.message;
    var alertHtml = '<div class="alert alert-' + alertType + ' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>' + headMsg + '</strong> <br/>' + errorMsg + '</div>';
    $('#alert').html();
    $('#alert').html(alertHtml);
}
function alertErrMsg(resData) {
    var errorMsg = '';
    var headMsg = '';
    var alertType = '';
    errorMsg = "Error encountered!!";
    headMsg = resData.responseText;
    alertType = "danger";
    var alertHtml = '<div class="alert alert-' + alertType + ' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>' + headMsg + '</strong> <br/>' + errorMsg + '</div>';
    $('#alert').html();
    $('#alert').html(alertHtml);
}