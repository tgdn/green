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

	'use strict';var _createClass=function(){function defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||false;descriptor.configurable=true;if("value" in descriptor)descriptor.writable=true;Object.defineProperty(target,descriptor.key,descriptor);}}return function(Constructor,protoProps,staticProps){if(protoProps)defineProperties(Constructor.prototype,protoProps);if(staticProps)defineProperties(Constructor,staticProps);return Constructor;};}();function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor)){throw new TypeError("Cannot call a class as a function");}}var AddHousemates=function(){function AddHousemates(){_classCallCheck(this,AddHousemates);var that=this;this._bind('handleSubmit','handleRemove','handleAdd');this.form=$('form#add-housemate-form');this.inputsBlock=this.form.find('#email-inputs');this.inputCount=3;this.inputTemplate='\n        <div class="form-group form-group-lg col-sm-10 col-sm-offset-1" style="display: none">\n            <input type="text" name="email[]" class="form-control" placeholder="name@domain.com">\n            <a href="#" class="close-icon icon ion-ios-close-empty"></a>\n        </div>';this.form.submit(this.handleSubmit);this.form.find('#add-another').on('click',this.handleAdd);this.inputsBlock.find('a.close-icon').on('click',this.handleRemove);}_createClass(AddHousemates,[{key:'_bind',value:function _bind(){var _this=this;for(var _len=arguments.length,methods=Array(_len),_key=0;_key<_len;_key++){methods[_key]=arguments[_key];}methods.forEach(function(method){_this[method]=_this[method].bind(_this);});}},{key:'handleSubmit',value:function handleSubmit(event){var onevalid=false;this.inputsBlock.find('input').map(function(index,el){if($(el).val().length>5){onevalid=true;}});if(!onevalid)event.preventDefault();}},{key:'handleAdd',value:function handleAdd(event){var _this2=this;event.preventDefault();var that=this;if(this.inputCount==1){this.inputsBlock.find('a.close-icon').removeClass('hidden');}$(this.inputTemplate).find('a.close-icon').on('click',that.handleRemove).parent().appendTo(this.inputsBlock).slideDown(100,function(){_this2.inputCount++;});}},{key:'handleRemove',value:function handleRemove(event){var _this3=this;event.preventDefault();var formgroup=$(event.target.parentNode);if(this.inputCount>1){formgroup.slideUp(120,function(){$(_this3).remove();_this3.inputCount--;if(_this3.inputCount==1){_this3.inputsBlock.find('a.close-icon').addClass('hidden');}});}}}]);return AddHousemates;}();$(document).ready(function(){new AddHousemates();});

/***/ }
/******/ ]);