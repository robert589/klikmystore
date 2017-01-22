import {Form} from '../common/form';
import {ProductAdjustmentField} from './product-adjustment-field';
import {TextAreaField} from './../common/text-area-field';
import {System} from '../common/system';

export class AdjustmentStockForm extends Form{

    paField : ProductAdjustmentField;

    remarkField : TextAreaField;

    rules() {
        this.setRequiredField([this.remarkField, this.paField]);
        this.registerFields([this.paField, this.remarkField]);
    }

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.href = System.getBaseUrl() + "/inventory/list";
        }
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
