import React from 'react';

import BaseComponent from './base-component.jsx';
import Input from './input.jsx';

export default class LoginForm extends BaseComponent {

    render() {

        let passwordError = 'Enter a combination of at least six numbers, letters and punctuation marks. Both upper case and lower case.';

        return (
            <form method="post" action="" id="login-form">
                <div className="form-group form-group-lg">
                    <Input type='email' className='form-control' name='email' id="email-id" validations='isEmail' errorMessage='Not a valid email' required />
                </div>
                <div class="form-group form-group-lg">
                    <Input type='password' className='form-control' name='password' id="password-id" validations='isPassword' errorMessage={passwordError} required />
                </div>
                <div class="form-group text-center">
                    <input type="submit" value="Enter" className="btn btn-lg btn-block btn-t-plain" />
                </div>
            </form>
        )
    }

};
