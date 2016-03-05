var path = require('path');
var config = {
    entry: {
        createbill: path.resolve(__dirname, 'create-bill.js'),
    },
    output: {
        path: path.join(__dirname, 'build'),
        filename: '[name].bundle.js'
    },
    module: {
        loaders: [{
            test: /\.js$/,
            loader: 'babel',
            query: {
                presets: ['es2015'],
                //compact: true,
                comments: false
            }
        }]
    }
};

module.exports = config;
