import {Component} from '../common/component';
import {CreateOrderForm} from './create-order-form';
import {AddUserFormModal} from './add-user-form-modal';

export class CreateOrder extends Component{
    form  :CreateOrderForm;

    addUserFormModal : AddUserFormModal;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.form = new CreateOrderForm(document.getElementById(this.id + "-form"));
        this.addUserFormModal = new AddUserFormModal(
                                    document.getElementById(this.id + "-usermodal"));
    }
    
    bindEvent() {
        super.bindEvent();
        this.form.attachEvent(
            CreateOrderForm.TRIGGER_USER_FORM_EVENT, this.showAddUserFormModal.bind(this));
   }

    showAddUserFormModal() {
        this.addUserFormModal.show();
    }
    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
