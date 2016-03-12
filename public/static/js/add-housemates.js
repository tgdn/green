class AddHousemates {
    constructor() {
        let that = this;
        /* es6 does not bind event methods by default */
        this._bind('handleSubmit', 'handleRemove', 'handleAdd');


        this.form = $('form#add-housemate-form');
        this.inputsBlock = this.form.find('#email-inputs');
        //this.inputs = this.inputsBlock.find('input');

        /* start with three */
        this.inputCount = 3;

        this.inputTemplate = `
        <div class="form-group form-group-lg col-sm-10 col-sm-offset-1" style="display: none">
            <input type="text" name="email[]" class="form-control" placeholder="name@domain.com">
            <a href="#" class="close-icon icon ion-ios-close-empty"></a>
        </div>`;

        /* watch form submission */
        this.form.submit(this.handleSubmit);

        this.form.find('#add-another').on('click', this.handleAdd);
        /* remove input */
        this.inputsBlock.find('a.close-icon').on('click', this.handleRemove);
    }

    _bind(...methods) {
        methods.forEach((method) => {
            this[method] = this[method].bind(this)
        });
    }

    handleSubmit(event) {

        /* do we need to validate the fields? */
        let onevalid = false;
        this.inputsBlock.find('input').map((index, el) => {
            if ($(el).val().length > 5) {
                onevalid = true;
            }
        });

        if (!onevalid)
            event.preventDefault();
    }

    handleAdd(event) {
        event.preventDefault();
        let that = this;

        /* show close icons */
        if (this.inputCount == 1) {
            this.inputsBlock.find('a.close-icon').removeClass('hidden');
        }

        /* append element and add click handler */
        $(this.inputTemplate)
            .find('a.close-icon').on('click', that.handleRemove)
            .parent()
            .appendTo(this.inputsBlock).slideDown(100, () => {
            this.inputCount++;
        });
    }

    handleRemove(event) {
        event.preventDefault();
        let formgroup = $(event.target.parentNode);

        if (this.inputCount > 1) {
            formgroup.slideUp(120, () => {
                $(this).remove();
                this.inputCount--;

                /* hide close icons */
                if (this.inputCount == 1) {
                    this.inputsBlock.find('a.close-icon').addClass('hidden');
                }
            });
        }
    }
}

$(document).ready(function() {
    new AddHousemates;
});
