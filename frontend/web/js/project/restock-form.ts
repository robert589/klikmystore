import {Component} from '../common/component';
import {InputField} from './../common/input-field';
import {ProductOrderField} from './product-order-field';

export class RestockForm extends Component{

    supplierField : InputField;

    productOrderField : ProductOrderField;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.supplierField = new InputField(document.getElementById(this.id + "-supplier"));
        this.productOrderField = new ProductOrderField(document.getElementById(this.id + "-po-field"));
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
