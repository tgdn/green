var path = require('path');
var config = {
    entry: {
        housecreate: path.resolve(__dirname, 'app/housecreate.js'),
        login: path.resolve(__dirname, 'app/login.js')
    },
    output: {
        path: path.join(__dirname, 'build'),
        filename: '[name].bundle.js'
    },
    module: {
        loaders: [{
            test: /\.jsx?$/,
            loader: 'babel',
            query: {
                presets: ['es2015', 'react']
            }
        }]
    }
};

module.exports = config;
