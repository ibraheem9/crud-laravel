import { ElementRef, EventEmitter, NgZone, OnInit, SimpleChanges } from '@angular/core';
import { IDokaOptions } from '../lib/doka';
import * as i0 from "@angular/core";
export declare class AngularDokaComponent implements OnInit {
    private root;
    private zone;
    private doka;
    private handleEvent;
    src: string | File | Blob;
    options: IDokaOptions;
    oninit: EventEmitter<any>;
    onconfirm: EventEmitter<any>;
    oncancel: EventEmitter<any>;
    onclose: EventEmitter<any>;
    onload: EventEmitter<any>;
    onloaderror: EventEmitter<any>;
    ondestroy: EventEmitter<any>;
    onupdate: EventEmitter<any>;
    constructor(root: ElementRef, zone: NgZone);
    ngOnInit(): void;
    ngAfterViewInit(): void;
    ngOnChanges(changes: SimpleChanges): void;
    ngOnDestroy(): void;
    static ɵfac: i0.ɵɵFactoryDef<AngularDokaComponent, never>;
    static ɵcmp: i0.ɵɵComponentDefWithMeta<AngularDokaComponent, "lib-doka", never, { "src": "src"; "options": "options"; }, { "oninit": "oninit"; "onconfirm": "onconfirm"; "oncancel": "oncancel"; "onclose": "onclose"; "onload": "onload"; "onloaderror": "onloaderror"; "ondestroy": "ondestroy"; "onupdate": "onupdate"; }, never, ["*"]>;
}
