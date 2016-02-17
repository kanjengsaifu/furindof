function sendRequest(requestUrl, requestData, requestMethod, objReference, requestDataType, navigationType) {
    $.ajax({
        async: false,
        beforeSend: function() {
            $("body").append("<div class='backDropOverlay' id='backDropOverlay'><div><img src='assets/images/loading.gif'/><span>Loading..</span></div></div>");
        },
        complete: function() {
            $("#backDropOverlay").remove();
        },
        url: requestUrl,
        data: requestData,
        type: requestMethod,
        dataType: requestDataType,
        success: function(data, textStatus) {

            if (textStatus == 'success') {

                if ((navigationType == 'modules') || (navigationType == 'sidebarMenu')) {
                    if (navigationType == 'modules') {
                        $('.sidebar-menu').html(data.menu);
                        $('.content-wrapper').html(data.content);
                    }

                    if (navigationType == 'sidebarMenu') {
                        $('.content-wrapper').html(data.content);
                    }

                } else {

                    $('body').find('#alertMessage').remove();

                    $('.' + objReference).before("<div class='alert alert-" + data.responseAlertType + "' id='alertMessage'>" + data.responseString + "</div>");

                    if (data.isNeedRefresh === true) {
                        window.location = data.refreshURL;
                    }
                }
            } else {
                $('.' + objReference).html("<div class='alert alert-warning'>Proses penerimaan data dari server tidak berhasil [" + textStatus + "] </div>");
            }
        },
        error: function(data, textStatus) {
            $('body').find('#alertMessage').remove();
            $('body').find('.backDropOverlay').remove();
            $('.' + objReference).before("<div class='alert alert-warning' id='alertMessage'>Proses pengiriman data ke server tidak berhasil : [" + textStatus + "] </div>");
        }
    });

    $(window).scrollTop(0);
}

function sendRequestForm(requestUrl, requestData, objReference) {
    $.ajax({
        async: false,
        beforeSend: function() {
            $("body").append("<div class='backDropOverlay' id='backDropOverlay'><div><img src='assets/images/loading.gif'/><span>Processing..</span></div></div>");
        },
        complete: function() {
            $("#backDropOverlay").remove();
        },
        url: requestUrl,
        data: requestData,
        type: 'POST',
        success: function(data, textStatus) {
            $('body').find('#alertMessage').remove();
            $('body').find('.backDropOverlay').remove();
            (textStatus == 'success') ? $('.' + objReference).before(data): $('.' + objReference).html("<div class='alert alert-warning'  id='alertMessage'>Proses penerimaan data dari server tidak berhasil [" + textStatus + "] </div>");
        },
        error: function(data, textStatus) {
            $('body').find('#alertMessage').remove();
            $('body').find('.backDropOverlay').remove();
            $('.' + objReference).before("<div class='alert alert-warning' id='alertMessage'>Proses pengiriman data ke server tidak berhasil : [" + textStatus + "] </div>");
        }
    });

    $(window).scrollTop(0);
}

function ajaxItemsTrans(requestUrl, requestData) {
    
    var returnValue = '{textStatus : "failed"}';

    $.ajax({
        async: false,
        beforeSend: function() {
            $("body").append("<div class='backDropOverlay' id='backDropOverlay'><div><img src='assets/images/loading.gif'/><span>Processing..</span></div></div>");
        },
        complete: function() {
            $("#backDropOverlay").remove();
        },
        url: requestUrl,
        data: requestData,
        type: 'POST',
        dataType: 'JSON',
        success: function(data, textStatus) {
            returnValue =  data;
        },
        error: function(data, textStatus) {
        }
    });
  
    return returnValue;

    $(window).scrollTop(0);
}

function ajaxDataGrid(requestUrl, requestData, objReference) {
    $.ajax({
        async: false,
        beforeSend: function() {
            $("body").append("<div class='backDropOverlay' id='backDropOverlay'><div><img src='assets/images/loading.gif'/><span>Loading..</span></div></div>");
        },
        complete: function() {
            $("#backDropOverlay").remove();
        },
        url: requestUrl,
        data: requestData,
        type: 'POST',
        success: function(data, textStatus) {
            $('body').find('#alertMessage').remove();
            (textStatus == 'success') ? $('#' + objReference).html(data): $('#' + objReference).append("<div class='alert alert-warning'  id='alertMessage'>Proses penerimaan data dari server tidak berhasil [" + textStatus + "] </div>");
        },
        error: function(data, textStatus) {
            $('body').find('#alertMessage').remove();
            $('body').find('.backDropOverlay').remove();
            $('#' + objReference).append("<div class='alert alert-warning' id='alertMessage'>Proses pengiriman data ke server tidak berhasil : [" + textStatus + "] </div>");
        }
    });

    $(window).scrollTop(0);
}


function ajaxLinkURL(requestUrl, objReference) {
    $.ajax({
        async: true,
        beforeSend: function() {
            $("body").append("<div class='backDropOverlay' id='backDropOverlay'><div><img src='assets/images/loading.gif'/><span>Loading..</span></div></div>");
        },
        complete: function() {
            $("#backDropOverlay").remove();
        },
        url: requestUrl,
        type: 'GET',
        success: function(data, textStatus) {
            (textStatus == 'success') ? $('.' + objReference).html(data): $('.' + objReference).html("<div class='alert alert-warning'>Proses penerimaan data dari server tidak berhasil [" + textStatus + "] </div>");
        },
        error: function(data, textStatus) {
            $('body').find('#alertMessage').remove();
            $('body').find('.backDropOverlay').remove();
            $('.' + objReference).before("<div class='alert alert-warning' id='alertMessage'>Proses pengiriman data ke server tidak berhasil : [" + textStatus + "] </div>");
        }
    });

    $(window).scrollTop(0);
}

function ajaxLinkReference(requestUrl, requestData, objReference) {
    $.ajax({
        async: false,
        beforeSend: function() {
            $("body").append("<div class='backDropOverlay' id='backDropOverlay'><div><img src='assets/images/loading.gif'/><span>Loading..</span></div></div>");
        },
        complete: function() {
            $("#backDropOverlay").remove();
        },
        url: requestUrl,
        data: requestData,
        type: 'POST',
        success: function(data, textStatus) {
            (textStatus == 'success') ? $('.' + objReference).html(data): $('.' + objReference).html("<div class='alert alert-warning'>Proses penerimaan data dari server tidak berhasil [" + textStatus + "] </div>");
        },
        error: function(data, textStatus) {
            $('body').find('#alertMessage').remove();
            $('body').find('.backDropOverlay').remove();
            $('.' + objReference).before("<div class='alert alert-warning' id='alertMessage'>Proses pengiriman data ke server tidak berhasil : [" + textStatus + "] </div>");
        }
    });

    $(window).scrollTop(0);
}

function ajaxFillGridJSON(requestUrl, requestData) {
    
   var returnValue = '{textStatus : "failed"}';

    $.ajax({
        async: false,
        beforeSend: function() {
            $("body").append("<div class='backDropOverlay' id='backDropOverlay'><div><img src='assets/images/loading.gif'/><span>Processing..</span></div></div>");
        },
        complete: function() {
            $("#backDropOverlay").remove();
        },
        url: requestUrl,
        data: requestData,
        type: 'POST',
        success: function(data, textStatus) {
            returnValue =  data;
        },
        error: function(data, textStatus) {
        }
    });
  
    return returnValue;

    $(window).scrollTop(0);
}