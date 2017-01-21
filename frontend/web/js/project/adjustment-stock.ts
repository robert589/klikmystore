import {Component} from '../common/component';
import {AdjustmentStockForm} from './adjustment-stock-form';

export class AdjustmentStock extends Component{

    form : AdjustmentStockForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new AdjustmentStockForm(document.getElementById(this.id + "-form"));
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
