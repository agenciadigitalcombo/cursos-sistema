
function setMethodPay($e) {
    let value = $e.value
    if (value == 'CREDIT_CARD') {
        optCard.classList.remove('hidden')
    } else {
        optCard.classList.add('hidden')
    }
}


function maskCvv($e) {
    $e.value = $e.value.replace(/\D/gi, '').substr(0, 3)
}
function maskValidade($e) {
    $e.value = $e.value.replace(/\D/gi, '').replace(/(\d{2,2})(\d{2,2})/gi, '$1/$2').substr(0, 5)
}
function maskNumero($e) {
    $e.value = $e.value.replace(/\D/gi, '').replace(/(\d{4,4})(\d{4,4})(\d{4,4})(\d{4,4})/gi, '$1 $2 $3 $4').substr(0, 19)
}

function maskCep($e) {
    $e.value = $e.value.replace(/\D/gi, '')
        .replace(/(\d{5})(\d{3})/gi, "\$1-\$2")
        .substring(0, 9);
}