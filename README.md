# Validador de CPF e CNPJ

Esta API permite validar CPF e CNPJ utilizando PHP. A API pode ser acessada através de endpoints simples que aceitam parâmetros via URL.

## Como usar

### Validação de CPF

Endpoint para validar um CPF:

http://api.cinedsoti.com.br/?acao=validarCPF&cpf={CPF}

Substitua `{CPF}` pelo número do CPF que deseja validar.

Exemplo de uso:

http://api.cinedsoti.com.br/?acao=validarCPF&cpf=12345678909


### Validação de CNPJ

Endpoint para validar um CNPJ:

http://api.cinedsoti.com.br/?acao=validarCNPJ&cnpj={CNPJ}

Substitua `{CNPJ}` pelo número do CNPJ que deseja validar.

Exemplo de uso:

http://api.cinedsoti.com.br/?acao=validarCNPJ&cnpj=12345678000195


## Respostas

A API retorna uma resposta JSON com o seguinte formato:

- **Para CPF:**
    ```json
    {
      "cpf": "12345678909",
      "valido": true
    }
    ```

- **Para CNPJ:**
    ```json
    {
      "cnpj": "12345678000195",
      "valido": false
    }
    ```

Se houver um erro, a resposta será no formato:
```json
{
  "error": "Mensagem de erro"
}



### 4. Exemplo de Requisição

```php
<?php

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
?>
