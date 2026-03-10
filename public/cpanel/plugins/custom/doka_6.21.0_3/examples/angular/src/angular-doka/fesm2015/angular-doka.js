import { EventEmitter, ɵɵdirectiveInject, ElementRef, NgZone, ɵɵdefineComponent, ɵɵNgOnChangesFeature, ɵɵprojectionDef, ɵɵelementStart, ɵɵprojection, ɵɵelementEnd, ɵsetClassMetadata, Component, Input, Output, ɵɵelement, ɵɵdefineNgModule, ɵɵdefineInjector, ɵɵsetNgModuleScope, NgModule } from '@angular/core';

const Doka = window['Doka'];
const supported = Doka.supported;
const create = Doka.create;

const _c0 = ["*"];
// We test if Doka is supported on the current client
const isSupported = supported();
// Methods not made available on the component
const filteredComponentMethods = [
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
const outputs = [
    'oninit',
    'onconfirm',
    'oncancel',
    'onclose',
    'onload',
    'onloaderror',
    'ondestroy',
    'onupdate'
];
class AngularDokaComponent {
    constructor(root, zone) {
        this.handleEvent = (e) => {
            const output = this[`on${e.type.split(':')[1]}`];
            const event = Object.assign({}, e.detail);
            delete event.doka;
            output.emit(event);
        };
        this.src = null;
        this.options = {};
        this.oninit = new EventEmitter();
        this.onconfirm = new EventEmitter();
        this.oncancel = new EventEmitter();
        this.onclose = new EventEmitter();
        this.onload = new EventEmitter();
        this.onloaderror = new EventEmitter();
        this.ondestroy = new EventEmitter();
        this.onupdate = new EventEmitter();
        this.root = root;
        this.zone = zone;
    }
    ngOnInit() { }
    ngAfterViewInit() {
        // no sufficient features supported in this browser
        if (!isSupported)
            return;
        // will block angular from listening to events inside doka
        this.zone.runOutsideAngular(() => {
            // get host child <div>
            const inner = this.root.nativeElement.firstChild;
            // if image or canvas supplied
            const src = inner.querySelector('img') || inner.querySelector('canvas') || this.src;
            // create instance
            this.doka = create(inner, Object.assign({ 
                // source from slot
                src }, this.options));
        });
        // route events
        const dokaRoot = this.doka.element;
        outputs.forEach(event => dokaRoot.addEventListener(`Doka:${event.substr(2)}`, this.handleEvent));
        // Copy instance method references to component instance
        Object.keys(this.doka)
            // remove unwanted methods
            .filter(key => filteredComponentMethods.indexOf(key) === -1)
            // set method references from the component instance to the doka instance
            .forEach(key => this[key] = this.doka[key]);
    }
    ngOnChanges(changes) {
        // no need to handle first change
        if (changes.firstChange)
            return;
        // no doka instance available
        if (!this.doka)
            return;
        // use new options object as base ( or if not available, use current options )
        const options = changes.options ? changes.options.currentValue : this.options;
        // update source
        if (changes.src)
            options.src = changes.src.currentValue;
        // set new options
        this.doka.setOptions(options);
    }
    ngOnDestroy() {
        // no doka instance available
        if (!this.doka)
            return;
        // detach events
        const dokaRoot = this.doka.element;
        outputs.forEach(event => dokaRoot.removeEventListener(`Doka:${event.substr(2)}`, this.handleEvent));
        // we done!
        this.doka.destroy();
        this.doka = null;
    }
}
AngularDokaComponent.ɵfac = function AngularDokaComponent_Factory(t) { return new (t || AngularDokaComponent)(ɵɵdirectiveInject(ElementRef), ɵɵdirectiveInject(NgZone)); };
AngularDokaComponent.ɵcmp = ɵɵdefineComponent({ type: AngularDokaComponent, selectors: [["lib-doka"]], inputs: { src: "src", options: "options" }, outputs: { oninit: "oninit", onconfirm: "onconfirm", oncancel: "oncancel", onclose: "onclose", onload: "onload", onloaderror: "onloaderror", ondestroy: "ondestroy", onupdate: "onupdate" }, features: [ɵɵNgOnChangesFeature], ngContentSelectors: _c0, decls: 2, vars: 0, template: function AngularDokaComponent_Template(rf, ctx) { if (rf & 1) {
        ɵɵprojectionDef();
        ɵɵelementStart(0, "div");
        ɵɵprojection(1);
        ɵɵelementEnd();
    } }, styles: ["[_nghost-%COMP%] {\n      display: block;\n    }"] });
/*@__PURE__*/ (function () { ɵsetClassMetadata(AngularDokaComponent, [{
        type: Component,
        args: [{
                selector: 'lib-doka',
                template: `
    <div>
      <ng-content></ng-content>
    </div>
  `,
                styles: [`
    :host {
      display: block;
    }
  `]
            }]
    }], function () { return [{ type: ElementRef }, { type: NgZone }]; }, { src: [{
            type: Input
        }], options: [{
            type: Input
        }], oninit: [{
            type: Output
        }], onconfirm: [{
            type: Output
        }], oncancel: [{
            type: Output
        }], onclose: [{
            type: Output
        }], onload: [{
            type: Output
        }], onloaderror: [{
            type: Output
        }], ondestroy: [{
            type: Output
        }], onupdate: [{
            type: Output
        }] }); })();

const _c0$1 = ["*"];
// We test if Doka is supported on the current client
const isSupported$1 = supported();
// Methods not made available on the component
const filteredComponentMethods$1 = [
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
const outputs$1 = [
    'oninit',
    'onconfirm',
    'oncancel',
    'onclose',
    'onload',
    'onloaderror',
    'ondestroy',
    'onupdate'
];
class AngularDokaModalComponent {
    constructor(root, zone) {
        this.handleEvent = (e) => {
            const output = this[`on${e.type.split(':')[1]}`];
            const event = Object.assign({}, e.detail);
            delete event.doka;
            output.emit(event);
        };
        this.src = null;
        this.options = {};
        this.oninit = new EventEmitter();
        this.onconfirm = new EventEmitter();
        this.oncancel = new EventEmitter();
        this.onclose = new EventEmitter();
        this.onload = new EventEmitter();
        this.onloaderror = new EventEmitter();
        this.ondestroy = new EventEmitter();
        this.onupdate = new EventEmitter();
        this.root = root;
        this.zone = zone;
    }
    ngOnInit() { }
    ngAfterViewInit() {
        // no sufficient features supported in this browser
        if (!isSupported$1)
            return;
        // will block angular from listening to events inside doka
        this.zone.runOutsideAngular(() => {
            // get host child <div>
            const inner = this.root.nativeElement;
            // if image or canvas supplied
            const src = inner.querySelector('img') || inner.querySelector('canvas') || this.src;
            // create instance
            this.doka = create(Object.assign({ 
                // source from slot
                src }, this.options));
        });
        // route events
        const dokaRoot = this.doka.element;
        outputs$1.forEach(event => dokaRoot.addEventListener(`Doka:${event.substr(2)}`, this.handleEvent));
        // Copy instance method references to component instance
        Object.keys(this.doka)
            // remove unwanted methods
            .filter(key => filteredComponentMethods$1.indexOf(key) === -1)
            // set method references from the component instance to the doka instance
            .forEach(key => this[key] = this.doka[key]);
    }
    ngOnChanges(changes) {
        // no need to handle first change
        if (changes.firstChange)
            return;
        // no doka instance available
        if (!this.doka)
            return;
        // use new options object as base ( or if not available, use current options )
        const options = changes.options ? changes.options.currentValue : this.options;
        // update source
        if (changes.src)
            options.src = changes.src.currentValue;
        // set new options
        this.doka.setOptions(options);
    }
    ngOnDestroy() {
        // no doka instance available
        if (!this.doka)
            return;
        // detach events
        const dokaRoot = this.doka.element;
        outputs$1.forEach(event => dokaRoot.removeEventListener(`Doka:${event.substr(2)}`, this.handleEvent));
        // we done!
        this.doka.destroy();
        this.doka = null;
    }
}
AngularDokaModalComponent.ɵfac = function AngularDokaModalComponent_Factory(t) { return new (t || AngularDokaModalComponent)(ɵɵdirectiveInject(ElementRef), ɵɵdirectiveInject(NgZone)); };
AngularDokaModalComponent.ɵcmp = ɵɵdefineComponent({ type: AngularDokaModalComponent, selectors: [["lib-doka-modal"]], inputs: { src: "src", options: "options" }, outputs: { oninit: "oninit", onconfirm: "onconfirm", oncancel: "oncancel", onclose: "onclose", onload: "onload", onloaderror: "onloaderror", ondestroy: "ondestroy", onupdate: "onupdate" }, features: [ɵɵNgOnChangesFeature], ngContentSelectors: _c0$1, decls: 1, vars: 0, template: function AngularDokaModalComponent_Template(rf, ctx) { if (rf & 1) {
        ɵɵprojectionDef();
        ɵɵprojection(0);
    } }, styles: ["[_nghost-%COMP%] {\n      display: block;\n    }"] });
/*@__PURE__*/ (function () { ɵsetClassMetadata(AngularDokaModalComponent, [{
        type: Component,
        args: [{
                selector: 'lib-doka-modal',
                template: `
    <ng-content></ng-content>
  `,
                styles: [`
    :host {
      display: block;
    }
  `]
            }]
    }], function () { return [{ type: ElementRef }, { type: NgZone }]; }, { src: [{
            type: Input
        }], options: [{
            type: Input
        }], oninit: [{
            type: Output
        }], onconfirm: [{
            type: Output
        }], oncancel: [{
            type: Output
        }], onclose: [{
            type: Output
        }], onload: [{
            type: Output
        }], onloaderror: [{
            type: Output
        }], ondestroy: [{
            type: Output
        }], onupdate: [{
            type: Output
        }] }); })();

const _c0$2 = ["*"];
// We test if Doka is supported on the current client
const isSupported$2 = supported();
// Methods not made available on the component
const filteredComponentMethods$2 = [
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
const outputs$2 = [
    'oninit',
    'onconfirm',
    'oncancel',
    'onclose',
    'onload',
    'onloaderror',
    'ondestroy',
    'onupdate'
];
class AngularDokaOverlayComponent {
    constructor(root, zone) {
        this.handleEvent = (e) => {
            const output = this[`on${e.type.split(':')[1]}`];
            const event = Object.assign({}, e.detail);
            delete event.doka;
            output.emit(event);
        };
        this.src = null;
        this.options = {};
        this.enabled = false;
        this.oninit = new EventEmitter();
        this.onconfirm = new EventEmitter();
        this.oncancel = new EventEmitter();
        this.onclose = new EventEmitter();
        this.onload = new EventEmitter();
        this.onloaderror = new EventEmitter();
        this.ondestroy = new EventEmitter();
        this.onupdate = new EventEmitter();
        this.root = root;
        this.zone = zone;
    }
    ngOnInit() { }
    ngAfterViewInit() {
        // no sufficient features supported in this browser
        if (!isSupported$2)
            return;
        this.update();
    }
    ngOnChanges(changes) {
        // no need to handle first change
        if (changes.firstChange)
            return;
        // update!
        this.update(changes);
    }
    ngOnDestroy() {
        this.hide();
    }
    show(changes) {
        if (this.doka) {
            // use new options object as base ( or if not available, use current options )
            const options = changes.options ? changes.options.currentValue : this.options;
            // update source
            if (changes.src)
                options.src = changes.src.currentValue;
            // set new options
            this.doka.setOptions(options);
            return;
        }
        // will block angular from listening to events inside doka
        this.zone.runOutsideAngular(() => {
            // get host child <div>
            const inner = this.root.nativeElement.querySelector('div').firstChild;
            // create instance
            this.doka = create(inner, Object.assign(Object.assign({ 
                // source from slot
                src: this.src }, this.options), { 
                // always preview mode
                styleLayoutMode: 'preview', outputData: true }));
        });
        // route events
        const dokaRoot = this.doka.element;
        outputs$2.forEach(event => dokaRoot.addEventListener(`Doka:${event.substr(2)}`, this.handleEvent));
        // Copy instance method references to component instance
        Object.keys(this.doka)
            // remove unwanted methods
            .filter(key => filteredComponentMethods$2.indexOf(key) === -1)
            // set method references from the component instance to the doka instance
            .forEach(key => this[key] = this.doka[key]);
    }
    hide() {
        // no doka instance available
        if (!this.doka)
            return;
        // detach events
        const dokaRoot = this.doka.element;
        outputs$2.forEach(event => dokaRoot.removeEventListener(`Doka:${event.substr(2)}`, this.handleEvent));
        // we done!
        this.doka.destroy();
        this.doka = null;
    }
    update(changes) {
        if (this.enabled) {
            this.show(changes);
        }
        else {
            this.hide();
        }
    }
}
AngularDokaOverlayComponent.ɵfac = function AngularDokaOverlayComponent_Factory(t) { return new (t || AngularDokaOverlayComponent)(ɵɵdirectiveInject(ElementRef), ɵɵdirectiveInject(NgZone)); };
AngularDokaOverlayComponent.ɵcmp = ɵɵdefineComponent({ type: AngularDokaOverlayComponent, selectors: [["lib-doka-overlay"]], inputs: { src: "src", options: "options", enabled: "enabled" }, outputs: { oninit: "oninit", onconfirm: "onconfirm", oncancel: "oncancel", onclose: "onclose", onload: "onload", onloaderror: "onloaderror", ondestroy: "ondestroy", onupdate: "onupdate" }, features: [ɵɵNgOnChangesFeature], ngContentSelectors: _c0$2, decls: 3, vars: 0, template: function AngularDokaOverlayComponent_Template(rf, ctx) { if (rf & 1) {
        ɵɵprojectionDef();
        ɵɵprojection(0);
        ɵɵelementStart(1, "div");
        ɵɵelement(2, "div");
        ɵɵelementEnd();
    } }, styles: ["[_nghost-%COMP%] {\n      display: block;\n      position: relative;\n      overflow: hidden;\n    }\n    \n    [_nghost-%COMP%]     img {\n      display: block;\n      width: 100%;\n      height: auto;\n    }\n    \n    [_nghost-%COMP%]    > div[_ngcontent-%COMP%] {\n      position: absolute;\n      left: 0;\n      top: 0;\n      width: 100%;\n      height: 100%;\n    }"] });
/*@__PURE__*/ (function () { ɵsetClassMetadata(AngularDokaOverlayComponent, [{
        type: Component,
        args: [{
                selector: 'lib-doka-overlay',
                template: `
    <ng-content></ng-content>
    <div>
        <div></div>
    </div>
  `,
                styles: [`
    :host {
      display: block;
      position: relative;
      overflow: hidden;
    }
    
    :host /deep/ img {
      display: block;
      width: 100%;
      height: auto;
    }
    
    :host > div {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
    }
    `]
            }]
    }], function () { return [{ type: ElementRef }, { type: NgZone }]; }, { src: [{
            type: Input
        }], options: [{
            type: Input
        }], enabled: [{
            type: Input
        }], oninit: [{
            type: Output
        }], onconfirm: [{
            type: Output
        }], oncancel: [{
            type: Output
        }], onclose: [{
            type: Output
        }], onload: [{
            type: Output
        }], onloaderror: [{
            type: Output
        }], ondestroy: [{
            type: Output
        }], onupdate: [{
            type: Output
        }] }); })();

class AngularDokaModule {
}
AngularDokaModule.ɵmod = ɵɵdefineNgModule({ type: AngularDokaModule });
AngularDokaModule.ɵinj = ɵɵdefineInjector({ factory: function AngularDokaModule_Factory(t) { return new (t || AngularDokaModule)(); }, imports: [[]] });
(function () { (typeof ngJitMode === "undefined" || ngJitMode) && ɵɵsetNgModuleScope(AngularDokaModule, { declarations: [AngularDokaComponent,
        AngularDokaModalComponent,
        AngularDokaOverlayComponent], exports: [AngularDokaComponent,
        AngularDokaModalComponent,
        AngularDokaOverlayComponent] }); })();
/*@__PURE__*/ (function () { ɵsetClassMetadata(AngularDokaModule, [{
        type: NgModule,
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
    }], null, null); })();

/*
 * Public API Surface of angular-doka
 */

/**
 * Generated bundle index. Do not edit.
 */

export { AngularDokaComponent, AngularDokaModalComponent, AngularDokaModule, AngularDokaOverlayComponent };
//# sourceMappingURL=angular-doka.js.map
