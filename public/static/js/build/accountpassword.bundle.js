/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

	'use strict';var _createClass=function(){function defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||false;descriptor.configurable=true;if("value" in descriptor)descriptor.writable=true;Object.defineProperty(target,descriptor.key,descriptor);}}return function(Constructor,protoProps,staticProps){if(protoProps)defineProperties(Constructor.prototype,protoProps);if(staticProps)defineProperties(Constructor,staticProps);return Constructor;};}();function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor)){throw new TypeError("Cannot call a class as a function");}}var AccountProfile=function(){function AccountProfile(){_classCallCheck(this,AccountProfile);var that=this;this._bind('handleSubmit');this.form=$('#accountpassword-form');this.oldpassInput=this.form.find('input[name=oldpass]');this.password1Input=this.form.find('input[name=password1]');this.password2Input=this.form.find('input[name=password2]');this.submitBtn=this.form.find('input[type=submit]').first();this.submitBtnVal=this.submitBtn.val();this.form.submit(this.handleSubmit);}_createClass(AccountProfile,[{key:'_bind',value:function _bind(){var _this=this;for(var _len=arguments.length,methods=Array(_len),_key=0;_key<_len;_key++){methods[_key]=arguments[_key];}methods.forEach(function(method){_this[method]=_this[method].bind(_this);});}},{key:'validate',value:function validate(event){var errors=[],oldpass=this.oldpassInput.val(),password1=this.password1Input.val(),password2=this.password2Input.val();if(oldpass==null||oldpass.length<=0){errors.push("You need to enter your current password");return errors;}if(password1==null||password1.length<=0||password2==null||password2.length<=0){errors.push("Your password and a confirmation are required");return errors;}if(password1!==password2){errors.push("The passwords do not match");return errors;}return errors;}},{key:'handleSubmit',value:function handleSubmit(event){var _this2=this;event.preventDefault();var errorsBlock=$('#js-errors'),errors=this.validate(event),oldpass=this.oldpassInput.val(),password1=this.password1Input.val(),password2=this.password2Input.val(),url=document.origin.concat(document.location.pathname.concat(document.location.search?document.location.search.concat('&json'):'?json')),data={};$('#result').empty();errorsBlock.empty();errors.forEach(function(error){errorsBlock.append('<span class="help-block">'+error+'</span>');});if(errors.length>0){return;}data['oldpass']=oldpass;data['password1']=password1;data['password2']=password2;this.submitBtn.attr('disabled',true);this.submitBtn.val('changing...');$.post(url,data,function(resp){_this2.submitBtn.attr('disabled',false);_this2.submitBtn.val(_this2.submitBtnVal);if(!resp.success){resp.messages.forEach(function(error){errorsBlock.append('<span class="help-block">'+error+'</span>');});}else {$('#result').html('<span class="help-block">Your new password was saved.</span>');_this2.form.find('input[type=password]').val('');}});}}]);return AccountProfile;}();$(document).ready(function(){new AccountProfile();});

/***/ }
/******/ ]);