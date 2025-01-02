// JavaScript

// Display element
let display = document.getElementById('display');
let display_card = document.getElementById('display_card');
let display_password = document.getElementById('display_password');
let cashier_password = document.getElementById('cashier_password')
let entered_cash_sum = '0'
let entered_card_sum = '0'
let entered_debt_sum = '0'
let entered_gift_card = '0'
let cash_sum = 0
let card_sum = 0
let debt_sum = 0
let gift_card = 0
let accepting_sum_int = 0
let change_sum_int = 0
let klaviaturaNumber = 0
let selected_product_price_value = 0

let getTotalSum = 0
let payment_sum = document.getElementById('payment_sum')
let accepting_sum = document.getElementById('accepting_sum')
let change_sum = document.getElementById('change_sum')

let calculators = document.getElementById('calculators')
let debt_display = document.getElementById('debt_display')
let gift_card_input = document.getElementById('gift_card_input')
let selected_product_name = document.getElementById('selected_product_name')
let selected_product_price = document.getElementById('selected_product_price')
let selected_product_amount = document.getElementById('selected_product_amount')
let selected_product_unit = document.getElementById('selected_product_unit')
let selected_product_stock = document.getElementById('selected_product_stock')
let changeAmountAndPriceId = document.getElementById('changeAmountAndPriceId')
let dotKeyboard = document.getElementById('dotKeyboard')
let gift_card_sum_text = document.getElementById('gift_card_sum_text')
let gift_card_sum = document.getElementById('gift_card_sum')
let gift_card_sum_content = document.getElementById('gift_card_sum_content')
let giftCardConfirmButton = document.getElementById('giftCardConfirmButton')
let return_modal_button_click = document.querySelector('#return_modal_button_click')
let dot_has = false
let orderProductData = {}


let selectedProductAmount = ''
let product_element_quantity = ''
let product_element_sum = ''
let product_element_id = ''
let orderProduct_amount = ''
let orderProduct_barcode = ''
let orderProduct_discount = ''
let orderProduct_discount_percent = ''
let orderProduct_id = ''
let orderProduct_last_price = ''
let orderProduct_name = ''
let orderProduct_price = ''
let orderProduct_quantity = ''
let orderProduct_stock = ''
let orderProduct_unit = ''
let orderProduct_unit_id = ''
let amount_or_price = ''
let display_edit_product = ''
let orderProductElement = ''
let payment_product_amount_element = ''
let payment_product_all_price_element = ''
let payment_product_return_price_element = ''
let selected_total_sum = ''
let return_total_sum = 0
let selected_product_sum = ''
let selected_product_quantity = ''
let selected_sales_item_id = ''
let selected_sales_items = []
let selected_sales_items_object = []
let return_modal_body = document.getElementById('return_modal_body')
let selected_product_amount_clicked = false
let selected_product_price_clicked = false
let display_or_display_card_or_debt = ''
let display_edit_payment = ''

let selected_display_clicked = false
let selected_display_card_clicked = false
let selected_debt_display_clicked = false
let gift_card_display_clicked = false
let is_edit_product_modal_opened_for_price = false
let is_edit_product_modal_opened_for_amount = false

let is_payment_modal_opened_for_cash = false
let is_payment_modal_opened_for_card = false
let is_payment_modal_opened_for_debt = false
let is_payment_modal_opened_for_gift_card = false


function format_entered_sum(numbers){
    if(parseInt(numbers)>0){
        return parseInt(numbers).toLocaleString()
    }else{
        return 0
    }
}

function setValues(cash_sum_, card_sum_, debt_sum_, gift_card_){
    switch (display_or_display_card_or_debt) {
        case "display":
            display.value = format_entered_sum(cash_sum_)
            break;
        case "display_card":
            display_card.value = format_entered_sum(card_sum_)
            break;
        case "debt_display":
            debt_display.value = format_entered_sum(debt_sum_)
            break;
        case "gift_card_input":
            gift_card_input.value = gift_card_
            break;
    }
    if(parseInt(getTotalSum) > (cash_sum_ + card_sum_ + debt_sum_)){
        accepting_sum.innerText = format_entered_sum(cash_sum_ + card_sum_ + debt_sum_); // Aks holda, raqamni qo'shamiz
        accepting_sum_int = cash_sum_ + card_sum_
        change_sum.innerText = '0'
        change_sum_int = 0
    }else if(parseInt(getTotalSum) == (cash_sum_ + card_sum_ + debt_sum_)){
        accepting_sum.innerText = format_entered_sum(parseInt(getTotalSum)); // Aks holda, raqamni qo'shamiz
        accepting_sum_int = cash_sum_ + card_sum_
        change_sum.innerText = '0'
        change_sum_int = 0
    }else{
        accepting_sum.innerText = format_entered_sum(parseInt(getTotalSum)); // Aks holda, raqamni qo'shamiz
        accepting_sum_int = cash_sum_ + card_sum_
        change_sum.innerText = format_entered_sum(cash_sum_ + card_sum_ + debt_sum_ - parseInt(getTotalSum))
        change_sum_int = cash_sum_ + card_sum_ + debt_sum_ - parseInt(getTotalSum)
    }
}

