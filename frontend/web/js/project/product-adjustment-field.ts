import {Field} from '../common/field';
import {SearchField} from '../common/search-field';
import {Button} from '../common/button';
export class ProductAdjustmentField extends Field{

    searchProduct : SearchField;

    addBtn : Button;

    list : HTMLElement;

    getValue() {
        return null;
    }

    constructor(root: HTMLElement) {
        super(root);
        this.searchProduct = new SearchField(document.getElementById(this.id + "-product"));
        this.addBtn = new Button(document.getElementById(this.id + "-add"), this.addNew.bind(this));
        this.list = <HTMLElement> this.root.getElementsByClassName('pa-field-list')[0];
    }


    addNew() {

    }
    
    decorate() {
        super.decorate();
        
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
