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
export class AngularDokaComponent {
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
AngularDokaComponent.ɵfac = function AngularDokaComponent_Factory(t) { return new (t || AngularDokaComponent)(i0.ɵɵdirectiveInject(i0.ElementRef), i0.ɵɵdirectiveInject(i0.NgZone)); };
AngularDokaComponent.ɵcmp = i0.ɵɵdefineComponent({ type: AngularDokaComponent, selectors: [["lib-doka"]], inputs: { src: "src", options: "options" }, outputs: { oninit: "oninit", onconfirm: "onconfirm", oncancel: "oncancel", onclose: "onclose", onload: "onload", onloaderror: "onloaderror", ondestroy: "ondestroy", onupdate: "onupdate" }, features: [i0.ɵɵNgOnChangesFeature], ngContentSelectors: _c0, decls: 2, vars: 0, template: function AngularDokaComponent_Template(rf, ctx) { if (rf & 1) {
        i0.ɵɵprojectionDef();
        i0.ɵɵelementStart(0, "div");
        i0.ɵɵprojection(1);
        i0.ɵɵelementEnd();
    } }, styles: ["[_nghost-%COMP%] {\n      display: block;\n    }"] });
/*@__PURE__*/ (function () { i0.ɵsetClassMetadata(AngularDokaComponent, [{
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
    }], function () { return [{ type: i0.ElementRef }, { type: i0.NgZone }]; }, { src: [{
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
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYW5ndWxhci1kb2thLmNvbXBvbmVudC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzIjpbIi4uLy4uLy4uLy4uLy4uL3NyYy9hbmd1bGFyL3Byb2plY3RzL2FuZ3VsYXItZG9rYS9zcmMvbGliL2Rva2EvYW5ndWxhci1kb2thLmNvbXBvbmVudC50cyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSxPQUFPLEVBQUUsU0FBUyxFQUFjLFlBQVksRUFBa0IsS0FBSyxFQUFFLE1BQU0sRUFBaUIsTUFBTSxlQUFlLENBQUM7QUFDbEgsT0FBTyxFQUFFLE1BQU0sRUFBRSxTQUFTLEVBQUUsTUFBTSxRQUFRLENBQUM7OztBQUczQyxxREFBcUQ7QUFDckQsTUFBTSxXQUFXLEdBQUcsU0FBUyxFQUFFLENBQUM7QUFFaEMsOENBQThDO0FBQzlDLE1BQU0sd0JBQXdCLEdBQWtCO0lBQzlDLFlBQVk7SUFDWixJQUFJO0lBQ0osS0FBSztJQUNMLFFBQVE7SUFDUixVQUFVO0lBQ1YsYUFBYTtJQUNiLGNBQWM7SUFDZCxjQUFjO0lBQ2QsZ0JBQWdCO0lBQ2hCLGdCQUFnQjtJQUNoQixTQUFTO0NBQ1YsQ0FBQztBQUVGLE1BQU0sT0FBTyxHQUFrQjtJQUM3QixRQUFRO0lBQ1IsV0FBVztJQUNYLFVBQVU7SUFDVixTQUFTO0lBQ1QsUUFBUTtJQUNSLGFBQWE7SUFDYixXQUFXO0lBQ1gsVUFBVTtDQUNYLENBQUM7QUFnQkYsTUFBTSxPQUFPLG9CQUFvQjtJQXdCL0IsWUFBWSxJQUFnQixFQUFFLElBQVk7UUFuQmxDLGdCQUFXLEdBQXdCLENBQUMsQ0FBYSxFQUFFLEVBQUU7WUFDM0QsTUFBTSxNQUFNLEdBQUcsSUFBSSxDQUFDLEtBQUssQ0FBQyxDQUFDLElBQUksQ0FBQyxLQUFLLENBQUMsR0FBRyxDQUFDLENBQUMsQ0FBQyxDQUFDLEVBQUUsQ0FBQyxDQUFDO1lBQ2pELE1BQU0sS0FBSyxxQkFBTyxDQUFDLENBQUMsTUFBTSxDQUFDLENBQUM7WUFDNUIsT0FBTyxLQUFLLENB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LGtCQUFrQjtRQUNsQixJQUFJLENBQUMsSUFBSSxDQUFDLFVBQVUsQ0FBQyxPQUFPLENBQUMsQ0FBQztJQUNoQyxDQUFDO0lBRUQsV0FBVztRQUNULDZCQUE2QjtRQUM3QixJQUFJLENBQUMsSUFBSSxDQUFDLElBQUk7WUFBRSxPQUFPO1FBRXZCLGdCQUFnQjtRQUNoQixNQUFNLFFBQVEsR0FBZSxJQUFJLENBQUMsSUFBSSxDQUFDLE9BQU8sQ0FBQztRQUMvQyxPQUFPLENBQUMsT0FBTyxDQUFDLEtBQUssQ0FBQyxFQUFFLENBQUMsUUFBUSxDQUFDLG1CQUFtQixDQUFDLFFBQVEsS0FBSyxDQUFDLE1BQU0sQ0FBQyxDQUFDLENBQUMsRUFBRSxFQUFFLElBQUksQ0FBQyxXQUFXLENBQUMsQ0FBQyxDQUFDO1FBRXBHLFdBQVc7UUFDWCxJQUFJLENBQUMsSUFBSSxDQUFDLE9BQU8sRUFBRSxDQUFDO1FBQ3BCLElBQUksQ0FBQyxJQUFJLEdBQUcsSUFBSSxDQUFDO0lBQ25CLENBQUM7O3dGQWxHVSxvQkFBb0I7eURBQXBCLG9CQUFvQjs7UUFYN0IsMkJBQ0U7UUFBQSxrQkFBWTtRQUNkLGlCQUFNOztrREFTRyxvQkFBb0I7Y0FkaEMsU0FBUztlQUFDO2dCQUNULFFBQVEsRUFBRSxVQUFVO2dCQUNwQixRQUFRLEVBQUU7Ozs7R0FJVDtnQkFDRCxNQUFNLEVBQUUsQ0FBQzs7OztHQUlSLENBQUM7YUFDSDs7a0JBY0UsS0FBSzs7a0JBQ0wsS0FBSzs7a0JBRUwsTUFBTTs7a0JBQ04sTUFBTTs7a0JBQ04sTUFBTTs7a0JBQ04sTUFBTTs7a0JBQ04sTUFBTTs7a0JBQ04sTUFBTTs7a0JBQ04sTUFBTTs7a0JBQ04sTUFBTSIsInNvdXJjZXNDb250ZW50IjpbImltcG9ydCB7IENvbXBvbmVudCwgRWxlbWVudFJlZiwgRXZlbnRFbWl0dGVyLCBOZ1pvbmUsIE9uSW5pdCwgSW5wdXQsIE91dHB1dCwgU2ltcGxlQ2hhbmdlcyB9IGZyb20gJ0Bhbmd1bGFyL2NvcmUnO1xuaW1wb3J0IHsgY3JlYXRlLCBzdXBwb3J0ZWQgfSBmcm9tICcuLi9saWInO1xuaW1wb3J0IHsgSURva2FJbnN0YW5jZSwgSURva2FPcHRpb25zIH0gZnJvbSAnLi4vbGliL2Rva2EnO1xuXG4vLyBXZSB0ZXN0IGlmIERva2EgaXMgc3VwcG9ydGVkIG9uIHRoZSBjdXJyZW50IGNsaWVudFxuY29uc3QgaXNTdXBwb3J0ZWQgPSBzdXBwb3J0ZWQoKTtcblxuLy8gTWV0aG9kcyBub3QgbWFkZSBhdmFpbGFibGUgb24gdGhlIGNvbXBvbmVudFxuY29uc3QgZmlsdGVyZWRDb21wb25lbnRNZXRob2RzOiBBcnJheTxzdHJpbmc+ID0gW1xuICAnc2V0T3B0aW9ucycsXG4gICdvbicsXG4gICdvZmYnLFxuICAnb25PbmNlJyxcbiAgJ2FwcGVuZFRvJyxcbiAgJ2luc2VydEFmdGVyJyxcbiAgJ2luc2VydEJlZm9yZScsXG4gICdpc0F0dGFjaGVkVG8nLFxuICAncmVwbGFjZUVsZW1lbnQnLFxuICAncmVzdG9yZUVsZW1lbnQnLFxuICAnZGVzdHJveSdcbl07XG5cbmNvbnN0IG91dHB1dHM6IEFycmF5PHN0cmluZz4gPSBbXG4gICdvbmluaXQnLCBcbiAgJ29uY29uZmlybScsIFxuICAnb25jYW5jZWwnLCBcbiAgJ29uY2xvc2UnLFxuICAnb25sb2FkJywgXG4gICdvbmxvYWRlcnJvcicsIFxuICAnb25kZXN0cm95JywgXG4gICdvbnVwZGF0ZSdcbl07XG5cbkBDb21wb25lbnQoe1xuICBzZWxlY3RvcjogJ2xpYi1kb2thJyxcbiAgdGVtcGxhdGU6IGBcbiAgICA8ZGl2PlxuICAgICAgPG5nLWNvbnRlbnQ+PC9uZy1jb250ZW50PlxuICAgIDwvZGl2PlxuICBgLFxuICBzdHlsZXM6IFtgXG4gICAgOmhvc3Qge1xuICAgICAgZGlzcGxheTogYmxvY2s7XG4gICAgfVxuICBgXVxufSlcblxuZXhwb3J0IGNsYXNzIEFuZ3VsYXJEb2thQ29tcG9uZW50IGltcGxlbWVudHMgT25Jbml0IHtcblxuICBwcml2YXRlIHJvb3Q6IEVsZW1lbnRSZWY7XG4gIHByaXZhdGUgem9uZTogTmdab25lO1xuICBwcml2YXRlIGRva2E6IElEb2thSW5zdGFuY2U7XG4gIHByaXZhdGUgaGFuZGxlRXZlbnQ6IEV2ZW50SGFuZGxlck5vbk51bGwgPSAoZTpDdXN0b21FdmVudCkgPT4ge1xuICAgIGNvbnN0IG91dHB1dCA9IHRoaXNbYG9uJHtlLnR5cGUuc3BsaXQoJzonKVsxXX1gXTtcbiAgICBjb25zdCBldmVudCA9IHsuLi5lLmRldGFpbH07XG4gICAgZGVsZXRlIGV2ZW50LmRva2E7XG4gICAgb3V0cHV0LmVtaXQoZXZlbnQpO1xuICB9O1xuXG4gIEBJbnB1dCgpIHNyYzogc3RyaW5nfEZpbGV8QmxvYiA9IG51bGw7XG4gIEBJbnB1dCgpIG9wdGlvbnM6IElEb2thT3B0aW9ucyA9IHt9O1xuXG4gIEBPdXRwdXQoKSBvbmluaXQ6IEV2ZW50RW1pdHRlcjxhbnk+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgb25jb25maXJtOiBFdmVudEVtaXR0ZXI8YW55PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIG9uY2FuY2VsOiBFdmVudEVtaXR0ZXI8YW55PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIG9uY2xvc2U6IEV2ZW50RW1pdHRlcjxhbnk+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgb25sb2FkOiBFdmVudEVtaXR0ZXI8YW55PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIG9ubG9hZGVycm9yOiBFdmVudEVtaXR0ZXI8YW55PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIG9uZGVzdHJveTogRXZlbnRFbWl0dGVyPGFueT4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBvbnVwZGF0ZTogRXZlbnRFbWl0dGVyPGFueT4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG5cbiAgY29uc3RydWN0b3Iocm9vdDogRWxlbWVudFJlZiwgem9uZTogTmdab25lKSB7XG4gICAgdGhpcy5yb290ID0gcm9vdDtcbiAgICB0aGlzLnpvbmUgPSB6b25lO1xuICB9XG5cbiAgbmdPbkluaXQoKSB7fVxuXG4gIG5nQWZ0ZXJWaWV3SW5pdCgpIHtcblxuICAgIC8vIG5vIHN1ZmZpY2llbnQgZmVhdHVyZXMgc3VwcG9ydGVkIGluIHRoaXMgYnJvd3NlclxuICAgIGlmICghaXNTdXBwb3J0ZWQpIHJldHVybjtcblxuICAgIC8vIHdpbGwgYmxvY2sgYW5ndWxhciBmcm9tIGxpc3RlbmluZyB0byBldmVudHMgaW5zaWRlIGRva2FcbiAgICB0aGlzLnpvbmUucnVuT3V0c2lkZUFuZ3VsYXIoKCkgPT4ge1xuXG4gICAgICAvLyBnZXQgaG9zdCBjaGlsZCA8ZGl2PlxuICAgICAgY29uc3QgaW5uZXIgPSB0aGlzLnJvb3QubmF0aXZlRWxlbWVudC5maXJzdENoaWxkO1xuXG4gICAgICAvLyBpZiBpbWFnZSBvciBjYW52YXMgc3VwcGxpZWRcbiAgICAgIGNvbnN0IHNyYyA9IGlubmVyLnF1ZXJ5U2VsZWN0b3IoJ2ltZycpIHx8IGlubmVyLnF1ZXJ5U2VsZWN0b3IoJ2NhbnZhcycpIHx8IHRoaXMuc3JjO1xuICAgICAgXG4gICAgICAvLyBjcmVhdGUgaW5zdGFuY2VcbiAgICAgIHRoaXMuZG9rYSA9IGNyZWF0ZShpbm5lciwge1xuICAgICAgICAvLyBzb3VyY2UgZnJvbSBzbG90XG4gICAgICAgIHNyYyxcblxuICAgICAgICAvLyBvdXIgb3B0aW9uc1xuICAgICAgICAuLi50aGlzLm9wdGlvbnNcbiAgICAgIH0pO1xuXG4gICAgfSk7XG5cbiAgICAvLyByb3V0ZSBldmVudHNcbiAgICBjb25zdCBkb2thUm9vdDpIVE1MRWxlbWVudCA9IHRoaXMuZG9rYS5lbGVtZW50O1xuICAgIG91dHB1dHMuZm9yRWFjaChldmVudCA9PiBkb2thUm9vdC5hZGRFdmVudExpc3RlbmVyKGBEb2thOiR7ZXZlbnQuc3Vic3RyKDIpfWAsIHRoaXMuaGFuZGxlRXZlbnQpKTtcblxuICAgIC8vIENvcHkgaW5zdGFuY2UgbWV0aG9kIHJlZmVyZW5jZXMgdG8gY29tcG9uZW50IGluc3RhbmNlXG4gICAgT2JqZWN0LmtleXModGhpcy5kb2thKVxuXG4gICAgICAvLyByZW1vdmUgdW53YW50ZWQgbWV0aG9kc1xuICAgICAgLmZpbHRlcihrZXkgPT4gZmlsdGVyZWRDb21wb25lbnRNZXRob2RzLmluZGV4T2Yoa2V5KSA9PT0gLTEpXG4gICAgICBcbiAgICAgIC8vIHNldCBtZXRob2QgcmVmZXJlbmNlcyBmcm9tIHRoZSBjb21wb25lbnQgaW5zdGFuY2UgdG8gdGhlIGRva2EgaW5zdGFuY2VcbiAgICAgIC5mb3JFYWNoKGtleSA9PiB0aGlzW2tleV0gPSB0aGlzLmRva2Fba2V5XSk7XG4gIH1cblxuICBuZ09uQ2hhbmdlcyhjaGFuZ2VzOiBTaW1wbGVDaGFuZ2VzKSB7XG4gICAgLy8gbm8gbmVlZCB0byBoYW5kbGUgZmlyc3QgY2hhbmdlXG4gICAgaWYgKGNoYW5nZXMuZmlyc3RDaGFuZ2UpIHJldHVybjtcblxuICAgIC8vIG5vIGRva2EgaW5zdGFuY2UgYXZhaWxhYmxlXG4gICAgaWYgKCF0aGlzLmRva2EpIHJldHVybjtcblxuICAgIC8vIHVzZSBuZXcgb3B0aW9ucyBvYmplY3QgYXMgYmFzZSAoIG9yIGlmIG5vdCBhdmFpbGFibGUsIHVzZSBjdXJyZW50IG9wdGlvbnMgKVxuICAgIGNvbnN0IG9wdGlvbnMgPSBjaGFuZ2VzLm9wdGlvbnMgPyBjaGFuZ2VzLm9wdGlvbnMuY3VycmVudFZhbHVlIDogdGhpcy5vcHRpb25zO1xuICAgIFxuICAgIC8vIHVwZGF0ZSBzb3VyY2VcbiAgICBpZiAoY2hhbmdlcy5zcmMpIG9wdGlvbnMuc3JjID0gY2hhbmdlcy5zcmMuY3VycmVudFZhbHVlO1xuXG4gICAgLy8gc2V0IG5ldyBvcHRpb25zXG4gICAgdGhpcy5kb2thLnNldE9wdGlvbnMob3B0aW9ucyk7XG4gIH1cblxuICBuZ09uRGVzdHJveSgpIHtcbiAgICAvLyBubyBkb2thIGluc3RhbmNlIGF2YWlsYWJsZVxuICAgIGlmICghdGhpcy5kb2thKSByZXR1cm47XG5cbiAgICAvLyBkZXRhY2ggZXZlbnRzXG4gICAgY29uc3QgZG9rYVJvb3Q6SFRNTEVsZW1lbnQgPSB0aGlzLmRva2EuZWxlbWVudDtcbiAgICBvdXRwdXRzLmZvckVhY2goZXZlbnQgPT4gZG9rYVJvb3QucmVtb3ZlRXZlbnRMaXN0ZW5lcihgRG9rYToke2V2ZW50LnN1YnN0cigyKX1gLCB0aGlzLmhhbmRsZUV2ZW50KSk7XG5cbiAgICAvLyB3ZSBkb25lIVxuICAgIHRoaXMuZG9rYS5kZXN0cm95KCk7XG4gICAgdGhpcy5kb2thID0gbnVsbDtcbiAgfVxuXG59XG4iXX0=