function selected_payment_input_func(){
    setTimeout(function () {
        if(debt_display != undefined && debt_display != null && display_card != undefined && display_card != null && display != undefined && display != null){
            if(selected_debt_display_clicked){
                setTimeout(function(){
                    debt_display.focus()
                    debt_display.addEventListener('blur', function () {
                        if(selected_debt_display_clicked) {
                            debt_display.focus()
                        }
                    })
                    display_or_display_card_or_debt = 'debt_display'
                    display_edit_payment = debt_display
                }, 444)
            }else if(selected_display_card_clicked){
                setTimeout(function(){
                    display_card.focus()
                    display_card.addEventListener('blur', function () {
                        if(selected_display_card_clicked) {
                            display_card.focus()
                        }
                        display_or_display_card_or_debt = 'display_card'
                        display_edit_payment = display_card
                    })
                }, 444)
            }else if(gift_card_display_clicked){
                setTimeout(function(){
                    gift_card_input.focus()
                    gift_card_input.addEventListener('blur', function () {
                        if(gift_card_display_clicked) {
                            gift_card_input.focus()
                        }
                        display_or_display_card_or_debt = 'gift_card_input'
                        display_edit_payment = gift_card_input
                    })
                }, 444)
            }else{
                setTimeout(function(){
                    display.focus()
                    display.addEventListener('blur', function () {
                        if(selected_display_clicked) {
                            display.focus()
                        }
                        display_or_display_card_or_debt = 'display'
                        display_edit_payment = display
                    })
                }, 444)
            }
        }
    }, 94)
}
if(display != undefined && display != null){
    display.addEventListener('click', function () {
        selected_display_clicked = true
        selected_display_card_clicked = false
        selected_debt_display_clicked = false
        gift_card_display_clicked = false
        selected_payment_input_func()
    })
}
if(display_card != undefined && display_card != null){
    display_card.addEventListener('click', function () {
        selected_display_clicked = false
        selected_display_card_clicked = true
        selected_debt_display_clicked = false
        gift_card_display_clicked = false
        selected_payment_input_func()
    })
}

if(debt_display != undefined && debt_display != null){
    debt_display.addEventListener('click', function () {
        selected_display_clicked = false
        selected_display_card_clicked = false
        gift_card_display_clicked = false
        selected_debt_display_clicked = true
        selected_payment_input_func()
    })
}

if(gift_card_input != undefined && gift_card_input != null){
    gift_card_input.addEventListener('click', function () {
        selected_display_clicked = false
        selected_display_card_clicked = false
        selected_debt_display_clicked = false
        gift_card_display_clicked = true
        selected_payment_input_func()
    })
}

// Function to append numbers to the display
function appendNumber(number) {
    switch (display_or_display_card_or_debt) {
        case "display":
            if (display.value == '0') {
                entered_cash_sum = String(number)
            } else {
                if(!is_payment_modal_opened_for_cash){
                    entered_cash_sum = String(entered_cash_sum) + number
                }else{
                    entered_cash_sum = String(number)
                    is_payment_modal_opened_for_cash = false
                }
            }
            cash_sum = parseInt(entered_cash_sum)
            autoSetCardSum()
            break;
        case "display_card":
            if (display_card.value == '0') {
                entered_card_sum = String(number)
            } else {
                if(!is_payment_modal_opened_for_card){
                    entered_card_sum = String(entered_card_sum) + number
                }else{
                    entered_card_sum = String(number)
                    is_payment_modal_opened_for_card = false
                }
            }
            card_sum = parseInt(entered_card_sum)
            autoSetDebtSum()
            break;
        case "debt_display":
            if (debt_display.value == '0') {
                entered_debt_sum = parseInt(number)
            } else {
                if(!is_payment_modal_opened_for_debt){
                    entered_debt_sum = String(entered_debt_sum) + number
                }else{
                    entered_debt_sum = String(number)
                    is_payment_modal_opened_for_debt = false
                }
            }
            debt_sum = parseInt(entered_debt_sum)
            break;
        case "gift_card_input":
            if (gift_card_input.value == '0') {
                entered_gift_card = parseInt(number)
            } else {
                if(!is_payment_modal_opened_for_gift_card){
                    entered_gift_card = String(entered_gift_card) + number
                }else{
                    entered_gift_card = String(number)
                    is_payment_modal_opened_for_gift_card = false
                }
            }
            gift_card = parseInt(entered_gift_card)
            break;
    }
    setValues(cash_sum, card_sum, debt_sum, gift_card, display_or_display_card_or_debt)
}

// Function to clear the display
function clearDisplay() {
    switch (display_or_display_card_or_debt) {
        case "display":
            cash_sum = 0
            autoSetCardSum()
            break;
        case "display_card":
            card_sum = 0
            autoSetDebtSum()
            break;
        case "debt_display":
            debt_sum = 0
            break;
        case "gift_card_input":
            gift_card = 0
            break;
    }
    setValues(cash_sum, card_sum, debt_sum, gift_card, display_or_display_card_or_debt)
}

// Function to remove the last digit (Backspace)
function backspace() {
    switch (display_or_display_card_or_debt) {
        case "display":
            if (display.value.length > 1) {
                entered_cash_sum = String(entered_cash_sum).slice(0, -1)
                cash_sum = parseInt(entered_cash_sum)
            } else {
                entered_cash_sum = '0'
                cash_sum = parseInt(entered_cash_sum)
            }
            autoSetCardSum()
            break;
        case "display_card":
            if (display_card.value.length > 1) {
                entered_card_sum = String(entered_card_sum).slice(0, -1)
                card_sum = parseInt(entered_card_sum)
            } else {
                entered_card_sum = '0'
                card_sum = parseInt(entered_card_sum)
            }
            autoSetDebtSum()
            break;
        case "debt_display":
            if (debt_display.value.length > 1) {
                entered_debt_sum = String(entered_debt_sum).slice(0, -1)
                debt_sum = parseInt(entered_debt_sum)
            } else {
                entered_debt_sum = '0'
                debt_sum = parseInt(entered_debt_sum)
            }
            break;
        case "gift_card_input":
            if (gift_card_input.value.length > 1) {
                entered_gift_card = String(entered_gift_card).slice(0, -1)
                gift_card = parseInt(entered_gift_card)
            } else {
                entered_gift_card = '0'
                gift_card = parseInt(entered_gift_card)
            }
            break;
    }
    setValues(cash_sum, card_sum, debt_sum, gift_card, display_or_display_card_or_debt)
}

