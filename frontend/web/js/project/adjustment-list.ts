import {Component} from '../common/component';

import {AdjustmentListLVI} from './adjustment-list-lvi';
import {Button} from './../common/button';
import {System} from './../common/system';

export class AdjustmentList extends Component{

    redirectToAdd : Button;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    redirectToAddButton() {
        window.location.href = System.getBaseUrl() + "/inventory/adjustment"; 
    }

    decorate() {
        super.decorate();
        this.redirectToAdd = new Button(document.getElementById(this.id + "-add"), 
                    this.redirectToAddButton.bind(this));
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
