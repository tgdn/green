import React from 'react';
import { render } from 'react-dom'
import { Router, Route, Link, browserHistory } from 'react-router'

import BaseComponent from './common/base-component.jsx';
import LoginForm from './common/loginform.jsx';

render(<LoginForm />, document.getElementById('app'));