// Function to append numbers to the display
function appendPassword(number) {
    if (display_password.value == '') {
        cashier_password.value = String(number)
        display_password.value = String(number); // Agar dastlabki raqam 0 bo'lsa, uni o'zgartiramiz
    } else {
        cashier_password.value = String(cashier_password.value) + String(number)
        display_password.value = cashier_password.value; // Aks holda, raqamni qo'shamiz
    }
}
if(display_password != undefined && display_password != null){
    display_password.addEventListener('input', function (event) {
        cashier_password.value = String(event.target.value)
        display_password.value = cashier_password.value; // Aks holda, raqamni qo'shamiz
    })
}

// Function to clear the display
function clearDisplayPassword() {
    cashier_password.value = ''
    display_password.value = ''; // Ekrandagi raqamni tozalash
}

// Function to remove the last digit (Backspace)
function backspacePassword() {
    if (display_password.value.length > 1) {
        cashier_password.value = String(cashier_password.value).slice(0, -1)
        display_password.value = String(cashier_password.value); // Oxirgi belgini o'chirish
    } else {
        display_password.value = ''; // Agar faqat bir raqam qolgan bo'lsa, uni 0 ga o'zgartiramiz
        cashier_password.value = ''
    }
}

function editProductFunc(orderProduct){
    is_edit_product_modal_opened_for_price = true
    is_edit_product_modal_opened_for_amount = true
    orderProductElement = orderProduct
    let client_selected_product_row = document.getElementsByClassName('client_selected_product_row')
    for(let k=0; k<client_selected_product_row.length; k++){
        if(client_selected_product_row[k].classList.contains('active')){
            client_selected_product_row[k].classList.remove('active')
        }
    }
    if(orderProduct != null && orderProduct != undefined){
        if(!orderProduct.classList.contains('active')){
            orderProduct.classList.add('active')
        }
        product_element_quantity = orderProduct.querySelector('td h6 .product__quantity')
        product_element_sum = orderProduct.querySelector('td h6 .product__sum')
    }
    if(!dotKeyboard.classList.contains('d-none')){
        dotKeyboard.classList.add('d-none')
    }
    orderProductData = JSON.parse(orderProduct.getAttribute('data-product'))
    if(Object.keys(orderProductData).length>0){
        selected_product_name.innerText = orderProductData.name + ' '+orderProductData.amount
        selected_product_price_value = parseInt(parseFloat(orderProductData.quantity)*parseInt(orderProductData.last_price.replace(/\s/g, ''), 10))
        selected_product_price.value = format_entered_sum(selected_product_price_value)
        selected_product_amount.value = parseFloat(orderProductData.quantity)
        selected_product_unit.innerText = orderProductData.unit
        if(selected_product_stock != undefined && selected_product_stock != null){
            selected_product_stock.innerText = parseFloat(orderProductData.stock) - parseFloat(orderProductData.quantity)+' '+left_text
        }
        selectedProductAmount = parseFloat(selected_product_amount.value)
        orderProduct_amount = orderProductData.amount
        orderProduct_barcode = orderProductData.barcode
        orderProduct_discount = orderProductData.discount
        orderProduct_discount_percent = orderProductData.discount_percent
        orderProduct_id = orderProductData.id
        orderProduct_last_price = parseInt(orderProductData.last_price.replace(/\s/g, ''), 10)
        orderProduct_name = orderProductData.name
        orderProduct_price = orderProductData.price
        orderProduct_quantity = parseFloat(orderProductData.quantity)
        orderProduct_stock = parseFloat(orderProductData.stock)
        orderProduct_unit = orderProductData.unit
        orderProduct_unit_id = orderProductData.unit_id
        if(orderProductData.sales_item_id != undefined && orderProductData.sales_item_id != null){
            selected_sales_item_id = orderProductData.sales_item_id
        }
        selected_product_sum = orderProduct_last_price
        selected_product_quantity = orderProduct_quantity
    }
    if(![4, 7, 8, 10, 11].includes(parseInt(orderProductData.unit_id))){
        selected_product_price.disabled = true
        selected_product_amount_clicked = true
        selected_product_price_clicked = false
    }else{
        selected_product_price_clicked = true
        selected_product_amount_clicked = false
        selected_product_price.disabled = false
    }
    selected_product_input_func()
    if(order_selected_product_name != '' && order_selected_product_name != null && order_selected_product_name != undefined){
        order_selected_product_name.innerText = orderProductData.name+' '+orderProduct_amount
    }
    if(order_selected_product_info != '' && order_selected_product_info != null && order_selected_product_info != undefined){
        order_selected_product_info.innerHTML = `${orderProduct_last_price} * ${selectedProductAmount} = ${new Intl.NumberFormat('ru-RU').format(orderProduct_last_price*selectedProductAmount, 10)}`
    }
}
function selected_product_input_func(){
    setTimeout(function () {
        if(selected_product_amount_clicked){
            amount_or_price = 'amount'
            display_edit_product = selected_product_amount
            setTimeout(function () {
                selected_product_amount.focus(); // Fokusni qayta tiklash
                selected_product_amount.addEventListener('blur', function (event) {
                    event.preventDefault()
                    if(selected_product_amount_clicked) {
                        selected_product_amount.focus()
                    }
                })
            }, 444)
            if([4, 7, 8, 10, 11].includes(parseInt(orderProductData.unit_id))) {
                openDotKeyboard()
            }
        }else{
            amount_or_price = 'price'
            if(![4, 7, 8, 10, 11].includes(parseInt(orderProductData.unit_id))){
                selected_product_price.disabled = true
                setTimeout(function () {
                    selected_product_amount.focus(); // Fokusni qayta tiklash
                    selected_product_amount.addEventListener('blur', function (event) {
                    event.preventDefault()
                        if(selected_product_amount_clicked) {
                            selected_product_amount.focus()
                        }
                    })
                }, 444)
                closeDotKeyboard()
            }else{
                display_edit_product = selected_product_price
                selected_product_price.disabled = false
                setTimeout(function () {
                    selected_product_price.focus(); // Fokusni qayta tiklash
                    selected_product_price.addEventListener('blur', function (event) {
                        event.preventDefault()
                        if(selected_product_price_clicked) {
                            selected_product_price.focus()
                        }
                    })
                }, 444)
                closeDotKeyboard()
            }
        }
    }, 94)
}
function openDotKeyboard(){
    if(Object.keys(orderProductData).length>0){
        if(dotKeyboard.classList.contains('d-none')){
            dotKeyboard.classList.remove('d-none')
        }
    }
}
function closeDotKeyboard(){
    if(!dotKeyboard.classList.contains('d-none')){
        dotKeyboard.classList.add('d-none')
    }
}

