class TokenGenerator {
    constructor() {
        let that = this;
        /* es6 does not bind event methods by default */
        this._bind('handleGenerate');

        $('#gen-token-link').on('click', this.handleGenerate);

    }

    _bind(...methods) {
        methods.forEach((method) => {
            this[method] = this[method].bind(this)
        });
    }

    handleGenerate(event) {
        event.preventDefault();
        
        $('#gen-token-link').find('.icon').addClass('fa-spin');
        let url = $('#gen-token-link').data('href');
        $.post(url, (resp) =>{
            $('#gen-token-link').find('.icon').removeClass('fa-spin');
            $('kbd#token').html(resp.newtoken);
        });
    }
}

$(document).ready(function() {
    new TokenGenerator;
});
