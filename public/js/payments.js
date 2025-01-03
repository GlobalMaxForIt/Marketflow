let bill_info_table = document.getElementsByClassName('bill_info_table')
let return_bill_info_table = document.getElementsByClassName('return_bill_info_table')

let bills_history_subtotal = document.getElementById('bills_history_subtotal')
let bills_history_client = document.getElementById('bills_history_client')
let bills_history_discount = document.getElementById('bills_history_discount')
let bills_history_total = document.getElementById('bills_history_total')
let bills_history_gift_card = document.getElementById('bills_history_gift_card')
let return_back_history_gift_card = document.getElementById('return_back_history_gift_card')
let bills_history_gift_card_sum = document.querySelector('#bills_history_gift_card .order-info-sum')
let return_back_history_gift_card_sum = document.querySelector('#return_back_history_gift_card .order-info-sum')
let client_title_text = document.getElementById('client_title_text')

let payment_history_data = document.getElementById('payment_history_data')
let returned_back_history_data = document.getElementById('returned_back_history_data')

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
let returned_back_history_code = document.getElementById('returned_back_history_code')
let product_full_info_alert = document.getElementById('product_full_info_alert')
let return_modal_button = document.getElementById('return_modal_button')
let returned_back_modal_button = document.getElementById('returned_back_modal_button')
let return_total_amount_text = document.getElementById('return_total_amount_text')
let return_total_amount = document.getElementById('return_total_amount')
let returned_back_total_amount_text = document.getElementById('returned_back_total_amount_text')
let returned_back_total_amount = document.getElementById('returned_back_total_amount')

let client_full_name_html = document.getElementById('client_full_name')
let client_max_payment = 0
let bill_id = ''
let stock_int = 0

let bills_history_html = ''
let client_id = ''
let client_info = {}
let payment_gift_card = {}
let payment_returned_gift_card = {}

let refund_modal_form_url = document.getElementById('refund_modal_form')
function refundBillFunc(url){
    refund_modal_form_url.setAttribute("action", url)
}
let sale_quantity_html = ''
function setItem(item, index){
    if(parseFloat(item.quantity) > 0){
        sale_quantity_html = `<h6>${item.quantity} ${item.items.unit}</h6>`
    }else{
        sale_quantity_html = `<span class="font-14 color_red">${taken_back_text}</span>`
    }
    if(item.price <= 0){
        setPaymentHistoryHtmlWithouthDiscount(item, index)
    }else if(parseInt(item.price.replace(/\s+/g, "")) > parseInt(item.all_price.replace(/\s+/g, ""))){
        setPaymentHistoryHtmlWithDiscount(item, index)
    }else{
        setPaymentHistoryHtmlWithouthDiscount(item, index)
    }
}

function setReturnedItem(item, index){
    if(parseFloat(item.quantity) > 0){
        sale_quantity_html = `<h6>${item.quantity} ${item.items.unit}</h6>`
    }else{
        sale_quantity_html = `<span class="font-14 color_red">${taken_back_text}</span>`
    }
    if(item.price <= 0){
        setReturnedPaymentHistoryHtmlWithouthDiscount(item, index)
    }else if(parseInt(item.price.replace(/\s+/g, "")) > parseInt(item.all_price.replace(/\s+/g, ""))){
        setReturnedPaymentHistoryHtmlWithDiscount(item, index)
    }else{
        setReturnedPaymentHistoryHtmlWithouthDiscount(item, index)
    }
}

