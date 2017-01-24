import {Component} from '../common/component';
import {RestockListLVI} from './restock-list-lvi';
import {Button} from './../common/button';
import {System} from './../common/system';

export class RestockList extends Component{

    items : RestockListLVI[];

    addRestockRedirect : Button;
    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.items = [];
        this.addRestockRedirect = new Button(document.getElementById(this.id + "-add"),
                                this.redirectToAddRestock.bind(this));
    }

    redirectToAddRestock() {
        window.location.href = System.getBaseUrl() + "/inventory/restock"; 
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
