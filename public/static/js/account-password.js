class AccountProfile {
    constructor() {
        let that = this;
        /* es6 does not bind event methods by default */
        this._bind('handleSubmit');

        this.form = $('#accountpassword-form');
        this.oldpassInput = this.form.find('input[name=oldpass]');
        this.password1Input = this.form.find('input[name=password1]');
        this.password2Input = this.form.find('input[name=password2]');

        this.submitBtn = this.form.find('input[type=submit]').first();
        this.submitBtnVal = this.submitBtn.val();

        this.form.submit(this.handleSubmit);
    }

    _bind(...methods) {
        methods.forEach((method) => {
            this[method] = this[method].bind(this)
        });
    }

    validate(event) {
        let
            errors = [],
            oldpass = this.oldpassInput.val(),
            password1 = this.password1Input.val(),
            password2 = this.password2Input.val();

        if (oldpass == null || oldpass.length <= 0) {
            errors.push("You need to enter your current password");
            return errors;
        }

        if ( (password1 == null || password1.length <= 0) || (password2 == null || password2.length <= 0) ) {
            errors.push("Your password and a confirmation are required");
            return errors;
        }

        if (password1 !== password2) {
            errors.push("The passwords do not match");
            return errors;
        }

        return errors;
    }

    handleSubmit(event) {
        event.preventDefault();

        let
            errorsBlock = $('#js-errors'),
            errors = this.validate(event),
            oldpass = this.oldpassInput.val(),
            password1 = this.password1Input.val(),
            password2 = this.password2Input.val(),
            url = document.origin.concat(document.location.pathname.concat(document.location.search ? document.location.search.concat('&json') : '?json')),
            data = {};

        $('#result').empty();
        errorsBlock.empty();
        errors.forEach((error) => {
            errorsBlock.append(`<span class="help-block">${error}</span>`)
        });

        if (errors.length > 0) {
            return;
        }

        data['oldpass'] = oldpass;
        data['password1'] = password1;
        data['password2'] = password2;

        this.submitBtn.attr('disabled', true);
        this.submitBtn.val('changing...');

        $.post(url, data, (resp) => {
            /* enable submit button */
            this.submitBtn.attr('disabled', false);
            this.submitBtn.val(this.submitBtnVal);

            if (!resp.success) {
                /* add error messages */
                resp.messages.forEach((error) => {
                    errorsBlock.append(`<span class="help-block">${error}</span>`);
                });
            } else {
                /* redirect on success */
                $('#result').html(`<span class="help-block">Your new password was saved.</span>`);
                this.form.find('input[type=password]').val('');
            }
        });

    }
}

$(document).ready(function() {
    new AccountProfile;
});