if(selected_product_price != undefined && selected_product_price != null){
    selected_product_price.addEventListener('click', function () {
        selected_product_price_clicked = true
        selected_product_amount_clicked = false
        selected_product_input_func()
    })
}
if(selected_product_amount != undefined && selected_product_amount != null){
    selected_product_amount.addEventListener('click', function () {
        selected_product_amount_clicked = true
        selected_product_price_clicked = false
        selected_product_input_func()
    })
}
selected_product_input_func()

// Function to append numbers to the display
function appendEditProduct(number) {
    if (display_edit_product.value == '0' || display_edit_product.value == '') {
        if(dot_has){
            display_edit_product.value = '0.'+String(number);
        }else{
            if(amount_or_price == 'amount'){
                display_edit_product.value = String(number);
            }else{
                selected_product_price_value = parseInt(number)
                display_edit_product.value = format_entered_sum(selected_product_price_value);
            }
        }
    } else {
        if(dot_has){
            if(amount_or_price == 'amount'){
                if(is_edit_product_modal_opened_for_amount){
                    display_edit_product.value = String(number);
                    is_edit_product_modal_opened_for_amount = false
                }else{
                    display_edit_product.value = String(display_edit_product.value)+'.'+String(number);
                }
            }else{
                if(is_edit_product_modal_opened_for_price){
                    selected_product_price_value = parseInt(number)
                    display_edit_product.value = format_entered_sum(selected_product_price_value);
                    is_edit_product_modal_opened_for_price = false
                }else{
                    selected_product_price_value = parseInt(display_edit_product.value.replace(/\s/g, '')+'.'+String(number))
                    display_edit_product.value = format_entered_sum(selected_product_price_value);
                }
            }
        }else{
            if(amount_or_price == 'amount'){
                if(is_edit_product_modal_opened_for_amount){
                    display_edit_product.value = String(number)
                    is_edit_product_modal_opened_for_amount = false;
                }else{
                    display_edit_product.value = String(display_edit_product.value)+String(number);
                }
            }else{
                if(is_edit_product_modal_opened_for_price){
                    selected_product_price_value = parseInt(number)
                    display_edit_product.value = format_entered_sum(selected_product_price_value);
                    is_edit_product_modal_opened_for_price = false
                }else{
                    selected_product_price_value = parseInt(display_edit_product.value.replace(/\s/g, '')+String(number))
                    display_edit_product.value = format_entered_sum(selected_product_price_value);
                }
            }
        }
    }
    dot_has = false
    if(amount_or_price == 'amount'){
        selected_product_price_value = parseInt(orderProduct_last_price * parseFloat(display_edit_product.value.replace(/\s/g, '')))
        selected_product_price.value = format_entered_sum(selected_product_price_value)
    }else{
        selected_product_amount.value = (parseInt(selected_product_price.value.replace(/\s/g, ''))/orderProduct_last_price).toFixed(2)
    }
    if(selected_product_stock != undefined && selected_product_stock != null){
        selected_product_stock.innerText = orderProduct_stock - parseFloat(selected_product_amount.value)
    }
}

function appendDotEditProduct(){
    dot_has = true
}
function changePriceByAmount(amount__value, last__value){
    if(stock_int > 0 || page_name == 'payment') {
        if(is_edit_product_modal_opened_for_amount) {
            if(amount__value != ''){
                selected_product_amount.value = last__value
            }else if(amount__value == '') {
                if (last__value == '.' && amount__value.length < 1 ) {
                    dot_has = true
                }else{
                    selected_product_amount.value = '0'
                }
            }
            selected_product_price_value = orderProduct_last_price * parseFloat(last__value)
            selected_product_price.value = format_entered_sum(selected_product_price_value)
            dot_has = false
            is_edit_product_modal_opened_for_amount = false
        }else{
            if (amount__value == '') {
                if (last__value == '.' && amount__value.length < 1 ) {
                    dot_has = true
                }else{
                    selected_product_amount.value = '0'
                }
            } else {
                if(amount__value.length == 1 && dot_has) {
                    selected_product_amount.value = '0.' + String(amount__value).slice(0, 1); // Aks holda, raqamni qo'shamiz
                } else {
                    if (amount__value == '0') {
                        selected_product_amount.value = '0'; // Aks holda, raqamni qo'shamiz
                    } else {
                        selected_product_amount.value = parseFloat(amount__value); // Aks holda, raqamni qo'shamiz
                    }
                }
                dot_has = false
            }
            selected_product_price_value = orderProduct_last_price * parseFloat(amount__value.replace(/\s/g, ''))
            selected_product_price.value = format_entered_sum(selected_product_price_value)
        }
        if(selected_product_stock != undefined && selected_product_stock != null){
            selected_product_stock.innerText = orderProduct_stock - parseFloat(selected_product_amount.value)
        }
    }
}

