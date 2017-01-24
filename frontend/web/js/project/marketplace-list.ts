import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class MarketplaceList extends Component{
    
    addMp : Button;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        
        this.addMp = new Button(document.getElementById(this.id + "-add"), 
                        this.redirectToAddMp.bind(this));  
    }
    

    redirectToAddMp() {
        window.location.href = System.getBaseUrl() + "/order/create-marketplace";
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
