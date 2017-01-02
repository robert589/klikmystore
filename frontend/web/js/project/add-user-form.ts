import {Form} from '../common/form';
import {InputField} from './../common/input-field';
import {TextAreaField} from './../common/text-area-field';

export class AddUserForm extends Form{

    public static get SUCCESSFULLY_ADDED() {return  "AU_FORM_SUCCESSFULLY_ADDED"};
    firstNameField  :  InputField;

    lastNameField : InputField;

    telpField : InputField;

    addrField : TextAreaField;

    successfullyAddedEvent : CustomEvent;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb   = function(data) {
            this.root.dispatchEvent(this.successfullyAddedEvent);
        }.bind(this);
    }
    
    rules() {
        this.setRequiredField([this.firstNameField]);
        this.registerFields([this.firstNameField, this.lastNameField, this.telpField, this.addrField]);
    }

    decorate() {
        super.decorate();
        this.firstNameField = new InputField(document.getElementById(this.id + "-first-name"));
        this.lastNameField = new InputField(document.getElementById(this.id + "-last-name"));
        this.telpField = new InputField(document.getElementById(this.id + "-telephone"));
        this.addrField = new TextAreaField(document.getElementById(this.id + "-address"));
    }
    
    bindEvent() {
        super.bindEvent();
        this.successfullyAddedEvent = new CustomEvent(AddUserForm.SUCCESSFULLY_ADDED);
   }
    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
