let bill_info_table = document.getElementsByClassName('bill_info_table')

let bills_history_subtotal = document.getElementById('bills_history_subtotal')
let bills_history_client = document.getElementById('bills_history_client')
let bills_history_discount = document.getElementById('bills_history_discount')
let bills_history_total = document.getElementById('bills_history_total')
let client_title_text = document.getElementById('client_title_text')

let payment_history_data = document.getElementById('payment_history_data')

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
let payment_history_code = document.getElementById('payment_history_code')
let product_full_info_alert = document.getElementById('product_full_info_alert')
let return_modal_button = document.getElementById('return_modal_button')

let client_full_name_html = document.getElementById('client_full_name')
let return_modal_title = document.getElementById('return_modal_title')
let return_modal_body = document.getElementById('return_modal_body')

let client_max_payment = 0
let bill_id = ''
let stock_int = 0

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
        bills_history_html = bills_history_html  + `<div class="bill_info d-flex justify-content-between align-items-center client_selected_product_row">
                                        <div class="width_30_percent d-flex">
                                            <h6 class="me-2">${index+1}.</h6>
                                            <img onclick="showImage('${item.items.product_image}')"  data-bs-toggle="modal" data-bs-target="#images-modal" src="${item.items.product_image}" alt="" width="24px">
                                        </div>
                                        <div class="width_45_percent d-flex flex-column justify-content-center">
                                            <h6>${item.items.name + ' '+ item.items.amount}</h6>
                                            <h6>${item.quantity} ${item.items.unit}</h6>
                                            <h6 id="payment_product_amount"></h6>
                                        </div>
                                        <div class="width_25_percent text-end bill_info_sum d-flex flex-column">
                                            <h6 id="payment_product_all_price">${item.all_price} ${sum_text}</h6>
                                            <del class="opacity_1">${item.price} ${sum_text}</del>
                                            <h6 id="payment_product_return_price"></h6>
                                        </div>
                                        <a data-product='${JSON.stringify({
                                                amount:item.items.amount,
                                                barcode:item.items.barcode,
                                                code:item.items.code,
                                                discount:item.items.discount,
                                                discount_percent:item.items.discount_percent,
                                                id:item.items.id,
                                                last_price:item.items.last_price,
                                                name:item.items.name,
                                                price:item.items.price,
                                                quantity:item.items.quantity,
                                                stock:item.items.stock,
                                                unit:item.items.unit,
                                                unit_id:item.items.unit_id
                                            })}' 
                                        onclick="editProductFunc(this)" data-bs-toggle="modal" data-bs-target="#edit_product_modal">
                                            <img src="${return_icon}" class="width_20_px">
                                        </a>
                                    </div>`
    }else{
        bills_history_html = bills_history_html  + `<div class="bill_info d-flex justify-content-between align-items-center client_selected_product_row">
                                        <div class="width_30_percent d-flex">
                                            <h6 class="me-2">${index+1}.</h6>
                                            <img onclick="showImage('${item.items.product_image}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="${item.items.product_image}" alt="" height="44px">
                                        </div>
                                        <div class="width_45_percent d-flex flex-column justify-content-center">
                                            <h6>${item.items.name + ' ' + item.items.amount}</h6>
                                            <h6>${item.quantity} ${item.items.unit}</h6>
                                            <h6 id="payment_product_amount"></h6>
                                        </div>
                                        <div class="width_25_percent text-end bill_info_sum">
                                            <h6 id="payment_product_all_price">${item.all_price} ${sum_text}</h6>
                                            <h6 id="payment_product_return_price"></h6>
                                        </div>
                                        <a data-product='${JSON.stringify({
                                            amount:item.items.amount,
                                            barcode:item.items.barcode,
                                            code:item.items.code,
                                            discount:item.items.discount,
                                            discount_percent:item.items.discount_percent,
                                            id:item.items.id,
                                            last_price:item.items.last_price,
                                            name:item.items.name,
                                            price:item.items.price,
                                            quantity:item.items.quantity,
                                            stock:item.items.stock,
                                            unit:item.items.unit,
                                            unit_id:item.items.unit_id
                                        })}' 
                                        data-product-left=""
                                        onclick="editProductFunc(this)" data-bs-toggle="modal" data-bs-target="#edit_product_modal">
                                            <img src="${return_icon}" class="width_20_px">
                                        </a>
                                    </div>`
    }
}

function setData(item) {
    payment_history_data.innerHTML = ''
    bills_history_html = ''
    if(item != null && item != undefined){
        item.forEach((item_, index_) =>{
            setItem(item_, index_)
        });
    }
    payment_history_data.innerHTML = bills_history_html
    return_modal_body.innerHTML = bills_history_html
}

function showBillInfo(this_element, sales_data, code, price, discount_price, total_amount, return_amount, saleId, client_full_name, client_discount_price){
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
    if(return_modal_button.classList.contains('d-none')){
        return_modal_button.classList.remove('d-none')
    }
    bills_history_html = ''
    payment_history_code.textContent = '#'+code
    return_modal_title.textContent = '#'+code
    bills_history_subtotal.textContent = price +' '+ sum_text
    bills_history_client.textContent = client_discount_price +' '+ sum_text
    bills_history_discount.textContent = discount_price +' '+ sum_text
    bills_history_total.textContent = total_amount +' '+ sum_text
    client_title_text.setAttribute('data-bs-content', client_full_name)
    selected_total_sum = parseInt(total_amount.replace(/\s/g, ''), 10)
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