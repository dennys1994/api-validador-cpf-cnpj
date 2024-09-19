function fazerRequisicao($acao, $parametro) {
    $url = "http://api.cinedsoti.com.br/?acao=$acao&$parametro";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Erro: ' . curl_error($ch);
    } else {
        echo 'Resposta da API: ' . $response;
    }

    curl_close($ch);
}

// Exemplo de chamada para validar CPF
fazerRequisicao('validarCPF', 'cpf=12345678909');

// Exemplo de chamada para validar CNPJ
fazerRequisicao('validarCNPJ', 'cnpj=12345678000195');