function changeAmountByPrice(price__value, last__value){
    if(stock_int > 0 || page_name == 'payment') {
        if(is_edit_product_modal_opened_for_price) {
            if(last__value == undefined || last__value == null){
                last__value = '0'
            }
            selected_product_price_value = parseInt(last__value.replace(/\s/g, '')); // Aks holda, raqamni qo'shamiz
            selected_product_price.value = format_entered_sum(selected_product_price_value); // Aks holda, raqamni qo'shamiz
            is_edit_product_modal_opened_for_price = false
        }else{
            selected_product_price_value = parseInt(price__value.replace(/\s/g, '')); // Aks holda, raqamni qo'shamiz
            selected_product_price.value = format_entered_sum(selected_product_price_value); // Aks holda, raqamni qo'shamiz
        }
        if(selected_product_price_value>0){
            selected_product_amount.value = parseInt((parseInt(selected_product_price_value) / orderProduct_last_price)*100)/100
        }else{
            selected_product_amount.value = '0';
        }
        if(selected_product_stock != undefined && selected_product_stock != null){
            selected_product_stock.innerText = orderProduct_stock - parseFloat(selected_product_amount.value)
        }
    }
}
if(selected_product_amount != undefined && selected_product_amount != null){
    selected_product_amount.addEventListener('input', function (event) {
        is_exist = false
        changePriceByAmount(event.target.value, event.data)
    })
}
if(selected_product_price != undefined && selected_product_price != null){
    selected_product_price.addEventListener('input', function (event) {
        changeAmountByPrice(event.target.value, event.data)
    })
}

function changeAmountAndPrice(){
    checklist_changed = false
    element_id = ''
    if(product_element_quantity != '') {
        product_element_quantity.innerText = parseInt(selected_product_amount.value*1000)/1000
    }
    if(product_element_sum != '') {
        product_element_sum.innerText = selected_product_price.value
    }
    orderProduct_stock = orderProduct_stock
    orderProduct_quantity = parseFloat(selected_product_amount.value)
    orderProduct_last_price = selected_product_price_value
    orderProduct_stock = orderProduct_stock - orderProduct_quantity
    if(orderProduct_stock > 0) {
        if (order_data.length > 0) {
            for (let i = 0; i < order_data.length; i++) {
                if (order_data[i].id == orderProduct_id) {
                    if(orderProduct_quantity>0){
                        order_data[i].quantity = orderProduct_quantity
                    }else{
                        order_data.splice(i, 1)
                        if(order_selected_product_name != '' && order_selected_product_name != null && order_selected_product_name != undefined){
                            order_selected_product_name.innerText = ''
                        }
                        if(order_selected_product_info != '' && order_selected_product_info != null && order_selected_product_info != undefined) {
                            order_selected_product_info.innerHTML = ''
                        }
                    }
                }
            }
        }
        if (order_data.length > 0) {
            showHasItems()
        } else {
            hideHasItems()
        }

        if (localStorage.getItem('order_data') != undefined && localStorage.getItem('order_data') != null) {
            localStorage.setItem('order_data', JSON.stringify(order_data))
        } else {
            localStorage.removeItem('order_data')
            localStorage.setItem('order_data', JSON.stringify(order_data))
        }

        if (order_data_content != undefined && order_data_content != null) {
            order_data_html = setOrderHtml(order_data)
            order_data_content.innerHTML = order_data_html
        }

        stock_int = orderProduct_stock;

        element_id_name = 'stock__'+orderProduct_id
        if(element_id_name.length == 8){
            element_id = document.getElementById(element_id_name)
        }
        if(element_id != null && element_id != undefined && element_id != '') {
            element_id.innerText = parseFloat(stock_int)
        }

        notify_product_text = orderProductData.name+' '+orderProduct_amount + ' '+notify_text
        toastr.success(notify_product_text)
    }else{
        toastr.warning(orderProductData.name+' '+orderProduct_amount +' '+orderProduct_stock+' '+notify_text_left_in_stock)
    }
    if(Object.keys(orderProductData).length>0){
        selected_product_name.innerText = orderProductData.name + ' '+orderProductData.amount
        selected_product_unit.innerText = orderProductData.unit
        selectedProductAmount = parseFloat(selected_product_amount.value)
        orderProduct_last_price = parseInt(selected_product_price_value/selectedProductAmount)
    }
    if(orderProduct_quantity>0){
        if(order_selected_product_name != '' && order_selected_product_name != null && order_selected_product_name != undefined){
            order_selected_product_name.innerText = orderProductData.name+' '+orderProduct_amount
        }
        if(order_selected_product_info != '' && order_selected_product_info != null && order_selected_product_info != undefined){
            order_selected_product_info.innerHTML = `${orderProduct_last_price} * ${selectedProductAmount} = ${new Intl.NumberFormat('ru-RU').format(orderProduct_last_price*selectedProductAmount, 10)}`
        }
    }
}

