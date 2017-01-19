import {Component} from '../common/component';
import {SearchField} from './../common/search-field';
import {ProductOrderField} from './product-order-field';

export class RestockForm extends Component{

    supplierField : SearchField;

    productOrderField : ProductOrderField;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.supplierField = new SearchField(document.getElementById(this.id + "-supplier"));
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
