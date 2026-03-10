(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? factory(exports, require('@angular/core')) :
  typeof define === 'function' && define.amd ? define('angular-doka', ['exports', '@angular/core'], factory) :
  (global = global || self, factory(global['angular-doka'] = {}, global.ng.core));
}(this, (function (exports, i0) { 'use strict';

  var Doka = window['Doka'];
  var supported = Doka.supported;
  var create = Doka.create;

  var _c0 = ["*"];
  // We test if Doka is supported on the current client
  var isSupported = supported();
  // Methods not made available on the component
  var filteredComponentMethods = [
      'setOptions',
      'on',
      'off',
      'onOnce',
      'appendTo',
      'insertAfter',
      'insertBefore',
      'isAttachedTo',
      'replaceElement',
      'restoreElement',
      'destroy'
  ];
  var outputs = [
      'oninit',
      'onconfirm',
      'oncancel',
      'onclose',
      'onload',
      'onloaderror',
      'ondestroy',
      'onupdate'
  ];
  var AngularDokaComponent = /** @class */ (function () {
      function AngularDokaComponent(root, zone) {
          var _this = this;
          this.handleEvent = function (e) {
              var output = _this["on" + e.type.split(':')[1]];
              var event = Object.assign({}, e.detail);
              delete event.doka;
              output.emit(event);
          };
          this.src = null;
          this.options = {};
          this.oninit = new i0.EventEmitter();
          this.onconfirm = new i0.EventEmitter();
          this.oncancel = new i0.EventEmitter();
          this.onclose = new i0.EventEmitter();
          this.onload = new i0.EventEmitter();
          this.onloaderror = new i0.EventEmitter();
          this.ondestroy = new i0.EventEmitter();
          this.onupdate = new i0.EventEmitter();
          this.root = root;
          this.zone = zone;
      }
      AngularDokaComponent.prototype.ngOnInit = function () { };
      AngularDokaComponent.prototype.ngAfterViewInit = function () {
          var _this = this;
          // no sufficient features supported in this browser
          if (!isSupported)
              return;
          // will block angular from listening to events inside doka
          this.zone.runOutsideAngular(function () {
              // get host child <div>
              var inner = _this.root.nativeElement.firstChild;
              // if image or canvas supplied
              var src = inner.querySelector('img') || inner.querySelector('canvas') || _this.src;
              // create instance
              _this.doka = create(inner, Object.assign({
                  // source from slot
                  src: src
              }, _this.options));
          });
          // route events
          var dokaRoot = this.doka.element;
          outputs.forEach(function (event) { return dokaRoot.addEventListener("Doka:" + event.substr(2), _this.handleEvent); });
          // Copy instance method references to component instance
          Object.keys(this.doka)
              // remove unwanted methods
              .filter(function (key) { return filteredComponentMethods.indexOf(key) === -1; })
              // set method references from the component instance to the doka instance
              .forEach(function (key) { return _this[key] = _this.doka[key]; });
      };
      AngularDokaComponent.prototype.ngOnChanges = function (changes) {
          // no need to handle first change
          if (changes.firstChange)
              return;
          // no doka instance available
          if (!this.doka)
              return;
          // use new options object as base ( or if not available, use current options )
          var options = changes.options ? changes.options.currentValue : this.options;
          // update source
          if (changes.src)
              options.src = changes.src.currentValue;
          // set new options
          this.doka.setOptions(options);
      };
      AngularDokaComponent.prototype.ngOnDestroy = function () {
          var _this = this;
          // no doka instance available
          if (!this.doka)
              return;
          // detach events
          var dokaRoot = this.doka.element;
          outputs.forEach(function (event) { return dokaRoot.removeEventListener("Doka:" + event.substr(2), _this.handleEvent); });
          // we done!
          this.doka.destroy();
          this.doka = null;
      };
      return AngularDokaComponent;
  }());
  AngularDokaComponent.ɵfac = function AngularDokaComponent_Factory(t) { return new (t || AngularDokaComponent)(i0.ɵɵdirectiveInject(i0.ElementRef), i0.ɵɵdirectiveInject(i0.NgZone)); };
  AngularDokaComponent.ɵcmp = i0.ɵɵdefineComponent({ type: AngularDokaComponent, selectors: [["lib-doka"]], inputs: { src: "src", options: "options" }, outputs: { oninit: "oninit", onconfirm: "onconfirm", oncancel: "oncancel", onclose: "onclose", onload: "onload", onloaderror: "onloaderror", ondestroy: "ondestroy", onupdate: "onupdate" }, features: [i0.ɵɵNgOnChangesFeature], ngContentSelectors: _c0, decls: 2, vars: 0, template: function AngularDokaComponent_Template(rf, ctx) {
          if (rf & 1) {
              i0.ɵɵprojectionDef();
              i0.ɵɵelementStart(0, "div");
              i0.ɵɵprojection(1);
              i0.ɵɵelementEnd();
          }
      }, styles: ["[_nghost-%COMP%] {\n      display: block;\n    }"] });
  /*@__PURE__*/ (function () {
      i0.ɵsetClassMetadata(AngularDokaComponent, [{
              type: i0.Component,
              args: [{
                      selector: 'lib-doka',
                      template: "\n    <div>\n      <ng-content></ng-content>\n    </div>\n  ",
                      styles: ["\n    :host {\n      display: block;\n    }\n  "]
                  }]
          }], function () { return [{ type: i0.ElementRef }, { type: i0.NgZone }]; }, { src: [{
                  type: i0.Input
              }], options: [{
                  type: i0.Input
              }], oninit: [{
                  type: i0.Output
              }], onconfirm: [{
                  type: i0.Output
              }], oncancel: [{
                  type: i0.Output
              }], onclose: [{
                  type: i0.Output
              }], onload: [{
                  type: i0.Output
              }], onloaderror: [{
                  type: i0.Output
              }], ondestroy: [{
                  type: i0.Output
              }], onupdate: [{
                  type: i0.Output
              }] });
  })();

  var _c0$1 = ["*"];
  // We test if Doka is supported on the current client
  var isSupported$1 = supported();
  // Methods not made available on the component
  var filteredComponentMethods$1 = [
      'setOptions',
      'on',
      'off',
      'onOnce',
      'appendTo',
      'insertAfter',
      'insertBefore',
      'isAttachedTo',
      'replaceElement',
      'restoreElement',
      'destroy'
  ];
  var outputs$1 = [
      'oninit',
      'onconfirm',
      'oncancel',
      'onclose',
      'onload',
      'onloaderror',
      'ondestroy',
      'onupdate'
  ];
  var AngularDokaModalComponent = /** @class */ (function () {
      function AngularDokaModalComponent(root, zone) {
          var _this = this;
          this.handleEvent = function (e) {
              var output = _this["on" + e.type.split(':')[1]];
              var event = Object.assign({}, e.detail);
              delete event.doka;
              output.emit(event);
          };
          this.src = null;
          this.options = {};
          this.oninit = new i0.EventEmitter();
          this.onconfirm = new i0.EventEmitter();
          this.oncancel = new i0.EventEmitter();
          this.onclose = new i0.EventEmitter();
          this.onload = new i0.EventEmitter();
          this.onloaderror = new i0.EventEmitter();
          this.ondestroy = new i0.EventEmitter();
          this.onupdate = new i0.EventEmitter();
          this.root = root;
          this.zone = zone;
      }
      AngularDokaModalComponent.prototype.ngOnInit = function () { };
      AngularDokaModalComponent.prototype.ngAfterViewInit = function () {
          var _this = this;
          // no sufficient features supported in this browser
          if (!isSupported$1)
              return;
          // will block angular from listening to events inside doka
          this.zone.runOutsideAngular(function () {
              // get host child <div>
              var inner = _this.root.nativeElement;
              // if image or canvas supplied
              var src = inner.querySelector('img') || inner.querySelector('canvas') || _this.src;
              // create instance
              _this.doka = create(Object.assign({
                  // source from slot
                  src: src
              }, _this.options));
          });
          // route events
          var dokaRoot = this.doka.element;
          outputs$1.forEach(function (event) { return dokaRoot.addEventListener("Doka:" + event.substr(2), _this.handleEvent); });
          // Copy instance method references to component instance
          Object.keys(this.doka)
              // remove unwanted methods
              .filter(function (key) { return filteredComponentMethods$1.indexOf(key) === -1; })
              // set method references from the component instance to the doka instance
              .forEach(function (key) { return _this[key] = _this.doka[key]; });
      };
      AngularDokaModalComponent.prototype.ngOnChanges = function (changes) {
          // no need to handle first change
          if (changes.firstChange)
              return;
          // no doka instance available
          if (!this.doka)
              return;
          // use new options object as base ( or if not available, use current options )
          var options = changes.options ? changes.options.currentValue : this.options;
          // update source
          if (changes.src)
              options.src = changes.src.currentValue;
          // set new options
          this.doka.setOptions(options);
      };
      AngularDokaModalComponent.prototype.ngOnDestroy = function () {
          var _this = this;
          // no doka instance available
          if (!this.doka)
              return;
          // detach events
          var dokaRoot = this.doka.element;
          outputs$1.forEach(function (event) { return dokaRoot.removeEventListener("Doka:" + event.substr(2), _this.handleEvent); });
          // we done!
          this.doka.destroy();
          this.doka = null;
      };
      return AngularDokaModalComponent;
  }());
  AngularDokaModalComponent.ɵfac = function AngularDokaModalComponent_Factory(t) { return new (t || AngularDokaModalComponent)(i0.ɵɵdirectiveInject(i0.ElementRef), i0.ɵɵdirectiveInject(i0.NgZone)); };
  AngularDokaModalComponent.ɵcmp = i0.ɵɵdefineComponent({ type: AngularDokaModalComponent, selectors: [["lib-doka-modal"]], inputs: { src: "src", options: "options" }, outputs: { oninit: "oninit", onconfirm: "onconfirm", oncancel: "oncancel", onclose: "onclose", onload: "onload", onloaderror: "onloaderror", ondestroy: "ondestroy", onupdate: "onupdate" }, features: [i0.ɵɵNgOnChangesFeature], ngContentSelectors: _c0$1, decls: 1, vars: 0, template: function AngularDokaModalComponent_Template(rf, ctx) {
          if (rf & 1) {
              i0.ɵɵprojectionDef();
              i0.ɵɵprojection(0);
          }
      }, styles: ["[_nghost-%COMP%] {\n      display: block;\n    }"] });
  /*@__PURE__*/ (function () {
      i0.ɵsetClassMetadata(AngularDokaModalComponent, [{
              type: i0.Component,
              args: [{
                      selector: 'lib-doka-modal',
                      template: "\n    <ng-content></ng-content>\n  ",
                      styles: ["\n    :host {\n      display: block;\n    }\n  "]
                  }]
          }], function () { return [{ type: i0.ElementRef }, { type: i0.NgZone }]; }, { src: [{
                  type: i0.Input
              }], options: [{
                  type: i0.Input
              }], oninit: [{
                  type: i0.Output
              }], onconfirm: [{
                  type: i0.Output
              }], oncancel: [{
                  type: i0.Output
              }], onclose: [{
                  type: i0.Output
              }], onload: [{
                  type: i0.Output
              }], onloaderror: [{
                  type: i0.Output
              }], ondestroy: [{
                  type: i0.Output
              }], onupdate: [{
                  type: i0.Output
              }] });
  })();

  var _c0$2 = ["*"];
  // We test if Doka is supported on the current client
  var isSupported$2 = supported();
  // Methods not made available on the component
  var filteredComponentMethods$2 = [
      'setOptions',
      'on',
      'off',
      'onOnce',
      'appendTo',
      'insertAfter',
      'insertBefore',
      'isAttachedTo',
      'replaceElement',
      'restoreElement',
      'destroy'
  ];
  var outputs$2 = [
      'oninit',
      'onconfirm',
      'oncancel',
      'onclose',
      'onload',
      'onloaderror',
      'ondestroy',
      'onupdate'
  ];
  var AngularDokaOverlayComponent = /** @class */ (function () {
      function AngularDokaOverlayComponent(root, zone) {
          var _this = this;
          this.handleEvent = function (e) {
              var output = _this["on" + e.type.split(':')[1]];
              var event = Object.assign({}, e.detail);
              delete event.doka;
              output.emit(event);
          };
          this.src = null;
          this.options = {};
          this.enabled = false;
          this.oninit = new i0.EventEmitter();
          this.onconfirm = new i0.EventEmitter();
          this.oncancel = new i0.EventEmitter();
          this.onclose = new i0.EventEmitter();
          this.onload = new i0.EventEmitter();
          this.onloaderror = new i0.EventEmitter();
          this.ondestroy = new i0.EventEmitter();
          this.onupdate = new i0.EventEmitter();
          this.root = root;
          this.zone = zone;
      }
      AngularDokaOverlayComponent.prototype.ngOnInit = function () { };
      AngularDokaOverlayComponent.prototype.ngAfterViewInit = function () {
          // no sufficient features supported in this browser
          if (!isSupported$2)
              return;
          this.update();
      };
      AngularDokaOverlayComponent.prototype.ngOnChanges = function (changes) {
          // no need to handle first change
          if (changes.firstChange)
              return;
          // update!
          this.update(changes);
      };
      AngularDokaOverlayComponent.prototype.ngOnDestroy = function () {
          this.hide();
      };
      AngularDokaOverlayComponent.prototype.show = function (changes) {
          var _this = this;
          if (this.doka) {
              // use new options object as base ( or if not available, use current options )
              var options = changes.options ? changes.options.currentValue : this.options;
              // update source
              if (changes.src)
                  options.src = changes.src.currentValue;
              // set new options
              this.doka.setOptions(options);
              return;
          }
          // will block angular from listening to events inside doka
          this.zone.runOutsideAngular(function () {
              // get host child <div>
              var inner = _this.root.nativeElement.querySelector('div').firstChild;
              // create instance
              _this.doka = create(inner, Object.assign(Object.assign({
                  // source from slot
                  src: _this.src
              }, _this.options), {
                  // always preview mode
                  styleLayoutMode: 'preview', outputData: true
              }));
          });
          // route events
          var dokaRoot = this.doka.element;
          outputs$2.forEach(function (event) { return dokaRoot.addEventListener("Doka:" + event.substr(2), _this.handleEvent); });
          // Copy instance method references to component instance
          Object.keys(this.doka)
              // remove unwanted methods
              .filter(function (key) { return filteredComponentMethods$2.indexOf(key) === -1; })
              // set method references from the component instance to the doka instance
              .forEach(function (key) { return _this[key] = _this.doka[key]; });
      };
      AngularDokaOverlayComponent.prototype.hide = function () {
          var _this = this;
          // no doka instance available
          if (!this.doka)
              return;
          // detach events
          var dokaRoot = this.doka.element;
          outputs$2.forEach(function (event) { return dokaRoot.removeEventListener("Doka:" + event.substr(2), _this.handleEvent); });
          // we done!
          this.doka.destroy();
          this.doka = null;
      };
      AngularDokaOverlayComponent.prototype.update = function (changes) {
          if (this.enabled) {
              this.show(changes);
          }
          else {
              this.hide();
          }
      };
      return AngularDokaOverlayComponent;
  }());
  AngularDokaOverlayComponent.ɵfac = function AngularDokaOverlayComponent_Factory(t) { return new (t || AngularDokaOverlayComponent)(i0.ɵɵdirectiveInject(i0.ElementRef), i0.ɵɵdirectiveInject(i0.NgZone)); };
  AngularDokaOverlayComponent.ɵcmp = i0.ɵɵdefineComponent({ type: AngularDokaOverlayComponent, selectors: [["lib-doka-overlay"]], inputs: { src: "src", options: "options", enabled: "enabled" }, outputs: { oninit: "oninit", onconfirm: "onconfirm", oncancel: "oncancel", onclose: "onclose", onload: "onload", onloaderror: "onloaderror", ondestroy: "ondestroy", onupdate: "onupdate" }, features: [i0.ɵɵNgOnChangesFeature], ngContentSelectors: _c0$2, decls: 3, vars: 0, template: function AngularDokaOverlayComponent_Template(rf, ctx) {
          if (rf & 1) {
              i0.ɵɵprojectionDef();
              i0.ɵɵprojection(0);
              i0.ɵɵelementStart(1, "div");
              i0.ɵɵelement(2, "div");
              i0.ɵɵelementEnd();
          }
      }, styles: ["[_nghost-%COMP%] {\n      display: block;\n      position: relative;\n      overflow: hidden;\n    }\n    \n    [_nghost-%COMP%]     img {\n      display: block;\n      width: 100%;\n      height: auto;\n    }\n    \n    [_nghost-%COMP%]    > div[_ngcontent-%COMP%] {\n      position: absolute;\n      left: 0;\n      top: 0;\n      width: 100%;\n      height: 100%;\n    }"] });
  /*@__PURE__*/ (function () {
      i0.ɵsetClassMetadata(AngularDokaOverlayComponent, [{
              type: i0.Component,
              args: [{
                      selector: 'lib-doka-overlay',
                      template: "\n    <ng-content></ng-content>\n    <div>\n        <div></div>\n    </div>\n  ",
                      styles: ["\n    :host {\n      display: block;\n      position: relative;\n      overflow: hidden;\n    }\n    \n    :host /deep/ img {\n      display: block;\n      width: 100%;\n      height: auto;\n    }\n    \n    :host > div {\n      position: absolute;\n      left: 0;\n      top: 0;\n      width: 100%;\n      height: 100%;\n    }\n    "]
                  }]
          }], function () { return [{ type: i0.ElementRef }, { type: i0.NgZone }]; }, { src: [{
                  type: i0.Input
              }], options: [{
                  type: i0.Input
              }], enabled: [{
                  type: i0.Input
              }], oninit: [{
                  type: i0.Output
              }], onconfirm: [{
                  type: i0.Output
              }], oncancel: [{
                  type: i0.Output
              }], onclose: [{
                  type: i0.Output
              }], onload: [{
                  type: i0.Output
              }], onloaderror: [{
                  type: i0.Output
              }], ondestroy: [{
                  type: i0.Output
              }], onupdate: [{
                  type: i0.Output
              }] });
  })();

  var AngularDokaModule = /** @class */ (function () {
      function AngularDokaModule() {
      }
      return AngularDokaModule;
  }());
  AngularDokaModule.ɵmod = i0.ɵɵdefineNgModule({ type: AngularDokaModule });
  AngularDokaModule.ɵinj = i0.ɵɵdefineInjector({ factory: function AngularDokaModule_Factory(t) { return new (t || AngularDokaModule)(); }, imports: [[]] });
  (function () {
      (typeof ngJitMode === "undefined" || ngJitMode) && i0.ɵɵsetNgModuleScope(AngularDokaModule, { declarations: [AngularDokaComponent,
              AngularDokaModalComponent,
              AngularDokaOverlayComponent], exports: [AngularDokaComponent,
              AngularDokaModalComponent,
              AngularDokaOverlayComponent] });
  })();
  /*@__PURE__*/ (function () {
      i0.ɵsetClassMetadata(AngularDokaModule, [{
              type: i0.NgModule,
              args: [{
                      declarations: [
                          AngularDokaComponent,
                          AngularDokaModalComponent,
                          AngularDokaOverlayComponent
                      ],
                      imports: [],
                      exports: [
                          AngularDokaComponent,
                          AngularDokaModalComponent,
                          AngularDokaOverlayComponent
                      ]
                  }]
          }], null, null);
  })();

  /*
   * Public API Surface of angular-doka
   */

  /**
   * Generated bundle index. Do not edit.
   */

  exports.AngularDokaComponent = AngularDokaComponent;
  exports.AngularDokaModalComponent = AngularDokaModalComponent;
  exports.AngularDokaModule = AngularDokaModule;
  exports.AngularDokaOverlayComponent = AngularDokaOverlayComponent;

  Object.defineProperty(exports, '__esModule', { value: true });

})));
//# sourceMappingURL=angular-doka.umd.js.map
