function passwordHiddenAndShow(inputId, toggleId){
    const input = document.querySelector('#'+inputId)
    const toggle = document.querySelector('#'+toggleId)
    if(input.type === 'password'){
        input.type = 'text'
        toggle.innerHTML = '<i class="fas fa-eye-slash"></i>'
    } else {
        input.type = 'password'
        toggle.innerHTML = '<i class="fas fa-eye"></i>'
    }
}