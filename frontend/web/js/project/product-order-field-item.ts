import {Component} from '../common/component';
import {String} from './../common/string';

export class ProductOrderFieldItem extends Component{

    idElement : HTMLElement;

    nameElement : HTMLElement;

    quantityViewElement : HTMLElement;

    quantity : string;
    constructor(root: HTMLElement) {
        super(root);
        this.quantity = this.root.getAttribute('data-quantity');
    }
    
    decorate() {
        super.decorate();
        this.idElement = <HTMLElement> this.root.getElementsByClassName('pof-item-id')[0];
        this.nameElement = <HTMLElement> this.root.getElementsByClassName('pof-item-name')[0];
    }
    
    bindEvent() {
        super.bindEvent();
   }
    detach() {
        super.detach();
    }
    
    getId() {
        return  String.trim(this.idElement.innerHTML);
    }

    unbindEvent() {
        // no event to unbind
    }
}
