import {Component} from '../common/component';
import {Button} from './../common/button';
import {System} from './../common/system';

export class OrderList extends Component{

    acceptBtns : Button[];

    rejectBtns : Button[];
    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        
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
   }
    detach() {
        super.detach();
    }
    
    unbindEvent() {
        // no event to unbind
    }
}
