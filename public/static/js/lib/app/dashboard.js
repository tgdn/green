import React from 'react';
import { render } from 'react-dom';
import { Router, Route, IndexRoute, hashHistory } from 'react-router';

import House from './components/dashboard/HouseModel.js';

//const house = new House();

import App from './components/dashboard/app.jsx';
import Index from './components/dashboard/index.jsx';
import {Members, MembersAdd} from './components/dashboard/members.jsx';

render((
    <Router history={hashHistory}>
        <Route path='/' component={App}>
            <IndexRoute component={Index} />
            <Route path="/members" component={Members} />
        </Route>
    </Router>
), document.getElementById('app'));
