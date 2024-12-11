// JavaScript

// Display element
let display = document.getElementById('display');
let display_card = document.getElementById('display_card');
let display_password = document.getElementById('display_password');
let cashier_password = document.getElementById('cashier_password')
let entered_cash_sum = '0'
let entered_card_sum = '0'
let cash_sum = 0
let card_sum = 0
let accepting_sum_int = 0
let leaving_sum_int = 0
let change_sum_int = 0
let klaviaturaNumber = 0

let getTotalSum = 0
let payment_sum = document.getElementById('payment_sum')
let accepting_sum = document.getElementById('accepting_sum')
let leaving_sum = document.getElementById('leaving_sum')
let change_sum = document.getElementById('change_sum')

let calculators = document.getElementById('calculators')
let cashCalculator = document.getElementById('cashCalculator')
let cardCalculator = document.getElementById('cardCalculator')
let cardContent = document.getElementById('cardContent')
let card_payment_ = document.getElementById('card_payment_')
let is_set_mixed = false

function format_entered_sum(numbers){
    if(parseInt(numbers)>0){
        return parseInt(numbers).toLocaleString()
    }else{
        return 0
    }
}

function setValues(cash_sum_, card_sum_){
    display.value = format_entered_sum(cash_sum_); // Aks holda, raqamni qo'shamiz
    display_card.value = format_entered_sum(card_sum_); // Aks holda, raqamni qo'shamiz
    if(parseInt(getTotalSum) > (cash_sum_ + card_sum_)){
        accepting_sum.innerText = format_entered_sum(cash_sum_ + card_sum_); // Aks holda, raqamni qo'shamiz
        accepting_sum_int = cash_sum_ + card_sum_
        leaving_sum.innerText = format_entered_sum(parseInt(getTotalSum) - accepting_sum_int)
        leaving_sum_int = parseInt(getTotalSum) - accepting_sum_int
        change_sum.innerText = '0'
        change_sum_int = 0
    }else if(parseInt(getTotalSum) == (cash_sum_ + card_sum_)){
        accepting_sum.innerText = format_entered_sum(parseInt(getTotalSum)); // Aks holda, raqamni qo'shamiz
        accepting_sum_int = parseInt(getTotalSum)
        leaving_sum.innerText = '0'
        leaving_sum_int = 0
        change_sum.innerText = '0'
        change_sum_int = 0
    }else{
        accepting_sum.innerText = format_entered_sum(parseInt(getTotalSum)); // Aks holda, raqamni qo'shamiz
        accepting_sum_int = parseInt(getTotalSum)
        leaving_sum.innerText = '0'
        leaving_sum_int = 0
        change_sum.innerText = format_entered_sum(cash_sum_ + card_sum_ - parseInt(getTotalSum))
        change_sum_int = cash_sum_ + card_sum_ - parseInt(getTotalSum)
    }
}

// Function to append numbers to the display
function appendNumber(number) {
    if (display.value == '0') {
        entered_cash_sum = parseInt(number)
    } else {
        entered_cash_sum = String(entered_cash_sum) + number
    }
    cash_sum = parseInt(entered_cash_sum)
    if(is_set_mixed){
        autoSetCardSum()
    }
    setValues(cash_sum, card_sum)
}

// Function to append numbers to the display
function appendNumberCard(number) {
    if (display_card.value == '0') {
        entered_card_sum = parseInt(number)
    } else {
        entered_card_sum = String(entered_card_sum) + number
    }
    card_sum = parseInt(entered_card_sum)
    setValues(cash_sum, card_sum)
}

// Function to clear the display
function clearDisplay() {
    cash_sum = 0
    if(is_set_mixed){
        autoSetCardSum()
    }
    setValues(cash_sum, card_sum)
}

// Function to clear the display
function clearDisplayCard() {
    card_sum = 0
    setValues(cash_sum, card_sum)
}
// Function to remove the last digit (Backspace)
function backspace() {
    if (display.value.length > 1) {
        entered_cash_sum = String(entered_cash_sum).slice(0, -1)
        cash_sum = parseInt(entered_cash_sum)
        if(is_set_mixed){
            autoSetCardSum()
        }
        setValues(cash_sum, card_sum)
    } else {
        entered_cash_sum = '0'
        cash_sum = parseInt(entered_cash_sum)
        if(is_set_mixed){
            autoSetCardSum()
        }
        setValues(cash_sum, card_sum)
    }
}

