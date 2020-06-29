
$(document).ready(function validacao() {
    $("#signupForm").validate({
        errorElement: "small",
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");

            if (element.prop("type") === "radio") {
                error.insertAfter(element.next("label"));
            } else {
                error.insertAfter(element);
            }
            // if (element.prop("type") === "checkbox") {
            //     //error.insertAfter(element.next("div"));
            //     alert('teste');
            // } else {
            //     error.insertAfter(element);
            // }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        },

        rules: {
            datanascimento: {
                required: true,
                dateITA: true
            },
            dataexpedicao: {
                required: true,
                dateITA: true
            }
        }
    });

});