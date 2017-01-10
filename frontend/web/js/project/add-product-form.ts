import {Form} from '../common/form';
import {DynamicWholesaleField} from './dynamic-wholesale-field';
import {InputField} from './../common/input-field';
import {SearchField} from './../common/search-field';
import {System} from './../common/system';

export class AddProductForm extends Form{
    
    imageField : InputField;
    
    wholeSaleField : DynamicWholesaleField;

    nameField : InputField;

    skuField : InputField;

    weightField : InputField;

    linkField : InputField;

    categoryField : SearchField;

    quantityField : InputField;

    minQuantityField : InputField;

    price1Field : InputField;

    price2Field : InputField;

    price3Field : InputField;

    price4Field : InputField;

    constructor(root: HTMLElement) {
        super(root);
        this.successCb = function(data) {
            window.location.href = System.getBaseUrl() + "/product/list";
        }
    }
    
    decorate() {
        super.decorate();
        this.wholeSaleField = 
            new DynamicWholesaleField(document.getElementById(this.id + "-dynamic-wholesale"));
        this.categoryField = new SearchField(document.getElementById(this.id + "-category-field"));
        this.imageField = new InputField(document.getElementById(this.id + "-picture-field"));
        this.nameField = new InputField(document.getElementById(this.id + "-name-field"));
        this.skuField = new InputField(document.getElementById(this.id + "-sku-field"));
        this.weightField = new InputField(document.getElementById(this.id + "-weight-field"));
        this.linkField = new InputField(document.getElementById(this.id + "-link-field"));
        this.quantityField = new InputField(document.getElementById(this.id + "-quantity-field"));
        this.minQuantityField = new InputField(document.getElementById(this.id + "-min-quantity-field"));
        this.price1Field = new InputField(document.getElementById(this.id + "-price1-field"));
        this.price2Field = new InputField(document.getElementById(this.id + "-price2-field"));
        this.price3Field = new InputField(document.getElementById(this.id + "-price3-field"));
        this.price4Field = new InputField(document.getElementById(this.id + "-price4-field"));
    }
    
    bindEvent() {
        super.bindEvent();
    }

    rules() {
        this.registerFields([this.wholeSaleField, this.categoryField, this.nameField, this.skuField, this.weightField,
                            this.linkField, this.quantityField, this.minQuantityField, this.price1Field, this.price2Field,
                            this.price3Field, this.price4Field]);

        this.setRequiredField([this.categoryField, this.nameField, this.skuField, this.weightField,
                            this.linkField, this.quantityField, this.minQuantityField, this.price1Field, this.price2Field,
                            this.price3Field, this.price4Field]);
    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