function changeAmountAndPriceReturn(){
    return_total_sum = 0
    payment_product_amount_element = orderProductElement.parentElement.querySelector('#payment_product_amount')
    payment_product_return_price_element = orderProductElement.parentElement.querySelector('#payment_product_return_price')
    for(let i=0; i<selected_sales_items.length; i++){
        if(selected_sales_item_id == selected_sales_items[i]['sales_item_id']){
            selected_sales_items.splice(i, 1)
            selected_sales_items_object.splice(i, 1)
        }
    }
    if(selected_sales_items.length == 0){
        if(!return_modal_button.classList.contains('d-none')){
            return_modal_button.classList.add('d-none')
        }
        if(!return_total_amount.classList.contains('d-none')){
            return_total_amount.classList.add('d-none')
        }
        if(!return_total_amount_text.classList.contains('d-none')){
            return_total_amount_text.classList.add('d-none')
        }
    }
    if(parseFloat(selected_product_quantity) - parseFloat(selected_product_amount.value)>=0 && parseFloat(selected_product_amount.value)>0){
        if(return_modal_button.classList.contains('d-none')){
            return_modal_button.classList.remove('d-none')
        }
        if(return_total_amount.classList.contains('d-none')){
            return_total_amount.classList.remove('d-none')
        }
        if(return_total_amount_text.classList.contains('d-none')){
            return_total_amount_text.classList.remove('d-none')
        }
        payment_product_amount_element.innerText = selected_product_amount.value + ' '+ orderProductData.unit
        payment_product_return_price_element.innerText = new Intl.NumberFormat('ru-RU').format(selected_product_price_value, 10) + ' ' + sum_text
        selected_sales_items.push({'sales_item_id':selected_sales_item_id, 'quantity':parseFloat(selected_product_amount.value), 'all_sum':parseInt(selected_product_price_value)})
        selected_sales_items_object.push(JSON.stringify({'sales_item_id':selected_sales_item_id, 'quantity':parseFloat(selected_product_amount.value), 'all_sum':parseInt(selected_product_price_value)}))
    }else if(parseFloat(selected_product_amount.value) <= 0){
        payment_product_amount_element.innerText = ''
        payment_product_return_price_element.innerText = ''
    }
    for(let i=0; i<selected_sales_items.length; i++){
        return_total_sum = return_total_sum + parseInt(selected_sales_items[i].all_sum)
    }
    return_total_amount.innerText = new Intl.NumberFormat('ru-RU').format(return_total_sum, 10) + ' ' + sum_text
    return_modal_body.innerHTML = `<h4> ${new Intl.NumberFormat('ru-RU').format(return_total_sum, 10) + ' ' + sum_text}</h4>`
}

if(return_modal_button_click != undefined && return_modal_button_click != null){
    return_modal_button_click.addEventListener('click', function () {
        if(loader != undefined && loader != null){
            if(loader.classList.contains("d-none")){
                loader.classList.remove("d-none")
            }
        }
        if(myDiv != undefined && myDiv != null){
            if(myDiv.classList.contains("d-none")){
                myDiv.classList.remove("d-none")
            }
        }
        $(document).ready(function () {
            $.ajax({
                url: cashbox_big_url,
                type:'POST',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept':'application/json'
                },
                data:{
                    'id':bill_id,
                    'data':selected_sales_items_object
                },
                success: function (data) {
                    if(data.status == true){
                        setTimeout(function () {
                            if(loader != undefined && loader != null){
                                if(!loader.classList.contains("d-none")){
                                    loader.classList.add("d-none")
                                }
                            }
                            if(myDiv != undefined && myDiv != null){
                                if(!myDiv.classList.contains("d-none")){
                                    myDiv.classList.add("d-none")
                                }
                            }
                            location.reload()
                        }, 244)
                        toastr.success(return_success_text+' '+data.return_all_sum+' '+data.code)
                    }
                },
                error: function (e) {
                    console.log(e)
                }
            })
        })
    })
}

// Function to clear the display
function clearDisplayEditProduct() {
    display_edit_product.value = '0'; // Ekrandagi raqamni tozalash
    selected_product_amount.value = '0'; // Ekrandagi raqamni tozalash
    selected_product_price.value = '0'; // Ekrandagi raqamni tozalash
    selected_product_price_value = 0; // Ekrandagi raqamni tozalash
    if(selected_product_stock != undefined && selected_product_stock != null){
        selected_product_stock.innerText = orderProduct_stock
    }
}

// Function to remove the last digit (Backspace)
function backspaceEditProduct() {
    if (String(selected_product_price_value).length > 1) {
        display_edit_product.value = String(display_edit_product.value).slice(0, -1); // Oxirgi belgini o'chirish
    } else {
        display_edit_product.value = '0'; // Agar faqat bir raqam qolgan bo'lsa, uni 0 ga o'zgartiramiz
    }
    if(amount_or_price == 'amount'){
        selected_product_price_value = orderProduct_last_price * parseFloat(display_edit_product.value.replace(/\s/g, ''))
        selected_product_price.value = format_entered_sum(selected_product_price_value)
    }else{
        selected_product_amount.value = parseInt(display_edit_product.value.replace(/\s/g, ''))/orderProduct_last_price
    }
    if(selected_product_stock != undefined && selected_product_stock != null){
        selected_product_stock.innerText = stock_int - parseFloat(selected_product_amount.value)
    }
}
let debt_display_content = document.getElementById('debt_display_content')
function paymentFunc() {
    is_payment_modal_opened_for_cash = true
    is_payment_modal_opened_for_card = true
    is_payment_modal_opened_for_debt = true
    is_payment_modal_opened_for_gift_card = true

    setTimeout(function () {
        display.focus()
    }, 94)
    getTotalSum = total_all_left_sum
    payment_sum.innerText = format_entered_sum(getTotalSum)
    entered_cash_sum = parseInt(getTotalSum)
    cash_sum = entered_cash_sum
    display.value = format_entered_sum(cash_sum)
    if(parseInt(client_id)>0){
        if(debt_display_content.classList.contains('d-none')){
            debt_display_content.classList.remove('d-none')
        }
    }else{
        if(!debt_display_content.classList.contains('d-none')){
            debt_display_content.classList.add('d-none')
        }
    }
    autoSetCardSum()
    setValues(cash_sum, card_sum, debt_sum, display_or_display_card_or_debt)
    selected_display_clicked = true
    selected_payment_input_func()
}

