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

	'use strict';var _createClass=function(){function defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||false;descriptor.configurable=true;if("value" in descriptor)descriptor.writable=true;Object.defineProperty(target,descriptor.key,descriptor);}}return function(Constructor,protoProps,staticProps){if(protoProps)defineProperties(Constructor.prototype,protoProps);if(staticProps)defineProperties(Constructor,staticProps);return Constructor;};}();function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor)){throw new TypeError("Cannot call a class as a function");}}var Notifications=function(){function Notifications(){var _this=this;_classCallCheck(this,Notifications);var that=this;this._bind('handleChecked');$('input[type=checkbox]').change(function(e){_this.handleChecked(e,$(e.target));});$('#mark-all-read').on('click',function(e){e.preventDefault();$('input[type=checkbox]').map(function(index,el){var $el=$(el);if(!$el.is(':checked')){$el.prop('checked',true).change();}});});}_createClass(Notifications,[{key:'_bind',value:function _bind(){var _this2=this;for(var _len=arguments.length,methods=Array(_len),_key=0;_key<_len;_key++){methods[_key]=arguments[_key];}methods.forEach(function(method){_this2[method]=_this2[method].bind(_this2);});}},{key:'handleChecked',value:function handleChecked(event,el){var checked=el.is(':checked'),notif_id=el.val(),url=document.origin.concat(document.location.pathname).concat('/mark_read/'+notif_id);$.post(url,function(resp){if(resp.success){$('#notif-count-sidebar').html(function(i,val){return val-1;});}});}}]);return Notifications;}();$(document).ready(function(){new Notifications();});

/***/ }
/******/ ]);