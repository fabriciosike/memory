<?php
session_start();

// 1. Inicializa o jogo se não existir ou se reiniciar
if (!isset($_SESSION['fila']) || isset($_POST['reiniciar'])) {
    $_SESSION['fila'] = ["🚗 Carro Azul", "🚖 Táxi", "🚒 Bombeiro"];
    $_SESSION['carros_atendidos'] = 0;
    $_SESSION['modo'] = "FIFO"; // Modo padrão guardado na sessão
    $_SESSION['mensagem'] = "Bem-vindo! Escolha o modo da estrutura de dados e gerencie os carros.";
}

// 2. Atualiza o modo (FIFO ou LIFO) de forma segura se o usuário alterar via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modo'])) {
    $modoSelecionado = $_POST['modo'];
    if (in_array($modoSelecionado, ["FIFO", "LIFO"]) && $_SESSION['modo'] !== $modoSelecionado) {
        $_SESSION['modo'] = $modoSelecionado;
        $_SESSION['mensagem'] = "Modo alterado para " . ($_SESSION['modo'] === 'FIFO' ? 'FIFO (Fila)' : 'LIFO (Pilha)') . "!";
    }
}

// 3. Processa as ações de chegar ou liberar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['reiniciar'])) {
    
    // Ação: Inserir elemento (Igual para ambos: entra no fim da estrutura)
    if (isset($_POST['acao']) && $_POST['acao'] === 'chegar') {
        if (count($_SESSION['fila']) >= 5) {
            $_SESSION['mensagem'] = "❌ Estacionamento Lotado! Libere espaço antes de aceitar novos carros.";
        } else {
            $modelos = ["🏎️ Carro Corrida", "🚙 SUV", "🚌 Ônibus", "🚓 Polícia", "🚚 Caminhão"];
            $novo_carro = $modelos[array_rand($modelos)];
            
            array_push($_SESSION['fila'], $novo_carro);
            $_SESSION['mensagem'] = "Novo veículo chegou: $novo_carro!";
        }
    }
    
    // Ação: Remover elemento (Muda dependendo do Modo salvo na SESSÃO)
    if (isset($_POST['acao']) && $_POST['acao'] === 'sair') {
        if (empty($_SESSION['fila'])) {
            $_SESSION['mensagem'] = "📭 O estacionamento já está vazio!";
        } else {
            if ($_SESSION['modo'] === "FIFO") {
                // FIFO: Primeiro a entrar é o primeiro a sair (Início do array)
                $liberado = array_shift($_SESSION['fila']);
                $_SESSION['mensagem'] = "Sucesso (FIFO)! Você liberou o primeiro da fila: $liberado.";
            } else {
                // LIFO: Último a entrar é o primeiro a sair (Fim do array)
                $liberado = array_pop($_SESSION['fila']);
                $_SESSION['mensagem'] = "Sucesso (LIFO)! O beco estava fechado, então o último a entrar saiu primeiro: $liberado.";
            }
            $_SESSION['carros_atendidos']++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de ED: FIFO vs LIFO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5" style="max-width: 650px;">
    <div class="text-center mb-4">
        <h1 class="fw-bold text-dark">🚦 Simulador de Estrutura de Dados</h1>
        <p class="text-muted">Alterne entre **FIFO** e **LIFO** para ver a diferença na prática!</p>
        
        <div class="p-3 bg-white rounded shadow-sm border mb-3">
            <h4>Veículos Liberados: <span class="badge bg-success"><?= $_SESSION['carros_atendidos'] ?></span></h4>
        </div>
    </div>

    <div class="card p-3 shadow-sm mb-4 bg-white">
        <h5 class="text-center mb-3 fw-bold">Selecione a Estrutura de Dados:</h5>
        <form method="POST" id="form-modo" class="d-flex justify-content-center gap-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="modo" id="modoFifo" value="FIFO" 
                       onchange="this.form.submit()" <?= $_SESSION['modo'] === 'FIFO' ? 'checked' : '' ?>>
                <label class="form-check-label fw-bold text-primary" for="modoFifo">
                    📥 FIFO (Fila / Queue)
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="modo" id="modoLifo" value="LIFO" 
                       onchange="this.form.submit()" <?= $_SESSION['modo'] === 'LIFO' ? 'checked' : '' ?>>
                <label class="form-check-label fw-bold text-danger" for="modoLifo">
                    📚 LIFO (Pilha / Stack)
                </label>
            </div>
        </form>
    </div>

    <div class="alert <?= $_SESSION['modo'] === 'FIFO' ? 'alert-primary' : 'alert-danger' ?> text-center shadow-sm text-dark fw-medium" role="alert">
        <?= $_SESSION['mensagem'] ?>
    </div>

    <div class="card p-4 shadow-sm mb-4 bg-dark text-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="small text-warning">🏁 SAÍDA</span>
            <h5 class="m-0">🚙 Estado da Memória / Vagas</h5>
            <span class="small text-info">📥 ENTRADA</span>
        </div>
        
        <div class="d-flex flex-column gap-2 p-2 bg-secondary rounded" style="min-height: 220px;">
            <?php if (empty($_SESSION['fila'])): ?>
                <span class="text-white-50 text-center my-auto">Estacionamento Vazio (Null)</span>
            <?php else: ?>
                <?php foreach ($_SESSION['fila'] as $index => $carro): ?>
                    <?php 
                        // Calcula dinamicamente quem sai baseado na sessão
                        $isProximo = false;
                        if ($_SESSION['modo'] === 'FIFO' && $index === 0) $isProximo = true;
                        if ($_SESSION['modo'] === 'LIFO' && $index === count($_SESSION['fila']) - 1) $isProximo = true;
                        
                        $bgItem = $isProximo ? 'bg-warning text-dark border border-3 border-white' : 'bg-light text-dark';
                    ?>
                    <div class="p-3 rounded shadow-sm d-flex justify-content-between align-items-center <?= $bgItem ?>">
                        <span class="fw-bold fs-5"><?= $carro ?></span>
                        <?php if ($isProximo): ?>
                            <span class="badge bg-dark text-white">PRÓXIMO A SAIR</span>
                        <?php else: ?>
                            <span class="text-muted small">Posição: <?= $index + 1 ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="card p-3 shadow-sm text-center">
        <form method="POST" class="row g-2">
            <div class="col-6">
                <button type="submit" name="acao" value="chegar" class="btn btn-outline-primary btn-lg w-100">
                    ➕ Chegar Carro
                </button>
            </div>
            <div class="col-6">
                <button type="submit" name="acao" value="sair" class="btn btn-success btn-lg w-100" <?= empty($_SESSION['fila']) ? 'disabled' : '' ?>>
                    ➖ Liberar Carro
                </button>
            </div>
        </form>
        
        <form method="POST" class="mt-3">
            <button type="submit" name="reiniciar" class="btn btn-sm btn-link text-secondary w-100">
                Reiniciar Tudo
            </button>
        </form>
    </div>

    <div class="mt-4 card p-3 bg-white shadow-xs">
        <h6 class="fw-bold">💡 O que está acontecendo?</h6>
        <?php if ($_SESSION['modo'] === 'FIFO'): ?>
            <p class="small text-muted mb-0"><strong>FIFO (First In, First Out):</strong> Funciona como uma fila comum. O primeiro carro que entrou (no topo da lista) é o primeiro a sair.</p>
        <?php else: ?>
            <p class="small text-muted mb-0"><strong>LIFO (Last In, First Out):</strong> Funciona como uma pilha. O último carro que chegou bloqueia a saída, então ele precisa ser removido primeiro.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>