if(display != undefined && display != null){
    display.addEventListener('input', (e) => {
        klaviaturaNumber = 0
        if(!is_payment_modal_opened_for_cash){
            klaviaturaNumber = formatInput(display).replace(/\s+/g, '')
        }else{
            klaviaturaNumber = e.data
            is_payment_modal_opened_for_cash = false
        }
        entered_cash_sum = klaviaturaNumber
        cash_sum = parseInt(klaviaturaNumber)
        autoSetCardSum()
        setValues(cash_sum, card_sum, debt_sum, display_or_display_card_or_debt='display')
    });
}

if(display_card != undefined && display_card != null){
    display_card.addEventListener('input', (e) => {
        klaviaturaNumber = 0
        if(!is_payment_modal_opened_for_card){
            klaviaturaNumber = formatInput(display_card).replace(/\s+/g, '')
        }else{
            klaviaturaNumber = e.data
            is_payment_modal_opened_for_card = false
        }
        entered_card_sum = klaviaturaNumber
        card_sum = parseInt(klaviaturaNumber)
        autoSetDebtSum()
        setValues(cash_sum, card_sum, debt_sum, display_or_display_card_or_debt='display_card')
    });
}
if(debt_display != undefined && debt_display != null){
    debt_display.addEventListener('input', (e) => {
        klaviaturaNumber = 0
        if(!is_payment_modal_opened_for_debt){
            klaviaturaNumber = formatInput(debt_display).replace(/\s+/g, '')
        }else{
            klaviaturaNumber = e.data
            is_payment_modal_opened_for_debt = false
        }
        entered_debt_sum = klaviaturaNumber
        debt_sum = parseInt(klaviaturaNumber)
        setValues(cash_sum, card_sum, debt_sum, display_or_display_card_or_debt='debt_display')
    });
}
if(gift_card_input != undefined && gift_card_input != null){
    gift_card_input.addEventListener('input', (e) => {
        klaviaturaNumber = 0
        if(!is_payment_modal_opened_for_gift_card){
            klaviaturaNumber = formatInput(gift_card_input).replace(/\s+/g, '')
        }else{
            klaviaturaNumber = e.data
            is_payment_modal_opened_for_gift_card = false
        }
        entered_gift_card = klaviaturaNumber
        gift_card = parseInt(klaviaturaNumber)
        setValues(cash_sum, card_sum, debt_sum, gift_card, display_or_display_card_or_debt='gift_card_input')
    });
}
let gift_card_sum_html = ''
function giftCardConfirm(){
    gift_card_sum_html = ''
    if(loader != undefined && loader != null){
        if(loader.classList.contains("d-none")){
            loader.classList.remove("d-none")
        }
    }
    if(myDiv != undefined && myDiv != null){
        if(myDiv.classList.contains("d-none")){
            myDiv.classList.remove("d-none")
        }
    }
    $(document).ready(function () {
        try{
            $.ajax({
                url: gift_card_url,
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept':'application/json'
                },
                data:{
                    'gift_card_code':gift_card,
                    'get_total_sum':getTotalSum
                },
                success: function (data__) {
                    console.log(data__)
                    hideHasItems()
                    setTimeout(function () {
                        if(loader != undefined && loader != null){
                            if(!loader.classList.contains("d-none")){
                                loader.classList.add("d-none")
                            }
                        }
                        if(myDiv != undefined && myDiv != null){
                            if(!myDiv.classList.contains("d-none")){
                                myDiv.classList.add("d-none")
                            }
                        }
                    }, 244)
                    if(data__.status == true){
                        if(gift_card_sum_text.classList.contains('d-none')){
                            gift_card_sum_text.classList.remove('d-none')
                        }
                        if(gift_card_sum_content.classList.contains('d-none')){
                            gift_card_sum_content.classList.remove('d-none')
                        }
                        giftCardConfirmButton.disabled = true
                        if(data__.data.percent){
                            gift_card_sum_html = `(${data__.data.percent}) ${data__.data.price} ${sum_text}`
                        }else{
                            gift_card_sum_html = `${data__.data.price} ${sum_text}`
                        }
                        gift_card_sum.innerText = gift_card_sum_html
                        toastr.success(data__.message)
                    }else{
                        toastr.warning(data__.message)
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error)
                    // Handle errors here
                    console.log(xhr.responseText); // Log the error response from the server
                    toastr.error('An error occurred: ' + xhr.status + ' ' + error); // Show error message
                }
            })
        }catch (e) {
            console.log(e)
        }
    })
}

function removeGiftCard(){
    if(!gift_card_sum_text.classList.contains('d-none')){
        gift_card_sum_text.classList.add('d-none')
    }
    if(!gift_card_sum_content.classList.contains('d-none')){
        gift_card_sum_content.classList.add('d-none')
    }
    giftCardConfirmButton.disabled = false
    gift_card_sum.innerText = ''
}

