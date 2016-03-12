class AccountProfile {
    constructor() {
        let that = this;
        /* es6 does not bind event methods by default */
        this._bind('handleSubmit');

        this.form = $('#accountprofile-form');
        this.nameInput = this.form.find('input[name=fname]');
        this.emailInput = this.form.find('input[name=email]');

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
            name = this.nameInput.val(),
            email = this.emailInput.val();

        if ( (name == null || name.length <= 0) || (email == null || email.length <= 0) ) {
            errors.push("Both your name and email are required");
            return errors;
        }

        return errors;
    }

    handleSubmit(event) {
        event.preventDefault();

        let
            errorsBlock = $('#js-errors'),
            errors = this.validate(event),
            name = this.nameInput.val(),
            email = this.emailInput.val(),
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

        data['fname'] = name;
        data['email'] = email;

        this.submitBtn.attr('disabled', true);
        this.submitBtn.val('saving...');

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
                $('#result').html(`<span class="help-block">Your profile has been saved.</span>`);
            }
        });

    }
}

$(document).ready(function() {
    new AccountProfile;
});
