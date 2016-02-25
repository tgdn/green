
import classnames from 'classnames';
import React from 'react';
import validator from 'validator';

import BaseComponent from './base-component.jsx';

validator.extend('isValue', (str) => {
    if (str && str != null && str != '') {
        return true;
    }
    return false;
});

validator.extend('isPassword', (str) => {
    return /^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{4,}$/.test(str);
});

class InputBase extends BaseComponent {

    constructor(props) {
        super(props);
        this.state = {
            value: null,
            valid: true,
            message: null
        };

        // bind methods to instance
        this._bind('_onFocus', '_onBlur', '_onChange');
    }

    componentWillMount() {

        // set the error message or set a default one
        if (!this.props.errorMessage) {
            this.errorMessage = 'This field is invalid';
        } else {
            this.errorMessage = this.props.errorMessage;
        }

        this.validations = this.props.validations ? this.props.validations : '';

        if (this.props.required) {
            this.validations += this.props.validations ? ',isValue' : 'isValue';
        }
    }

    getValue() {
        return this.refs.input.value;
    }

    validate() {
        if (!this.validations) {
            return;
        }

        // true by default, false if validation fails
        this.setState({ valid: true });

        // only validate if there is a value or if it is required
        if (this.state.value || this.props.required) {

            // split each validator
            this.validations.split(',').forEach( (validation) => {

                // arguments are split by ':'
                // ie: isLength:4:10
                let args = validation.split(':');
                let validateMethod = args.shift();

                console.log(validateMethod);

                // JSON parse to convert string values to the correct type
                // '1' will make it an actual number
                args = args.map( (arg) => {
                    return JSON.parse(arg);
                });

                args = [this.state.value].concat(args);
                console.log(validator[validateMethod]);

                if (!validator[validateMethod].apply(validator, args)) {
                    this.setState({ valid: false, message: this.errorMessage });
                }

            });

        }
    }

    _onFocus(event) {
        this.setState({ value: this.state.value, valid: true, message: null });
    }

    _onBlur(event) {
        this.setState({ value: event.target.value }, () => { this.validate() });
    }

    _onChange(event) {
        this.setState({ value: event.target.value });
    }

    renderLabel(children) {
        return this.props.label ? (
            <label htmlFor={this.props.id} key='label'>
                {children}
                {this.props.label}
            </label>
        ) : children;
    }

    renderInput() {
        let classes = classnames('av-text', {
            invalid: !this.state.valid ? true : false
        });

        // beware of this.props
        return (
            <input {...this.props} className={classes} ref='input' key='input' onFocus={this._onFocus} onBlur={this._onBlur} onChange={this._onChange}></input>
        );
    }

    render() {
        let label = this.renderLabel();
        let input = this.renderInput();

        let errorBlock = !this.state.valid ? (
            <div className={'invalid-error'}>{this.state.message}</div>
        ) : null;

        let helpBlock = this.props.help ? (
            <div className={'field-help'}>{this.props.help}</div>
        ) : null;

        return (
            <div className={'field-wrapper'}>
                {label}
                {input}
                {helpBlock}
                {errorBlock}
            </div>
        );
    }
}

InputBase.propTypes = {
    type: React.PropTypes.string,
    label: React.PropTypes.node,
    help: React.PropTypes.node,
    invalid: React.PropTypes.string,
    multiple: React.PropTypes.bool,
    disabled: React.PropTypes.bool,
    defaultValue: React.PropTypes.any,
    id: React.PropTypes.oneOfType([
        React.PropTypes.string,
        React.PropTypes.number
    ]),
    validations: React.PropTypes.string,
    errorMessage: React.PropTypes.node,
    name: React.PropTypes.oneOfType([
        React.PropTypes.string,
        React.PropTypes.number
    ])
};

InputBase.defaultProps = {
    disabled: false,
    multiple: false
};

export default InputBase;
