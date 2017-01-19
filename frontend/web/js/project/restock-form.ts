import {Form} from '../common/form';
import {SearchField} from './../common/search-field';
import {ProductOrderField} from './product-order-field';

export class RestockForm extends Form{

    supplierField : SearchField;

    productOrderField : ProductOrderField;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    rules() {
        this.setRequiredField([this.supplierField]);
        this.registerFields([this.productOrderField, this.supplierField]);
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
