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
        };
        InputField.prototype.triggerValueChangedEvent = function () {
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
define("project/app", ["require", "exports", "common/component", "project/login", "project/add-product", "project/add-category"], function (require, exports, component_9, login_1, add_product_1, add_category_1) {
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
    }(component_9.Component));
    exports.App = App;
});
define("project/init", ["require", "exports", "project/app"], function (require, exports, app_1) {
    "use strict";
    var root = document.getElementsByTagName("html")[0];
    var app = new app_1.App(root);
});
