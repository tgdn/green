class Notifications {

    constructor() {
        let that = this;
        this._bind('handleChecked');

        $('input[type=checkbox]').change((e) => {
            this.handleChecked(e, $(e.target));
        });

        $('#mark-all-read').on('click', (e) => {
            e.preventDefault();
            $('input[type=checkbox]').map((index, el) => {
                let $el = $(el);
                if (!$el.is(':checked')) {
                    $el.prop('checked', true).change();
                }
            });
        });
    }

    _bind(...methods) {
        methods.forEach((method) => {
            this[method] = this[method].bind(this)
        });
    }

    handleChecked(event, el) {
        let
            checked = el.is(':checked'),
            notif_id = el.val(),
            url = document.origin.concat(document.location.pathname).concat('/mark_read/' + notif_id);

            /* simply post */
            $.post(url, (resp) => {
                if (resp.success) {
                    $('#notif-count-sidebar').html((i, val) => {
                        return val - 1;
                    });
                }
            });
    }
}

$(document).ready(function() {
    new Notifications;
});
