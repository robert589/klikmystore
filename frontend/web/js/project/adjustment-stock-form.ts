import {Form} from '../common/form';
import {ProductAdjustmentField} from './product-adjustment-field';
import {TextAreaField} from './../common/text-area-field';

export class AdjustmentStockForm extends Form{

    paField : ProductAdjustmentField;

    remarkField : TextAreaField;

    rules() {

    }

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.remarkField = new TextAreaField(document.getElementById(this.id + "-remark"));
        this.paField = new ProductAdjustmentField(document.getElementById(this.id + "adjustment"));    
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
