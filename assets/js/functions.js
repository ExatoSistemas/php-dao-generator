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

function ucfirst(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
}

/** Converte uma string que separa palavras_com_underline para o padrão camelCase com a primeira letra minuscula */
function underlineToCamelDown(word){
    const wordArray = word.split("_")
    let wordCamel = "";

    for(let singleWord = 0; singleWord < wordArray.length; singleWord++){
        if(singleWord == 0){
            wordCamel += wordArray[singleWord].toLowerCase()
        } else {
            wordCamel += ucfirst(wordArray[singleWord].toLowerCase())
        }
    }

    return wordCamel;
}

/** Converte uma string que separa palavras_com_underline para o padrão camelCase com a primeira letra maiuscula */
function underlineToCamelUp(word){
    const wordArray = word.split("_")
    let wordCamel = "";

    for(let singleWord = 0; singleWord < wordArray.length; singleWord++){
        wordCamel += ucfirst(wordArray[singleWord].toLowerCase())
    }

    return wordCamel;
}