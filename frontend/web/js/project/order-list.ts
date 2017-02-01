import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';
import {DropdownField} from './../common/dropdown-field';
import {PrintOrderModal} from './print-order-modal';

export class OrderList extends Component{

    acceptBtns : Button[];

    rejectBtns : Button[];

    redirectAdd : Button;

    actions  : DropdownField[];

    printOrderModal : PrintOrderModal;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    redirectToAddOrder() {
        window.location.href = System.getBaseUrl() + "/order/create";
    }
    
    decorate() {
        super.decorate();
        this.redirectAdd = new Button(document.getElementById(this.id + "-add"), 
                    this.redirectToAddOrder.bind(this));
        let rejects : NodeListOf<Element> = this.root.getElementsByClassName('order-list-rej');
        this.rejectBtns = [];
        for(let i = 0 ; i  < rejects.length; i++) {
            let btn : Button = new Button(<HTMLElement> rejects.item(i),
                                         this.clickRejectBtn.bind(this));
            this.rejectBtns.push(btn);
        }

        let accepts : NodeListOf<Element> = this.root.getElementsByClassName('order-list-acc');
        this.acceptBtns = [];
        for(let i = 0; i < accepts.length; i++) {
            let btn : Button = new Button(<HTMLElement> accepts.item(i), this.clickAcceptBtn.bind(this));
            this.acceptBtns.push(btn);
        }

        this.actions = [];
        let rawActions : NodeListOf<Element> = this.root.getElementsByClassName('order-list-action');
        for(let i = 0; i < rawActions.length; i++) {
            let dropdown : DropdownField = new DropdownField(<HTMLElement> rawActions.item(i));
            this.actions.push(dropdown);
        }
        this.printOrderModal = new PrintOrderModal(document.getElementById(this.id + "-modal"));
    }


    clickRejectBtn(e : Event) {
        let data = {};
        data['order_id'] = (<HTMLElement>e.currentTarget).getAttribute('data-order-id');
        data = System.addCsrf(data);
        $.ajax({
            url : System.getBaseUrl() + "/order/reject",
            method : "post", 
            data : data,
            dataType : "json",
            context : this,
            success : function(data) {
                if(data.status == 1) {
                    window.location.reload();
                }
            },
            error : function(data) {

            }
        });
    }

    clickAcceptBtn(e : Event) {
        let data = {};
        data['order_id'] = (<HTMLElement>e.currentTarget).getAttribute('data-order-id');
        data = System.addCsrf(data);
        $.ajax({
            url : System.getBaseUrl() + "/order/accept",
            method : "post", 
            data : data,
            dataType: "json",
            context : this,
            success : function(data) {
                if(data.status == 1) {
                    window.location.reload();
                }
            },
            error : function(data) {

            }
        });
    }
    
    bindEvent() {
        super.bindEvent();
        for(let i = 0; i < this.actions.length; i++) {
            this.actions[i].attachEvent(DropdownField.CHANGE_VALUE, 
                    this.changeActionEvent.bind(this, this.actions[i]));
        }
    }

    changeActionEvent(df : DropdownField) {  
        let value : string = <string>df.getValue();
        let data = {};
        data['new_status'] = value;
        data['order_id'] = df.getRoot().getAttribute('data-order-id');

        if(value === 'print') {
            this.printOrderModal.show();
            this.printOrderModal.setOrderId(data['order_id']);
        } else {
            data = System.addCsrf(data);
            df.disable();
            $.ajax({
                url : System.getBaseUrl() + "/order/change-status",
                method : "post", 
                data : data,
                dataType: "json",
                context : this,
                success : function(data) {
                    df.enable();
                    if(data.status == 1) {
                        window.location.reload();
                    }
                },
                error : function(data) {
                    df.enable();
                }
            });
        }
    }
    
    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
