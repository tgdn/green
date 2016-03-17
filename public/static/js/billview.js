class BillView {

    constructor() {
        let that = this;
        this._bind('handleClick');

        $('#paynow').on('click', (e) => {
            this.handleClick(e, $(e.target));
        });

    }

    _bind(...methods) {
        methods.forEach((method) => {
            this[method] = this[method].bind(this)
        });
    }

    handleClick(event, el) {
        let
            bill_id = el.data('id'),
            url = document.origin.concat(document.location.pathname).concat('/pay/' + bill_id);

        console.log(bill_id);

            /* simply post */
            $.post(url, (resp) => {
                if (resp.success) {
                    location.reload();
                }
            });
    }
}

$(document).ready(function() {
    new BillView;
});
