import React from 'react';
import { Router, Route, IndexRoute, Link, hashHistory } from 'react-router';

import Input from '../../common/input.jsx';

import Dashboard from './dashboard.jsx';

export class MembersAdd extends Dashboard {
    render() {

    }
}

export class Members extends Dashboard {

    renderMembers() {
        let _this = this;
        let members = this.state.house ? this.state.house.members : [];

        return (
            <ul className="list-unstyled house-members-list">
                {members.map((member) => {
                    let name = member.id == _this.state.user.id ? 'you' : member.full_name;
                    let remove_label = member.id == _this.state.user.id ? 'leave' : 'remove';
                    return (
                        <li key={member.id}>
                            <div>
                                <span className="house-members-list_name">
                                    {name}
                                </span>
                                <small className="house-members-list_email text-muted">
                                    {member.email}
                                </small>
                                <button className="btn btn-xs btn-t-red-outline house-members-list_del-btn">
                                    {remove_label}
                                </button>
                            </div>
                        </li>
                    )
                })}
            </ul>
        );
    }

    render() {
        let members = this.renderMembers();

        return (
            <div className="col-sm-8 col-md-8 col-lg-6">
                <div className="panel panel-default">
                    <div className="panel-body">
                        <h5>
                            Members
                        </h5>
                        <div id="houseview-app" className="larger-font">
                            {members}

                            <div className="text-center">
                                <Link to="/members/add" className="btn btn-t-plain">
                                    Add housemates
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
