import {Component} from '../common/component';
import {Modal} from '../common/modal';
import {AddUserForm} from './add-user-form';

export class AddUserFormModal extends Modal{

    form : AddUserForm;

    constructor(root: HTMLElement) {
        super(root);

    }
    
    decorate() {
        super.decorate();   
        this.form = new AddUserForm(document.getElementById(this.id + "-form"));    
    }
    
    bindEvent() {
        super.bindEvent();
        this.form.attachEvent(AddUserForm.SUCCESSFULLY_ADDED, function() {
            this.hide();
        }.bind(this));
   }
    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
