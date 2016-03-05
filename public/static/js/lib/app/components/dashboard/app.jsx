import React from 'react';
import { Link, IndexLink } from 'react-router';

import BaseComponent from '../../common/base-component.jsx';
import Input from '../../common/input.jsx';

import Dashboard from './dashboard.jsx';

export default class App extends Dashboard {
    render() {
        let name = this.state.house ? this.state.house.name : 'House';
        return (
            <div>
                <div className="col-sm-4 col-lg-3">
                    <div className="list-group">
                        <li className="list-group-item">
                            <h5><b>{name}</b></h5>
                        </li>
                        <IndexLink to="/" className="list-group-item" activeClassName="active">
                            <span className="pull-right"><i className="icon ion-ios-arrow-right"></i></span>
                            Bills
                        </IndexLink>
                        <Link to="/members" className="list-group-item" activeClassName="active">
                            <span className="pull-right"><i className="icon ion-ios-arrow-right"></i></span>
                            Members
                        </Link>
                        <Link to="/notifications" className="list-group-item" activeClassName="active">
                            <span className="pull-right"><i className="icon ion-ios-arrow-right"></i></span>
                            Notifications
                        </Link>
                        <Link to="/preferences" className="list-group-item" activeClassName="active">
                            <span className="pull-right"><i className="icon ion-ios-arrow-right"></i></span>
                            Preferences
                        </Link>
                    </div>

                    <div className="panel panel-default">
                        <div className="panel-body">
                            <h5>
                                People
                            </h5>
                            <ul className="list-unstyled">
                                <li className="empty-list">
                                    <em>No people yet</em>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {this.props.children}

                <div className="col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-4 col-lg-offset-0 col-lg-3">
                    <div className="panel panel-default">
                        <div className="panel-body">
                            <ul className="list-inline footer-list">
                                <li>CS139 - University of Warwick</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
