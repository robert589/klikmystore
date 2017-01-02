import {Field} from '../common/field';


export class WholesaleField extends Field{

    constructor(root: HTMLElement) {
        super(root);
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

    getValue() {
        let data : Object = {};
        return null;
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
