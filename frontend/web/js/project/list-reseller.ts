import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class ListReseller extends Component{

    addBtn : Button;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.redirectToAdd.bind(this));    
    }

    redirectToAdd() {
        window.location.href = System.getBaseUrl() + "/reseller/add";
    }
    
    bindEvent() {
        super.bindEvent();
    }


    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
