import _ from 'lodash';

class Component {
    constructor(el) {
        this.el = el;
        this.$el = $(el);
        this.value = this.$el.val();
        this.handlers = [];

        this.setupCallbacks();
    }

    setupCallbacks() {}

    handleEvent(event) {
        let that = this;
        this.handlers.forEach((handler) => {
            handler(that, event);
        });
    }

    addHandler(handler) {
        this.handlers.push(handler);
    }
}

class Input extends Component {
    setupCallbacks() {
        /* modern browsers use the input event */
        this.$el.on('input', (e) => {
            this.value = e.target.value;
            this.handleEvent(e);
        });
    }
}

class RadioCheckboxInput extends Input {
    constructor(el) {
        super(el);
        this.checked = this.$el.is(':checked');
    }

    setupCallbacks() {
        /* simply use the change event */
        this.$el.change((e) => {
            this.checked = $(e.target).is(':checked');
            this.handleEvent(e);
        });
    }
}

class MemberCheckbox extends RadioCheckboxInput {
    constructor(el) {
        super(el);
        this.inputcost = this.$el.parent('label').parent('.checkbox').find('.cost-container > input');
    }
}

class BillForm {
    constructor() {
        let that = this;
        /* es6 does not bind event methods by default */
        this._bind('onOptionChange', 'onMemberSelected', 'onNameChange' , 'onCostChange', 'calculate', 'handleSubmit');

        this.inputs = [];
        this.inputs['opts'] = [];
        this.inputs['members'] = [];

        this.opt = 'split';
        this.selected_members = [];

        this.form = $('form#bills-create-form');
        this.submitBtn = this.form.find('input[type=submit]').first();
        this.submitBtnVal = this.submitBtn.val();

        this.inputs['name'] = new Input(this.form.find('input[name=name]'));
        this.inputs['cost'] = new Input(this.form.find('input[name=cost]'));

        /* add option radios to instance */
        this.form.find('input[name=billopt]').map((index, el) => {
            let billoptinput = new RadioCheckboxInput(el);
            billoptinput.addHandler(this.onOptionChange); /* set handler */

            that.inputs['opts'].push(billoptinput)
        });

        /* add member checkboxes to instance */
        this.form.find('input[name=userselect]').map((index, el) => {
            let input = new MemberCheckbox(el);
            input.addHandler(this.onMemberSelected); /* set handler */

            that.inputs['members'].push(input);
            if (input.checked) {
                this.selected_members.push(input);
            }
        });

        /* add handlers for name and cost inputs */
        this.inputs['name'].addHandler(this.onNameChange);
        this.inputs['cost'].addHandler(this.onCostChange);
        /* watch form submission */
        this.form.submit(this.handleSubmit);
    }

    _bind(...methods) {
        methods.forEach((method) => {
            this[method] = this[method].bind(this)
        });
    }


    onOptionChange(el, event) {
        /* update option */
        this.opt = event.target.value;

        /* enable or disable inputs for selected_members */
        if (this.opt == 'select') {
            this.selected_members.forEach((el) => {
                el.inputcost.attr('disabled', !el.checked);
            });
        } else {
            this.selected_members.forEach((el) => {
                el.inputcost.attr('disabled', true);
            });
        }

        this.calculate();
    }

    onMemberSelected(el, event) {
        let checked = el.$el.is(':checked') ? true : false;

        if (this.opt == 'select') {
            el.inputcost.attr('disabled', !el.checked);
        }

        /* add selected member to instance array */
        if (checked) {
            this.selected_members.push(el);
        } else {
            /* otherwise set back to zero and remove from selected instance array */
            el.inputcost.val('0.0');
            this.selected_members = _.without(this.selected_members, el);
        }
        /* remove member if added twice */
        _.uniq(this.selected_members);

        /* always calculate when something changes */
        this.calculate();
    }

    onNameChange(el, event) {}

    onCostChange(el, event) {
        /* simply recalculate */
        this.calculate();
    }

    calculate() {
        let members_count = this.selected_members.length;
        let cost = this.inputs['cost'].value;

        if (members_count == 0) return; /* we don't want divisions by zero */

        /* simply set to zero */
        if (cost == NaN || cost == null || cost.length == 0) cost = 0;

        /* only have two digits after the decimal point */
        let cost_per_member = (cost / members_count).toFixed(2);
        /* add zero after comma if no digits after the decimal point */
        if ((cost_per_member % 1) == 0) {
            cost_per_member = parseFloat(cost_per_member).toFixed(1);
        }
        /* set the correct values to the user specific cost */
        this.selected_members.forEach((el) => {
            el.inputcost.val(cost_per_member);
        });
    }

    validate(event) {
        let
            errors = [],
            members_count = this.selected_members.length,
            cost = this.inputs['cost'].value,
            name = this.inputs['name'].value;

        if (name == null || name.length <= 0) {
            errors.push("You need to specify a description");
            return errors;
        }

        if (isNaN(cost) || cost == null || cost.length == 0 || cost <= 0) {
            errors.push("Please provide a valid amount");
            /* no need to check further */
            return errors;
        }

        if (members_count == 0) {
            errors.push("You need to select at least a member");
            /* no need to check further */
            return errors;
        }

        /* check that amount is equal to sum of each selected user cost */
        if (this.opt == 'select') {
            let total = 0;

            this.selected_members.some((el) => {
                let tempval = parseFloat(el.inputcost.val());

                if (isNaN(tempval) || tempval == null || tempval.length == 0 || tempval <= 0) {
                    errors.push("Please specify correct ratios");
                    return true;
                } else {
                    total += parseFloat(tempval);
                }
            });

            if (errors.length > 0) return errors

            /* now compare total sum and total cost with */
            if (Math.abs(cost - total) > 0.010000001) {
                errors.push("The total bill is not equal to your selected ratios");
                return errors;
            }
        }
        return errors;
    }

    handleSubmit(event) {
        event.preventDefault();

        let errors = this.validate(event);
        let errorsBlock = $('#js-errors');

        /* empty errors and print new ones */
        errorsBlock.empty();
        errors.forEach((error) => {
            errorsBlock.append(`<span class="help-block">${error}</span>`)
        });

        /* return if there are errors */
        if (errors.length > 0) return;

        /* disable submit button so the user only submits once */
        this.submitBtn.attr('disabled', true);
        this.submitBtn.val('creating...');

        let
            data = {},
            url = document.origin.concat(document.location.pathname.concat(document.location.search ? document.location.search.concat('&json') : '?json'));

        data.cost = this.inputs['cost'].value;
        data.name = this.inputs['name'].value;
        data.opt = this.opt;
        data['userselect[]'] = [];
        data.usercosts = {};

        this.selected_members.forEach((el) => {
            data['userselect[]'].push(el.value);
            data.usercosts[el.inputcost.attr('name')] = el.inputcost.val();
        });

        $.post(url, data, (resp) => {
            if (!resp.success) {
                /* enable submit button */
                this.submitBtn.attr('disabled', false);
                this.submitBtn.val(this.submitBtnVal);
                /* add error messages */
                resp.messages.forEach((error) => {
                    errorsBlock.append(`<span class="help-block">${error}</span>`);
                });
            } else {
                /* redirect on success */
                window.location = resp.billurl;
            }
        });

    }
}

$(document).ready(function() {
    new BillForm;
});
