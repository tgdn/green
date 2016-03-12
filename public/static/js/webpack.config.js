var path = require('path');
var config = {
    entry: {
        createbill: path.resolve(__dirname, 'create-bill.js'),
        addhousemates: path.resolve(__dirname, 'add-housemates.js'),
        tokengen: path.resolve(__dirname, 'token-gen.js'),
        accountprofile: path.resolve(__dirname, 'account-profile.js'),
        accountpassword: path.resolve(__dirname, 'account-password.js'),
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
                compact: true,
                comments: false
            }
        }]
    }
};

module.exports = config;
