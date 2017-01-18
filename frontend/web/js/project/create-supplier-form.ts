import {Form} from '../common/form';
import {InputField} from '../common/input-field';
import {TextAreaField} from './../common/text-area-field';
import {System} from './../common/system';

export class CreateSupplierForm extends Form{

    companyName : InputField;

    firstName : InputField;

    lastName : InputField;

    email : InputField;

    phone : InputField;

    address : TextAreaField;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.href = System.getBaseUrl() + "/supplier/list";
        }
    }
    
    decorate() {
        super.decorate();
        this.companyName = new InputField(document.getElementById(this.id + "-name"));
        this.firstName = new InputField(document.getElementById(this.id + "-supp-first-name"));
        this.lastName = new InputField(document.getElementById(this.id + "-supp-last-name"));
        this.email = new InputField(document.getElementById(this.id + "-supp-email"));
        this.phone = new InputField(document.getElementById(this.id + "-phone"));
        this.address = new TextAreaField(document.getElementById(this.id + "-address"));
    }

    rules() {
        this.setRequiredField([this.companyName, this.firstName, this.lastName, this.email]);
    
        this.registerFields([this.companyName, this.firstName, 
                    this.lastName, this.email, this.phone, this.address]);
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
