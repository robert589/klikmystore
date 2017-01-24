import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class CourierList extends Component{

    addCourier : Button;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    redirectToAddCourier() {
        window.location.href = System.getBaseUrl() + "/order/create-courier";
    }

    decorate() {
        super.decorate();
        this.addCourier = new Button(document.getElementById(this.id + "-add"), 
                        this.redirectToAddCourier.bind(this));    
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
