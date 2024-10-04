<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="quiz.css">
    <title>Quiz</title>
    <style>
        .question {
            margin-top: 20px;
        }

        .answer-btn {
            margin: 5px;
        }

        .justification {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
            display: none;
        }

        .next-btn {
            margin-top: 20px;
            display: none;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        #quizSubject {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 id="quizSubject"></h1>
        <div id="questionContainer"></div>
        <button id="nextQuestionBtn" class="btn btn-primary next-btn" onclick="nextQuestion()">Avançar</button>
    </div>

    <script>
        // Função para obter parâmetros da URL
        function getQueryParams() {
            let params = {};
            window.location.search.substring(1).split("&").forEach(function(pair) {
                let [key, value] = pair.split("=");
                params[decodeURIComponent(key)] = decodeURIComponent(value);
            });
            return params;
        }

        // Perguntas por matéria (adicione aqui suas perguntas, opções, respostas e justificativas)
        var questionsData = {
            'Matemática': [{
                    question: " QUESTÃO FÁCIL- (ENEM) A figura é uma representação simplificada do carrossel de um parque de diversões, visto de cima. Nessa representação, os cavalos estão identificados pelos pontos escuros, e ocupam circunferências de raios 3 m e 4 m, respectivamente, ambas centradas no ponto O. Em cada sessão de funcionamento, o carrossel efetua 10 voltas. Quantos metros uma criança sentada no cavalo C1 percorrerá a mais do que uma criança no cavalo C2, em uma sessão? Use 3,0 como aproximação para π.",
                    options: ["55,5", "60", "175,5", "235,5"],
                    correctAnswer: 1,
                    justification: "A criança no cavalo C1 percorre 60 metros a mais que a criança no cavalo C2, porque as circunferências têm raios diferentes, e o cavalo C1, que está mais distante do centro, percorre uma distância maior."
                },
                {
                    question: "QUETÃO MÉDIA - (Enem - PPL) A logomarca de uma empresa de computação é um quadrado, AEFG, com partes pintadas como mostra a figura. Sabe-se que todos os ângulos agudos presentes na figura medem 45° e que AB = BC = CD = DE. A fim de divulgar a marca entre os empregados, a gerência decidiu que fossem pintadas logomarcas de diversos tamanhos nas portas, paredes e fachada da empresa. Pintadas as partes cinzas de todas as logomarcas, sem desperdício e sem sobras, já foram gastos R$ 320. O preço das tintas cinza, preta e branca é o mesmo. Considerando que não haja desperdício e sobras, o custo para pintar as partes pretas e o custo para pintar as partes brancas serão, respectivamente",
                    options: ["320 e 640", "960 e 1280", "2240 e 2560", "640 e 960"],
                    correctAnswer: 1,
                    justification: "Analisando a imagem, sabemos que a área do logotipo todo é igual a 8 vezes as áreas pintadas de cinza, logo, o custo com o todo será de 320 ⸳ 8 = R$ 2560. Sabemos que a área da parte branca é metade da área total:R$ 2560 : 2 = R$ 1280Para pintar a área preta, o custo será de 2560 – 320 – 1280 = R$ 960. Então, os custos das partes preta e branca serão de, respectivamente, R$ 960 e R$ 1280."
                }
            ],
            'Português': [{
                    question: "DIFÍCIL: Leia o texto abaixo e responda as questões 06 e 07.Folhetins do “correio mercantil”Domingo passado o caminho de São Cristóvão rivalizava com os aristocráticospasseios da Glória, do Botafogo e São Clemente, no luxo e na concorrência, naanimação e até na poeira. O Jockey Club anunciara a sua primeira corrida; e,apesar dos bilhetes amarelos, dos erros tipográficos e do silêncio dos jornais, asociedade elegante se esforçou em responder à amabilidade do convite. [...]Desde sete horas da manhã começaram a passar as elegantes carruagens, e osgrupos dos gentlemen riders, cavaleiros por gosto ou por economia. [...]Às 10 horas abriu-se a raia (turf), e começou a corrida com a irregularidade docostume. Os parelheiros pouco adestrados, sem o ensino conveniente, nãopartiram ao sinal e ao mesmo tempo, e disto resultou que muitas vezes o prêmioda vitória não coube ao jóquei que montava o melhor corredor, e sim àquele quetinha a felicidade de ser o primeiro a lançar-se na raia. A última corrida, que durouum minuto e dezenove segundos, teria sido brilhante se dois dos cavalos não setivessem lembrado de imitar as pombinhas de Vênus, que dizem, voavam presaspor um laço de amor.A diretoria, que envidou todos os seus esforços para tornar agradáveis as novascorridas, deve tomar as providências necessárias a fim de fazer cessar estesinconvenientes, formulando com o auxílio dos entendidos um regulamento severodo turf. Convém substituir o sinal da partida por outro mais forte e mais preciso, esó admitir à inscrição cavalos parelheiros já habituados à raia.A uma hora da tarde estava tudo acabado, e os sócios e convidados disseramadeus às verdes colinas do Engenho Novo, e voltaram à cidade para descansar esatisfazer a necessidade tão trivial e comum de jantar, insuportável costume, que,apesar de todas as revoluções do globo e todas as vicissitudes da moda, duradesde princípio do mundo. [...]ALENCAR, José de. Ao correr da pena. Disponível em: https://bit.ly/3qB7pZY.Acesso em: 24 ago. 2021. Fragmento. Nesse texto, um trecho que mostra a posição do enunciador é:",
                    options: ["(A) Domingo passado o caminho de São Cristóvão rivalizava com asaristocráticos passeios da Glória, do Botafogo e São Clemente,... (1ºparágrafo)", "(B) A diretoria, que envidou todos os seus esforços para tornar agradáveis as novas corridas, deve tomar as providências necessárias... (4º parágrafo)", "(C) O Jockey Club anunciara a sua primeira corrida; e, apesar dos bilhetes amarelos,... (1º parágrafo)", "(D) Os parelheiros pouco adestrados, sem o ensino conveniente, não partiramao sinal... (3º parágrafo)"],
                    correctAnswer: 1,
                    justification: " A opção B mostra a posição do enunciador, pois o autor do texto expressa uma opinião crítica ao sugerir que a diretoria do Jockey Club deve tomar providências para resolver os problemas nas corridas. O uso de 'deve tomar' indica uma recomendação pessoal do autor, mostrando seu ponto de vista sobre a situação."
                },
                {
                    question: "Domingo passado o caminho de São Cristóvão rivalizava com os aristocráticospasseios da Glória, do Botafogo e São Clemente, no luxo e na concorrência, naanimação e até na poeira. O Jockey Club anunciara a sua primeira corrida; e,apesar dos bilhetes amarelos, dos erros tipográficos e do silêncio dos jornais, asociedade elegante se esforçou em responder à amabilidade do convite. [...]Desde sete horas da manhã começaram a passar as elegantes carruagens, e osgrupos dos gentlemen riders, cavaleiros por gosto ou por economia. [...]Às 10 horas abriu-se a raia (turf), e começou a corrida com a irregularidade docostume. Os parelheiros pouco adestrados, sem o ensino conveniente, nãopartiram ao sinal e ao mesmo tempo, e disto resultou que muitas vezes o prêmioda vitória não coube ao jóquei que montava o melhor corredor, e sim àquele quetinha a felicidade de ser o primeiro a lançar-se na raia. A última corrida, que durouum minuto e dezenove segundos, teria sido brilhante se dois dos cavalos não setivessem lembrado de imitar as pombinhas de Vênus, que dizem, voavam presaspor um laço de amor.A diretoria, que envidou todos os seus esforços para tornar agradáveis as novascorridas, deve tomar as providências necessárias a fim de fazer cessar estesinconvenientes, formulando com o auxílio dos entendidos um regulamento severodo turf. Convém substituir o sinal da partida por outro mais forte e mais preciso, esó admitir à inscrição cavalos parelheiros já habituados à raia.A uma hora da tarde estava tudo acabado, e os sócios e convidados disseramadeus às verdes colinas do Engenho Novo, e voltaram à cidade para descansar esatisfazer a necessidade tão trivial e comum de jantar, insuportável costume, que,apesar de todas as revoluções do globo e todas as vicissitudes da moda, duradesde princípio do mundo. Entende-se desse texto que",
                    options: ["O Jockey Club ficava localizado no Engenho Novo. ", "O caminho que levava ao Jockey Club passava por Botafogo.", "Os cavaleiros do Jockey Club eram pessoas ilustres da sociedade.", "Os cavalos eram adestrados no Jockey Club."],
                    correctAnswer: 0,
                    justification: "A letra A está certa porque o texto menciona que, ao final das corridas, os sócios e convidados disseram adeus às verdes colinas do Engenho Novo, indicando que o Jockey Club estava localizado nesse bairro, já que foi onde ocorreu o evento das corridas."
                },
                // Continue inserindo as perguntas e justificativas para Português
            ],
            'Física': [
                {
                    question: "ENEM (Fácil) Um estudante observa que, ao abrir uma torneira, a água cai verticalmente e, ao se aproximar do chão, os filetes de água se tornam mais finos. Isso ocorre porque:",
                    options: ["a) a pressão atmosférica diminui ao longo da queda.", "b) a velocidade da água aumenta ao longo da queda.", "c) a densidade da água diminui ao longo da queda.", "d) o volume da água aumenta ao longo da queda."],
                    correctAnswer: 1,
                    justification: "Justificativa para a resposta correta da pergunta 1 de Física."
                },
                // Continue inserindo as perguntas e justificativas para Física
            ],
            'Biologia': [
                {
                    question: "Considere a situação hipotética de lançamento, em um ecossistema, de umadeterminanete quantidade de gás carbônico, com marcação radioativa nocarbono. Como passar do tempo, esse gás se dispersaria pelo ambiente e seriaincorporado por seres vivos.Considere as seguintes moléculas:I. Moléculas de glicose sintetizadas pelos produtores.II. Moléculas de gás carbônico produzidas pelos consumidores a partir daoxidação da glicose sintetizada pelos produtores.III. Moléculas de amido produzidas como substância de reserva das plantas.IV. Moléculas orgânicas sintetizadas pelos decopositores. Carbono radioativo poderia ser encontrado nas moléculas descritas em",
                    options: ["A-) I, apenas.", "B-) I e II, apenas", "C-) I, II, III e IV", "D-) III e IV, apenas."],
                    correctAnswer: 2,
                    justification: "Justificativa para a resposta correta da pergunta 1 de Biologia."
                },
                // Continue inserindo as perguntas e justificativas para Biologia
            ],
            'História': [
                {
                    question: "1-Com o surgimento das primeiras cidades – que remontam 12 mil anos atrás – na convivência social e política, começaram a se destacar algumas pessoas, grupos ou famílias em cargos de liderança, surgindo as primeiras instituições políticas, religiosas e administrativas com a função de coordenar os estoques de alimentos, as práticas e cultos religiosos e a defesa da cidade. Com o passar dos anos, esta organização tornou-se mais complexa e assumiu diferentes formas de atuação e modelos políticos. Sobre as formas políticas desenvolvidas no Ocidente ao longo de sua história, assinale a alternativa CORRETA.",
                    options: ["Opção 1", "Opção 2", "Opção 3", "Opção 4"],
                    correctAnswer: 0,
                    justification: "Justificativa para a resposta correta da pergunta 1 de História."
                },
                // Continue inserindo as perguntas e justificativas para História
            ],
            'Geografia': [
                {
                    question: "Exemplo de pergunta de Geografia 1",
                    options: ["Opção 1", "Opção 2", "Opção 3", "Opção 4"],
                    correctAnswer: 3,
                    justification: "Justificativa para a resposta correta da pergunta 1 de Geografia."
                },
                // Continue inserindo as perguntas e justificativas para Geografia
            ],
            'Sociologia': [
                {
                    question: "Exemplo de pergunta de Sociologia 1",
                    options: ["Opção 1", "Opção 2", "Opção 3", "Opção 4"],
                    correctAnswer: 1,
                    justification: "Justificativa para a resposta correta da pergunta 1 de Sociologia."
                },
                // Continue inserindo as perguntas e justificativas para Sociologia
            ],
            'Artes': [
                {
                    question: "Exemplo de pergunta de Artes 1",
                    options: ["Opção 1", "Opção 2", "Opção 3", "Opção 4"],
                    correctAnswer: 2,
                    justification: "Justificativa para a resposta correta da pergunta 1 de Artes."
                },
                // Continue inserindo as perguntas e justificativas para Artes
            ],
            'Filosofia': [
                {
                    question: "Exemplo de pergunta de Filosofia 1",
                    options: ["Opção 1", "Opção 2", "Opção 3", "Opção 4"],
                    correctAnswer: 0,
                    justification: "Justificativa para a resposta correta da pergunta 1 de Filosofia."
                },
                // Continue inserindo as perguntas e justificativas para Filosofia
            ]
        };

        var currentQuestionIndex = 0; // Controla o índice da pergunta atual
        var subject = ''; // Guarda o assunto selecionado

        // Função para exibir perguntas
        function displayQuestion(subject, index) {
            var questionContainer = document.getElementById('questionContainer');
            var questionObj = questionsData[subject][index];

            // Limpar conteúdo anterior
            questionContainer.innerHTML = "";

            // Adicionar pergunta
            var questionElem = document.createElement('div');
            questionElem.className = 'question';
            questionElem.innerHTML = "<strong>" + (index + 1) + ". " + questionObj.question + "</strong>";
            questionContainer.appendChild(questionElem);

            // Adicionar opções de resposta
            questionObj.options.forEach(function(option, idx) {
                var button = document.createElement('button');
                button.className = "btn btn-outline-primary answer-btn";
                button.innerText = option;
                button.onclick = function() {
                    showJustification(questionObj, idx);
                };
                questionContainer.appendChild(button);
            });

            // Criar um elemento para a justificativa
            var justificationElem = document.createElement('div');
            justificationElem.className = "justification";
            questionContainer.appendChild(justificationElem);
        }

        // Função para exibir a justificativa da resposta
        function showJustification(questionObj, selectedAnswer) {
            var justificationElem = document.querySelector('.justification');

            // Verifica se a resposta está correta ou não
            if (selectedAnswer === questionObj.correctAnswer) {
                justificationElem.innerHTML = "Correto! " + questionObj.justification;
                justificationElem.style.color = "green";
            } else {
                justificationElem.innerHTML = "Incorreto. " + questionObj.justification;
                justificationElem.style.color = "red";
            }

            justificationElem.style.display = "block"; // Exibir justificativa
            document.getElementById('nextQuestionBtn').style.display = "block"; // Exibir botão de avançar
        }

        // Função para avançar para a próxima pergunta
        function nextQuestion() {
            currentQuestionIndex++;
            if (currentQuestionIndex < questionsData[subject].length) {
                displayQuestion(subject, currentQuestionIndex); // Exibir próxima pergunta
                document.getElementById('nextQuestionBtn').style.display = "none"; // Esconder botão de avançar até nova resposta
            } else {
                document.getElementById('questionContainer').innerHTML = "<h3>Quiz concluído!</h3>";
                document.getElementById('nextQuestionBtn').style.display = "none"; // Esconder botão de avançar no fim
            }
        }

        // Executar ao carregar a página
        window.onload = function() {
            var params = getQueryParams();
            subject = params['subject'];
            document.getElementById('quizSubject').innerText = subject;
            displayQuestion(subject, currentQuestionIndex); // Exibir primeira pergunta
        }
    </script>
</body>

</html>
