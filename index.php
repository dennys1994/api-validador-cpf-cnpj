<?php

header('Content-Type: application/json');

// Função para validar CPF
function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    if (strlen($cpf) !== 11) {
        return false;
    }
    if (preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

// Função para validar CNPJ
function validarCNPJ($cnpj) {
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
    if (strlen($cnpj) !== 14 || preg_match('/^(\d)\1{13}$/', $cnpj)) {
        return false;
    }
    for ($t = 12; $t < 14; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cnpj[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cnpj[$c] != $d) {
            return false;
        }
    }
    return true;
}
// Exemplo de chamada: http://api.cinedsoti.com.br/?acao=validarCPF&cpf=12345678909

// Captura a requisição
$request_method = $_SERVER['REQUEST_METHOD'];
$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

switch ($acao) {
    case 'validarCPF':
        $cpf = isset($_GET['cpf']) ? $_GET['cpf'] : '';
        if ($cpf) {
            $valido = validarCPF($cpf);
            echo json_encode(['cpf' => $cpf, 'valido' => $valido]);
        } else {
            echo json_encode(['error' => 'CPF não fornecido.']);
        }
        break;

    case 'validarCNPJ':
        $cnpj = isset($_GET['cnpj']) ? $_GET['cnpj'] : '';
        if ($cnpj) {
            $valido = validarCNPJ($cnpj);
            echo json_encode(['cnpj' => $cnpj, 'valido' => $valido]);
        } else {
            echo json_encode(['error' => 'CNPJ não fornecido.']);
        }
        break;

    // Adicione outros casos para novas funcionalidades aqui

    default:
        echo json_encode(['error' => 'Ação inválida.']);
        break;
}

/*exemplo de funcao para fazer requisicao na API

<?php

function fazerRequisicao($acao, $parametro) {
    $url = "http://api.cinedsoti.com.br/?acao=$acao&$parametro";

    $ch = curl_init();

    // Configurações do cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Executa a requisição
    $response = curl_exec($ch);

    // Verifica erros
    if (curl_errno($ch)) {
        echo 'Erro: ' . curl_error($ch);
    } else {
        echo 'Resposta da API: ' . $response;
    }

    // Fecha a conexão
    curl_close($ch);
}

// Exemplo de chamada para validar CPF
fazerRequisicao('validarCPF', 'cpf=12345678909');

// Exemplo de chamada para validar CNPJ
fazerRequisicao('validarCNPJ', 'cnpj=12345678000195');

?>
*/
?>
