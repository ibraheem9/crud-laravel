import { Component, EventEmitter, Input, Output } from '@angular/core';
import { create, supported } from '../lib';
import * as i0 from "@angular/core";
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
export class AngularDokaOverlayComponent {
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
        if (!isSupported)
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
        outputs.forEach(event => dokaRoot.addEventListener(`Doka:${event.substr(2)}`, this.handleEvent));
        // Copy instance method references to component instance
        Object.keys(this.doka)
            // remove unwanted methods
            .filter(key => filteredComponentMethods.indexOf(key) === -1)
            // set method references from the component instance to the doka instance
            .forEach(key => this[key] = this.doka[key]);
    }
    hide() {
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
    update(changes) {
        if (this.enabled) {
            this.show(changes);
        }
        else {
            this.hide();
        }
    }
}
AngularDokaOverlayComponent.ɵfac = function AngularDokaOverlayComponent_Factory(t) { return new (t || AngularDokaOverlayComponent)(i0.ɵɵdirectiveInject(i0.ElementRef), i0.ɵɵdirectiveInject(i0.NgZone)); };
AngularDokaOverlayComponent.ɵcmp = i0.ɵɵdefineComponent({ type: AngularDokaOverlayComponent, selectors: [["lib-doka-overlay"]], inputs: { src: "src", options: "options", enabled: "enabled" }, outputs: { oninit: "oninit", onconfirm: "onconfirm", oncancel: "oncancel", onclose: "onclose", onload: "onload", onloaderror: "onloaderror", ondestroy: "ondestroy", onupdate: "onupdate" }, features: [i0.ɵɵNgOnChangesFeature], ngContentSelectors: _c0, decls: 3, vars: 0, template: function AngularDokaOverlayComponent_Template(rf, ctx) { if (rf & 1) {
        i0.ɵɵprojectionDef();
        i0.ɵɵprojection(0);
        i0.ɵɵelementStart(1, "div");
        i0.ɵɵelement(2, "div");
        i0.ɵɵelementEnd();
    } }, styles: ["[_nghost-%COMP%] {\n      display: block;\n      position: relative;\n      overflow: hidden;\n    }\n    \n    [_nghost-%COMP%]     img {\n      display: block;\n      width: 100%;\n      height: auto;\n    }\n    \n    [_nghost-%COMP%]    > div[_ngcontent-%COMP%] {\n      position: absolute;\n      left: 0;\n      top: 0;\n      width: 100%;\n      height: 100%;\n    }"] });
