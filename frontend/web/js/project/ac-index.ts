import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class AcIndex extends Component{

    role : Button;

    permission : Button;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.role = new Button(document.getElementById(this.id + "-role"), 
                    this.redirectToRole.bind(this));   
        this.permission = new Button(document.getElementById(this.id + "-permission"),
                    this.redirectToRole.bind(this));
    }

    redirectToRole() {
        window.location.href = System.getBaseUrl() + "/ac/role";
    }

    redirectToPermission() {
        window.location.href = System.getBaseUrl() + "/ac/permission";
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
