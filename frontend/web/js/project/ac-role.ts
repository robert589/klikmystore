import {Component} from '../common/component';
import {CreateRoleForm} from './create-role-form';

export class AcRole extends Component{

    form : CreateRoleForm;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new CreateRoleForm(document.getElementById(this.id + "-create"));
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
