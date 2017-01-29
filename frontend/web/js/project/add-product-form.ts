import {Form} from '../common/form';
import {DynamicWholesaleField} from './dynamic-wholesale-field';
import {InputField} from './../common/input-field';
import {SearchField} from './../common/search-field';
import {System} from './../common/system';

export class AddProductForm extends Form{
    
    imageField : InputField;

    imageIdField : InputField;

    previewImage : HTMLImageElement;
    
    wholeSaleField : DynamicWholesaleField;

    nameField : InputField;

    skuField : InputField;

    weightField : InputField;

    linkField : InputField;

    categoryField : SearchField;

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
        this.imageField = new InputField(document.getElementById(this.id + "-image-field"));
        this.imageIdField = new InputField(document.getElementById(this.id + "-image-id-field"));
        this.nameField = new InputField(document.getElementById(this.id + "-name-field"));
        this.skuField = new InputField(document.getElementById(this.id + "-sku-field"));
        this.weightField = new InputField(document.getElementById(this.id + "-weight-field"));
        this.linkField = new InputField(document.getElementById(this.id + "-link-field"));
        this.minQuantityField = new InputField(document.getElementById(this.id + "-min-quantity-field"));
        this.price1Field = new InputField(document.getElementById(this.id + "-price1-field"));
        this.price2Field = new InputField(document.getElementById(this.id + "-price2-field"));
        this.price3Field = new InputField(document.getElementById(this.id + "-price3-field"));
        this.previewImage = <HTMLImageElement> document.getElementsByClassName('ap-form-preview')[0];
        this.price4Field = new InputField(document.getElementById(this.id + "-price4-field"));
    }
    
    bindEvent() {
        super.bindEvent();
        this.imageField.attachEvent(InputField.VALUE_CHANGED, this.uploadImage.bind(this))
    }
    
    validateUploadImage() {
        if(!this.imageField.getValue()) {
            return false;
        }

        return true;
    }

    uploadImage() {
        this.submitButton.disable(true);
        if(!this.validateUploadImage()) {
            return false;
        }

        let formData = new FormData();
        formData.append("files[]", this.imageField.getValue());
        formData.append(System.getCsrfParam(), System.getCsrfValue());

        let ajaxSettings : JQueryAjaxSettings = {
            url : System.getBaseUrl() + "/image/upload",
            type: this.method,
            context : this,
            data : formData,
            processData : false,
            cache: false,
            contentType : false,
            success : function(data) {
                var parsed = JSON.parse(data);
                this.submitButton.disable(false);
                if(parsed['status'] === 1) {
                    this.appendPreviewImage(parsed.image_id, parsed.image_path);
                } else {
                    if(!System.isEmptyValue(parsed['errors'])) {
                        this.handleErrors(parsed['errors']);
                    }
                }
            },
            error : function() {
                this.submitButton.disable(false);
            }   
        };
        $.ajax (ajaxSettings);


    }
    
    appendPreviewImage(id : string, path : string) {
        this.previewImage.src = path;
        this.previewImage.classList.remove('app-hide');
        this.imageIdField.setValue(id);
    }

    rules() {
        this.registerFields([this.wholeSaleField, this.categoryField, this.nameField, this.skuField, this.weightField,
                            this.linkField, this.minQuantityField, this.price1Field, this.price2Field,
                            this.imageIdField,
                            this.price3Field, this.price4Field]);

        this.setRequiredField([this.categoryField, this.nameField, this.skuField, this.weightField,
                            this.linkField, this.minQuantityField, this.price1Field, this.price2Field,
                            this.price3Field, this.price4Field]);
    }

    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
