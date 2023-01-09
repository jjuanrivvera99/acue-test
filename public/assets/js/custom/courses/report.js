// On document ready
KTUtil.onDOMContentLoaded(function () {
    const validator = FormValidation.formValidation(document.getElementById('report'), {
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required',
                    },
                    emailAddress: {
                        message: 'The email is not valid',
                    }
                },
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: '.fv-row',
                eleInvalidClass: '',
                eleValidClass: ''
            })
        }
    });

    $("#report").on('submit', function (e) {
        e.preventDefault();

        // get all the inputs into an array.
        const inputs = $('#report :input');

        const data = {};

        inputs.each(function() {
            data[this.name] = $(this).val();
        });

        data.state = 'available';

        const submitButton = document.getElementById('submit');

        validator.validate().then(function (status) {
            console.log('validated!');

            if (status == 'Valid') {
                // Show loading indication
                submitButton.setAttribute('data-kt-indicator', 'on');

                // Disable button to avoid multiple click
                submitButton.disabled = true;

                // Enable button
                submitButton.disabled = false;

                $.ajax({
                    url: '/api/courses/report',
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        Swal.fire({
                            text: "Form has been successfully submitted!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    },
                    error: function (response) {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    },
                    complete: function () {
                        // Remove loading indication
                        submitButton.removeAttribute('data-kt-indicator');
                    }
                });
            }
        });
    });
});
