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
export class AngularDokaModalComponent {
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
AngularDokaModalComponent.ɵfac = function AngularDokaModalComponent_Factory(t) { return new (t || AngularDokaModalComponent)(i0.ɵɵdirectiveInject(i0.ElementRef), i0.ɵɵdirectiveInject(i0.NgZone)); };
AngularDokaModalComponent.ɵcmp = i0.ɵɵdefineComponent({ type: AngularDokaModalComponent, selectors: [["lib-doka-modal"]], inputs: { src: "src", options: "options" }, outputs: { oninit: "oninit", onconfirm: "onconfirm", oncancel: "oncancel", onclose: "onclose", onload: "onload", onloaderror: "onloaderror", ondestroy: "ondestroy", onupdate: "onupdate" }, features: [i0.ɵɵNgOnChangesFeature], ngContentSelectors: _c0, decls: 1, vars: 0, template: function AngularDokaModalComponent_Template(rf, ctx) { if (rf & 1) {
        i0.ɵɵprojectionDef();
        i0.ɵɵprojection(0);
    } }, styles: ["[_nghost-%COMP%] {\n      display: block;\n    }"] });
/*@__PURE__*/ (function () { i0.ɵsetClassMetadata(AngularDokaModalComponent, [{
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
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYW5ndWxhci1kb2thLW1vZGFsLmNvbXBvbmVudC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzIjpbIi4uLy4uLy4uLy4uLy4uL3NyYy9hbmd1bGFyL3Byb2plY3RzL2FuZ3VsYXItZG9rYS9zcmMvbGliL2Rva2EtbW9kYWwvYW5ndWxhci1kb2thLW1vZGFsLmNvbXBvbmVudC50cyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSxPQUFPLEVBQUUsU0FBUyxFQUFjLFlBQVksRUFBa0IsS0FBSyxFQUFFLE1BQU0sRUFBaUIsTUFBTSxlQUFlLENBQUM7QUFDbEgsT0FBTyxFQUFFLE1BQU0sRUFBRSxTQUFTLEVBQUUsTUFBTSxRQUFRLENBQUM7OztBQUczQyxxREFBcUQ7QUFDckQsTUFBTSxXQUFXLEdBQUcsU0FBUyxFQUFFLENBQUM7QUFFaEMsOENBQThDO0FBQzlDLE1BQU0sd0JBQXdCLEdBQWtCO0lBQzlDLFlBQVk7SUFDWixJQUFJO0lBQ0osS0FBSztJQUNMLFFBQVE7SUFDUixVQUFVO0lBQ1YsYUFBYTtJQUNiLGNBQWM7SUFDZCxjQUFjO0lBQ2QsZ0JBQWdCO0lBQ2hCLGdCQUFnQjtJQUNoQixTQUFTO0NBQ1YsQ0FBQztBQUVGLE1BQU0sT0FBTyxHQUFrQjtJQUM3QixRQUFRO0lBQ1IsV0FBVztJQUNYLFVBQVU7SUFDVixTQUFTO0lBQ1QsUUFBUTtJQUNSLGFBQWE7SUFDYixXQUFXO0lBQ1gsVUFBVTtDQUNYLENBQUM7QUFjRixNQUFNLE9BQU8seUJBQXlCO0lBd0JwQyxZQUFZLElBQWdCLEVBQUUsSUFBWTtRQW5CbEMsZ0JBQVcsR0FBd0IsQ0FBQyxDQUFhLEVBQUUsRUFBRTtZQUMzRCxNQUFNLE1BQU0sR0FBRyxJQUFJLENBQUMsS0FBSyxDQUFDLENBQUMsSUFBSSxDQUFDLEtBQUssQ0FBQyxHQUFHLENBQUMsQ0FBQyxDQUFDLENBQUMsRUFBRSxDQUFDLENBQUM7WUFDakQsTUFBTSxLQUFLLHFCQUFPLENBQUMsQ0FBQyxNQUFNLENBQUMsQ0FBQztZ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QUFrQjtRQUNsQixJQUFJLENBQUMsSUFBSSxDQUFDLFVBQVUsQ0FBQyxPQUFPLENBQUMsQ0FBQztJQUNoQyxDQUFDO0lBRUQsV0FBVztRQUNULDZCQUE2QjtRQUM3QixJQUFJLENBQUMsSUFBSSxDQUFDLElBQUk7WUFBRSxPQUFPO1FBRXZCLGdCQUFnQjtRQUNoQixNQUFNLFFBQVEsR0FBZSxJQUFJLENBQUMsSUFBSSxDQUFDLE9BQU8sQ0FBQztRQUMvQyxPQUFPLENBQUMsT0FBTyxDQUFDLEtBQUssQ0FBQyxFQUFFLENBQUMsUUFBUSxDQUFDLG1CQUFtQixDQUFDLFFBQVEsS0FBSyxDQUFDLE1BQU0sQ0FBQyxDQUFDLENBQUMsRUFBRSxFQUFFLElBQUksQ0FBQyxXQUFXLENBQUMsQ0FBQyxDQUFDO1FBRXBHLFdBQVc7UUFDWCxJQUFJLENBQUMsSUFBSSxDQUFDLE9BQU8sRUFBRSxDQUFDO1FBQ3BCLElBQUksQ0FBQyxJQUFJLEdBQUcsSUFBSSxDQUFDO0lBQ25CLENBQUM7O2tHQWxHVSx5QkFBeUI7OERBQXpCLHlCQUF5Qjs7UUFUbEMsa0JBQVk7O2tEQVNILHlCQUF5QjtjQVpyQyxTQUFTO2VBQUM7Z0JBQ1QsUUFBUSxFQUFFLGdCQUFnQjtnQkFDMUIsUUFBUSxFQUFFOztHQUVUO2dCQUNELE1BQU0sRUFBRSxDQUFDOzs7O0dBSVIsQ0FBQzthQUNIOztrQkFjRSxLQUFLOztrQkFDTCxLQUFLOztrQkFFTCxNQUFNOztrQkFDTixNQUFNOztrQkFDTixNQUFNOztrQkFDTixNQUFNOztrQkFDTixNQUFNOztrQkFDTixNQUFNOztrQkFDTixNQUFNOztrQkFDTixNQUFNIiwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IHsgQ29tcG9uZW50LCBFbGVtZW50UmVmLCBFdmVudEVtaXR0ZXIsIE5nWm9uZSwgT25Jbml0LCBJbnB1dCwgT3V0cHV0LCBTaW1wbGVDaGFuZ2VzIH0gZnJvbSAnQGFuZ3VsYXIvY29yZSc7XG5pbXBvcnQgeyBjcmVhdGUsIHN1cHBvcnRlZCB9IGZyb20gJy4uL2xpYic7XG5pbXBvcnQgeyBJRG9rYUluc3RhbmNlLCBJRG9rYU9wdGlvbnMgfSBmcm9tICcuLi9saWIvZG9rYSc7XG5cbi8vIFdlIHRlc3QgaWYgRG9rYSBpcyBzdXBwb3J0ZWQgb24gdGhlIGN1cnJlbnQgY2xpZW50XG5jb25zdCBpc1N1cHBvcnRlZCA9IHN1cHBvcnRlZCgpO1xuXG4vLyBNZXRob2RzIG5vdCBtYWRlIGF2YWlsYWJsZSBvbiB0aGUgY29tcG9uZW50XG5jb25zdCBmaWx0ZXJlZENvbXBvbmVudE1ldGhvZHM6IEFycmF5PHN0cmluZz4gPSBbXG4gICdzZXRPcHRpb25zJyxcbiAgJ29uJyxcbiAgJ29mZicsXG4gICdvbk9uY2UnLFxuICAnYXBwZW5kVG8nLFxuICAnaW5zZXJ0QWZ0ZXInLFxuICAnaW5zZXJ0QmVmb3JlJyxcbiAgJ2lzQXR0YWNoZWRUbycsXG4gICdyZXBsYWNlRWxlbWVudCcsXG4gICdyZXN0b3JlRWxlbWVudCcsXG4gICdkZXN0cm95J1xuXTtcblxuY29uc3Qgb3V0cHV0czogQXJyYXk8c3RyaW5nPiA9IFtcbiAgJ29uaW5pdCcsIFxuICAnb25jb25maXJtJywgXG4gICdvbmNhbmNlbCcsIFxuICAnb25jbG9zZScsXG4gICdvbmxvYWQnLCBcbiAgJ29ubG9hZGVycm9yJywgXG4gICdvbmRlc3Ryb3knLCBcbiAgJ29udXBkYXRlJ1xuXTtcblxuQENvbXBvbmVudCh7XG4gIHNlbGVjdG9yOiAnbGliLWRva2EtbW9kYWwnLFxuICB0ZW1wbGF0ZTogYFxuICAgIDxuZy1jb250ZW50PjwvbmctY29udGVudD5cbiAgYCxcbiAgc3R5bGVzOiBbYFxuICAgIDpob3N0IHtcbiAgICAgIGRpc3BsYXk6IGJsb2NrO1xuICAgIH1cbiAgYF1cbn0pXG5cbmV4cG9ydCBjbGFzcyBBbmd1bGFyRG9rYU1vZGFsQ29tcG9uZW50IGltcGxlbWVudHMgT25Jbml0IHtcblxuICBwcml2YXRlIHJvb3Q6IEVsZW1lbnRSZWY7XG4gIHByaXZhdGUgem9uZTogTmdab25lO1xuICBwcml2YXRlIGRva2E6IElEb2thSW5zdGFuY2U7XG4gIHByaXZhdGUgaGFuZGxlRXZlbnQ6IEV2ZW50SGFuZGxlck5vbk51bGwgPSAoZTpDdXN0b21FdmVudCkgPT4ge1xuICAgIGNvbnN0IG91dHB1dCA9IHRoaXNbYG9uJHtlLnR5cGUuc3BsaXQoJzonKVsxXX1gXTtcbiAgICBjb25zdCBldmVudCA9IHsuLi5lLmRldGFpbH07XG4gICAgZGVsZXRlIGV2ZW50LmRva2E7XG4gICAgb3V0cHV0LmVtaXQoZXZlbnQpO1xuICB9O1xuXG4gIEBJbnB1dCgpIHNyYzogc3RyaW5nfEZpbGV8QmxvYiA9IG51bGw7XG4gIEBJbnB1dCgpIG9wdGlvbnM6IElEb2thT3B0aW9ucyA9IHt9O1xuXG4gIEBPdXRwdXQoKSBvbmluaXQ6IEV2ZW50RW1pdHRlcjxhbnk+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgb25jb25maXJtOiBFdmVudEVtaXR0ZXI8YW55PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIG9uY2FuY2VsOiBFdmVudEVtaXR0ZXI8YW55PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIG9uY2xvc2U6IEV2ZW50RW1pdHRlcjxhbnk+ID0gbmV3IEV2ZW50RW1pdHRlcigpO1xuICBAT3V0cHV0KCkgb25sb2FkOiBFdmVudEVtaXR0ZXI8YW55PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIG9ubG9hZGVycm9yOiBFdmVudEVtaXR0ZXI8YW55PiA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcbiAgQE91dHB1dCgpIG9uZGVzdHJveTogRXZlbnRFbWl0dGVyPGFueT4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG4gIEBPdXRwdXQoKSBvbnVwZGF0ZTogRXZlbnRFbWl0dGVyPGFueT4gPSBuZXcgRXZlbnRFbWl0dGVyKCk7XG5cbiAgY29uc3RydWN0b3Iocm9vdDogRWxlbWVudFJlZiwgem9uZTogTmdab25lKSB7XG4gICAgdGhpcy5yb290ID0gcm9vdDtcbiAgICB0aGlzLnpvbmUgPSB6b25lO1xuICB9XG4gIFxuICBuZ09uSW5pdCgpIHt9XG5cbiAgbmdBZnRlclZpZXdJbml0KCkge1xuXG4gICAgLy8gbm8gc3VmZmljaWVudCBmZWF0dXJlcyBzdXBwb3J0ZWQgaW4gdGhpcyBicm93c2VyXG4gICAgaWYgKCFpc1N1cHBvcnRlZCkgcmV0dXJuO1xuXG4gICAgLy8gd2lsbCBibG9jayBhbmd1bGFyIGZyb20gbGlzdGVuaW5nIHRvIGV2ZW50cyBpbnNpZGUgZG9rYVxuICAgIHRoaXMuem9uZS5ydW5PdXRzaWRlQW5ndWxhcigoKSA9PiB7XG5cbiAgICAgIC8vIGdldCBob3N0IGNoaWxkIDxkaXY+XG4gICAgICBjb25zdCBpbm5lciA9IHRoaXMucm9vdC5uYXRpdmVFbGVtZW50O1xuXG4gICAgICAvLyBpZiBpbWFnZSBvciBjYW52YXMgc3VwcGxpZWRcbiAgICAgIGNvbnN0IHNyYyA9IGlubmVyLnF1ZXJ5U2VsZWN0b3IoJ2ltZycpIHx8IGlubmVyLnF1ZXJ5U2VsZWN0b3IoJ2NhbnZhcycpIHx8IHRoaXMuc3JjO1xuICAgICAgXG4gICAgICAvLyBjcmVhdGUgaW5zdGFuY2VcbiAgICAgIHRoaXMuZG9rYSA9IGNyZWF0ZSh7XG4gICAgICAgIC8vIHNvdXJjZSBmcm9tIHNsb3RcbiAgICAgICAgc3JjLFxuXG4gICAgICAgIC8vIG91ciBvcHRpb25zXG4gICAgICAgIC4uLnRoaXMub3B0aW9uc1xuICAgICAgfSk7XG5cbiAgICB9KTtcblxuICAgIC8vIHJvdXRlIGV2ZW50c1xuICAgIGNvbnN0IGRva2FSb290OkhUTUxFbGVtZW50ID0gdGhpcy5kb2thLmVsZW1lbnQ7XG4gICAgb3V0cHV0cy5mb3JFYWNoKGV2ZW50ID0+IGRva2FSb290LmFkZEV2ZW50TGlzdGVuZXIoYERva2E6JHtldmVudC5zdWJzdHIoMil9YCwgdGhpcy5oYW5kbGVFdmVudCkpO1xuXG4gICAgLy8gQ29weSBpbnN0YW5jZSBtZXRob2QgcmVmZXJlbmNlcyB0byBjb21wb25lbnQgaW5zdGFuY2VcbiAgICBPYmplY3Qua2V5cyh0aGlzLmRva2EpXG5cbiAgICAgIC8vIHJlbW92ZSB1bndhbnRlZCBtZXRob2RzXG4gICAgICAuZmlsdGVyKGtleSA9PiBmaWx0ZXJlZENvbXBvbmVudE1ldGhvZHMuaW5kZXhPZihrZXkpID09PSAtMSlcbiAgICAgIFxuICAgICAgLy8gc2V0IG1ldGhvZCByZWZlcmVuY2VzIGZyb20gdGhlIGNvbXBvbmVudCBpbnN0YW5jZSB0byB0aGUgZG9rYSBpbnN0YW5jZVxuICAgICAgLmZvckVhY2goa2V5ID0+IHRoaXNba2V5XSA9IHRoaXMuZG9rYVtrZXldKTtcbiAgfVxuXG4gIG5nT25DaGFuZ2VzKGNoYW5nZXM6IFNpbXBsZUNoYW5nZXMpIHtcbiAgICAvLyBubyBuZWVkIHRvIGhhbmRsZSBmaXJzdCBjaGFuZ2VcbiAgICBpZiAoY2hhbmdlcy5maXJzdENoYW5nZSkgcmV0dXJuO1xuXG4gICAgLy8gbm8gZG9rYSBpbnN0YW5jZSBhdmFpbGFibGVcbiAgICBpZiAoIXRoaXMuZG9rYSkgcmV0dXJuO1xuXG4gICAgLy8gdXNlIG5ldyBvcHRpb25zIG9iamVjdCBhcyBiYXNlICggb3IgaWYgbm90IGF2YWlsYWJsZSwgdXNlIGN1cnJlbnQgb3B0aW9ucyApXG4gICAgY29uc3Qgb3B0aW9ucyA9IGNoYW5nZXMub3B0aW9ucyA/IGNoYW5nZXMub3B0aW9ucy5jdXJyZW50VmFsdWUgOiB0aGlzLm9wdGlvbnM7XG4gICAgXG4gICAgLy8gdXBkYXRlIHNvdXJjZVxuICAgIGlmIChjaGFuZ2VzLnNyYykgb3B0aW9ucy5zcmMgPSBjaGFuZ2VzLnNyYy5jdXJyZW50VmFsdWU7XG5cbiAgICAvLyBzZXQgbmV3IG9wdGlvbnNcbiAgICB0aGlzLmRva2Euc2V0T3B0aW9ucyhvcHRpb25zKTtcbiAgfVxuXG4gIG5nT25EZXN0cm95KCkge1xuICAgIC8vIG5vIGRva2EgaW5zdGFuY2UgYXZhaWxhYmxlXG4gICAgaWYgKCF0aGlzLmRva2EpIHJldHVybjtcblxuICAgIC8vIGRldGFjaCBldmVudHNcbiAgICBjb25zdCBkb2thUm9vdDpIVE1MRWxlbWVudCA9IHRoaXMuZG9rYS5lbGVtZW50O1xuICAgIG91dHB1dHMuZm9yRWFjaChldmVudCA9PiBkb2thUm9vdC5yZW1vdmVFdmVudExpc3RlbmVyKGBEb2thOiR7ZXZlbnQuc3Vic3RyKDIpfWAsIHRoaXMuaGFuZGxlRXZlbnQpKTtcblxuICAgIC8vIHdlIGRvbmUhXG4gICAgdGhpcy5kb2thLmRlc3Ryb3koKTtcbiAgICB0aGlzLmRva2EgPSBudWxsO1xuICB9XG5cbn0iXX0=