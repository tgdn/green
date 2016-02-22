import React from 'react';
import { render } from 'react-dom'
import { Router, Route, Link, browserHistory } from 'react-router'

import BaseComponent from './base-component.jsx';
import LoginForm from './loginform.jsx';

export default function () {

    render((
        <div>hello</div>
    ), document.getElementById('public-app-main'));

    /*render((
        <Router history={browserHistory}>
        <Route path="/" component={App} onEnter={}>
            <Route path="register" component={Login} onEnter={} />
        </Route>
        </Router>
    ), document.getElementById('public-app-main'));*/
}
