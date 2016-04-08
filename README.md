# Green
A household management service written in PHP at the University of Warwick.

###### How it works
The application is a PHP micro-framework, it works as is, __dependencies__ are:

* PHP 5
* SQLite3
* NodeJS

###### Installation

Go to `public/static/js/` and run

```bash
npm install # this will install dependencies (webpack, react, ...)
npm run build # this will compile and watch changes in the JS. Break once it's finished
```

Update the config file in `application/config.php` so that you can configure where the db file lives.

Check that sqlite is installed and that the server is running. It should work out of the box.
