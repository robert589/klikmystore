import {Component} from '../common/component';
import {Button} from './../common/button';
import {SearchField} from './../common/search-field';
import {ProductOrderField} from './product-order-field';

export class CreateOrderForm extends Component{

    public static get TRIGGER_USER_FORM_EVENT() {return "CO_FORM_TRIGGER_USER_FORM_EVENT"};

    public static get OLD_INDEX() {return 0;}
    public static get NEW_INDEX() {return 1;}

    addUserBtn : Button;

    userFormEvent  : CustomEvent;

    senderField : SearchField;

    receiverField : SearchField;

    productOrderField : ProductOrderField;

    marketplaceField : SearchField;

    courierField : SearchField;

    cityField : SearchField;

    districtField : SearchField;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.addUserBtn = new Button(document.getElementById(this.id + "-add-user-1"), 
                        this.triggerUserFormEvent.bind(this));
        this.receiverField = new SearchField(document.getElementById(this.id + "-receiver-field"));
        this.senderField = new SearchField(document.getElementById(this.id + "-sender-field"));
        this.productOrderField = new ProductOrderField(document.getElementById(this.id + "-po-field"));
        this.marketplaceField = new SearchField(document.getElementById(this.id + "-marketplace"));
        this.courierField = new SearchField(document.getElementById(this.id + "-courier"));
        this.cityField = new SearchField(document.getElementById(this.id + "-city"));
        this.districtField = new SearchField(document.getElementById(this.id + "-district"));
    }

    triggerUserFormEvent(e) {
        e.preventDefault();
        this.root.dispatchEvent(this.userFormEvent);
    }
    
    bindEvent() {
        super.bindEvent();
        this.userFormEvent = new CustomEvent(CreateOrderForm.TRIGGER_USER_FORM_EVENT);
        this.cityField.attachEvent(SearchField.GET_VALUE_EVENT, this.enableDistrictField.bind(this));
        this.cityField.attachEvent(SearchField.LOSE_VALUE_EVENT, this.disableDistrictField.bind(this));
    }

    disableDistrictField() {
        this.districtField.disable();
        this.districtField.resetValue();
    }

    enableDistrictField() {
        this.districtField.enable();
        let data = [];
        data['city_id'] = this.cityField.getValue();
        this.districtField.setAdditionalData(data);
    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
