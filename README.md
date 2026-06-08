# 🚦 Simulador de Estruturas de Dados: FIFO vs LIFO

## 📖 Sobre o Projeto

O **Simulador de Estruturas de Dados: FIFO vs LIFO** é um jogo educativo desenvolvido com o objetivo de auxiliar estudantes na compreensão prática dos conceitos de **Fila (FIFO - First In, First Out)** e **Pilha (LIFO - Last In, First Out)**.

Utilizando a analogia de um estacionamento, o sistema permite visualizar de forma interativa como os elementos são inseridos e removidos em cada estrutura de dados, tornando o aprendizado mais intuitivo, dinâmico e acessível.

O projeto foi desenvolvido como atividade de extensão universitária, buscando aproximar conceitos teóricos da programação e das estruturas de dados de situações cotidianas.

---

## 🎯 Objetivos

* Facilitar o aprendizado dos conceitos de FIFO e LIFO.
* Demonstrar visualmente o comportamento de filas e pilhas.
* Incentivar a aprendizagem por meio da interação prática.
* Auxiliar estudantes de Computação, Engenharia e áreas correlatas.
* Disponibilizar uma ferramenta educacional simples e acessível via navegador.

---

## 🖥️ Funcionalidades

* Alternância dinâmica entre os modos **FIFO** e **LIFO**.
* Inserção de novos veículos na estrutura.
* Remoção de veículos conforme a regra da estrutura selecionada.
* Destaque visual do próximo elemento a ser removido.
* Contador de veículos atendidos.
* Reinicialização da simulação.
* Interface responsiva desenvolvida com Bootstrap.

---

## 📚 Conceitos Trabalhados

### FIFO (First In, First Out)

Em uma fila, o primeiro elemento que entra é o primeiro a sair.

Exemplo:

Entrada:
🚗 → 🚖 → 🚒

Saída:
🚗 → 🚖 → 🚒

---

### LIFO (Last In, First Out)

Em uma pilha, o último elemento que entra é o primeiro a sair.

Exemplo:

Entrada:
🚗 → 🚖 → 🚒

Saída:
🚒 → 🚖 → 🚗

---

## 🛠️ Tecnologias Utilizadas

* PHP
* HTML5
* CSS3
* Bootstrap 5
* Sessões PHP (Session)
* JavaScript (eventos simples)

---

## 📂 Estrutura do Projeto

```text
/
├── index.php
├── assets/
│   ├── css/
│   ├── js/
│   └── imagens/
└── README.md
```

---

## 🚀 Como Executar

### Pré-requisitos

* PHP 7.4 ou superior
* Servidor Web (Apache, Nginx ou XAMPP)

### Instalação

1. Clone o repositório:

```bash
git clone https://github.com/seu-usuario/fifo-lifo-simulator.git
```

2. Acesse a pasta do projeto:

```bash
cd fifo-lifo-simulator
```

3. Inicie um servidor PHP local:

```bash
php -S localhost:8000
```

4. Abra o navegador:

```text
http://localhost:8000
```

---

## 🎮 Como Jogar

1. Escolha entre os modos:

   * FIFO (Fila)
   * LIFO (Pilha)

2. Clique em **"Chegar Carro"** para adicionar veículos.

3. Clique em **"Liberar Carro"** para remover veículos da estrutura.

4. Observe qual veículo será removido conforme a regra da estrutura selecionada.

5. Compare os resultados para compreender as diferenças entre Fila e Pilha.

---

## 📈 Resultados Educacionais

Durante a aplicação do projeto observou-se:

* Melhor compreensão dos conceitos de estruturas de dados.
* Maior engajamento dos estudantes em atividades práticas.
* Facilidade na visualização dos processos de inserção e remoção.
* Aprendizagem mais significativa por meio da gamificação.

---

## 🔮 Melhorias Futuras

* Inclusão de Listas Encadeadas.
* Inclusão de Árvores Binárias.
* Inclusão de Grafos.
* Sistema de níveis e pontuação.
* Modo multiplayer para atividades em sala de aula.
* Painel de estatísticas de aprendizagem.

---

## 👨‍💻 Autor

Desenvolvido como projeto educacional para apoio ao ensino de Estruturas de Dados e promoção da aprendizagem ativa em cursos de Computação e Engenharia.

---

## 📄 Licença

Este projeto é disponibilizado para fins acadêmicos e educacionais.