function formatInput(param){
    // Faqat raqamlarni olamiz
    let value = param.value.replace(/\D/g, '');
    // Har 3 raqamdan keyin bo‘sh joy qo‘shamiz
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ' ');

    // Formatlangan qiymatni input maydoniga qaytaramiz

    if(value != '' && value != '0'){
        param.value = value;
    }else{
        param.value = '0'
    }
    return param.value
}
function autoSetCardSum(){
    if(parseInt(getTotalSum) - cash_sum>0){
        card_sum = parseInt(getTotalSum) - cash_sum
    }else{
        card_sum = 0
        debt_sum = 0
    }
    display.value = format_entered_sum(cash_sum)
    display_card.value = format_entered_sum(card_sum)
    debt_display.value = format_entered_sum(debt_sum)
}

function autoSetDebtSum(){
    if(parseInt(getTotalSum) - cash_sum - card_sum>0){
        debt_sum = parseInt(getTotalSum) - cash_sum - card_sum
    }else{
        debt_sum = 0
    }
    display_card.value = format_entered_sum(card_sum)
    debt_display.value = format_entered_sum(debt_sum)
}

function paymentPayFunc(text) {
    if(loader != undefined && loader != null){
        if(loader.classList.contains("d-none")){
            loader.classList.remove("d-none")
        }
    }
    if(myDiv != undefined && myDiv != null){
        if(myDiv.classList.contains("d-none")){
            myDiv.classList.remove("d-none")
        }
    }

    $(document).ready(function () {
        if(order_data.length>0){
            try{
                $.ajax({
                    url: payment_pay_url,
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token.trim()
                    },
                    dataType: 'json', // Javobni JSON formatida tahlil qilish
                    data:{
                        'order_data':order_data,
                        'client_id':client_id,
                        'sale_id':selected_checklist_id,
                        'client_dicount_price':clientDicountPrice,
                        'paid_amount':accepting_sum_int,
                        'return_amount':change_sum_int,
                        'card_sum':card_sum,
                        'cash_sum':cash_sum,
                        'debt_sum':debt_sum,
                        'text':text,
                        'checklist_changed':checklist_changed
                        // 'client_dicount_price':clientDicountPrice,
                    },
                    success: function (data) {
                        hideHasItems()
                        if(data.status == true){
                            setTimeout(function () {
                                if(loader != undefined && loader != null){
                                    if(!loader.classList.contains("d-none")){
                                        loader.classList.add("d-none")
                                    }
                                }
                                if(myDiv != undefined && myDiv != null){
                                    if(!myDiv.classList.contains("d-none")){
                                        myDiv.classList.add("d-none")
                                    }
                                }
                                getCheckAsideFunc()
                            }, 244)
                            if(localStorage.getItem('order_data') != undefined && localStorage.getItem('order_data') != null){
                                localStorage.removeItem('order_data')
                            }
                            toastr.success(payment_success_text+' '+data.code)
                            truncuateCashboxFunc()

                        }else if(data.status == false){
                            setTimeout(function () {
                                if(loader != undefined && loader != null){
                                    if(!loader.classList.contains("d-none")){
                                        loader.classList.add("d-none")
                                    }
                                }
                                if(myDiv != undefined && myDiv != null){
                                    if(!myDiv.classList.contains("d-none")){
                                        myDiv.classList.add("d-none")
                                    }
                                }
                                getCheckAsideFunc()
                            }, 244)
                            if(localStorage.getItem('order_data') != undefined && localStorage.getItem('order_data') != null){
                                localStorage.removeItem('order_data')
                            }
                            toastr.success(set_aside_success_text+' '+data.code)
                            truncuateCashboxFunc()
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle errors here
                        console.log(xhr.responseText); // Log the error response from the server
                        toastr.error('An error occurred: ' + xhr.status + ' ' + error); // Show error message
                    }
                })
            }catch (e) {
                console.log(e)
            }
        }else{
            toastr.warning(ordered_fail_text)
        }
    })
}

function deleteCheckFunc() {
    if(loader != undefined && loader != null){
        if(loader.classList.contains("d-none")){
            loader.classList.remove("d-none")
        }
    }
    if(myDiv != undefined && myDiv != null){
        if(myDiv.classList.contains("d-none")){
            myDiv.classList.remove("d-none")
        }
    }
    $(document).ready(function () {
        try{
            $.ajax({
                url: "/../api/payment-delete",
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                data:{
                    'sale_id':selected_checklist_id,
                },
                success: function (data) {
                    hideHasItems()
                    if(data.status == true){
                        if(set_checklist_button_delete != undefined && set_checklist_button_delete != null) {
                            set_checklist_button_delete.disabled = true
                        }
                        setTimeout(function () {
                            if(loader != undefined && loader != null){
                                if(!loader.classList.contains("d-none")){
                                    loader.classList.add("d-none")
                                }
                            }
                            if(myDiv != undefined && myDiv != null){
                                if(!myDiv.classList.contains("d-none")){
                                    myDiv.classList.add("d-none")
                                }
                            }
                            getCheckAsideFunc()
                        }, 244)
                        if(localStorage.getItem('order_data') != undefined && localStorage.getItem('order_data') != null){
                            localStorage.removeItem('order_data')
                        }
                        toastr.success(set_aside_success_text+' '+data.code)
                        truncuateCashboxFunc()
                    }
                },
                error: function (xhr, status, error) {
                    // Handle errors here
                    console.log(xhr.responseText); // Log the error response from the server
                    toastr.error('An error occurred: ' + xhr.status + ' ' + error); // Show error message
                }
            })
        }catch (e) {
            console.log(e)
        }
    })
}
