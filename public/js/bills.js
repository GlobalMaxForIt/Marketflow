let bill_info_table = document.getElementsByClassName('bill_info_table')

let bills_history_subtotal = document.getElementById('bills_history_subtotal')
let bills_history_client = document.getElementById('bills_history_client')
let bills_history_discount = document.getElementById('bills_history_discount')
let bills_history_total = document.getElementById('bills_history_total')
let client_title_text = document.getElementById('client_title_text')

let bills_history_data = document.getElementById('bills_history_data')

let client_name = document.getElementById('client_name')
let client_surname = document.getElementById('client_surname')
let client_middlename = document.getElementById('client_middlename')
let client_phone = document.getElementById('client_phone')
let client_image_input = document.getElementById('client_image_input')
let client_email = document.getElementById('client_email')
let client_male = document.getElementById('client_male')
let client_female = document.getElementById('client_female')
let client_address = document.getElementById('client_address')
let client_notes = document.getElementById('client_notes')
let client_region = document.getElementById('region')
let client_district = document.getElementById('district')

let client_full_name_html = document.getElementById('client_full_name')

let client_max_payment = 0
let bill_id = ''
$(document).ready(function () {
    if($('#client_select_id') != undefined && $('#client_select_id') != null){
        $('#client_select_id').select2({
            dropdownParent: $('#select_client') // modal ID ni kiriting
        });
    }
})


let bills_history_html = ''
let client_id = ''
let client_info = {}

let refund_modal_form_url = document.getElementById('refund_modal_form')
function refundBillFunc(url){
    refund_modal_form_url.setAttribute("action", url)
}

function setItem(item, index){
    if(parseInt(item.price.replace(/\s+/g, "")) > parseInt(item.all_price.replace(/\s+/g, ""))){
        bills_history_html = bills_history_html  + `<div class="bill_info d-flex justify-content-between align-items-center">
                                        <div class="width_30_percent d-flex">
                                            <h6 class="me-2">${index+1}.</h6>
                                            <img onclick="showImage('${item.items.product_image}')"  data-bs-toggle="modal" data-bs-target="#images-modal" src="${item.items.product_image}" alt="" width="24px">
                                        </div>
                                        <div class="width_45_percent d-flex flex-column justify-content-center">
                                            <h6>${item.items.product_name}</h6>
                                            <h6>${item.quantity} ${items_text}</h6>
                                        </div>
                                        <div class="width_25_percent text-end bill_info_sum d-flex flex-column">
                                            <h6>${item.all_price} ${sum_text}</h6>
                                            <del class="opacity_1">${item.price} ${sum_text}</del>
                                        </div>
                                    </div>`
    }else{
        bills_history_html = bills_history_html  + `<div class="bill_info d-flex justify-content-between align-items-center">
                                        <div class="width_30_percent d-flex">
                                            <h6 class="me-2">${index+1}.</h6>
                                            <img onclick="showImage('${item.items.product_image}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="${item.items.product_image}" alt="" height="44px">
                                        </div>
                                        <div class="width_45_percent d-flex flex-column justify-content-center">
                                            <h6>${item.items.product_name}</h6>
                                            <h6>${item.quantity} ${items_text}</h6>
                                        </div>
                                        <div class="width_25_percent text-end bill_info_sum"><h6>${item.price} ${sum_text}</h6></div>
                                    </div>`
    }
}

function setData(item) {
    bills_history_data.innerHTML = ''
    bills_history_html = ''
    if(item != null && item != undefined){
        item.forEach((item_, index_) =>{
            setItem(item_, index_)
        });
    }
    bills_history_data.innerHTML = bills_history_html

}

function showBillInfo(this_element, sales_data, price, discount_price, total_amount, return_amount, saleId, client_full_name, client_discount_price){
    bills_history_subtotal.textContent = ''
    bills_history_discount.textContent = ''
    bills_history_total.textContent = ''
    bills_history_client.textContent = ''

    bill_id = saleId
    let pay_total_amount = parseInt(total_amount.split(' ').join(''))
    let pay_return_amount = parseInt(return_amount.split(' ').join(''))
    if(pay_return_amount>0){
        client_max_payment = pay_return_amount
    }else if(pay_total_amount>0){
        client_max_payment = pay_total_amount
    }else{
        client_max_payment = 0
    }

    for(let j=0; j<bill_info_table.length; j++){
        if(bill_info_table[j].classList.contains('active')){
            bill_info_table[j].classList.remove('active')
        }
    }
    if(!this_element.classList.contains('active')){
        this_element.classList.add('active')
    }
    bills_history_html = ''

    bills_history_subtotal.textContent = price +' '+ sum_text
    bills_history_client.textContent = client_discount_price +' '+ sum_text
    bills_history_discount.textContent = discount_price +' '+ sum_text
    bills_history_total.textContent = total_amount +' '+ sum_text
    client_title_text.setAttribute('data-bs-content', client_full_name)

    setData(sales_data);
}

function removeActive(){
    for(let j=0; j<bill_info_table.length; j++){
        if(bill_info_table[j].classList.contains('active')){
            bill_info_table[j].classList.remove('active')
        }
    }
}

client_title_text.addEventListener('click', function () {

})