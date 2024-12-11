let input__event = {}
setTimeout(function () {
    let dataTables_filter_input = document.querySelector('#offcanvasTop .dataTables_filter input')
    let keys = document.querySelectorAll('.key_big');
    keys.forEach(key => {
        key.addEventListener('click', () => {
            const keyText = key.textContent.trim();
            if (keyText === 'Space') {
                dataTables_filter_input.value += ' ';
            } else {
                dataTables_filter_input.value += keyText;
            }

            inputEvent(dataTables_filter_input)
        });
    });
}, 844)

function clearKeyboardDisplay(){
    let dataTables_filter_input = document.querySelector('#offcanvasTop .dataTables_filter input')
    dataTables_filter_input.value = ''
    inputEvent(dataTables_filter_input)
}
function backspaceKeyboard(){
    let dataTables_filter_input = document.querySelector('#offcanvasTop .dataTables_filter input')
    if (dataTables_filter_input.value.length > 1) {
        dataTables_filter_input.value = String(dataTables_filter_input.value).slice(0, -1)
    } else {
        dataTables_filter_input.value = ''
    }
    inputEvent(dataTables_filter_input)
}
function inputEvent(dataTables_filter_input){
    // "input" hodisasini qo'lda qo'zg'atish
    input__event = new Event('input', { bubbles: true });
    dataTables_filter_input.dispatchEvent(input__event);
}

let input__event_fast = {}
setTimeout(function () {
    let dataTables_filter_input_fast = document.querySelector('#fastgoods .dataTables_filter input')
    let keys_fast = document.querySelectorAll('.key_big_fast');
    keys_fast.forEach(key => {
        key.addEventListener('click', () => {
            const keyText = key.textContent.trim();
            if (keyText === 'Space') {
                dataTables_filter_input_fast.value += ' ';
            } else {
                dataTables_filter_input_fast.value += keyText;
            }

            inputEventFast(dataTables_filter_input_fast)
        });
    });
}, 844)

function clearKeyboardDisplayFast(){
    let dataTables_filter_input_fast = document.querySelector('#fastgoods .dataTables_filter input')
    dataTables_filter_input_fast.value = ''
    inputEventFast(dataTables_filter_input_fast)
}
function backspaceKeyboardFast(){
    let dataTables_filter_input_fast = document.querySelector('#fastgoods .dataTables_filter input')
    if (dataTables_filter_input_fast.value.length > 1) {
        dataTables_filter_input_fast.value = String(dataTables_filter_input_fast.value).slice(0, -1)
    } else {
        dataTables_filter_input_fast.value = ''
    }
    inputEventFast(dataTables_filter_input_fast_fast)
}
function inputEventFast(dataTables_filter_input_fast){
    // "input" hodisasini qo'lda qo'zg'atish
    input__event_fast = new Event('input', { bubbles: true });
    dataTables_filter_input_fast.dispatchEvent(input__event_fast);
}