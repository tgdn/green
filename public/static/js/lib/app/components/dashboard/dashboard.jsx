import React from 'react';
import $ from 'jquery';

import BaseComponent from '../../common/base-component.jsx';

export default class Dashboard extends BaseComponent {

    constructor(props) {
        super(props);

        this.state = {
            house: null,
            user: null
        }

        this._bind('componentDidMount', 'fetchHouse');
    }

    componentDidMount() {
        this.fetchHouse();
    }

    fetchHouse() {
        let _this = this;
        let url = document.location.pathname.concat(document.location.search ? document.location.search.concat('&json') : '?json');

        $.get(url, (resp) => {
            /* jquery automatically parses application/json */
            _this.setState({ house: resp.house, user: resp.you });
        });
    }

}
