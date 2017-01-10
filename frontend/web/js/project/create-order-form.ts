import {Form} from '../common/form';
import {Button} from './../common/button';
import {SearchField} from './../common/search-field';
import {ProductOrderField} from './product-order-field';
import {CheckboxField} from './../common/checkbox-field';
import {System} from './../common/system';
import {RadioField} from './../common/radio-field';
import {InputField} from './../common/input-field';
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

    paperTypeField : RadioField;

    printInvoiceField : CheckboxField;

    printLabelField : CheckboxField;

    totalPriceElement : HTMLElement;

    totalWeightElement : HTMLElement;

    totalQuantityElement : HTMLElement;

    tariffElement : HTMLElement;

    pickupField : InputField;

    constructor(root: HTMLElement) {
        super(root);
        this.registerFields([this.senderField, this.receiverField, this.productOrderField, this.marketplaceField,
                                this.courierField, this.cityField, this.offlineOrderField, this.dropshipField, this.offlineOrderField,
                                this.districtField, this.paperTypeField]);
        this.setRequiredField([this.senderField, this.receiverField, this.courierField, this.marketplaceField, this.productOrderField, 
                                    this.cityField, this.districtField, this.paperTypeField]);
    }

    rules() {

    }   

    decorate() {
        super.decorate();
        this.addUserBtn = new Button(document.getElementById(this.id + "-add-user-1"), 
                        this.triggerUserFormEvent.bind(this));
        this.receiverField = new SearchField(document.getElementById(this.id + "-receiver-field"));
        this.paperTypeField = new RadioField(document.getElementById(this.id + "-paper-size"));
        this.senderField = new SearchField(document.getElementById(this.id + "-sender-field"));
        this.productOrderField = new ProductOrderField(document.getElementById(this.id + "-po-field"));
        this.marketplaceField = new SearchField(document.getElementById(this.id + "-marketplace"));
        this.courierField = new SearchField(document.getElementById(this.id + "-courier"));
        this.cityField = new SearchField(document.getElementById(this.id + "-city"));
        this.districtField = new SearchField(document.getElementById(this.id + "-district"));
        this.totalPriceElement = <HTMLElement> this.root.getElementsByClassName('co-form-price')[0];
        this.totalQuantityElement = <HTMLElement> this.root.getElementsByClassName('co-form-quantity')[0];
        this.totalWeightElement = <HTMLElement> this.root.getElementsByClassName('co-form-weight')[0];
        this.tariffElement = <HTMLElement> this.root.getElementsByClassName('co-form-tariff')[0];
        this.offlineOrderField = new CheckboxField(document.getElementById(this.id + "-offline-order"));
        this.dropshipField = new CheckboxField(document.getElementById(this.id + "-dropship"));
        this.printInvoiceField = new CheckboxField(document.getElementById(this.id + "-print-invoice"));
        this.printLabelField = new CheckboxField(document.getElementById(this.id + "-label"));
        this.pickupField = new InputField(document.getElementById(this.id + "-pickup"));
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
        this.districtField.attachEvent(SearchField.GET_VALUE_EVENT, this.updateTariff.bind(this));
        this.districtField.attachEvent(SearchField.LOSE_VALUE_EVENT, this.resetTariff.bind(this));
    }
    
    resetTariff() {
        this.setTariff(0);
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

    setTariff(tariff : number) {
        this.tariffElement.innerHTML = "" + tariff;
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
        data['courier_code'] = this.courierField.getValue();
        this.districtField.setAdditionalData(data);
    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }

    updateTariff() {
        let data = {};
        data["district_id"] = this.districtField.getValue();
        data["courier_code"] = this.courierField.getValue();
        $.ajax({
            url : System.getBaseUrl() + "/order/get-tariff",
            method : "get",
            data : data,
            dataType : "json",
            context : this,
            success : function(data) {
                if(data.status != 1) {
                    this.setTariff(0);
                } else {
                    this.setTariff(data.tariff);
                }
            }
        })
    }
}
