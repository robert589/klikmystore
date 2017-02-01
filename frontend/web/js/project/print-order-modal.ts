import {Modal} from '../common/modal';
import {System} from './../common/system';

export class PrintOrderModal extends Modal{

    loading : HTMLElement;

    view : HTMLElement;

    constructor(root: HTMLElement) {
        super(root);
    }
    
    decorate() {
        super.decorate();
        this.loading = <HTMLElement> this.root.getElementsByClassName('po-modal-loading')[0];
        this.view = <HTMLElement> this.root.getElementsByClassName('po-modal-view')[0];  
          
    }

    setOrderId(id : string) {
        let data = {};
        data['order_id'] = id;
        data = System.addCsrf(data);
        $.ajax({
            url : System.getBaseUrl() + "/order/get-print-view",
            data: data,
            context : this,
            method : "POST",
            dataType: "json",
            success : function(data) {
                if(data.status) {
                    this.loading.classList.add('app-hide');
                    this.view.innerHTML = data.views;
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
