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
                    options: ["A) 55,5", "B) 60", "C) 175,5", "D) 235,5"],
                    correctAnswer: 1,
                    justification: "A criança no cavalo C1 percorre 60 metros a mais que a criança no cavalo C2, porque as circunferências têm raios diferentes, e o cavalo C1, que está mais distante do centro, percorre uma distância maior."
                },
                {
                    question: "QUESTÃO MÉDIA - (Enem - PPL) A logomarca de uma empresa de computação é um quadrado, AEFG, com partes pintadas como mostra a figura. Sabe-se que todos os ângulos agudos presentes na figura medem 45° e que AB = BC = CD = DE. A fim de divulgar a marca entre os empregados, a gerência decidiu que fossem pintadas logomarcas de diversos tamanhos nas portas, paredes e fachada da empresa. Pintadas as partes cinzas de todas as logomarcas, sem desperdício e sem sobras, já foram gastos R$ 320. O preço das tintas cinza, preta e branca é o mesmo. Considerando que não haja desperdício e sobras, o custo para pintar as partes pretas e o custo para pintar as partes brancas serão, respectivamente",
                    options: ["A) 320 e 640", "B) 960 e 1280", "C) 2240 e 2560", "D) 640 e 960"],
                    correctAnswer: 1,
                    justification: "Analisando a imagem, sabemos que a área do logotipo todo é igual a 8 vezes as áreas pintadas de cinza, logo, o custo com o todo será de 320 ⸳ 8 = R$ 2560. Sabemos que a área da parte branca é metade da área total:R$ 2560 : 2 = R$ 1280Para pintar a área preta, o custo será de 2560 – 320 – 1280 = R$ 960. Então, os custos das partes preta e branca serão de, respectivamente, R$ 960 e R$ 1280."
                },
                {
                    question: "QUESTÃO FÁCIL - (Enem 2016)  Um senhor, pai de dois filhos, deseja comprar dois terrenos, com áreas de mesma medida, um para cada filho. Um dos terrenos visitados já está demarcado e, embora não tenha um formato convencional (como se observa na Figura B), agradou ao filho mais velho e, por isso, foi comprado. O filho mais novo possui um projeto arquitetônico de uma casa que quer construir, mas, para isso, precisa de um terreno na forma retangular (como mostrado na Figura A) cujo comprimento seja  7 m  maior do que a largura. Para satisfazer o filho mais novo, esse senhor precisa encontrar um terreno retangular cujas medidas, em metro, do comprimento e da largura sejam iguais, respectivamente, a ",
                    options: ["A) 7,5 e 14,5.", "B) 9,39,3 e 16,3.", "C) 10,0 e 17,0.", "D) 9,0 e 16,0. "],
                    correctAnswer: 3,
                    justification: "A letra D está  certa porque : Primeiro calcularemos a área da figura B. Podemos dividir essa área em dois triângulos retângulos, o primeiro com base igual a 3 m e altura igual a 21 m e o segundo com base e altura iguais a 15 m, então, temos que: A = (15 ⸳ 15) : 2 + (3 ⸳ 21) : 2 = 112,5 + 31,5 = 144 Por outro lado, sabemos que as áreas são as mesmas, então, temos que: x (x + 7) = 144 Analisando os divisores de 144, temos que 9 ⸳ (9 + 7) = 9 ⸳ 16 = 144 Nesse caso, temos que x = 9 e x + 7 = 16"
                },
                {
                    question: "QUESTÃO MÉDIA - Enem-2019 Uma fábrica produz velas de parafina em forma de pirâmide quadrangular regular com 19 cm de altura e 6cm de aresta da base. Essas velas são formadas por 4 blocos de mesma altura - 3 troncos de pirâmide de bases paralelas e 1 pirâmide na parte superior -, espaçados de 1 cm entre eles, sendo que a base superior de cada bloco é igual à base inferior do bloco sobreposto, com uma haste de ferro passando pelo centro de cada bloco, unindo-os, conforme a figura. Se o dono da fábrica resolver diversificar o modelo, retirando a pirâmide da parte superior, que tem 1,5 cm de aresta na base, mas mantendo o mesmo molde, quanto ele passará a gastar com parafina para fabricar uma vela?",
                    options: ["A) 216 cm3.", "B) 156 cm3", "C) 189 cm3.", "D) 192 cm3. "],
                    correctAnswer: 3,
                    justification: "A resposta correta é a letra D (192 cm³) porque, ao retirar a pirâmide do topo, restam apenas os três troncos de pirâmide. Esses troncos têm 5 cm de altura cada um e, com a base maior de 6 cm e a menor de 1,5 cm, o volume total dos três troncos de pirâmide é de 192 cm³."
                },
                {
                    question: "QUESTÃO MÉDIA - (Enem 2018) Um brinquedo chamado pula-pula, quando visto de cima, consiste de uma cama elástica com contorno em formato de um hexágono regular.Se a área do círculo inscrito no hexágono é 3π metros quadrados, então a área do hexágono, em metro quadrado, é: ",
                    options: ["A) 9", "B) 9√2 ", "C) 6√3 ", "D) 12√3 "],
                    correctAnswer: 2,
                    justification: "A resposta correta é a letra C (6√3) porque o lado do hexágono regular é igual ao raio do círculo inscrito. Sabendo que a área do círculo inscrito é 3π m², o raio é √3 metros. A área de um hexágono regular é dada pela fórmula (3√3/2) * lado², e ao substituir o lado por √3, o resultado é 6√3 metros quadrados."
                }
            ],
            'Português': [{
                    question: "DIFÍCIL: Leia o texto abaixo e responda as questões 01 e 02.Folhetins do “correio mercantil” Domingo passado o caminho de São Cristóvão rivalizava com os aristocráticos passeios da Glória, do Botafogo e São Clemente, no luxo e na concorrência, na animação e até na poeira. O Jockey Club anunciara a sua primeira corrida; e, apesar dos bilhetes amarelos, dos erros tipográficos e do silêncio dos jornais, a sociedade elegante se esforçou em responder à amabilidade do convite. [...]Desde sete horas da manhã começaram a passar as elegantes carruagens, e os grupos dos gentlemen riders, cavaleiros por gosto ou por economia. [...]Às 10 horas abriu-se a raia (turf), e começou a corrida com a irregularidade do costume. Os parelheiros pouco adestrados, sem o ensino conveniente, não partiram ao sinal e ao mesmo tempo, e disto resultou que muitas vezes o prêmio da vitória não coube ao jóquei que montava o melhor corredor, e sim àquele que tinha a felicidade de ser o primeiro a lançar-se na raia. A última corrida, que durou um minuto e dezenove segundos, teria sido brilhante se dois dos cavalos não se tivessem lembrado de imitar as pombinhas de Vênus, que dizem, voavam presas por um laço de amor.A diretoria, que envidou todos os seus esforços para tornar agradáveis as novas corridas, deve tomar as providências necessárias a fim de fazer cessar estes inconvenientes, formulando com o auxílio dos entendidos um regulamento severo do turf. Convém substituir o sinal da partida por outro mais forte e mais preciso, e só admitir à inscrição cavalos parelheiros já habituados à raia.A uma hora da tarde estava tudo acabado, e os sócios e convidados disseram adeus às verdes colinas do Engenho Novo, e voltaram à cidade para descansar e satisfazer a necessidade tão trivial e comum de jantar, insuportável costume, que, apesar de todas as revoluções do globo e todas as vicissitudes da moda, dura desde princípio do mundo. Desde sete horas da manhã começaram a passar as elegantes carruagens, e os  grupos dos gentlemen riders, cavaleiros por gosto ou por economia. Às 10 horas abriu-se a raia (turf), e começou a corrida com a irregularidade do costume. Os parelheiros pouco adestrados, sem o ensino conveniente, não partiram ao sinal e ao mesmo tempo, e disto resultou que muitas vezes o prêmio da vitória não coube ao jóquei que montava o melhor corredor, e sim àquele que tinha a felicidade de ser o primeiro a lançar-se na raia. A última corrida, que durou um minuto e dezenove segundos, teria sido brilhante se dois dos cavalos não se tivessem lembrado de imitar as pombinhas de Vênus, que dizem, voavam presas por um laço de amor. A diretoria, que envidou todos os seus esforços para tornar agradáveis as novas corridas, deve tomar as providências necessárias a fim de fazer cessar estes inconvenientes, formulando com o auxílio dos entendidos um regulamento severo do turf. Convém substituir o sinal da partida por outro mais forte e mais preciso, e só admitir à inscrição cavalos parelheiros já habituados à raia. A uma hora da tarde estava tudo acabado, e os sócios e convidados disseram adeus às verdes colinas do Engenho Novo, e voltaram à cidade para descansar e satisfazer a necessidade tão trivial e comum de jantar, insuportável costume, que, apesar de todas as revoluções do globo e todas as vicissitudes da moda, dura desde princípio do mundo. Nesse texto, um trecho que mostra a posição do enunciador é:",
                    options: ["(A) Domingo passado o caminho de São Cristóvão rivalizava com asaristocráticos passeios da Glória, do Botafogo e São Clemente,... (1ºparágrafo)", "(B) A diretoria, que envidou todos os seus esforços para tornar agradáveis as novas corridas, deve tomar as providências necessárias... (4º parágrafo)", "(C) O Jockey Club anunciara a sua primeira corrida; e, apesar dos bilhetes amarelos,... (1º parágrafo)", "(D) Os parelheiros pouco adestrados, sem o ensino conveniente, não partiramao sinal... (3º parágrafo)"],
                    correctAnswer: 1,
                    justification: " A opção B mostra a posição do enunciador, pois o autor do texto expressa uma opinião crítica ao sugerir que a diretoria do Jockey Club deve tomar providências para resolver os problemas nas corridas. O uso de 'deve tomar' indica uma recomendação pessoal do autor, mostrando seu ponto de vista sobre a situação."
                },
                {
                    question: "Domingo passado o caminho de São Cristóvão rivalizava com os aristocráticos passeios da Glória, do Botafogo e São Clemente, no luxo e na concorrência, na animação e até na poeira. O Jockey Club anunciara a sua primeira corrida; e, apesar dos bilhetes amarelos, dos erros tipográficos e do silêncio dos jornais, a sociedade elegante se esforçou em responder à amabilidade do convite. [...]Desde sete horas da manhã começaram a passar as elegantes carruagens, e os grupos dos gentlemen riders, cavaleiros por gosto ou por economia. [...]Às 10 horas abriu-se a raia (turf), e começou a corrida com a irregularidade do costume. Os parelheiros pouco adestrados, sem o ensino conveniente, não partiram ao sinal e ao mesmo tempo, e disto resultou que muitas vezes o prêmio da vitória não coube ao jóquei que montava o melhor corredor, e sim àquele que tinha a felicidade de ser o primeiro a lançar-se na raia. A última corrida, que durou um minuto e dezenove segundos, teria sido brilhante se dois dos cavalos não se tivessem lembrado de imitar as pombinhas de Vênus, que dizem, voavam presas por um laço de amor.A diretoria, que envidou todos os seus esforços para tornar agradáveis as novas corridas, deve tomar as providências necessárias a fim de fazer cessar estes inconvenientes, formulando com o auxílio dos entendidos um regulamento severo do turf. Convém substituir o sinal da partida por outro mais forte e mais preciso, e só admitir à inscrição cavalos parelheiros já habituados à raia.A uma hora da tarde estava tudo acabado, e os sócios e convidados disseram adeus às verdes colinas do Engenho Novo, e voltaram à cidade para descansar e satisfazer a necessidade tão trivial e comum de jantar, insuportável costume, que, apesar de todas as revoluções do globo e todas as vicissitudes da moda, dura desde princípio do mundo. Desde sete horas da manhã começaram a passar as elegantes carruagens, e os  grupos dos gentlemen riders, cavaleiros por gosto ou por economia. Às 10 horas abriu-se a raia (turf), e começou a corrida com a irregularidade do costume. Os parelheiros pouco adestrados, sem o ensino conveniente, não partiram ao sinal e ao mesmo tempo, e disto resultou que muitas vezes o prêmio da vitória não coube ao jóquei que montava o melhor corredor, e sim àquele que tinha a felicidade de ser o primeiro a lançar-se na raia. A última corrida, que durou um minuto e dezenove segundos, teria sido brilhante se dois dos cavalos não se tivessem lembrado de imitar as pombinhas de Vênus, que dizem, voavam presas por um laço de amor. A diretoria, que envidou todos os seus esforços para tornar agradáveis as novas corridas, deve tomar as providências necessárias a fim de fazer cessar estes inconvenientes, formulando com o auxílio dos entendidos um regulamento severo do turf. Convém substituir o sinal da partida por outro mais forte e mais preciso, e só admitir à inscrição cavalos parelheiros já habituados à raia. A uma hora da tarde estava tudo acabado, e os sócios e convidados disseram adeus às verdes colinas do Engenho Novo, e voltaram à cidade para descansar e satisfazer a necessidade tão trivial e comum de jantar, insuportável costume, que, apesar de todas as revoluções do globo e todas as vicissitudes da moda, dura desde princípio do mundo. Entende-se desse texto que",
                    options: ["A) O Jockey Club ficava localizado no Engenho Novo. ", "B) O caminho que levava ao Jockey Club passava por Botafogo.", "C) Os cavaleiros do Jockey Club eram pessoas ilustres da sociedade.", "D) Os cavalos eram adestrados no Jockey Club."],
                    correctAnswer: 0,
                    justification: "A letra A está certa porque o texto menciona que, ao final das corridas, os sócios e convidados disseram adeus às verdes colinas do Engenho Novo, indicando que o Jockey Club estava localizado nesse bairro, já que foi onde ocorreu o evento das corridas."
                },
                {
                    question: "Há um grande silêncio que está sempre à escuta…E a gente se põe a dizer inquietamente qualquer coisa,qualquer coisa, seja o que for,desde a corriqueira dúvida sobre se chove ou não chove hojeaté a tua dúvida metafísica1 [...]!E, por todo o sempre, enquanto a gente fala, fala, falao silêncio escuta…e cala.*Vocabulário: 1metafísica: área que estuda e tenta explicar as principais questões do pensamento filosófico, como a existência do ser, a causa e o sentido da realidade, e os aspectos ligados a natureza. Nesse texto, em qual verso foi utilizado o recurso da personificação?",
                    options: ["A) “o silêncio escuta…”. (3ª estrofe)", "B) “E, por todo o sempre, enquanto a gente fala, fala, fala”. (3ª estrofe)", "C)  “até a tua dúvida metafísica [...]!” (2ª estrofe)", "D) “qualquer coisa, seja o que for,”. (2ª estrofe)"],
                    correctAnswer: 0,
                    justification: "A resposta correta é a letra E (“o silêncio escuta…”). Nesse verso, ocorre o recurso da personificação, pois o silêncio, uma entidade abstrata, é descrito como se tivesse a capacidade humana de escutar, o que caracteriza a atribuição de qualidades humanas a algo não humano."
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
