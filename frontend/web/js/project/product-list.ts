import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class ProductList extends Component{

    addProduct  : Button;

    constructor(root: HTMLElement) {
        super(root);
    }

    redirectToAddProduct() {
        window.location.href = System.getBaseUrl() + "/product/add";
    }
    
    decorate() {
        super.decorate();
        this.addProduct = new Button(document.getElementById(this.id + "-add"), 
                    this.redirectToAddProduct.bind(this));
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
