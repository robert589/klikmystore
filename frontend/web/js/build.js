var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
define("common/component", ["require", "exports"], function (require, exports) {
    "use strict";
    var Component = (function () {
        function Component(root) {
            this.root = root;
            this.decorate();
            this.bindEvent();
        }
        Component.prototype.decorate = function () {
            this.id = this.root.getAttribute('id');
        };
        Component.prototype.bindEvent = function () {
        };
        Component.prototype.detach = function () {
        };
        /**
         * Remove completely
         */
        Component.prototype.remove = function () {
            this.detach();
            this.root.parentElement.removeChild(this.root);
        };
        Component.prototype.unbindEvent = function () {
        };
        Component.prototype.deconstruct = function () {
            this.detach();
            this.unbindEvent();
        };
        Component.prototype.getRoot = function () {
            return this.root;
        };
        Component.prototype.removeClass = function (className) {
            this.root.classList.remove(className);
        };
        Component.prototype.addClass = function (className) {
            this.root.classList.add(className);
        };
        Component.prototype.attachEvent = function (eventName, callback) {
            this.root.addEventListener(eventName, callback);
        };
        return Component;
    }());
    exports.Component = Component;
});
define("common/system", ["require", "exports"], function (require, exports) {
    "use strict";
    var System = (function () {
        function System() {
        }
        System.getUserId = function () {
        };
        System.getBaseUrl = function () {
            return document.getElementById('base-url').value;
        };
        System.isEmptyValue = function (x) {
            return x === null || typeof x === 'undefined' || x === '';
        };
        System.capitalizeFirstLetter = function (text) {
            return text.charAt(0).toUpperCase() + text.slice(1);
        };
        System.isEmail = function (text) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(text);
        };
        System.addCsrf = function (data) {
            var csrfParam = System.getCsrfParam();
            var csrfToken = System.getCsrfValue();
            data[csrfParam] = csrfToken;
            return data;
        };
        System.addCsrfToUrl = function (url) {
            var csrfParam = System.getCsrfParam();
            var csrfToken = System.getCsrfValue();
            return url + "?" + csrfParam + "=" + csrfToken;
        };
        System.getCsrfParam = function () {
            return document.querySelector('meta[name="csrf-param"]').getAttribute('content');
        };
        System.getCsrfValue = function () {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        };
        System.checkIdExist = function (id) {
            return !System.isEmptyValue(document.getElementById(id));
        };
        return System;
    }());
    exports.System = System;
});
define("common/Field", ["require", "exports", "common/component", "common/system"], function (require, exports, component_1, system_1) {
    "use strict";
    var Field = (function (_super) {
        __extends(Field, _super);
        function Field(root) {
            return _super.call(this, root) || this;
        }
        Field.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.fieldError = this.root.getElementsByClassName('field-error')[0];
            this.name = this.root.getAttribute('data-name');
        };
        Field.prototype.showError = function (errorMessage) {
            this.fieldError.innerHTML = errorMessage;
            this.fieldError.classList.remove('app-hide');
        };
        Field.prototype.hideError = function () {
            this.fieldError.classList.add('app-hide');
        };
        Field.prototype.getName = function () {
            return this.name;
        };
        Field.prototype.getDisplayName = function () {
            var constructedName = "";
            var first = true;
            var piecesOfName = this.name.split("_");
            for (var _i = 0, piecesOfName_1 = piecesOfName; _i < piecesOfName_1.length; _i++) {
                var piece = piecesOfName_1[_i];
                if (first) {
                    first = false;
                }
                else {
                    constructedName += " ";
                }
                constructedName += system_1.System.capitalizeFirstLetter(piece);
            }
            return constructedName;
        };
        Field.prototype.setIndex = function (index) {
            this.root.setAttribute('data-index', index + "");
        };
        Field.prototype.getIndex = function () {
            return parseInt(this.root.getAttribute('data-index'));
        };
        return Field;
    }(component_1.Component));
    exports.Field = Field;
});
define("common/input-field", ["require", "exports", "common/Field", "common/system"], function (require, exports, Field_1, system_2) {
    "use strict";
    var InputField = (function (_super) {
        __extends(InputField, _super);
        function InputField(root) {
            var _this = _super.call(this, root) || this;
            _this.dateFormat = 'dd-mm-yy';
            _this.type = _this.inputElement.getAttribute("type");
            return _this;
        }
        Object.defineProperty(InputField, "VALUE_CHANGED", {
            get: function () { return "INPUT_FIELD_VALUE_CHANGED"; },
            enumerable: true,
            configurable: true
        });
        ;
        InputField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.inputElement = this.root.getElementsByClassName('input-field-input')[0];
            if (!system_2.System.isEmptyValue(this.root.getAttribute('data-datepicker'))) {
                $("#" + this.id).find(".input-field-input")
                    .datepicker({ dateFormat: "dd/mm/yy",
                    onSelect: function (date) {
                        this.triggerValueChangedEvent();
                    }.bind(this)
                });
            }
            else if (!system_2.System.isEmptyValue(this.root.getAttribute('data-timepicker'))) {
                $("#" + this.id).find(".input-field-input")
                    .timepicker({
                    change: function (time) {
                        this.triggerValueChangedEvent();
                    }.bind(this)
                });
            }
        };
        InputField.prototype.bindEvent = function () {
            this.valueChangeEvent = new CustomEvent(InputField.VALUE_CHANGED);
            this.inputElement.addEventListener('change', this.triggerValueChangedEvent.bind(this));
        };
        InputField.prototype.triggerValueChangedEvent = function () {
            this.inputElement.setAttribute('value', this.inputElement.value);
            this.root.dispatchEvent(this.valueChangeEvent);
        };
        InputField.prototype.detach = function () {
            this.inputElement = null;
        };
        InputField.prototype.unbindEvent = function () {
        };
        InputField.prototype.getValue = function () {
            if (this.type === "file") {
                return this.inputElement.files[0];
            }
            return this.inputElement.value;
        };
        InputField.prototype.setValue = function (val) {
            this.inputElement.value = val;
        };
        InputField.prototype.getDateFormat = function () {
            return this.dateFormat;
        };
        InputField.prototype.disable = function () {
            this.inputElement.setAttribute('disabled', "true");
        };
        InputField.prototype.enable = function () {
            this.inputElement.removeAttribute('disabled');
        };
        InputField.prototype.setMax = function (max) {
            try {
                if (this.type !== "number") {
                    throw new TypeError("Input field must be a number type");
                }
                else {
                    this.inputElement.max = max + "";
                }
            }
            catch (e) {
                console.log(e.message);
            }
        };
        InputField.prototype.setMin = function (min) {
            try {
                if (this.type !== "number") {
                    throw new TypeError("Input field must be a number type");
                }
                else {
                    this.inputElement.min = min + "";
                }
            }
            catch (e) {
                console.log(e.message);
            }
        };
        return InputField;
    }(Field_1.Field));
    exports.InputField = InputField;
});
define("common/button", ["require", "exports", "common/component"], function (require, exports, component_2) {
    "use strict";
    var Button = (function (_super) {
        __extends(Button, _super);
        function Button(root, clickEvent) {
            var _this = _super.call(this, root) || this;
            _this.addClickEvent(clickEvent);
            return _this;
        }
        Button.prototype.addClickEvent = function (cb) {
            this.root.onclick = function (e) {
                if (!this.isDisabled()) {
                    cb(e);
                }
            }.bind(this);
        };
        Button.prototype.disable = function (on) {
            this.root.disabled = on;
        };
        Button.prototype.isDisabled = function () {
            return this.root.disabled;
        };
        Button.prototype.detach = function () {
            _super.prototype.detach.call(this);
            this.root.onclick = null;
            this.root = null;
        };
        return Button;
    }(component_2.Component));
    exports.Button = Button;
});
define("common/modal", ["require", "exports", "common/component", "common/button"], function (require, exports, component_3, button_1) {
    "use strict";
    var Modal = (function (_super) {
        __extends(Modal, _super);
        function Modal(root) {
            return _super.call(this, root) || this;
        }
        Modal.prototype.show = function () {
            this.root.classList.add('modal-show');
            this.root.classList.remove('modal-hide');
        };
        Modal.prototype.hide = function () {
            this.root.classList.add('modal-hide');
            this.root.classList.remove('modal-show');
        };
        Modal.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.closeButton = new button_1.Button(document.getElementById(this.id + "-close-button"), function (e) {
                this.hide();
            }.bind(this));
        };
        Modal.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.root.addEventListener('click', function (e) {
                if (e.target && !e.target.closest('.modal-content')) {
                    this.hide();
                }
            }.bind(this));
        };
        return Modal;
    }(component_3.Component));
    exports.Modal = Modal;
});
define("common/validation", ["require", "exports"], function (require, exports) {
    "use strict";
    var Validation = (function () {
        function Validation() {
        }
        return Validation;
    }());
    exports.Validation = Validation;
});
define("common/range-validation", ["require", "exports", "common/validation"], function (require, exports, validation_1) {
    "use strict";
    var RangeValidation = (function (_super) {
        __extends(RangeValidation, _super);
        function RangeValidation(targetField, min, max) {
            var _this = _super.call(this) || this;
            _this.targetField = targetField;
            _this.min = min;
            _this.max = max;
            _this.errorMessage = _this.getErrorMessage();
            _this.validate = _this.validateRange.bind(_this);
            return _this;
        }
        RangeValidation.prototype.getErrorMessage = function () {
            var message;
            if (this.max !== null && this.min !== null) {
                message =
                    this.targetField.getDisplayName() + " must be in the range of " +
                        this.min + " to " + this.max;
            }
            else if (this.min !== null) {
                message = this.targetField.getDisplayName() + " cannot be less than "
                    + this.min;
            }
            else {
                message = this.targetField.getDisplayName() + " must be at most "
                    + this.min;
            }
            return message;
        };
        RangeValidation.prototype.validateRange = function () {
            var valid = (this.min === null ||
                this.targetField.getValue() >= this.min)
                && (this.max === null ||
                    this.targetField.getValue() <= this.max);
            if (!valid) {
                this.targetField.showError(this.errorMessage);
            }
            return valid;
        };
        return RangeValidation;
    }(validation_1.Validation));
    exports.RangeValidation = RangeValidation;
});
define("common/form", ["require", "exports", "common/component", "common/system", "common/button"], function (require, exports, component_4, system_3, button_2) {
    "use strict";
    var Form = (function (_super) {
        __extends(Form, _super);
        function Form(root) {
            var _this = _super.call(this, root) || this;
            _this.rules();
            return _this;
        }
        Form.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            //init variable
            this.requiredFields = [];
            this.allFields = [];
            this.emailFields = [];
            this.rangeValidations = [];
            this.validations = [];
            this.method = this.root.getAttribute('method');
            this.url = this.root.getAttribute('url');
            this.file = Boolean(this.root.getAttribute('data-file'));
            this.submitButton = new button_2.Button(document.getElementById(this.id + "-submit-btn"), this.submit.bind(this));
        };
        Form.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.root.onsubmit = function (e) {
                return false;
            };
            this.root.onkeypress = function (e) {
                if (e.keyCode === 13) {
                    this.submit(e);
                }
            }.bind(this);
        };
        Form.prototype.registerFields = function (fields) {
            this.allFields = this.allFields.concat(fields);
        };
        Form.prototype.setRequiredField = function (fields) {
            this.requiredFields = this.requiredFields.concat(fields);
        };
        Form.prototype.setRangeValidations = function (validations) {
            this.rangeValidations = this.rangeValidations.concat(validations);
        };
        Form.prototype.setValidations = function (validations) {
            this.validations = this.validations.concat(validations);
        };
        Form.prototype.setEmailField = function (fields) {
            this.emailFields = this.emailFields.concat(fields);
        };
        Form.prototype.validate = function () {
            this.hideAllErrors();
            var valid = true;
            //validate required fields
            for (var _i = 0, _a = this.requiredFields; _i < _a.length; _i++) {
                var field = _a[_i];
                if (system_3.System.isEmptyValue(field.getValue())) {
                    field.showError(field.getDisplayName() + " is required");
                    valid = false;
                }
            }
            //validate email fields
            for (var _b = 0, _c = this.emailFields; _b < _c.length; _b++) {
                var field = _c[_b];
                if (!system_3.System.isEmail(field.getValue())) {
                    field.showError("The input must be a valid email address");
                    valid = false;
                }
            }
            //execute range validations
            for (var _d = 0, _e = this.rangeValidations; _d < _e.length; _d++) {
                var validation = _e[_d];
                if (!validation.validate()) {
                    valid = false;
                }
            }
            //execute all validations
            for (var _f = 0, _g = this.validations; _f < _g.length; _f++) {
                var validation = _g[_f];
                if (!validation.validate()) {
                    validation.targetField.showError(validation.errorMessage);
                    valid = false;
                }
            }
            return valid;
        };
        Form.prototype.hideAllErrors = function () {
            for (var _i = 0, _a = this.allFields; _i < _a.length; _i++) {
                var field = _a[_i];
                field.hideError();
            }
        };
        Form.prototype.getJson = function (sendCsrf) {
            var data = {};
            if (sendCsrf) {
                data = system_3.System.addCsrf(data);
            }
            for (var _i = 0, _a = this.allFields; _i < _a.length; _i++) {
                var field = _a[_i];
                data[field.getName()] = field.getValue();
            }
            return data;
        };
        Form.prototype.submit = function (e) {
            e.preventDefault();
            var valid = this.validate();
            if (valid) {
                this.sendToServerSide();
            }
            return false;
        };
        Form.prototype.sendToServerSide = function () {
            this.submitButton.disable(true);
            var ajaxSettings = {
                url: this.file ? system_3.System.addCsrfToUrl(this.url) : this.url,
                type: this.method,
                context: this,
                data: this.getJson(true),
                success: function (data) {
                    var parsed = JSON.parse(data);
                    if (parsed['status'] === 1) {
                        this.successCb(parsed);
                    }
                    else {
                        if (!system_3.System.isEmptyValue(parsed['errors'])) {
                            this.handleErrors(parsed['errors']);
                        }
                    }
                    this.submitButton.disable(false);
                },
                error: function () {
                    this.submitButton.disable(false);
                }
            };
            if (this.file) {
                ajaxSettings['processData'] = false;
                ajaxSettings['cache'] = false;
                ajaxSettings['contentType'] = false;
            }
            $.ajax(ajaxSettings);
        };
        Form.prototype.handleErrors = function (errors) {
            for (var _i = 0, _a = this.allFields; _i < _a.length; _i++) {
                var field = _a[_i];
                if (!system_3.System.isEmptyValue(errors[field.getName()])) {
                    field.showError(errors[field.getName()][0]);
                }
            }
        };
        Form.prototype.findField = function (name) {
            for (var _i = 0, _a = this.allFields; _i < _a.length; _i++) {
                var field = _a[_i];
                if (field.getName() === name) {
                    return field;
                }
            }
        };
        return Form;
    }(component_4.Component));
    exports.Form = Form;
});
define("project/login-form", ["require", "exports", "common/form", "common/input-field"], function (require, exports, form_1, input_field_1) {
    "use strict";
    var LoginForm = (function (_super) {
        __extends(LoginForm, _super);
        function LoginForm(root) {
            var _this = _super.call(this, root) || this;
            _this.failCb = function () {
            }.bind(_this);
            _this.successCb = function (data) {
                window.location.reload();
            }.bind(_this);
            return _this;
        }
        LoginForm.prototype.rules = function () {
            this.setRequiredField([this.emailField, this.passwordField]);
            this.setEmailField([this.emailField]);
        };
        LoginForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.emailField = new input_field_1.InputField(document.getElementById(this.id + "-email-field"));
            this.passwordField = new input_field_1.InputField(document.getElementById(this.id + "-password-field"));
            this.registerFields([this.emailField, this.passwordField]);
        };
        return LoginForm;
    }(form_1.Form));
    exports.LoginForm = LoginForm;
});
define("project/login", ["require", "exports", "common/component", "project/login-form"], function (require, exports, component_5, login_form_1) {
    "use strict";
    var Login = (function (_super) {
        __extends(Login, _super);
        function Login(root) {
            return _super.call(this, root) || this;
        }
        Login.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.loginForm = new login_form_1.LoginForm(document.getElementById(this.id + "form"));
        };
        Login.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        Login.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        Login.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return Login;
    }(component_5.Component));
    exports.Login = Login;
});
define("common/dynamic-field", ["require", "exports", "common/Field", "common/button"], function (require, exports, field_1, button_3) {
    "use strict";
    var DynamicField = (function (_super) {
        __extends(DynamicField, _super);
        function DynamicField(root) {
            var _this = _super.call(this, root) || this;
            _this.baseElementinString = _this.baseElement.innerHTML;
            return _this;
        }
        DynamicField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.addBtn = new button_3.Button(document.getElementById(this.id + "-add"), this.addField.bind(this));
            this.rmvBtn = new button_3.Button(document.getElementById(this.id + "-remove"), this.removeField.bind(this));
            this.baseElement = this.root.getElementsByClassName('dynamic-field-init')[0];
            this.areaField = this.root.getElementsByClassName('dynamic-field-area')[0];
        };
        DynamicField.prototype.getValue = function () {
            var value = [];
            for (var i = 0; i < this.fields.length; i++) {
                value.push(this.fields[i].getValue());
            }
            //if there is nothing
            if (value.length === 1 && value[0] === null) {
                return null;
            }
            return value;
        };
        DynamicField.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        DynamicField.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        DynamicField.prototype.unbindEvent = function () {
            // no event to unbind
        };
        DynamicField.prototype.findMaxIndexInFields = function () {
            var max = -1;
            for (var i = 0; i < this.fields.length; i++) {
                if (max < this.fields[i].getIndex()) {
                    max = this.fields[i].getIndex();
                }
            }
            return max;
        };
        DynamicField.prototype.findFieldsWithMaxIndex = function () {
            var max = -1;
            var maxField = null;
            for (var i = 0; i < this.fields.length; i++) {
                if (max < this.fields[i].getIndex()) {
                    max = this.fields[i].getIndex();
                    maxField = this.fields[i];
                }
            }
            return maxField;
        };
        /**
         * Append the base string
         */
        DynamicField.prototype.addElement = function () {
            var wrapper = document.createElement('div');
            wrapper.innerHTML = this.baseElementinString;
            var raw = wrapper.getElementsByClassName('dynamic-field-item')[0];
            raw.setAttribute("id", raw.getAttribute("id") + "-"
                + (this.findMaxIndexInFields() + 1));
            this.areaField.appendChild(raw);
            return raw;
        };
        DynamicField.prototype.removeField = function () {
            var field = this.findFieldsWithMaxIndex();
            var fieldElement = document.getElementById(field.getRoot().getAttribute('id'));
            field.detach();
            this.areaField.removeChild(fieldElement);
            var index = this.fields.indexOf(field);
            if (index > -1) {
                this.fields.splice(index, 1);
            }
        };
        return DynamicField;
    }(field_1.Field));
    exports.DynamicField = DynamicField;
});
define("project/wholesale-field", ["require", "exports", "common/Field"], function (require, exports, field_2) {
    "use strict";
    var WholesaleField = (function (_super) {
        __extends(WholesaleField, _super);
        function WholesaleField(root) {
            return _super.call(this, root) || this;
        }
        WholesaleField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
        };
        WholesaleField.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        WholesaleField.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        WholesaleField.prototype.getValue = function () {
            var data = {};
            return null;
        };
        WholesaleField.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return WholesaleField;
    }(field_2.Field));
    exports.WholesaleField = WholesaleField;
});
define("project/dynamic-wholesale-field", ["require", "exports", "common/dynamic-field", "project/wholesale-field"], function (require, exports, dynamic_field_1, wholesale_field_1) {
    "use strict";
    var DynamicWholesaleField = (function (_super) {
        __extends(DynamicWholesaleField, _super);
        function DynamicWholesaleField(root) {
            var _this = _super.call(this, root) || this;
            _this.fields = [];
            _this.fields.push(new wholesale_field_1.WholesaleField(_this.baseElement.querySelector("*")));
            _this.fields[0].setIndex(0);
            return _this;
        }
        DynamicWholesaleField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
        };
        /**
         * Don't forget to set index
         */
        DynamicWholesaleField.prototype.addField = function () {
            var raw = this.addElement();
            var field = new wholesale_field_1.WholesaleField(raw);
            field.setIndex(this.findMaxIndexInFields() + 1);
            this.fields.push(field);
        };
        DynamicWholesaleField.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        DynamicWholesaleField.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        DynamicWholesaleField.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return DynamicWholesaleField;
    }(dynamic_field_1.DynamicField));
    exports.DynamicWholesaleField = DynamicWholesaleField;
});
define("common/search-field-dropdown-item", ["require", "exports", "common/component"], function (require, exports, component_6) {
    "use strict";
    var SearchFieldDropdownItem = (function (_super) {
        __extends(SearchFieldDropdownItem, _super);
        function SearchFieldDropdownItem(root) {
            return _super.call(this, root) || this;
        }
        Object.defineProperty(SearchFieldDropdownItem, "CLICK_SFDI_EVENT", {
            get: function () { return "CLICK_SFDI_EVENT"; },
            enumerable: true,
            configurable: true
        });
        ;
        SearchFieldDropdownItem.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.text = this.root.getAttribute("data-text");
            this.itemId = this.root.getAttribute("data-itemId");
        };
        SearchFieldDropdownItem.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            var sfdiJson = {
                text: this.text,
                itemId: this.itemId
            };
            this.clickSfdiEvent = new CustomEvent(SearchFieldDropdownItem.CLICK_SFDI_EVENT, { detail: sfdiJson });
            this.root.addEventListener("click", function (e) {
                this.root.dispatchEvent(this.clickSfdiEvent);
            }.bind(this));
        };
        SearchFieldDropdownItem.prototype.unbindEvent = function () {
            this.root.addEventListener(SearchFieldDropdownItem.CLICK_SFDI_EVENT, null);
            this.root.addEventListener("click", null);
        };
        return SearchFieldDropdownItem;
    }(component_6.Component));
    exports.SearchFieldDropdownItem = SearchFieldDropdownItem;
});
define("common/search-field", ["require", "exports", "common/Field", "common/system", "common/search-field-dropdown-item"], function (require, exports, field_3, system_4, search_field_dropdown_item_1) {
    "use strict";
    var SearchField = (function (_super) {
        __extends(SearchField, _super);
        function SearchField(root) {
            var _this = _super.call(this, root) || this;
            _this.additionalData = [];
            _this.initValue();
            return _this;
        }
        Object.defineProperty(SearchField, "GET_VALUE_EVENT", {
            get: function () { return "SEARCH_FIELD_GET_VALUE_EVENT"; },
            enumerable: true,
            configurable: true
        });
        ;
        Object.defineProperty(SearchField, "LOSE_VALUE_EVENT", {
            get: function () { return "SEARCH_FIELD_LOSE_VALUE_EVENT"; },
            enumerable: true,
            configurable: true
        });
        ;
        SearchField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.url = this.root.getAttribute('data-url');
            this.items = [];
            this.input = this.root.getElementsByClassName('search-field-input')[0];
            this.dropdown = this.root.getElementsByClassName('search-field-dropdown')[0];
            this.loading = this.root.getElementsByClassName('search-field-loading')[0];
        };
        SearchField.prototype.bindEvent = function () {
            this.input.addEventListener('input', function (e) {
                this.sendAjax();
                if (this.curText !== this.input.value) {
                    this.resetValue();
                }
            }.bind(this));
            this.input.addEventListener('click', function (e) {
                this.sendAjax();
            }.bind(this));
            this.getValueEvent = new CustomEvent(SearchField.GET_VALUE_EVENT);
            this.loseValueEvent = new CustomEvent(SearchField.LOSE_VALUE_EVENT);
            document.addEventListener('click', function (e) {
                if (e.target && !e.target.closest('.search-field-dropdown')) {
                    this.emptyDropdown();
                }
            }.bind(this));
        };
        SearchField.prototype.resetValue = function () {
            this.curText = null;
            this.valueId = null;
            this.input.classList.remove('selected');
            this.root.dispatchEvent(this.loseValueEvent);
        };
        SearchField.prototype.emptyText = function () {
            this.input.value = null;
        };
        SearchField.prototype.emptyDropdown = function () {
            this.hideDropdown();
            this.dropdown.innerHTML = null;
            var i = 0;
            for (i = 0; i < this.items.length; i++) {
                this.items[i].deconstruct();
            }
            this.items = [];
        };
        SearchField.prototype.setAdditionalData = function (data) {
            this.additionalData = data;
        };
        SearchField.prototype.showLoading = function () {
            this.loading.classList.remove('app-hide');
        };
        SearchField.prototype.hideLoading = function () {
            this.loading.classList.add('app-hide');
        };
        SearchField.prototype.sendAjax = function () {
            this.showLoading();
            var data = {};
            data['q'] = this.input.value;
            data['id'] = this.id;
            //merge
            for (var attrname in this.additionalData) {
                data[attrname] = this.additionalData[attrname];
            }
            system_4.System.addCsrf(data);
            $.ajax({
                url: this.url,
                method: 'get',
                context: this,
                data: data,
                success: function (data) {
                    this.hideLoading();
                    var parsed = JSON.parse(data);
                    if (parsed.status === 1) {
                        this.emptyDropdown();
                        this.setDropdown(parsed.views);
                    }
                },
                error: function () {
                    this.hideLoading();
                }
            });
        };
        SearchField.prototype.initValue = function () {
            /**
             * Need improvement
             */
            if (!system_4.System.isEmptyValue(this.input.value)) {
                var index = this.root.getAttribute('data-index');
                var id = (system_4.System.isEmptyValue(index)) ? this.input.value : index;
                this.setValue(id, this.input.value);
            }
        };
        SearchField.prototype.setDropdown = function (views) {
            this.dropdown.innerHTML = views;
            var results = this.dropdown.getElementsByClassName('sfdi');
            var i;
            for (i = 0; i < results.length; i++) {
                this.items.push(new search_field_dropdown_item_1.SearchFieldDropdownItem(results.item(i)));
                this.items[i].attachEvent(search_field_dropdown_item_1.SearchFieldDropdownItem.CLICK_SFDI_EVENT, function (e) {
                    this.setValue(e.detail.itemId, e.detail.text);
                    this.emptyDropdown();
                }.bind(this));
            }
            this.showDropdown();
        };
        SearchField.prototype.hideDropdown = function () {
            this.dropdown.classList.add('app-hide');
        };
        SearchField.prototype.showDropdown = function () {
            this.dropdown.classList.remove('app-hide');
        };
        SearchField.prototype.setValue = function (id, text) {
            this.input.value = text;
            this.valueId = id;
            this.curText = text;
            this.input.classList.add('selected');
            this.root.dispatchEvent(this.getValueEvent);
        };
        SearchField.prototype.getValue = function () {
            return this.valueId;
        };
        SearchField.prototype.disable = function () {
            this.input.setAttribute('disabled', "true");
        };
        SearchField.prototype.enable = function () {
            this.input.removeAttribute('disabled');
        };
        return SearchField;
    }(field_3.Field));
    exports.SearchField = SearchField;
});
define("project/add-product-form", ["require", "exports", "common/form", "project/dynamic-wholesale-field", "common/input-field", "common/search-field", "common/system"], function (require, exports, form_2, dynamic_wholesale_field_1, input_field_2, search_field_1, system_5) {
    "use strict";
    var AddProductForm = (function (_super) {
        __extends(AddProductForm, _super);
        function AddProductForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.href = system_5.System.getBaseUrl() + "/product/list";
            };
            return _this;
        }
        AddProductForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.wholeSaleField =
                new dynamic_wholesale_field_1.DynamicWholesaleField(document.getElementById(this.id + "-dynamic-wholesale"));
            this.categoryField = new search_field_1.SearchField(document.getElementById(this.id + "-category-field"));
            this.imageField = new input_field_2.InputField(document.getElementById(this.id + "-picture-field"));
            this.nameField = new input_field_2.InputField(document.getElementById(this.id + "-name-field"));
            this.skuField = new input_field_2.InputField(document.getElementById(this.id + "-sku-field"));
            this.weightField = new input_field_2.InputField(document.getElementById(this.id + "-weight-field"));
            this.linkField = new input_field_2.InputField(document.getElementById(this.id + "-link-field"));
            this.quantityField = new input_field_2.InputField(document.getElementById(this.id + "-quantity-field"));
            this.minQuantityField = new input_field_2.InputField(document.getElementById(this.id + "-min-quantity-field"));
            this.price1Field = new input_field_2.InputField(document.getElementById(this.id + "-price1-field"));
            this.price2Field = new input_field_2.InputField(document.getElementById(this.id + "-price2-field"));
            this.price3Field = new input_field_2.InputField(document.getElementById(this.id + "-price3-field"));
            this.price4Field = new input_field_2.InputField(document.getElementById(this.id + "-price4-field"));
        };
        AddProductForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AddProductForm.prototype.rules = function () {
            this.registerFields([this.wholeSaleField, this.categoryField, this.nameField, this.skuField, this.weightField,
                this.linkField, this.quantityField, this.minQuantityField, this.price1Field, this.price2Field,
                this.price3Field, this.price4Field]);
            this.setRequiredField([this.categoryField, this.nameField, this.skuField, this.weightField,
                this.linkField, this.quantityField, this.minQuantityField, this.price1Field, this.price2Field,
                this.price3Field, this.price4Field]);
        };
        AddProductForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AddProductForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AddProductForm;
    }(form_2.Form));
    exports.AddProductForm = AddProductForm;
});
define("project/add-product", ["require", "exports", "common/component", "project/add-product-form"], function (require, exports, component_7, add_product_form_1) {
    "use strict";
    var AddProduct = (function (_super) {
        __extends(AddProduct, _super);
        function AddProduct(root) {
            return _super.call(this, root) || this;
        }
        AddProduct.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new add_product_form_1.AddProductForm(document.getElementById(this.id + "form"));
        };
        AddProduct.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AddProduct.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AddProduct.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AddProduct;
    }(component_7.Component));
    exports.AddProduct = AddProduct;
});
define("project/add-category-form", ["require", "exports", "common/form", "common/input-field"], function (require, exports, form_3, input_field_3) {
    "use strict";
    var AddCategoryForm = (function (_super) {
        __extends(AddCategoryForm, _super);
        function AddCategoryForm(root) {
            var _this = _super.call(this, root) || this;
            _this.failCb = function (data) {
            }.bind(_this);
            _this.successCb = function (data) {
                window.location.reload();
            }.bind(_this);
            return _this;
        }
        AddCategoryForm.prototype.rules = function () {
            this.registerFields([this.nameField, this.descField]);
            this.setRequiredField([this.nameField]);
        };
        AddCategoryForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.nameField = new input_field_3.InputField(document.getElementById(this.id + "-name-field"));
            this.descField = new input_field_3.InputField(document.getElementById(this.id + "-description-field"));
        };
        AddCategoryForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AddCategoryForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AddCategoryForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AddCategoryForm;
    }(form_3.Form));
    exports.AddCategoryForm = AddCategoryForm;
});
define("project/add-category", ["require", "exports", "common/component", "project/add-category-form"], function (require, exports, component_8, add_category_form_1) {
    "use strict";
    var AddCategory = (function (_super) {
        __extends(AddCategory, _super);
        function AddCategory(root) {
            return _super.call(this, root) || this;
        }
        AddCategory.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.addCategoryForm = new add_category_form_1.AddCategoryForm(document.getElementById(this.id + "form"));
        };
        AddCategory.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AddCategory.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AddCategory.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AddCategory;
    }(component_8.Component));
    exports.AddCategory = AddCategory;
});
define("project/create-marketplace-form", ["require", "exports", "common/form", "common/input-field"], function (require, exports, form_4, input_field_4) {
    "use strict";
    var CreateMarketplaceForm = (function (_super) {
        __extends(CreateMarketplaceForm, _super);
        function CreateMarketplaceForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.reload();
            }.bind(_this);
            return _this;
        }
        CreateMarketplaceForm.prototype.rules = function () {
            this.setRequiredField([this.codeField, this.nameField]);
            this.registerFields([this.codeField, this.nameField]);
        };
        CreateMarketplaceForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.codeField = new input_field_4.InputField(document.getElementById(this.id + "-code-field"));
            this.nameField = new input_field_4.InputField(document.getElementById(this.id + "-name-field"));
        };
        CreateMarketplaceForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CreateMarketplaceForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateMarketplaceForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateMarketplaceForm;
    }(form_4.Form));
    exports.CreateMarketplaceForm = CreateMarketplaceForm;
});
define("project/order-create-marketplace", ["require", "exports", "common/component", "project/create-marketplace-form"], function (require, exports, component_9, create_marketplace_form_1) {
    "use strict";
    var OrderCreateMarketplace = (function (_super) {
        __extends(OrderCreateMarketplace, _super);
        function OrderCreateMarketplace(root) {
            return _super.call(this, root) || this;
        }
        OrderCreateMarketplace.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new create_marketplace_form_1.CreateMarketplaceForm(document.getElementById(this.id + "form"));
        };
        OrderCreateMarketplace.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        OrderCreateMarketplace.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        OrderCreateMarketplace.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return OrderCreateMarketplace;
    }(component_9.Component));
    exports.OrderCreateMarketplace = OrderCreateMarketplace;
});
define("project/create-courier-form", ["require", "exports", "common/form", "common/input-field"], function (require, exports, form_5, input_field_5) {
    "use strict";
    var CreateCourierForm = (function (_super) {
        __extends(CreateCourierForm, _super);
        function CreateCourierForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.reload();
            }.bind(_this);
            return _this;
        }
        CreateCourierForm.prototype.rules = function () {
            this.setRequiredField([this.codeField, this.nameField]);
            this.registerFields([this.codeField, this.nameField]);
        };
        CreateCourierForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.codeField = new input_field_5.InputField(document.getElementById(this.id + "-code-field"));
            this.nameField = new input_field_5.InputField(document.getElementById(this.id + "-name-field"));
        };
        CreateCourierForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CreateCourierForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateCourierForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateCourierForm;
    }(form_5.Form));
    exports.CreateCourierForm = CreateCourierForm;
});
define("project/order-create-courier", ["require", "exports", "common/component", "project/create-courier-form"], function (require, exports, component_10, create_courier_form_1) {
    "use strict";
    var OrderCreateCourier = (function (_super) {
        __extends(OrderCreateCourier, _super);
        function OrderCreateCourier(root) {
            return _super.call(this, root) || this;
        }
        OrderCreateCourier.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new create_courier_form_1.CreateCourierForm(document.getElementById(this.id + "form"));
        };
        OrderCreateCourier.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        OrderCreateCourier.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        OrderCreateCourier.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return OrderCreateCourier;
    }(component_10.Component));
    exports.OrderCreateCourier = OrderCreateCourier;
});
define("common/string", ["require", "exports"], function (require, exports) {
    "use strict";
    var String = (function () {
        function String() {
        }
        String.trim = function (text) {
            return text.replace(/^\s+|\s+$/g, "");
        };
        return String;
    }());
    exports.String = String;
});
define("project/product-order-field-item", ["require", "exports", "common/component", "common/string", "common/button", "common/input-field", "common/system"], function (require, exports, component_11, string_1, button_4, input_field_6, system_6) {
    "use strict";
    var ProductOrderFieldItem = (function (_super) {
        __extends(ProductOrderFieldItem, _super);
        function ProductOrderFieldItem(root) {
            return _super.call(this, root) || this;
        }
        ProductOrderFieldItem.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.idElement = this.root.getElementsByClassName('pof-item-id')[0];
            this.nameElement = this.root.getElementsByClassName('pof-item-name')[0];
            this.quantityViewElement = document.getElementById(this.id + '-qty-view');
            this.quantityEditElement = document.getElementById(this.id + "-qty-edit");
            this.qtyValueElement = document.getElementById(this.id + "-qty-value");
            this.editQtyBtn = new button_4.Button(document.getElementById(this.id + "-editqty-btn"), this.switchToEditQty.bind(this));
            this.newQtyField = new input_field_6.InputField(document.getElementById(this.id + "-new-qty"));
        };
        ProductOrderFieldItem.prototype.switchToEditQty = function (e) {
            e.preventDefault();
            this.quantityEditElement.classList.remove('app-hide');
            this.quantityViewElement.classList.add('app-hide');
        };
        ProductOrderFieldItem.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.newQtyField.attachEvent("keydown", function (e) {
                if (e.keyCode === 13) {
                    e.preventDefault();
                    this.submitNewQty();
                }
            }.bind(this));
        };
        ProductOrderFieldItem.prototype.submitNewQty = function () {
            var data = {};
            data['product_id'] = this.getProductId();
            data['quantity'] = this.getQuantity();
            data = system_6.System.addCsrf(data);
            this.newQtyField.disable();
            $.ajax({
                url: system_6.System.getBaseUrl() + "/order/check-quantity",
                method: "post",
                data: data,
                dataType: "json",
                context: this,
                success: function (data) {
                    if (data.status == 1) {
                        this.updateNewQuantity();
                    }
                    else {
                        this.newQtyField.showError("Stock is not enough");
                    }
                    this.newQtyField.enable();
                },
                error: function (data) {
                    this.newQtyField.enable();
                }
            });
        };
        ProductOrderFieldItem.prototype.updateNewQuantity = function () {
            this.quantityEditElement.classList.add('app-hide');
            this.setQuantity(this.newQtyField.getValue());
            this.quantityViewElement.classList.remove('app-hide');
        };
        ProductOrderFieldItem.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ProductOrderFieldItem.prototype.getId = function () {
            return string_1.String.trim(this.idElement.innerHTML);
        };
        ProductOrderFieldItem.prototype.unbindEvent = function () {
            // no event to unbind
        };
        ProductOrderFieldItem.prototype.getProductId = function () {
            return string_1.String.trim(this.idElement.innerHTML);
        };
        ProductOrderFieldItem.prototype.getQuantity = function () {
            return parseInt(string_1.String.trim(this.qtyValueElement.innerHTML));
        };
        ProductOrderFieldItem.prototype.getWeight = function () {
            return parseInt(this.root.getAttribute('data-weight'));
        };
        ProductOrderFieldItem.prototype.setQuantity = function (value) {
            this.qtyValueElement.innerHTML = "" + value;
        };
        ProductOrderFieldItem.prototype.getPrice = function () {
            return parseInt(this.root.getAttribute('data-price'));
        };
        ProductOrderFieldItem.prototype.getValue = function () {
            return {
                id: this.getId(),
                quantity: this.getQuantity()
            };
        };
        return ProductOrderFieldItem;
    }(component_11.Component));
    exports.ProductOrderFieldItem = ProductOrderFieldItem;
});
define("project/product-order-field", ["require", "exports", "common/Field", "common/search-field", "common/input-field", "common/button", "common/system", "project/product-order-field-item"], function (require, exports, field_4, search_field_2, input_field_7, button_5, system_7, product_order_field_item_1) {
    "use strict";
    var ProductOrderField = (function (_super) {
        __extends(ProductOrderField, _super);
        function ProductOrderField(root) {
            var _this = _super.call(this, root) || this;
            _this.products = [];
            if (system_7.System.isEmptyValue(_this.root.getAttribute('data-check-range'))) {
                _this.enableCheckRange = false;
            }
            else {
                _this.enableCheckRange = true;
            }
            return _this;
        }
        Object.defineProperty(ProductOrderField, "NEW_PRODUCT_ADDED", {
            get: function () {
                return "POF_NEW_PRODUCT_ADDED";
            },
            enumerable: true,
            configurable: true
        });
        ProductOrderField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.quantityField = new input_field_7.InputField(document.getElementById(this.id + "-quantity"));
            this.productSearchField = new search_field_2.SearchField(document.getElementById(this.id + "-product"));
            this.addBtn = new button_5.Button(document.getElementById(this.id + "-add"), this.addProduct.bind(this));
            this.listEl = this.root.getElementsByClassName('po-field-list')[0];
        };
        ProductOrderField.prototype.addProduct = function (e) {
            e.preventDefault();
            var valid = this.validateAdd();
            if (valid) {
                var data = {};
                data['quantity'] = this.quantityField.getValue();
                data['product_id'] = this.productSearchField.getValue();
                data['check_range'] = this.enableCheckRange ? 1 : 0;
                data = system_7.System.addCsrf(data);
                this.addBtn.disable(true);
                $.ajax({
                    url: system_7.System.getBaseUrl() + "/order/add-product-to-order",
                    data: data,
                    context: this,
                    method: 'post',
                    dataType: 'json',
                    success: function (data) {
                        if (parseInt(data.status) === 1) {
                            this.addNewProductToElement(data.views);
                        }
                        else {
                            this.productSearchField.showError(data.errors.quantity);
                        }
                        this.addBtn.disable(false);
                    },
                    error: function (data) {
                        this.addBtn.disable(false);
                    }
                });
            }
        };
        ProductOrderField.prototype.addNewProductToElement = function (views) {
            this.listEl.innerHTML += views;
            var wrapper = document.createElement('div');
            wrapper.innerHTML = views;
            var rawElements = wrapper.getElementsByClassName('pof-item');
            var item = new product_order_field_item_1.ProductOrderFieldItem(rawElements.item(0));
            this.products.push(item);
            this.dispatchProductAddedEvent();
            this.productSearchField.resetValue();
            this.productSearchField.emptyText();
            this.quantityField.setValue(null);
        };
        ProductOrderField.prototype.dispatchProductAddedEvent = function () {
            this.root.dispatchEvent(this.newProductAdded);
        };
        ProductOrderField.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.newProductAdded = new CustomEvent(ProductOrderField.NEW_PRODUCT_ADDED);
        };
        ProductOrderField.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ProductOrderField.prototype.getValue = function () {
            var values = [];
            for (var i = 0; i < this.products.length; i++) {
                values.push(this.products[i].getValue());
            }
            return values;
        };
        ProductOrderField.prototype.getTotalPrice = function () {
            var price = 0;
            for (var i = 0; i < this.products.length; i++) {
                price += this.products[i].getQuantity() * this.products[i].getPrice();
            }
            return price;
        };
        ProductOrderField.prototype.getTotalQuantity = function () {
            var quantity = 0;
            for (var i = 0; i < this.products.length; i++) {
                quantity += this.products[i].getQuantity();
            }
            return quantity;
        };
        ProductOrderField.prototype.getTotalWeight = function () {
            var weight = 0;
            for (var i = 0; i < this.products.length; i++) {
                weight += this.products[i].getWeight();
            }
            return weight;
        };
        ProductOrderField.prototype.validateAdd = function () {
            this.productSearchField.hideError();
            this.quantityField.hideError();
            var valid = true;
            valid = this.checkExistence(this.productSearchField.getValue()) && valid;
            valid = this.checkRange() && valid;
            return valid;
        };
        ProductOrderField.prototype.checkRange = function () {
            if (parseInt(this.quantityField.getValue()) > 0) {
                return true;
            }
            this.productSearchField.showError("Quantity should be larger than 0");
            return false;
        };
        ProductOrderField.prototype.checkExistence = function (id) {
            for (var i = 0; i < this.products.length; i++) {
                if (this.products[i].getId() == id) {
                    this.productSearchField.showError("Product has been added");
                    return false;
                }
            }
            return true;
        };
        ProductOrderField.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return ProductOrderField;
    }(field_4.Field));
    exports.ProductOrderField = ProductOrderField;
});
define("common/checkbox-field", ["require", "exports", "common/Field"], function (require, exports, Field_2) {
    "use strict";
    var CheckboxField = (function (_super) {
        __extends(CheckboxField, _super);
        function CheckboxField(root) {
            return _super.call(this, root) || this;
        }
        CheckboxField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.inputElement = this.root.getElementsByClassName('checkbox-field-item')[0];
        };
        CheckboxField.prototype.bindEvent = function () {
        };
        CheckboxField.prototype.detach = function () {
            this.inputElement = null;
        };
        CheckboxField.prototype.getValue = function () {
            return this.inputElement.checked;
        };
        return CheckboxField;
    }(Field_2.Field));
    exports.CheckboxField = CheckboxField;
});
define("common/radio-field", ["require", "exports", "common/Field"], function (require, exports, Field_3) {
    "use strict";
    var RadioField = (function (_super) {
        __extends(RadioField, _super);
        function RadioField(root) {
            return _super.call(this, root) || this;
        }
        RadioField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.inputElements = [];
            var rawInputs = this.root.getElementsByClassName('radio-field-item');
            for (var i = 0; i < rawInputs.length; i++) {
                this.inputElements.push(rawInputs.item(i));
            }
        };
        RadioField.prototype.bindEvent = function () {
        };
        RadioField.prototype.detach = function () {
        };
        RadioField.prototype.getValue = function () {
            for (var i = 0; i < this.inputElements.length; i++) {
                if (this.inputElements[i].checked) {
                    return this.inputElements[i].value;
                }
            }
            return null;
        };
        return RadioField;
    }(Field_3.Field));
    exports.RadioField = RadioField;
});
define("project/create-order-form", ["require", "exports", "common/form", "common/button", "common/search-field", "project/product-order-field", "common/checkbox-field", "common/system", "common/radio-field", "common/input-field"], function (require, exports, form_6, button_6, search_field_3, product_order_field_1, checkbox_field_1, system_8, radio_field_1, input_field_8) {
    "use strict";
    var CreateOrderForm = (function (_super) {
        __extends(CreateOrderForm, _super);
        function CreateOrderForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.href = system_8.System.getBaseUrl() + "/order/list";
            };
            _this.registerFields([_this.senderField, _this.receiverField, _this.productOrderField, _this.marketplaceField,
                _this.courierField, _this.cityField, _this.dropshipField, _this.offlineOrderField, _this.pickupField,
                _this.districtField, _this.paperTypeField, _this.jobCodeField, _this.printLabelField, _this.printInvoiceField]);
            _this.setRequiredField([_this.senderField, _this.receiverField, _this.courierField, _this.marketplaceField, _this.productOrderField,
                _this.cityField, _this.districtField, _this.paperTypeField, _this.jobCodeField]);
            return _this;
        }
        Object.defineProperty(CreateOrderForm, "TRIGGER_USER_FORM_EVENT", {
            get: function () { return "CO_FORM_TRIGGER_USER_FORM_EVENT"; },
            enumerable: true,
            configurable: true
        });
        ;
        Object.defineProperty(CreateOrderForm, "OLD_INDEX", {
            get: function () { return 0; },
            enumerable: true,
            configurable: true
        });
        Object.defineProperty(CreateOrderForm, "NEW_INDEX", {
            get: function () { return 1; },
            enumerable: true,
            configurable: true
        });
        CreateOrderForm.prototype.rules = function () {
        };
        CreateOrderForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.addUserBtn = new button_6.Button(document.getElementById(this.id + "-add-user-1"), this.triggerUserFormEvent.bind(this));
            this.receiverField = new search_field_3.SearchField(document.getElementById(this.id + "-receiver-field"));
            this.paperTypeField = new radio_field_1.RadioField(document.getElementById(this.id + "-paper-size"));
            this.senderField = new search_field_3.SearchField(document.getElementById(this.id + "-sender-field"));
            this.productOrderField = new product_order_field_1.ProductOrderField(document.getElementById(this.id + "-po-field"));
            this.marketplaceField = new search_field_3.SearchField(document.getElementById(this.id + "-marketplace"));
            this.courierField = new search_field_3.SearchField(document.getElementById(this.id + "-courier"));
            this.cityField = new search_field_3.SearchField(document.getElementById(this.id + "-city"));
            this.districtField = new search_field_3.SearchField(document.getElementById(this.id + "-district"));
            this.totalPriceElement = this.root.getElementsByClassName('co-form-price')[0];
            this.totalQuantityElement = this.root.getElementsByClassName('co-form-quantity')[0];
            this.totalWeightElement = this.root.getElementsByClassName('co-form-weight')[0];
            this.tariffElement = this.root.getElementsByClassName('co-form-tariff')[0];
            this.offlineOrderField = new checkbox_field_1.CheckboxField(document.getElementById(this.id + "-offline-order"));
            this.dropshipField = new checkbox_field_1.CheckboxField(document.getElementById(this.id + "-dropship"));
            this.printInvoiceField = new checkbox_field_1.CheckboxField(document.getElementById(this.id + "-print-invoice"));
            this.printLabelField = new checkbox_field_1.CheckboxField(document.getElementById(this.id + "-label"));
            this.pickupField = new input_field_8.InputField(document.getElementById(this.id + "-pickup"));
            this.jobCodeField = new input_field_8.InputField(document.getElementById(this.id + "-jobcode"));
        };
        CreateOrderForm.prototype.triggerUserFormEvent = function (e) {
            e.preventDefault();
            this.root.dispatchEvent(this.userFormEvent);
        };
        CreateOrderForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.userFormEvent = new CustomEvent(CreateOrderForm.TRIGGER_USER_FORM_EVENT);
            this.courierField.attachEvent(search_field_3.SearchField.GET_VALUE_EVENT, this.enableCityField.bind(this));
            this.courierField.attachEvent(search_field_3.SearchField.LOSE_VALUE_EVENT, this.disableCityField.bind(this));
            this.cityField.attachEvent(search_field_3.SearchField.GET_VALUE_EVENT, this.enableDistrictField.bind(this));
            this.cityField.attachEvent(search_field_3.SearchField.LOSE_VALUE_EVENT, this.disableDistrictField.bind(this));
            this.productOrderField.attachEvent(product_order_field_1.ProductOrderField.NEW_PRODUCT_ADDED, this.updateLabel.bind(this));
            this.districtField.attachEvent(search_field_3.SearchField.GET_VALUE_EVENT, this.updateTariff.bind(this));
            this.districtField.attachEvent(search_field_3.SearchField.LOSE_VALUE_EVENT, this.resetTariff.bind(this));
        };
        CreateOrderForm.prototype.resetTariff = function () {
            this.setTariff(0);
        };
        CreateOrderForm.prototype.setTotalPrice = function (price) {
            this.totalPriceElement.innerHTML = "" + price;
        };
        CreateOrderForm.prototype.setTotalQuantity = function (quantity) {
            this.totalQuantityElement.innerHTML = "" + quantity;
        };
        CreateOrderForm.prototype.setTotalWeight = function (weight) {
            this.totalWeightElement.innerHTML = "" + weight;
        };
        CreateOrderForm.prototype.setTariff = function (tariff) {
            this.tariffElement.innerHTML = "" + tariff;
        };
        CreateOrderForm.prototype.updateLabel = function () {
            this.setTotalQuantity(this.productOrderField.getTotalQuantity());
            this.setTotalWeight(this.productOrderField.getTotalWeight());
            this.setTotalPrice(this.productOrderField.getTotalPrice());
        };
        CreateOrderForm.prototype.enableCityField = function () {
            this.cityField.enable();
            var data = [];
            data['courier_code'] = this.courierField.getValue();
            this.cityField.setAdditionalData(data);
        };
        CreateOrderForm.prototype.disableCityField = function () {
            this.cityField.disable();
            this.cityField.resetValue();
        };
        CreateOrderForm.prototype.disableDistrictField = function () {
            this.districtField.disable();
            this.districtField.resetValue();
        };
        CreateOrderForm.prototype.enableDistrictField = function () {
            this.districtField.enable();
            var data = [];
            data['city_id'] = this.cityField.getValue();
            data['courier_code'] = this.courierField.getValue();
            this.districtField.setAdditionalData(data);
        };
        CreateOrderForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateOrderForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        CreateOrderForm.prototype.updateTariff = function () {
            var data = {};
            data["district_id"] = this.districtField.getValue();
            data["courier_code"] = this.courierField.getValue();
            $.ajax({
                url: system_8.System.getBaseUrl() + "/order/get-tariff",
                method: "get",
                data: data,
                dataType: "json",
                context: this,
                success: function (data) {
                    if (data.status != 1) {
                        this.setTariff(0);
                    }
                    else {
                        this.setTariff(data.tariff);
                    }
                }
            });
        };
        return CreateOrderForm;
    }(form_6.Form));
    exports.CreateOrderForm = CreateOrderForm;
});
define("common/text-area-field", ["require", "exports", "common/Field"], function (require, exports, Field_4) {
    "use strict";
    var TextAreaField = (function (_super) {
        __extends(TextAreaField, _super);
        function TextAreaField(root) {
            return _super.call(this, root) || this;
        }
        TextAreaField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.inputElement = this.root.getElementsByClassName('text-area-field-edit')[0];
        };
        TextAreaField.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        TextAreaField.prototype.getValue = function () {
            return this.inputElement.innerHTML;
        };
        TextAreaField.prototype.resetValue = function () {
            this.inputElement.innerHTML = null;
        };
        return TextAreaField;
    }(Field_4.Field));
    exports.TextAreaField = TextAreaField;
});
define("project/add-user-form", ["require", "exports", "common/form", "common/input-field", "common/text-area-field"], function (require, exports, form_7, input_field_9, text_area_field_1) {
    "use strict";
    var AddUserForm = (function (_super) {
        __extends(AddUserForm, _super);
        function AddUserForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                this.root.dispatchEvent(this.successfullyAddedEvent);
            }.bind(_this);
            return _this;
        }
        Object.defineProperty(AddUserForm, "SUCCESSFULLY_ADDED", {
            get: function () { return "AU_FORM_SUCCESSFULLY_ADDED"; },
            enumerable: true,
            configurable: true
        });
        ;
        AddUserForm.prototype.rules = function () {
            this.setRequiredField([this.firstNameField]);
            this.registerFields([this.firstNameField, this.lastNameField, this.telpField, this.addrField]);
        };
        AddUserForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.firstNameField = new input_field_9.InputField(document.getElementById(this.id + "-first-name"));
            this.lastNameField = new input_field_9.InputField(document.getElementById(this.id + "-last-name"));
            this.telpField = new input_field_9.InputField(document.getElementById(this.id + "-telephone"));
            this.addrField = new text_area_field_1.TextAreaField(document.getElementById(this.id + "-address"));
        };
        AddUserForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.successfullyAddedEvent = new CustomEvent(AddUserForm.SUCCESSFULLY_ADDED);
        };
        AddUserForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AddUserForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AddUserForm;
    }(form_7.Form));
    exports.AddUserForm = AddUserForm;
});
define("project/add-user-form-modal", ["require", "exports", "common/modal", "project/add-user-form"], function (require, exports, modal_1, add_user_form_1) {
    "use strict";
    var AddUserFormModal = (function (_super) {
        __extends(AddUserFormModal, _super);
        function AddUserFormModal(root) {
            return _super.call(this, root) || this;
        }
        AddUserFormModal.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new add_user_form_1.AddUserForm(document.getElementById(this.id + "-form"));
        };
        AddUserFormModal.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.form.attachEvent(add_user_form_1.AddUserForm.SUCCESSFULLY_ADDED, function () {
                this.hide();
            }.bind(this));
        };
        AddUserFormModal.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AddUserFormModal.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AddUserFormModal;
    }(modal_1.Modal));
    exports.AddUserFormModal = AddUserFormModal;
});
define("project/create-order", ["require", "exports", "common/component", "project/create-order-form", "project/add-user-form-modal"], function (require, exports, component_12, create_order_form_1, add_user_form_modal_1) {
    "use strict";
    var CreateOrder = (function (_super) {
        __extends(CreateOrder, _super);
        function CreateOrder(root) {
            return _super.call(this, root) || this;
        }
        CreateOrder.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new create_order_form_1.CreateOrderForm(document.getElementById(this.id + "-form"));
            this.addUserFormModal = new add_user_form_modal_1.AddUserFormModal(document.getElementById(this.id + "-usermodal"));
        };
        CreateOrder.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.form.attachEvent(create_order_form_1.CreateOrderForm.TRIGGER_USER_FORM_EVENT, this.showAddUserFormModal.bind(this));
        };
        CreateOrder.prototype.showAddUserFormModal = function () {
            this.addUserFormModal.show();
        };
        CreateOrder.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateOrder.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateOrder;
    }(component_12.Component));
    exports.CreateOrder = CreateOrder;
});
define("project/order-list", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_13, button_7, system_9) {
    "use strict";
    var OrderList = (function (_super) {
        __extends(OrderList, _super);
        function OrderList(root) {
            return _super.call(this, root) || this;
        }
        OrderList.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            var rejects = this.root.getElementsByClassName('order-list-rej');
            this.rejectBtns = [];
            for (var i = 0; i < rejects.length; i++) {
                var btn = new button_7.Button(rejects.item(i), this.clickRejectBtn.bind(this));
                this.rejectBtns.push(btn);
            }
            var accepts = this.root.getElementsByClassName('order-list-acc');
            this.acceptBtns = [];
            for (var i = 0; i < accepts.length; i++) {
                var btn = new button_7.Button(accepts.item(i), this.clickAcceptBtn.bind(this));
                this.acceptBtns.push(btn);
            }
        };
        OrderList.prototype.clickRejectBtn = function (e) {
            var data = {};
            data['order_id'] = e.currentTarget.getAttribute('data-order-id');
            data = system_9.System.addCsrf(data);
            $.ajax({
                url: system_9.System.getBaseUrl() + "/order/reject",
                method: "post",
                data: data,
                dataType: "json",
                context: this,
                success: function (data) {
                    if (data.status == 1) {
                        window.location.reload();
                    }
                },
                error: function (data) {
                }
            });
        };
        OrderList.prototype.clickAcceptBtn = function (e) {
            var data = {};
            data['order_id'] = e.currentTarget.getAttribute('data-order-id');
            data = system_9.System.addCsrf(data);
            $.ajax({
                url: system_9.System.getBaseUrl() + "/order/accept",
                method: "post",
                data: data,
                dataType: "json",
                context: this,
                success: function (data) {
                    if (data.status == 1) {
                        window.location.reload();
                    }
                },
                error: function (data) {
                }
            });
        };
        OrderList.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        OrderList.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        OrderList.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return OrderList;
    }(component_13.Component));
    exports.OrderList = OrderList;
});
define("common/redactor-field", ["require", "exports", "common/Field"], function (require, exports, Field_5) {
    "use strict";
    var RedactorField = (function (_super) {
        __extends(RedactorField, _super);
        function RedactorField(root) {
            return _super.call(this, root) || this;
        }
        RedactorField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.inputElement = this.root.getElementsByClassName('redactor-editor')[0];
        };
        RedactorField.prototype.bindEvent = function () {
        };
        RedactorField.prototype.detach = function () {
            this.inputElement = null;
        };
        RedactorField.prototype.unbindEvent = function () {
        };
        RedactorField.prototype.getValue = function () {
            if (this.inputElement.innerHTML.length === 8) {
                return null;
            }
            return this.inputElement.innerHTML;
        };
        RedactorField.prototype.disable = function () {
            this.inputElement.setAttribute('disabled', "true");
        };
        RedactorField.prototype.enable = function () {
            this.inputElement.removeAttribute('disabled');
        };
        return RedactorField;
    }(Field_5.Field));
    exports.RedactorField = RedactorField;
});
define("project/create-news-form", ["require", "exports", "common/form", "common/redactor-field", "common/system"], function (require, exports, form_8, redactor_field_1, system_10) {
    "use strict";
    var CreateNewsForm = (function (_super) {
        __extends(CreateNewsForm, _super);
        function CreateNewsForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.href = system_10.System.getBaseUrl() + "/dashboard/index";
            };
            return _this;
        }
        CreateNewsForm.prototype.rules = function () {
            this.registerFields([this.redactor]);
            this.setRequiredField([this.redactor]);
        };
        CreateNewsForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.redactor = new redactor_field_1.RedactorField(document.getElementById(this.id + "-input"));
        };
        CreateNewsForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CreateNewsForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateNewsForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateNewsForm;
    }(form_8.Form));
    exports.CreateNewsForm = CreateNewsForm;
});
define("project/create-news", ["require", "exports", "common/component", "project/create-news-form"], function (require, exports, component_14, create_news_form_1) {
    "use strict";
    var CreateNews = (function (_super) {
        __extends(CreateNews, _super);
        function CreateNews(root) {
            return _super.call(this, root) || this;
        }
        CreateNews.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new create_news_form_1.CreateNewsForm(document.getElementById(this.id + "-form"));
        };
        CreateNews.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CreateNews.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateNews.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateNews;
    }(component_14.Component));
    exports.CreateNews = CreateNews;
});
define("project/restock-form", ["require", "exports", "common/form", "common/search-field", "project/product-order-field"], function (require, exports, form_9, search_field_4, product_order_field_2) {
    "use strict";
    var RestockForm = (function (_super) {
        __extends(RestockForm, _super);
        function RestockForm(root) {
            return _super.call(this, root) || this;
        }
        RestockForm.prototype.rules = function () {
            this.setRequiredField([this.supplierField]);
            this.registerFields([this.productOrderField, this.supplierField]);
        };
        RestockForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.supplierField = new search_field_4.SearchField(document.getElementById(this.id + "-supplier"));
            this.productOrderField = new product_order_field_2.ProductOrderField(document.getElementById(this.id + "-po-field"));
        };
        RestockForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        RestockForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        RestockForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return RestockForm;
    }(form_9.Form));
    exports.RestockForm = RestockForm;
});
define("project/restock", ["require", "exports", "common/component", "project/restock-form"], function (require, exports, component_15, restock_form_1) {
    "use strict";
    var Restock = (function (_super) {
        __extends(Restock, _super);
        function Restock(root) {
            return _super.call(this, root) || this;
        }
        Restock.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new restock_form_1.RestockForm(document.getElementById(this.id + "-form"));
        };
        Restock.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        Restock.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        Restock.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return Restock;
    }(component_15.Component));
    exports.Restock = Restock;
});
define("project/create-supplier-form", ["require", "exports", "common/form", "common/input-field", "common/text-area-field", "common/system"], function (require, exports, form_10, input_field_10, text_area_field_2, system_11) {
    "use strict";
    var CreateSupplierForm = (function (_super) {
        __extends(CreateSupplierForm, _super);
        function CreateSupplierForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.href = system_11.System.getBaseUrl() + "/supplier/list";
            };
            return _this;
        }
        CreateSupplierForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.companyName = new input_field_10.InputField(document.getElementById(this.id + "-name"));
            this.firstName = new input_field_10.InputField(document.getElementById(this.id + "-supp-first-name"));
            this.lastName = new input_field_10.InputField(document.getElementById(this.id + "-supp-last-name"));
            this.email = new input_field_10.InputField(document.getElementById(this.id + "-supp-email"));
            this.phone = new input_field_10.InputField(document.getElementById(this.id + "-phone"));
            this.address = new text_area_field_2.TextAreaField(document.getElementById(this.id + "-address"));
        };
        CreateSupplierForm.prototype.rules = function () {
            this.setRequiredField([this.companyName, this.firstName, this.lastName, this.email]);
            this.registerFields([this.companyName, this.firstName,
                this.lastName, this.email, this.phone, this.address]);
        };
        CreateSupplierForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CreateSupplierForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateSupplierForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateSupplierForm;
    }(form_10.Form));
    exports.CreateSupplierForm = CreateSupplierForm;
});
define("project/create-supplier", ["require", "exports", "common/component", "project/create-supplier-form"], function (require, exports, component_16, create_supplier_form_1) {
    "use strict";
    var CreateSupplier = (function (_super) {
        __extends(CreateSupplier, _super);
        function CreateSupplier(root) {
            return _super.call(this, root) || this;
        }
        CreateSupplier.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new create_supplier_form_1.CreateSupplierForm(document.getElementById(this.id + "-form"));
        };
        CreateSupplier.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CreateSupplier.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CreateSupplier.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CreateSupplier;
    }(component_16.Component));
    exports.CreateSupplier = CreateSupplier;
});
define("project/list-supplier", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_17, button_8, system_12) {
    "use strict";
    var ListSupplier = (function (_super) {
        __extends(ListSupplier, _super);
        function ListSupplier(root) {
            return _super.call(this, root) || this;
        }
        ListSupplier.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.addBtn = new button_8.Button(document.getElementById(this.id + "-add"), this.redirectToAdd.bind(this));
        };
        ListSupplier.prototype.redirectToAdd = function () {
            window.location.href = system_12.System.getBaseUrl() + "/supplier/create";
        };
        ListSupplier.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        ListSupplier.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ListSupplier.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return ListSupplier;
    }(component_17.Component));
    exports.ListSupplier = ListSupplier;
});
define("project/order-retur-field", ["require", "exports", "common/Field", "common/input-field"], function (require, exports, field_5, input_field_11) {
    "use strict";
    var OrderReturField = (function (_super) {
        __extends(OrderReturField, _super);
        function OrderReturField(root) {
            return _super.call(this, root) || this;
        }
        OrderReturField.prototype.validate = function () {
            var valid = true;
            for (var i = 0; i < this.total; i++) {
                this.returFields[i].hideError();
                this.effectFields[i].hideError();
                if (this.returFields[i].getValue() > 0) {
                    if (parseInt(this.quantityFields[i].getValue()) <
                        parseInt(this.returFields[i].getValue())) {
                        this.returFields[i].showError("Jumlah barang rusak tidak dapat lebih besar dari inventory");
                        valid = valid && false;
                    }
                    if (parseInt(this.returFields[i].getValue()) <
                        parseInt(this.effectFields[i].getValue())) {
                        this.effectFields[i].showError("Jumlah barang yang effect tidak dapat lebih besar dari retur");
                        valid = valid && false;
                    }
                }
            }
            return valid;
        };
        OrderReturField.prototype.getValue = function () {
            if (!this.validate()) {
                return null;
            }
            var values = [];
            for (var i = 0; i < this.total; i++) {
                if (this.returFields[i].getValue() > 0) {
                    var value = {
                        id: this.idFields[i].getValue(),
                        retur: this.returFields[i].getValue(),
                        remark: this.remarkFields[i].getValue(),
                        effect: this.effectFields[i].getValue()
                    };
                    values.push(value);
                }
            }
            return values;
        };
        OrderReturField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.total = parseInt(this.root.getAttribute('data-total'));
            this.effectFields = [];
            this.remarkFields = [];
            this.idFields = [];
            this.quantityFields = [];
            this.returFields = [];
            for (var i = 0; i < this.total; i++) {
                this.effectFields.push(new input_field_11.InputField(document.getElementById(this.id + "-effect-" + i)));
                this.remarkFields.push(new input_field_11.InputField(document.getElementById(this.id + "-remark-" + i)));
                this.quantityFields.push(new input_field_11.InputField(document.getElementById(this.id + "-quantity-" + i)));
                this.returFields.push(new input_field_11.InputField(document.getElementById(this.id + "-retur-" + i)));
                this.idFields.push(new input_field_11.InputField(document.getElementById(this.id + "-id-" + i)));
            }
        };
        OrderReturField.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            for (var i = 0; i < this.returFields.length; i++) {
                this.returFields[i].attachEvent('input', this.checkReturValue.bind(this, [i]));
            }
        };
        OrderReturField.prototype.checkReturValue = function (i) {
            if (this.returFields[i].getValue() > 0) {
                this.enableRemarkEffectField(i);
            }
            else {
                this.disableRemarkEffectField(i);
            }
        };
        OrderReturField.prototype.enableRemarkEffectField = function (i) {
            this.remarkFields[i].enable();
            this.effectFields[i].enable();
            this.effectFields[i].setMax((this.returFields[i].getValue()));
            this.remarkFields[i].setValue(null);
            this.effectFields[i].setValue(0 + "");
        };
        OrderReturField.prototype.disableRemarkEffectField = function (i) {
            this.remarkFields[i].disable();
            this.effectFields[i].disable();
            this.remarkFields[i].setValue(null);
            this.effectFields[i].setValue(0 + "");
        };
        OrderReturField.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        OrderReturField.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return OrderReturField;
    }(field_5.Field));
    exports.OrderReturField = OrderReturField;
});
define("project/retur-form", ["require", "exports", "common/form", "common/system", "project/order-retur-field", "common/search-field"], function (require, exports, form_11, system_13, order_retur_field_1, search_field_5) {
    "use strict";
    var ReturForm = (function (_super) {
        __extends(ReturForm, _super);
        function ReturForm(root) {
            return _super.call(this, root) || this;
        }
        ReturForm.prototype.rules = function () {
            this.setRequiredField([this.orderId]);
            this.registerFields([this.orderId]);
        };
        ReturForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.orderId = new search_field_5.SearchField(document.getElementById(this.id + "-order"));
            this.area = this.root.getElementsByClassName('retur-form-area')[0];
        };
        ReturForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
            this.orderId.attachEvent(search_field_5.SearchField.GET_VALUE_EVENT, this.retrieveOrderReturField.bind(this));
        };
        ReturForm.prototype.retrieveOrderReturField = function () {
            var data = {};
            data['order_id'] = this.orderId.getValue();
            data = system_13.System.addCsrf(data);
            $.ajax({
                url: system_13.System.getBaseUrl() + "/inventory/get-order-retur-field",
                method: "post",
                dataType: "json",
                data: data,
                context: this,
                success: function (data) {
                    if (parseInt(data.status) !== 1) {
                        return false;
                    }
                    this.updateArea(data.views);
                },
                error: function (data) {
                }
            });
        };
        ReturForm.prototype.updateArea = function (views) {
            this.area.innerHTML = views;
            var wrapper = document.createElement('div');
            wrapper.innerHTML = views;
            var rawElements = wrapper.getElementsByClassName('or-field');
            this.orderReturField =
                new order_retur_field_1.OrderReturField(rawElements.item(0));
            this.setRequiredField([this.orderReturField]);
            this.registerFields([this.orderReturField]);
        };
        ReturForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ReturForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return ReturForm;
    }(form_11.Form));
    exports.ReturForm = ReturForm;
});
define("project/retur", ["require", "exports", "common/component", "project/retur-form"], function (require, exports, component_18, retur_form_1) {
    "use strict";
    var Retur = (function (_super) {
        __extends(Retur, _super);
        function Retur(root) {
            return _super.call(this, root) || this;
        }
        Retur.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new retur_form_1.ReturForm(document.getElementById(this.id + "-form"));
        };
        Retur.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        Retur.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        Retur.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return Retur;
    }(component_18.Component));
    exports.Retur = Retur;
});
define("project/product-adjustment-field-item", ["require", "exports", "common/component", "common/input-field"], function (require, exports, component_19, input_field_12) {
    "use strict";
    var ProductAdjustmentFieldItem = (function (_super) {
        __extends(ProductAdjustmentFieldItem, _super);
        function ProductAdjustmentFieldItem(root) {
            return _super.call(this, root) || this;
        }
        ProductAdjustmentFieldItem.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.idElement = document.getElementById(this.id + "-id");
            this.adjustField = new input_field_12.InputField(document.getElementById(this.id + "-adjust"));
        };
        ProductAdjustmentFieldItem.prototype.getId = function () {
            return this.idElement.innerHTML;
        };
        ProductAdjustmentFieldItem.prototype.getValue = function () {
            return {
                id: this.getId(),
                adjust: parseInt(this.adjustField.getValue())
            };
        };
        ProductAdjustmentFieldItem.prototype.getQuantity = function () {
            return parseInt(this.adjustField.getValue());
        };
        ProductAdjustmentFieldItem.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        ProductAdjustmentFieldItem.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ProductAdjustmentFieldItem.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return ProductAdjustmentFieldItem;
    }(component_19.Component));
    exports.ProductAdjustmentFieldItem = ProductAdjustmentFieldItem;
});
define("project/product-adjustment-field", ["require", "exports", "common/Field", "common/search-field", "common/button", "common/system", "project/product-adjustment-field-item"], function (require, exports, field_6, search_field_6, button_9, system_14, product_adjustment_field_item_1) {
    "use strict";
    var ProductAdjustmentField = (function (_super) {
        __extends(ProductAdjustmentField, _super);
        function ProductAdjustmentField(root) {
            var _this = _super.call(this, root) || this;
            _this.items = [];
            return _this;
        }
        ProductAdjustmentField.prototype.getValue = function () {
            var values = [];
            for (var i = 0; i < this.items.length; i++) {
                if (this.items[i].getQuantity() !== 0) {
                    values.push(this.items[i].getValue());
                }
            }
            if (!values || values.length === 0) {
                return null;
            }
            return values;
        };
        ProductAdjustmentField.prototype.validateAddClient = function () {
            var valid = true;
            this.searchProduct.hideError();
            if (system_14.System.isEmptyValue(this.searchProduct.getValue())) {
                valid = false;
            }
            for (var i = 0; i < this.items.length; i++) {
                if (this.searchProduct.getValue() === this.items[i].getId()) {
                    valid = false;
                    this.searchProduct.showError("Product has ben added");
                }
            }
            return valid;
        };
        ProductAdjustmentField.prototype.addNew = function () {
            if (!this.validateAddClient()) {
                return false;
            }
            this.addBtn.disable(true);
            var data = {};
            data['product_id'] = this.searchProduct.getValue();
            data = system_14.System.addCsrf(data);
            $.ajax({
                url: system_14.System.getBaseUrl() + "/inventory/get-adjustment-item",
                method: "post",
                data: data,
                context: this,
                dataType: "json",
                success: function (data) {
                    this.addBtn.disable(false);
                    if (data.status) {
                        this.addToList(data.views);
                    }
                },
                error: function (data) {
                    this.addBtn.disable(false);
                }
            });
        };
        ProductAdjustmentField.prototype.addToList = function (views) {
            this.getListElement().innerHTML += views;
            var wrapper = document.createElement('div');
            wrapper.innerHTML = views;
            var rawElements = wrapper.getElementsByClassName('paf-item');
            var item = new product_adjustment_field_item_1.ProductAdjustmentFieldItem(rawElements.item(0));
            this.items.push(item);
        };
        ProductAdjustmentField.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.searchProduct = new search_field_6.SearchField(document.getElementById(this.id + "-product"));
            this.addBtn = new button_9.Button(document.getElementById(this.id + "-add"), this.addNew.bind(this));
        };
        ProductAdjustmentField.prototype.getListElement = function () {
            return this.root.getElementsByClassName('pa-field-list')[0];
        };
        ProductAdjustmentField.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        ProductAdjustmentField.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        ProductAdjustmentField.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return ProductAdjustmentField;
    }(field_6.Field));
    exports.ProductAdjustmentField = ProductAdjustmentField;
});
define("project/adjustment-stock-form", ["require", "exports", "common/form", "project/product-adjustment-field", "common/text-area-field", "common/system"], function (require, exports, form_12, product_adjustment_field_1, text_area_field_3, system_15) {
    "use strict";
    var AdjustmentStockForm = (function (_super) {
        __extends(AdjustmentStockForm, _super);
        function AdjustmentStockForm(root) {
            var _this = _super.call(this, root) || this;
            _this.successCb = function (data) {
                window.location.href = system_15.System.getBaseUrl() + "/inventory/list";
            };
            return _this;
        }
        AdjustmentStockForm.prototype.rules = function () {
            this.setRequiredField([this.remarkField, this.paField]);
            this.registerFields([this.paField, this.remarkField]);
        };
        AdjustmentStockForm.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.remarkField = new text_area_field_3.TextAreaField(document.getElementById(this.id + "-remark"));
            this.paField = new product_adjustment_field_1.ProductAdjustmentField(document.getElementById(this.id + "adjustment"));
        };
        AdjustmentStockForm.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AdjustmentStockForm.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AdjustmentStockForm.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AdjustmentStockForm;
    }(form_12.Form));
    exports.AdjustmentStockForm = AdjustmentStockForm;
});
define("project/adjustment-stock", ["require", "exports", "common/component", "project/adjustment-stock-form"], function (require, exports, component_20, adjustment_stock_form_1) {
    "use strict";
    var AdjustmentStock = (function (_super) {
        __extends(AdjustmentStock, _super);
        function AdjustmentStock(root) {
            return _super.call(this, root) || this;
        }
        AdjustmentStock.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.form = new adjustment_stock_form_1.AdjustmentStockForm(document.getElementById(this.id + "-form"));
        };
        AdjustmentStock.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AdjustmentStock.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AdjustmentStock.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AdjustmentStock;
    }(component_20.Component));
    exports.AdjustmentStock = AdjustmentStock;
});
define("project/restock-list-lvi", ["require", "exports", "common/component"], function (require, exports, component_21) {
    "use strict";
    var RestockListLVI = (function (_super) {
        __extends(RestockListLVI, _super);
        function RestockListLVI(root) {
            return _super.call(this, root) || this;
        }
        RestockListLVI.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
        };
        RestockListLVI.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        RestockListLVI.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        RestockListLVI.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return RestockListLVI;
    }(component_21.Component));
    exports.RestockListLVI = RestockListLVI;
});
define("project/restock-list", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_22, button_10, system_16) {
    "use strict";
    var RestockList = (function (_super) {
        __extends(RestockList, _super);
        function RestockList(root) {
            return _super.call(this, root) || this;
        }
        RestockList.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.items = [];
            this.addRestockRedirect = new button_10.Button(document.getElementById(this.id + "-add"), this.redirectToAddRestock.bind(this));
        };
        RestockList.prototype.redirectToAddRestock = function () {
            window.location.href = system_16.System.getBaseUrl() + "/inventory/restock";
        };
        RestockList.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        RestockList.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        RestockList.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return RestockList;
    }(component_22.Component));
    exports.RestockList = RestockList;
});
define("project/marketplace-list", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_23, button_11, system_17) {
    "use strict";
    var MarketplaceList = (function (_super) {
        __extends(MarketplaceList, _super);
        function MarketplaceList(root) {
            return _super.call(this, root) || this;
        }
        MarketplaceList.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.addMp = new button_11.Button(document.getElementById(this.id + "-add"), this.redirectToAddMp.bind(this));
        };
        MarketplaceList.prototype.redirectToAddMp = function () {
            window.location.href = system_17.System.getBaseUrl() + "/order/create-marketplace";
        };
        MarketplaceList.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        MarketplaceList.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        MarketplaceList.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return MarketplaceList;
    }(component_23.Component));
    exports.MarketplaceList = MarketplaceList;
});
define("project/adjustment-list-lvi", ["require", "exports", "common/component"], function (require, exports, component_24) {
    "use strict";
    var AdjustmentListLVI = (function (_super) {
        __extends(AdjustmentListLVI, _super);
        function AdjustmentListLVI(root) {
            return _super.call(this, root) || this;
        }
        AdjustmentListLVI.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
        };
        AdjustmentListLVI.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AdjustmentListLVI.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AdjustmentListLVI.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AdjustmentListLVI;
    }(component_24.Component));
    exports.AdjustmentListLVI = AdjustmentListLVI;
});
define("project/adjustment-list", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_25, button_12, system_18) {
    "use strict";
    var AdjustmentList = (function (_super) {
        __extends(AdjustmentList, _super);
        function AdjustmentList(root) {
            return _super.call(this, root) || this;
        }
        AdjustmentList.prototype.redirectToAddButton = function () {
            window.location.href = system_18.System.getBaseUrl() + "/inventory/adjustment";
        };
        AdjustmentList.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.redirectToAdd = new button_12.Button(document.getElementById(this.id + "-add"), this.redirectToAddButton.bind(this));
        };
        AdjustmentList.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        AdjustmentList.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        AdjustmentList.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return AdjustmentList;
    }(component_25.Component));
    exports.AdjustmentList = AdjustmentList;
});
define("project/courier-list", ["require", "exports", "common/component", "common/button", "common/system"], function (require, exports, component_26, button_13, system_19) {
    "use strict";
    var CourierList = (function (_super) {
        __extends(CourierList, _super);
        function CourierList(root) {
            return _super.call(this, root) || this;
        }
        CourierList.prototype.redirectToAddCourier = function () {
            window.location.href = system_19.System.getBaseUrl() + "/order/create-courier";
        };
        CourierList.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            this.addCourier = new button_13.Button(document.getElementById(this.id + "-add"), this.redirectToAddCourier.bind(this));
        };
        CourierList.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        CourierList.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        CourierList.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return CourierList;
    }(component_26.Component));
    exports.CourierList = CourierList;
});
define("project/app", ["require", "exports", "common/component", "project/login", "project/add-product", "project/add-category", "project/order-create-marketplace", "project/order-create-courier", "project/create-order", "project/order-list", "project/create-news", "project/restock", "project/create-supplier", "project/list-supplier", "project/retur", "project/adjustment-stock", "project/restock-list", "project/marketplace-list", "project/adjustment-list", "project/courier-list"], function (require, exports, component_27, login_1, add_product_1, add_category_1, order_create_marketplace_1, order_create_courier_1, create_order_1, order_list_1, create_news_1, restock_1, create_supplier_1, list_supplier_1, retur_1, adjustment_stock_1, restock_list_1, marketplace_list_1, adjustment_list_1, courier_list_1) {
    "use strict";
    var App = (function (_super) {
        __extends(App, _super);
        function App(root) {
            return _super.call(this, root) || this;
        }
        App.prototype.decorate = function () {
            _super.prototype.decorate.call(this);
            if (this.root.getElementsByClassName('login').length !== 0) {
                this.login = new login_1.Login(document.getElementById("lgn"));
            }
            else if (this.root.getElementsByClassName('add-product').length !== 0) {
                this.addProduct = new add_product_1.AddProduct(document.getElementById('ap'));
            }
            else if (this.root.getElementsByClassName('add-category').length !== 0) {
                this.addCategory = new add_category_1.AddCategory(document.getElementById('pac'));
            }
            else if (this.root.getElementsByClassName('order-cm').length !== 0) {
                this.orderCreateMarketplace = new order_create_marketplace_1.OrderCreateMarketplace(document.getElementById("ocm"));
            }
            else if (this.root.getElementsByClassName('order-cc').length !== 0) {
                this.orderCreateCourier = new order_create_courier_1.OrderCreateCourier(document.getElementById("occ"));
            }
            else if (this.root.getElementsByClassName('create-order').length !== 0) {
                this.createOrder = new create_order_1.CreateOrder(document.getElementById("oc"));
            }
            else if (this.root.getElementsByClassName('order-list').length !== 0) {
                this.orderList = new order_list_1.OrderList(document.getElementById("ol"));
            }
            else if (this.root.getElementsByClassName('create-news').length !== 0) {
                this.createNews = new create_news_1.CreateNews(document.getElementById("nc"));
            }
            else if (this.root.getElementsByClassName('restock').length !== 0) {
                this.restock = new restock_1.Restock(document.getElementById("ir"));
            }
            else if (this.root.getElementsByClassName('create-supplier').length !== 0) {
                this.createSupplier = new create_supplier_1.CreateSupplier(document.getElementById("sc"));
            }
            else if (this.root.getElementsByClassName('list-supplier').length !== 0) {
                this.listSupplier = new list_supplier_1.ListSupplier(document.getElementById("sl"));
            }
            else if (this.root.getElementsByClassName('retur').length !== 0) {
                this.retur = new retur_1.Retur(document.getElementById("ire"));
            }
            else if (this.root.getElementsByClassName('adj-stock').length !== 0) {
                this.adjustmentStock = new adjustment_stock_1.AdjustmentStock(document.getElementById("ias"));
            }
            else if (this.root.getElementsByClassName('restock-list').length !== 0) {
                this.restockList = new restock_list_1.RestockList(document.getElementById("irl"));
            }
            else if (this.root.getElementsByClassName('adj-list').length !== 0) {
                this.adjustmentList = new adjustment_list_1.AdjustmentList(document.getElementById("ial"));
            }
            else if (this.root.getElementsByClassName('mp-list').length !== 0) {
                this.marketplaceList = new marketplace_list_1.MarketplaceList(document.getElementById("oml"));
            }
            else if (this.root.getElementsByClassName('courier-list').length !== 0) {
                this.courierList = new courier_list_1.CourierList(document.getElementById("ocl"));
            }
        };
        App.prototype.bindEvent = function () {
            _super.prototype.bindEvent.call(this);
        };
        App.prototype.detach = function () {
            _super.prototype.detach.call(this);
        };
        App.prototype.unbindEvent = function () {
            // no event to unbind
        };
        return App;
    }(component_27.Component));
    exports.App = App;
});
define("project/init", ["require", "exports", "project/app"], function (require, exports, app_1) {
    "use strict";
    var root = document.getElementsByTagName("html")[0];
    var app = new app_1.App(root);
});
