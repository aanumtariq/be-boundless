function notify(
    type = "1",
    title = "Notification Title",
    message = "",
    url = undefined,
    from = "bottom",
    align = "center",
    icon = undefined,
    animIn = "animated flipInX",
    animOut = "animated flipOutX"
) {
    if (type == "1") {
        type = "success";
    }
    if (type == "0") {
        type = "danger";
    }
    if (type == "2") {
        type = "info";
    }
    if (type == "") {
        type = "inverse";
    }
    if (!title) {
        title = type;
    }
    $.notify(
        {
            icon: icon,
            title: title,
            message: message,
            url: url,
        },
        {
            element: "body",
            type: type,
            allow_dismiss: true,
            placement: {
                from: from,
                align: align,
            },
            offset: {
                x: 15, // Keep this as default
                y: 15, // Unless there'll be alignment issues as this value is targeted in CSS
            },
            spacing: 10,
            z_index: 1031,
            delay: 2500,
            timer: 1000,
            url_target: "_blank",
            mouse_over: false,
            animate: {
                enter: animIn,
                exit: animOut,
            },
            template:
                '<div data-notify="container" class="alert alert-dismissible alert-{0} alert--notify" role="alert">' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                "</div>" +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '<button type="button" aria-hidden="true" data-notify="dismiss" class="alert--notify__close">Close</button>' +
                "</div>",
        }
    );
}
function generateNotification(messageType, message, _url) {
    if (!_url) {
        _url = "";
    }
    var iconUse = "";
    if (messageType == "danger") {
        iconUse = "fa fa-exclamation-triangle";
    } else if (messageType == "success" || messageType == 1) {
        iconUse = "fa fa-check";
        messageType = "success";
    } else if (messageType == "info") {
        iconUse = "fa fa-info-circle";
    } else if (messageType == "error" || messageType == 0) {
        messageType = "danger";
        iconUse = "fa fa-exclamation-triangle";
    }
    $.notify(
        {
            // options
            icon: iconUse,
            title: "",
            message: message,
            url: _url,
            target: "_blank",
        },
        {
            // settings
            element: "body",
            position: null,
            type: messageType,
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: false,
            placement: {
                from: "bottom",
                align: "right",
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
            url_target: "_blank",
            mouse_over: null,
            animate: {
                enter: "animated fadeInDown",
                exit: "animated fadeOutUp",
            },
            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: "class",
            template:
                '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                "</div>" +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                "</div>",
        }
    );
}

function AddToWish(id) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "/addToWishList",
        method: "post",
        data: { id },
        success: function (result) {
            console.log(result);
            generateNotification(result.status, result.data);
        },
        error: function (params) {
            console.log(params);
            generateNotification(params.status, params.data);
        },
    });
}
