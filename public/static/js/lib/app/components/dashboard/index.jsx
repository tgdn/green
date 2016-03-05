import React from 'react';
import { Router, Route, IndexRoute, Link, hashHistory } from 'react-router';

import Dashboard from './dashboard.jsx';

export default class Index extends Dashboard {
    render() {
        return (
            <div className="col-sm-8 col-md-8 col-lg-6">
                <div className="panel panel-default">
                    <div className="panel-body">
                        <h5>
                            Home
                        </h5>
                    </div>
                </div>
            </div>
        );
    }
}