/*@__PURE__*/ (function () { i0.ɵsetClassMetadata(AngularDokaOverlayComponent, [{
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
    }], function () { return [{ type: i0.ElementRef }, { type: i0.NgZone }]; }, { src: [{
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
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYW5ndWxhci1kb2thLW92ZXJsYXkuY29tcG9uZW50LmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXMiOlsiLi4vLi4vLi4vLi4vLi4vc3JjL2FuZ3VsYXIvcHJvamVjdHMvYW5ndWxhci1kb2thL3NyYy9saWIvZG9rYS1vdmVybGF5L2FuZ3VsYXItZG9rYS1vdmVybGF5LmNvbXBvbmVudC50cyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSxPQUFPLEVBQUUsU0FBUyxFQUFjLFlBQVksRUFBa0IsS0FBSyxFQUFFLE1BQU0sRUFBaUIsTUFBTSxlQUFlLENBQUM7QUFDbEgsT0FBTyxFQUFFLE1BQU0sRUFBRSxTQUFTLEVBQUUsTUFBTSxRQUFRLENBQUM7OztBQUczQyxxREFBcUQ7QUFDckQsTUFBTSxXQUFXLEdBQUcsU0FBUyxFQUFFLENBQUM7QUFFaEMsOENBQThDO0FBQzlDLE1BQU0sd0JBQXdCLEdBQWE7SUFDekMsWUFBWTtJQUNaLElBQUk7SUFDSixLQUFLO0lBQ0wsUUFBUTtJQUNSLFVBQVU7SUFDVixhQUFhO0lBQ2IsY0FBYztJQUNkLGNBQWM7SUFDZCxnQkFBZ0I7SUFDaEIsZ0JBQWdCO0lBQ2hCLFNBQVM7Q0FDVixDQUFDO0FBRUYsTUFBTSxPQUFPLEdBQWE7SUFDeEIsUUFBUTtJQUNSLFdBQVc7SUFDWCxVQUFVO0lBQ1YsU0FBUztJQUNULFFBQVE7SUFDUixhQUFhO0lBQ2IsV0FBVztJQUNYLFVBQVU7Q0FDWCxDQUFDO0FBaUNGLE1BQU0sT0FBTywyQkFBMkI7SUF5QnRDLFlBQVksSUFBZ0IsRUFBRSxJQUFZO1FBcEJsQyxnQkFBVyxHQUF3QixDQUFDLENBQWEsRUFBRSxFQUFFO1lBQzNELE1BQU0sTUFBTSxHQUFHLElBQUksQ0FBQyxLQUFLLENBQUMsQ0FBQyxJQUFJLENBQUMsS0FBSyxDQUFDLEdBQUcsQ0FBQyxDQUFDLENBQUMsQ0FBQyxFQUFFLENBQUMsQ0FBQztZQUNqRCxNQUFNLEtBQUsscUJBQU8sQ0FBQyxDQUFDLE1BQU0sQ0FBQyxD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QkFDNUIsUUFBUSxFQUFFOzs7OztHQUtUO2dCQUNELE1BQU0sRUFBRSxDQUFDOzs7Ozs7Ozs7Ozs7Ozs7Ozs7OztLQW9CTixDQUFDO2FBQ0w7O2tCQWNFLEtBQUs7O2tCQUNMLEtBQUs7O2tCQUNMLEtBQUs7O2tCQUVMLE1BQU07O2tCQUNOLE1BQU07O2tCQUNOLE1BQU07O2tCQUNOLE1BQU07O2tCQUNOLE1BQU07O2tCQUNOLE1BQU07O2tCQUNOLE1BQU07O2tCQUNOLE1BQU0iLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgeyBDb21wb25lbnQsIEVsZW1lbnRSZWYsIEV2ZW50RW1pdHRlciwgTmdab25lLCBPbkluaXQsIElucHV0LCBPdXRwdXQsIFNpbXBsZUNoYW5nZXMgfSBmcm9tICdAYW5ndWxhci9jb3JlJztcbmltcG9ydCB7IGNyZWF0ZSwgc3VwcG9ydGVkIH0gZnJvbSAnLi4vbGliJztcbmltcG9ydCB7IElEb2thSW5zdGFuY2UsIElEb2thT3B0aW9ucyB9ICBmcm9tICcuLi9saWIvZG9rYSc7XG5cbi8vIFdlIHRlc3QgaWYgRG9rYSBpcyBzdXBwb3J0ZWQgb24gdGhlIGN1cnJlbnQgY2xpZW50XG5jb25zdCBpc1N1cHBvcnRlZCA9IHN1cHBvcnRlZCgpO1xuXG4vLyBNZXRob2RzIG5vdCBtYWRlIGF2YWlsYWJsZSBvbiB0aGUgY29tcG9uZW50XG5jb25zdCBmaWx0ZXJlZENvbXBvbmVudE1ldGhvZHM6IHN0cmluZ1tdID0gW1xuICAnc2V0T3B0aW9ucycsXG4gICdvbicsXG4gICdvZmYnLFxuICAnb25PbmNlJyxcbiAgJ2FwcGVuZFRvJyxcbiAgJ2luc2VydEFmdGVyJyxcbiAgJ2luc2VydEJlZm9yZScsXG4gICdpc0F0dGFjaGVkVG8nLFxuICAncmVwbGFjZUVsZW1lbnQnLFxuICAncmVzdG9yZUVsZW1lbnQnLFxuICAnZGVzdHJveSdcbl07XG5cbmNvbnN0IG91dHB1dHM6IHN0cmluZ1tdID0gW1xuICAnb25pbml0JywgXG4gICdvbmNvbmZpcm0nLCBcbiAgJ29uY2FuY2VsJywgXG4gICdvbmNsb3NlJyxcbiAgJ29ubG9hZCcsIFxuICAnb25sb2FkZXJyb3InLCBcbiAgJ29uZGVzdHJveScsIFxuICAnb251cGRhdGUnXG5dO1xuXG5AQ29tcG9uZW50KHtcbiAgc2VsZWN0b3I6ICdsaWItZG9rYS1vdmVybGF5JyxcbiAgdGVtcGxhdGU6IGBcbiAgICA8bmctY29udGVudD48L25nLWNvbnRlbnQ+XG4gICAgPGRpdj5cbiAgICAgICAgPGRpdj48L2Rpdj5cbiAgICA8L2Rpdj5cbiAgYCxcbiAgc3R5bGVzOiBbYFxuICAgIDpob3N0IHtcbiAgICAgIGRpc3BsYXk6IGJsb2NrO1xuICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xuICAgICAgb3ZlcmZsb3c6IGhpZGRlbjtcbiAgICB9XG4gICAgXG4gICAgOmhvc3QgL2RlZXAvIGltZyB7XG4gICAgICBkaXNwbGF5OiBibG9jaztcbiAgICAgIHdpZHRoOiAxMDAlO1xuICAgICAgaGVpZ2h0OiBhdXRvO1xuICAgIH1cbiAgICBcbiAgICA6aG9zdCA+IGRpdiB7XG4gICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gICAgICBsZWZ0OiAwO1xuICAgICAgdG9wOiAwO1xuICAgICAgd2lkdGg6IDEwMCU7XG4gICAgICBoZWlnaHQ6IDEwMCU7XG4gICAgfVxuICAgIGBdXG59KVxuXG5leHBvcnQgY2xhc3MgQW5ndWxhckRva2FPdmVybGF5Q29tcG9uZW50IGltcGxlbWVudHMgT25Jbml0IHtcblxuICBwcml2YXRlIHJvb3Q6IEVsZW1lbnRSZWY7XG4gIHByaXZhdGUgem9uZTogTmdab25lO1xuICBwcml2YXRlIGRva2E6IElEb2thSW5zdGFuY2U7XG4gIHByaXZhdGUgaGFuZGxlRXZlbnQ6IEV2ZW50SGFuZGxlck5vbk51bGwgPSAoZTpDdXN0b21FdmVudCkgPT4ge1xuICAgIGNvbnN0IG91dHB1dCA9IHRoaXNbYG9uJHtlLnR5cGUuc3BsaXQoJzonKVsxXX1gXTtcbiAgICBjb25zdCBldmVudCA9IHsuLi5lLmRldGFpbH07XG4gICAgZGVsZXRlIGV2ZW50LmRva2E7XG4gICAgb3V0cHV0LmVtaXQoZXZlbnQpO1xuICB9O1xuXG4gIEBJbnB1dCgpIHNyYzogc3RyaW5nfEZpbGV8QmxvYnxIVE1MSW1hZ2VFbGVtZW50fEhUTUxDYW52YXNFbGVtZW50ID0gbnVsbDtcbiAgQElucHV0KCkgb3B0aW9uczogSURva2FPcHRpb25zID0ge307XG4gIEBJbnB1dCgpIGVuYWJsZWQ6IGJvb2xlYW4gPSBmYWxzZTtcblxuICBAT3V0cHV0KCkgb25pbml0OiBFdmVudEVtaXR0ZXI8YW55PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIG9uY29uZmlybTogRXZlbnRFbWl0dGVyPGFueT4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBvbmNhbmNlbDogRXZlbnRFbWl0dGVyPGFueT4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBvbmNsb3NlOiBFdmVudEVtaXR0ZXI8YW55PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIG9ubG9hZDogRXZlbnRFbWl0dGVyPGFueT4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBvbmxvYWRlcnJvcjogRXZlbnRFbWl0dGVyPGFueT4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBvbmRlc3Ryb3k6IEV2ZW50RW1pdHRlcjxhbnk+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgb251cGRhdGU6IEV2ZW50RW1pdHRlcjxhbnk+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuXG4gIGNvbnN0cnVjdG9yKHJvb3Q6IEVsZW1lbnRSZWYsIHpvbmU6IE5nWm9uZSkge1xuICAgIHRoaXMucm9vdCA9IHJvb3Q7XG4gICAgdGhpcy56b25lID0gem9uZTtcbiAgfVxuXG4gIG5nT25Jbml0KCkge31cblxuICBuZ0FmdGVyVmlld0luaXQoKSB7XG5cbiAgICAvLyBubyBzdWZmaWNpZW50IGZlYXR1cmVzIHN1cHBvcnRlZCBpbiB0aGlzIGJyb3dzZXJcbiAgICBpZiAoIWlzU3VwcG9ydGVkKSByZXR1cm47XG5cbiAgICB0aGlzLnVwZGF0ZSgpO1xuICB9XG5cbiAgbmdPbkNoYW5nZXMoY2hhbmdlczogU2ltcGxlQ2hhbmdlcykge1xuICAgIC8vIG5vIG5lZWQgdG8gaGFuZGxlIGZpcnN0IGNoYW5nZVxuICAgIGlmIChjaGFuZ2VzLmZpcnN0Q2hhbmdlKSByZXR1cm47XG5cbiAgICAvLyB1cGRhdGUhXG4gICAgdGhpcy51cGRhdGUoY2hhbmdlcyk7XG4gIH1cblxuICBuZ09uRGVzdHJveSgpIHtcbiAgICB0aGlzLmhpZGUoKTtcbiAgfVxuXG4gIHNob3coY2hhbmdlcz86IFNpbXBsZUNoYW5nZXMpIHtcblxuICAgIGlmICh0aGlzLmRva2EpIHtcblxuICAgICAgLy8gdXNlIG5ldyBvcHRpb25zIG9iamVjdCBhcyBiYXNlICggb3IgaWYgbm90IGF2YWlsYWJsZSwgdXNlIGN1cnJlbnQgb3B0aW9ucyApXG4gICAgICBjb25zdCBvcHRpb25zID0gY2hhbmdlcy5vcHRpb25zID8gY2hhbmdlcy5vcHRpb25zLmN1cnJlbnRWYWx1ZSA6IHRoaXMub3B0aW9ucztcbiAgICAgIFxuICAgICAgLy8gdXBkYXRlIHNvdXJjZVxuICAgICAgaWYgKGNoYW5nZXMuc3JjKSBvcHRpb25zLnNyYyA9IGNoYW5nZXMuc3JjLmN1cnJlbnRWYWx1ZTtcblxuICAgICAgLy8gc2V0IG5ldyBvcHRpb25zXG4gICAgICB0aGlzLmRva2Euc2V0T3B0aW9ucyhvcHRpb25zKTtcblxuICAgICAgcmV0dXJuO1xuICAgIH1cblxuICAgIC8vIHdpbGwgYmxvY2sgYW5ndWxhciBmcm9tIGxpc3RlbmluZyB0byBldmVudHMgaW5zaWRlIGRva2FcbiAgICB0aGlzLnpvbmUucnVuT3V0c2lkZUFuZ3VsYXIoKCkgPT4ge1xuXG4gICAgICAvLyBnZXQgaG9zdCBjaGlsZCA8ZGl2PlxuICAgICAgY29uc3QgaW5uZXIgPSB0aGlzLnJvb3QubmF0aXZlRWxlbWVudC5xdWVyeVNlbGVjdG9yKCdkaXYnKS5maXJzdENoaWxkO1xuXG4gICAgICAvLyBjcmVhdGUgaW5zdGFuY2VcbiAgICAgIHRoaXMuZG9rYSA9IGNyZWF0ZShpbm5lciwge1xuICAgICAgICAvLyBzb3VyY2UgZnJvbSBzbG90XG4gICAgICAgIHNyYzogdGhpcy5zcmMsXG5cbiAgICAgICAgLy8gb3VyIG9wdGlvbnNcbiAgICAgICAgLi4udGhpcy5vcHRpb25zLFxuXG4gICAgICAgIC8vIGFsd2F5cyBwcmV2aWV3IG1vZGVcbiAgICAgICAgc3R5bGVMYXlvdXRNb2RlOiAncHJldmlldycsXG4gICAgICAgIG91dHB1dERhdGE6IHRydWVcbiAgICAgIH0pO1xuXG4gICAgfSk7XG5cbiAgICAvLyByb3V0ZSBldmVudHNcbiAgICBjb25zdCBkb2thUm9vdDpIVE1MRWxlbWVudCA9IHRoaXMuZG9rYS5lbGVtZW50O1xuICAgIG91dHB1dHMuZm9yRWFjaChldmVudCA9PiBkb2thUm9vdC5hZGRFdmVudExpc3RlbmVyKGBEb2thOiR7ZXZlbnQuc3Vic3RyKDIpfWAsIHRoaXMuaGFuZGxlRXZlbnQpKTtcblxuICAgIC8vIENvcHkgaW5zdGFuY2UgbWV0aG9kIHJlZmVyZW5jZXMgdG8gY29tcG9uZW50IGluc3RhbmNlXG4gICAgT2JqZWN0LmtleXModGhpcy5kb2thKVxuXG4gICAgICAvLyByZW1vdmUgdW53YW50ZWQgbWV0aG9kc1xuICAgICAgLmZpbHRlcihrZXkgPT4gZmlsdGVyZWRDb21wb25lbnRNZXRob2RzLmluZGV4T2Yoa2V5KSA9PT0gLTEpXG4gICAgICBcbiAgICAgIC8vIHNldCBtZXRob2QgcmVmZXJlbmNlcyBmcm9tIHRoZSBjb21wb25lbnQgaW5zdGFuY2UgdG8gdGhlIGRva2EgaW5zdGFuY2VcbiAgICAgIC5mb3JFYWNoKGtleSA9PiB0aGlzW2tleV0gPSB0aGlzLmRva2Fba2V5XSk7XG4gIH1cblxuICBoaWRlKCkge1xuXG4gICAgLy8gbm8gZG9rYSBpbnN0YW5jZSBhdmFpbGFibGVcbiAgICBpZiAoIXRoaXMuZG9rYSkgcmV0dXJuO1xuXG4gICAgLy8gZGV0YWNoIGV2ZW50c1xuICAgIGNvbnN0IGRva2FSb290OkhUTUxFbGVtZW50ID0gdGhpcy5kb2thLmVsZW1lbnQ7XG4gICAgb3V0cHV0cy5mb3JFYWNoKGV2ZW50ID0+IGRva2FSb290LnJlbW92ZUV2ZW50TGlzdGVuZXIoYERva2E6JHtldmVudC5zdWJzdHIoMil9YCwgdGhpcy5oYW5kbGVFdmVudCkpO1xuXG4gICAgLy8gd2UgZG9uZSFcbiAgICB0aGlzLmRva2EuZGVzdHJveSgpO1xuICAgIHRoaXMuZG9rYSA9IG51bGw7XG4gIH1cblxuICB1cGRhdGUoY2hhbmdlcz86IFNpbXBsZUNoYW5nZXMpIHtcbiAgICBpZiAodGhpcy5lbmFibGVkKSB7XG4gICAgICAgIHRoaXMuc2hvdyhjaGFuZ2VzKTtcbiAgICB9XG4gICAgZWxzZSB7XG4gICAgICAgIHRoaXMuaGlkZSgpO1xuICAgIH1cbiAgfVxuXG59XG4iXX0=