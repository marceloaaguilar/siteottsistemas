// Recupera a Chave Site Key
var siteKey = document.querySelector("#g-token");

// Envia a Site Key para o Google obter o token
grecaptcha.ready(function () {
    grecaptcha.execute('6LdwH0AlAAAAALLLmGD7bOBFaLLjbsvDqGI7yQrn', { action: 'submit' }).then(function (token) {
        // Enviar o token retornado pelo Google para o Formulário
        document.querySelector('#g-recaptcha-response').value = token;
    })
})

