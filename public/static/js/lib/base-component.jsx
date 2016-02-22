
import React from "react";

/*
Simply a React.Component that binds methods to this.
*/

export default class BaseComponent extends React.Component {

    _bind(...methods) {
        methods.forEach((method) => {
            this[method] = this[method].bind(this)
        });
    }

}
