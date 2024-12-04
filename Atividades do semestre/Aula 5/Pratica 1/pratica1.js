function appendNumber(number) {
    document.getElementById('display').value += number;
}

function appendOperator(operator) {
    document.getElementById('display').value += ' ' + operator + ' ';
}

function clearDisplay() {
    document.getElementById('display').value = '';
    document.getElementById('display').style.backgroundColor = '#999'; // 
}   

function calculate() {
    try {
        let result = eval(document.getElementById('display').value);
        document.getElementById('display').value = result;

        if (result >= 0) {
            document.getElementById('display').style.backgroundColor = 'green';
        } else {
            document.getElementById('display').style.backgroundColor = 'red';
        }
    } catch (e) {
        document.getElementById('display').value = 'Erro';
        document.getElementById('display').style.backgroundColor = 'black';
    }
}