// Function to remove the last digit (Backspace)
function backspaceCard() {
    if (display_card.value.length > 1) {
        entered_card_sum = String(entered_card_sum).slice(0, -1)
        card_sum = parseInt(entered_card_sum)
        setValues(cash_sum, card_sum)
    } else {
        entered_card_sum = '0'
        card_sum = parseInt(entered_card_sum)
        setValues(cash_sum, card_sum)
    }
}

// Function to append numbers to the display
function appendPassword(number) {
    if (display_password.innerText == '0') {
        cashier_password.value = String(number)
        display_password.innerText = String(number); // Agar dastlabki raqam 0 bo'lsa, uni o'zgartiramiz
    } else {
        cashier_password.value = String(cashier_password.value) + String(number)
        display_password.innerText = cashier_password.value; // Aks holda, raqamni qo'shamiz
    }
}

// Function to clear the display
function clearDisplayPassword() {
    cashier_password.value = '0'
    display_password.innerText = '0'; // Ekrandagi raqamni tozalash
}

// Function to remove the last digit (Backspace)
function backspacePassword() {
    if (display_password.innerText.length > 1) {
        cashier_password.value = String(cashier_password.value).slice(0, -1)
        display_password.innerText = String(cashier_password.value); // Oxirgi belgini o'chirish
    } else {
        display_password.innerText = '0'; // Agar faqat bir raqam qolgan bo'lsa, uni 0 ga o'zgartiramiz
        cashier_password.value = '0'
    }
}
function paymentFunc() {
    getTotalSum = total_all_left_sum
    payment_sum.innerText = format_entered_sum(getTotalSum)
    change_sum.innerText = '0'
}

let payment_types = document.querySelectorAll('#payment_modal .btn-outline-secondary')

function setPaymentTypes(button_){
    for(let ij = 0;ij<payment_types.length; ij++){
        if(payment_types[ij].classList.contains('active')){
            payment_types[ij].classList.remove('active')
        }
    }
    if(!button_.classList.contains('active')){
        button_.classList.add('active')
    }
}

function setCash(button__) {
    if(!cardContent.classList.contains('d-none')){
        cardContent.classList.add('d-none')
    }
    if(!cardCalculator.classList.contains('d-none')){
        cardCalculator.classList.add('d-none')
    }
    if(cashCalculator.classList.contains('d-none')){
        cashCalculator.classList.remove('d-none')
    }
    entered_cash_sum = '0'
    cash_sum = parseInt(entered_cash_sum)
    card_sum = 0
    is_set_mixed = false
    setValues(cash_sum, card_sum)
    setPaymentTypes(button__)
}
function setCard(button__) {
    if(cardContent.classList.contains('d-none')){
        cardContent.classList.remove('d-none')
    }
    if(!cashCalculator.classList.contains('d-none')){
        cashCalculator.classList.add('d-none')
    }
    if(!cardCalculator.classList.contains('d-none')){
        cardCalculator.classList.add('d-none')
    }
    card_payment_.value = format_entered_sum(getTotalSum)
    entered_card_sum = getTotalSum
    entered_cash_sum = '0'
    card_sum = parseInt(entered_card_sum)
    cash_sum = 0
    is_set_mixed = false
    setValues(cash_sum, card_sum)
    setPaymentTypes(button__)
}
function setMixed(button__) {
    if(!cardContent.classList.contains('d-none')){
        cardContent.classList.add('d-none')
    }
    if(cashCalculator.classList.contains('d-none')){
        cashCalculator.classList.remove('d-none')
    }
    if(cardCalculator.classList.contains('d-none')){
        cardCalculator.classList.remove('d-none')
    }
    is_set_mixed = true
    setValues(cash_sum, card_sum)
    setPaymentTypes(button__)

}

display.addEventListener('input', () => {
    klaviaturaNumber = 0
    klaviaturaNumber = formatInput(display).replace(/\s+/g, '')
    cash_sum = parseInt(klaviaturaNumber)
    if(is_set_mixed){
        autoSetCardSum()
    }
    setValues(cash_sum, card_sum)
});

display_card.addEventListener('input', () => {
    klaviaturaNumber = 0
    klaviaturaNumber = formatInput(display_card).replace(/\s+/g, '')
    card_sum = parseInt(klaviaturaNumber)
    setValues(cash_sum, card_sum)
});
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
    }
}
