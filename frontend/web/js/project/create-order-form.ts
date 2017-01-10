import {Form} from '../common/form';
import {Button} from './../common/button';
import {SearchField} from './../common/search-field';
import {ProductOrderField} from './product-order-field';
import {CheckboxField} from './../common/checkbox-field';

export class CreateOrderForm extends Form{

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

    offlineOrderField : CheckboxField;
    
    dropshipField : CheckboxField;

    districtField : SearchField;

    totalPriceElement : HTMLElement;

    totalWeightElement : HTMLElement;

    totalQuantityElement : HTMLElement;

    constructor(root: HTMLElement) {
        super(root);
    }

    rules() {

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
        this.totalPriceElement = <HTMLElement> this.root.getElementsByClassName('co-form-price')[0];
        this.totalQuantityElement = <HTMLElement> this.root.getElementsByClassName('co-form-quantity')[0];
        this.totalWeightElement = <HTMLElement> this.root.getElementsByClassName('co-form-weight')[0];
        this.offlineOrderField = new CheckboxField(document.getElementById(this.id + "-offline-order"));
        this.dropshipField = new CheckboxField(document.getElementById(this.id + "-dropship"));
    }

    triggerUserFormEvent(e) {
        e.preventDefault();
        this.root.dispatchEvent(this.userFormEvent);
    }
    
    bindEvent() {
        super.bindEvent();
        this.userFormEvent = new CustomEvent(CreateOrderForm.TRIGGER_USER_FORM_EVENT);
        this.courierField.attachEvent(SearchField.GET_VALUE_EVENT, this.enableCityField.bind(this));
        this.courierField.attachEvent(SearchField.LOSE_VALUE_EVENT, this.disableCityField.bind(this));
        this.cityField.attachEvent(SearchField.GET_VALUE_EVENT, this.enableDistrictField.bind(this));
        this.cityField.attachEvent(SearchField.LOSE_VALUE_EVENT, this.disableDistrictField.bind(this));
        this.productOrderField.attachEvent(ProductOrderField.NEW_PRODUCT_ADDED, this.updateLabel.bind(this));
        
    }

    setTotalPrice(price : number) {
        this.totalPriceElement.innerHTML = "" + price;
    }

    setTotalQuantity(quantity : number) {
        this.totalQuantityElement.innerHTML = "" + quantity;
    }

    setTotalWeight(weight : number) {
        this.totalWeightElement.innerHTML = "" + weight;
    }
 
    updateLabel() {
        this.setTotalQuantity(this.productOrderField.getTotalQuantity());
        this.setTotalWeight(this.productOrderField.getTotalWeight());
        this.setTotalPrice(this.productOrderField.getTotalPrice());
    }

    enableCityField() {
        this.cityField.enable();
        let data = [];
        data['courier_code'] = this.courierField.getValue();
        this.cityField.setAdditionalData(data);
    }

    disableCityField() {
        this.cityField.disable();
        this.cityField.resetValue();
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