function setPaymentHistoryHtmlWithDiscount(item, index){
    bills_history_html = bills_history_html  + `<div class="bill_info d-flex justify-content-between align-items-center client_selected_product_row">
                                        <div class="width_30_percent d-flex">
                                            <h6 class="me-2">${index+1}.</h6>
                                            <img onclick="showImage('${item.items.product_image}')"  data-bs-toggle="modal" data-bs-target="#images-modal" src="${item.items.product_image}" alt="" width="24px">
                                        </div>
                                        <div class="width_45_percent d-flex flex-column justify-content-center">
                                            <h6>${item.items.name + ' '+ item.items.amount}</h6>
                                            <h6>${sale_quantity_html}</h6>
                                            <h6 id="payment_product_amount"></h6>
                                        </div>
                                        <div class="width_25_percent text-end bill_info_sum d-flex flex-column">
                                            <h6 id="payment_product_all_price">${item.all_price} ${sum_text}</h6>
                                            <del class="opacity_1">${item.price} ${sum_text}</del>
                                            <h6 id="payment_product_return_price"></h6>
                                        </div>
                                        <a data-product='${JSON.stringify({
                                                    sales_item_id:item.id,
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
}

function setPaymentHistoryHtmlWithouthDiscount(item, index){
    bills_history_html = bills_history_html  + `<div class="bill_info d-flex justify-content-between align-items-center client_selected_product_row">
                                        <div class="width_30_percent d-flex">
                                            <h6 class="me-2">${index+1}.</h6>
                                            <img onclick="showImage('${item.items.product_image}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="${item.items.product_image}" alt="" height="44px">
                                        </div>
                                        <div class="width_45_percent d-flex flex-column justify-content-center">
                                            <h6>${item.items.name + ' ' + item.items.amount}</h6>
                                            <h6>${sale_quantity_html}</h6>
                                            <h6 id="payment_product_amount"></h6>
                                        </div>
                                        <div class="width_25_percent text-end bill_info_sum">
                                            <h6 id="payment_product_all_price">${item.all_price} ${sum_text}</h6>
                                            <h6 id="payment_product_return_price"></h6>
                                        </div>
                                        <a data-product='${JSON.stringify({
                                                sales_item_id:item.id,
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

function setReturnedPaymentHistoryHtmlWithDiscount(item, index){
    bills_history_html = bills_history_html  + `<div class="bill_info d-flex justify-content-between align-items-center client_selected_product_row">
                                        <div class="width_30_percent d-flex">
                                            <h6 class="me-2">${index+1}.</h6>
                                            <img onclick="showImage('${item.items.product_image}')"  data-bs-toggle="modal" data-bs-target="#images-modal" src="${item.items.product_image}" alt="" width="24px">
                                        </div>
                                        <div class="width_45_percent d-flex flex-column justify-content-center">
                                            <h6>${item.items.name + ' '+ item.items.amount}</h6>
                                            <h6>${sale_quantity_html}</h6>
                                            <h6 id="payment_product_amount"></h6>
                                        </div>
                                        <div class="width_25_percent text-end bill_info_sum d-flex flex-column">
                                            <h6 id="returned_product_all_price">${item.all_price} ${sum_text}</h6>
                                            <del class="opacity_1">${item.price} ${sum_text}</del>
                                            <h6 id="payment_product_return_price"></h6>
                                        </div>
                                    </div>`
}

function setReturnedPaymentHistoryHtmlWithouthDiscount(item, index){
    bills_history_html = bills_history_html  + `<div class="bill_info d-flex justify-content-between align-items-center client_selected_product_row">
                                        <div class="width_30_percent d-flex">
                                            <h6 class="me-2">${index+1}.</h6>
                                            <img onclick="showImage('${item.items.product_image}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="${item.items.product_image}" alt="" height="44px">
                                        </div>
                                        <div class="width_45_percent d-flex flex-column justify-content-center">
                                            <h6>${item.items.name + ' ' + item.items.amount}</h6>
                                            <h6>${sale_quantity_html}</h6>
                                            <h6 id="payment_product_amount"></h6>
                                        </div>
                                        <div class="width_25_percent text-end bill_info_sum">
                                            <h6 id="returned_product_all_price">${item.all_price} ${sum_text}</h6>
                                            <h6 id="payment_product_return_price"></h6>
                                        </div>
                                    </div>`
}

function setData(item) {
    payment_history_data.innerHTML = ''
    bills_history_html = ''
    if(item != null && item != undefined){
        JSON.parse(item).forEach((item_, index_) =>{
            setItem(item_, index_)
        });
    }
    payment_history_data.innerHTML = bills_history_html
}

function setReturnedData(item) {
    returned_back_history_data.innerHTML = ''
    bills_history_html = ''
    if(item != null && item != undefined){
        JSON.parse(item).forEach((item_, index_) =>{
            setReturnedItem(item_, index_)
        });
    }
    returned_back_history_data.innerHTML = bills_history_html
}

function showBillInfo(this_element, sales_data, sales_gift_card_data, code, price, discount_price, total_amount, return_amount, saleId, client_full_name, client_discount_price){
    bills_history_subtotal.textContent = ''
    bills_history_discount.textContent = ''
    bills_history_total.textContent = ''
    bills_history_client.textContent = ''
    bills_history_gift_card_sum.textContent = ''
    payment_gift_card = JSON.parse(sales_gift_card_data)
    if(Object.keys(payment_gift_card).length>0){
        if(bills_history_gift_card.classList.contains('d-none')){
            bills_history_gift_card.classList.remove('d-none')
        }
        if(payment_gift_card.percent){
            bills_history_gift_card_sum.textContent = `(${payment_gift_card.percent} %) ${format_entered_sum(payment_gift_card.sum)} ${sum_text}`
        }else{
            bills_history_gift_card_sum.textContent = `${format_entered_sum(payment_gift_card.sum)} ${sum_text}`
        }
    }else{
        if(!bills_history_gift_card.classList.contains('d-none')){
            bills_history_gift_card.classList.add('d-none')
        }
        bills_history_gift_card_sum.textContent = ''
    }
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
    payment_history_code.textContent = code
    if(return_modal_title == ''){
        return_modal_title.textContent = code
    }
    bills_history_subtotal.textContent = price +' '+ sum_text
    bills_history_client.textContent = client_discount_price +' '+ sum_text
    bills_history_discount.textContent = discount_price +' '+ sum_text
    bills_history_total.textContent = total_amount +' '+ sum_text
    if(client_title_text != undefined && client_title_text != null){
        client_title_text.setAttribute('data-bs-content', client_full_name)
    }
    selected_total_sum = parseInt(total_amount.replace(/\s/g, ''), 10)
    setData(sales_data);
    if(!return_modal_button.classList.contains('d-none')){
        return_modal_button.classList.add('d-none')
    }
    if(!return_total_amount.classList.contains('d-none')){
        return_total_amount.classList.add('d-none')
    }
    if(!return_total_amount_text.classList.contains('d-none')){
        return_total_amount_text.classList.add('d-none')
    }
    selected_sales_items = []
}

function showBillInfoModal(this_element, sales_data, sales_gift_card_data, code, price, saleId, client_full_name){
    bills_history_subtotal.textContent = ''
    bills_history_discount.textContent = ''
    bills_history_total.textContent = ''
    bills_history_client.textContent = ''
    bills_history_gift_card_sum.textContent = ''
    payment_returned_gift_card = JSON.parse(sales_gift_card_data)
    if(Object.keys(payment_returned_gift_card).length>0){
        if(return_back_history_gift_card.classList.contains('d-none')){
            return_back_history_gift_card.classList.remove('d-none')
        }
        if(payment_returned_gift_card.percent){
            return_back_history_gift_card_sum.textContent = `(${payment_returned_gift_card.percent} %) ${format_entered_sum(payment_returned_gift_card.sum)} ${sum_text}`
        }else{
            return_back_history_gift_card_sum.textContent = `${format_entered_sum(payment_returned_gift_card.sum)} ${sum_text}`
        }
    }else{
        if(!return_back_history_gift_card.classList.contains('d-none')){
            return_back_history_gift_card.classList.add('d-none')
        }
        return_back_history_gift_card_sum.textContent = ''
    }
    bill_id = saleId
    for(let j=0; j<return_bill_info_table.length; j++){
        if(return_bill_info_table[j].classList.contains('active')){
            return_bill_info_table[j].classList.remove('active')
        }
    }
    if(!this_element.classList.contains('active')){
        this_element.classList.add('active')
    }
    bills_history_html = ''
    returned_back_history_code.textContent = code
    if(returned_back_modal_title == ''){
        returned_back_modal_title.textContent = code
    }
    client_title_text.setAttribute('data-bs-content', client_full_name)
    setReturnedData(sales_data);
    if(returned_back_modal_button.classList.contains('d-none')){
        returned_back_modal_button.classList.remove('d-none')
    }
    if(returned_back_total_amount.classList.contains('d-none')){
        returned_back_total_amount.classList.remove('d-none')
        returned_back_total_amount.innerText = price +' '+ sum_text
    }
    if(returned_back_total_amount_text.classList.contains('d-none')){
        returned_back_total_amount_text.classList.remove('d-none')
    }
}

function removeActive(){
    for(let j=0; j<return_bill_info_table.length; j++){
        if(return_bill_info_table[j].classList.contains('active')){
            return_bill_info_table[j].classList.remove('active')
        }
    }
}

if(client_title_text != undefined && client_title_text != null) {
    client_title_text.addEventListener('click', function () {

    })
}