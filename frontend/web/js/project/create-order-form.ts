import {Component} from '../common/component';
import {Button} from './../common/button';
import {SearchField} from './../common/search-field';

export class CreateOrderForm extends Component{

    public static get TRIGGER_USER_FORM_EVENT() {return "CO_FORM_TRIGGER_USER_FORM_EVENT"};

    public static get OLD_INDEX() {return 0;}
    public static get NEW_INDEX() {return 1;}

    addUserBtn : Button;

    userFormEvent  : CustomEvent;

    senderField : SearchField;

    receiverField : SearchField;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.addUserBtn = new Button(document.getElementById(this.id + "-add-user-1"), 
                        this.triggerUserFormEvent.bind(this));
        this.receiverField = new SearchField(document.getElementById(this.id + "-receiver-field"));
        this.senderField = new SearchField(document.getElementById(this.id + "-sender-field"))
    }

    triggerUserFormEvent(e) {
        e.preventDefault();
        this.root.dispatchEvent(this.userFormEvent);
    }
    
    bindEvent() {
        super.bindEvent();
        this.userFormEvent = new CustomEvent(CreateOrderForm.TRIGGER_USER_FORM_EVENT);
    }
    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
