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
                {
                    question: "Há um grande silêncio que está sempre à escuta…E a gente se põe a dizer inquietamente qualquer coisa,qualquer coisa, seja o que for,desde a corriqueira dúvida sobre se chove ou não chove hojeaté a tua dúvida metafísica1 [...]!E, por todo o sempre, enquanto a gente fala, fala, falao silêncio escuta…e cala.*Vocabulário: 1metafísica: área que estuda e tenta explicar as principais questões do pensamento filosófico, como a existência do ser, a causa e o sentido da realidade, e os aspectos ligados a natureza. Entende-se desse texto que o eu lírico",
                    options: ["A) estuda os fenômenos climáticos.", "B) se incomoda com o silêncio.", "C)  ensina como aproveitar o tempo.", "D) se preocupa com as outras pessoas."],
                    correctAnswer: 1,
                    justification: "A opção correta seria: B) se incomoda com o silêncio. entende-se que o eu lírico expressa uma inquietação com o silêncio, que está sempre presente e escutando. Ao tentar preenchê-lo com qualquer tipo de fala, desde uma dúvida comum até questões filosóficas mais profundas, o eu lírico parece incomodado com essa constante presença silenciosa."
                },
                {
                    question: "Seara VermelhaOs colonos [...] da fazenda estavam espalhados pelas estradas da caatinga. Iam todos no rumo do sul, em busca do país de São Paulo. Muitos outros haviam ido antes, os contratantes de trabalhadores apareciam pelas fazendas, contavam histórias, diziam coisas de assombrar [...]. Cada trabalhador que chegava era fazendeiro em poucos anos [...].Eram esses mesmos caminhos, essas trilhas abertas na caatinga, que Jerônimo e seu irmão João Pedro trilhavam agora com suas famílias. Dinah, mulher de João Pedro, [...] contara as pessoas e os bichos da [...] comitiva [...].Ela, o marido e a filha, Gertrudes [...]. Puxara à mãe, era um touro no trabalho [...]. E a família de Jerônimo. Ele, Jucundina, os dois filhos e os três netos [...]. Faziam onze mas Dinah contava também Jeremias e Marisca.Jeremias ia na frente, Jerônimo puxava do cabresto, às vezes entregava a Tonho. Ia carregado com dois caçuás1 , onde levavam quase tudo o que possuíam. O resto estava nas trouxas que mulheres e homens conduziam [...]. Jeremias marchava no seu passo tardo, sem pressa [...].Naquele primeiro dia eles fizeram cinco léguas compridas, que eram quantas os separavam da fazenda Primavera. Chegaram com a noite quando Jeremias começava a empacar pelo caminho. Noca ia atrás de todos, quase não se aguentava de cansada, a gata apertada contra o peito. O contexto social a que se refere esse texto é",
                    options: ["A) A construção de estradas que interligam estados brasileiros.", "B) A importância da pecuária do Brasil.", "C) O crescimento da extração da borracha.", "D) O movimento migratório em direção ao estado de São Paulo."],
                    correctAnswer: 3,
                    justification: "A opção correta é: E) O movimento migratório em direção ao estado de São Paulo. O texto descreve um grupo de trabalhadores rurais que estão migrando em busca de melhores condições de vida, especificamente em direção ao estado de São Paulo, um destino comum para muitos migrantes em busca de trabalho e oportunidades no Brasil durante o período retratado."
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
                {
                    question: "ENEM (Fácil) - Um carro desloca-se em uma estrada retilínea com velocidade constante de 20 m/s. Quanto tempo o carro levará para percorrer uma distância de 200 metros?",
                    options: ["a) 10s", "b) 15s", "c) 20s", "d) 30s"],
                    correctAnswer: 2,
                    justification: "Justificativa para a resposta correta da pergunta 1 de Física."
                },
                {
                    question: "Nível Médio VUNESP - Uma pessoa está parada na calçada observando um caminhão que se move em linha reta com velocidade constante de 36 km/h. Em determinado momento, o caminhão buzina emitindo um som com frequência de 440 Hz. Sabendo que a velocidade do som no ar é de 340 m/s, a frequência do som percebida pela pessoa, devido ao efeito Doppler, será aproximadamente:",
                    options: ["a) 410 Hz", "b)  470 Hz", "c) 430 Hz", "d) 440 Hz"],
                    correctAnswer: 2,
                    justification: "Justificativa para a resposta correta da pergunta 1 de Física."
                },
                {
                    question: "FUVEST (Difícil) - Um bloco de massa 2 kg é puxado por uma força F de 10 N sobre uma superfície horizontal sem atrito. Sabendo que o bloco parte do repouso e que a força F atua ao longo de uma distância de 5 metros, a velocidade final do bloco será:",
                    options: ["a) 5 m/s", "b) 3 m/s", "c) 7 m/s", "d) 10 m/s"],
                    correctAnswer: 0,
                    justification: "Justificativa para a resposta correta da pergunta 1 de Física."
                },
                {
                    question: "FUVEST (Difícil) - Uma mola ideal, de constante elástica 𝑘=200 𝑁/𝑚k=200N/m, é comprimida em 10 cm. Em seguida, um objeto de massa 1 kg é colocado contra a mola comprimida e, ao ser liberado, o objeto é lançado horizontalmente. Desconsiderando atritos, determine a velocidade de lançamento do objeto.",
                    options: ["a) 1 m/s", "b) 2 m/s", "c) 3 m/s", "d) 4 m/s"],
                    correctAnswer: 1,
                    justification: "Justificativa para a resposta correta da pergunta 1 de Física."
                },
                // Continue inserindo as perguntas e justificativas para Física
            ],
            'Biologia': [
                {
                    question: "QUESTÃO FÁCIL - Considere a situação hipotética de lançamento, em um ecossistema, de umadeterminanete quantidade de gás carbônico, com marcação radioativa nocarbono. Como passar do tempo, esse gás se dispersaria pelo ambiente e seriaincorporado por seres vivos.Considere as seguintes moléculas:I. Moléculas de glicose sintetizadas pelos produtores.II. Moléculas de gás carbônico produzidas pelos consumidores a partir daoxidação da glicose sintetizada pelos produtores.III. Moléculas de amido produzidas como substância de reserva das plantas.IV. Moléculas orgânicas sintetizadas pelos decopositores. Carbono radioativo poderia ser encontrado nas moléculas descritas em",
                    options: ["A-) I, apenas.", "B-) I e II, apenas", "C-) I, II, III e IV", "D-) III e IV, apenas."],
                    correctAnswer: 2,
                    justification: ""
                },
                {
                    question: "QUESTÃO MÉDIA - Na história evolutiva dos metazoários, o processo digestivo",
                    options: ["A-) é completamente extracelular nos vertebrados, o que os distingue dosdemais grupos de animais.", "B-) passa de completamente intracelular a completamente extracelular, a partir dos nematelmintos", "C-) passa de completamente extracelular a completamente intracelular, a partir dos anelídeos.", "D-) é intracelular, com hidrólise enzimática de moléculas de grande tamanho, a partir dos equinodermas."],
                    correctAnswer: 1,
                    justification: ""
                },
                {
                    question: "QUESTÃO DIFÍCIL - As briófitas, no reino vegetal, e os anfíbios, entre os vertebrados, são considerados os primeiros grupos a conquistar o ambiente terrestre. Comparando-os, é correto afirmar que,",
                    options: ["A-) nos anfíbios e nas briófitas, o sistema vascular é pouco desenvolvido; isso faz com que, nos anfíbios, a temperatura não seja controlada internamente.", "B-) nos anfíbios e nas briófitas, a absorção de água se dá pela epiderme; o transporte de água é feito por difusão, célula por célula, às demais partes do corpo.", "C-) nos anfíbios e nas briófitas, a fecundação ocorre em meio seco; o desenvolvimento dos embriões se dá na água.", "D-) nos anfíbios, o produto imediato da meiose são os gametas; nas briófitas, a meiose origina um indivíduo haploide que posteriormente produz os gametas."],
                    correctAnswer: 3,
                    justification: ""
                },
                {
                    question: "QUESTÃO MÉDIA - Para que a célula possa transportar, para seu interior, o colesterol da circulação sanguínea, é necessária a presença de uma determinada proteína em sua membrana. Existem mutações do gene responsável pela síntese dessa proteína que impedem a sua produção. Quando um homem ou uma mulher possui uma dessas mutações, mesmo tendo também um alelo normal, apresenta Hipercolesterolemia, ou seja, aumento do nível de colesterol no sangue.A hipercolesterolemia devida a essa mutação tem, portanto, herança",
                    options: ["A-) ligada ao X recessiva.", "B-) ligada ao X dominante. ", "C-)  autossômica recessiva.", "D-) autossômica dominante."],
                    correctAnswer: 3,
                    justification: ""
                },
                {
                    question: "QUESTÃO FÁCIL - Considere as seguintes comparações entre uma comunidade pioneira e uma comunidade clímax, ambas sujeitas às mesmas condições ambientais, em um processo de sucessão ecológica primária:I. A produtividade primária bruta é maior numa comunidade clímax do que numa comunidade pioneira.II. A produtividade primária líquida é maior numa comunidade pioneira do que numa comunidade clímax.III. A complexidade de nichos é maior numa comunidade pioneira do que numa comunidade clímax.Está correto apenas o que se afirma em",
                    options: ["A-) I e II.", "B-) I e III", "C-) III.", "D-) II"],
                    correctAnswer: 0,
                    justification: ""
                },
                // Continue inserindo as perguntas e justificativas para Biologia
            ],
            'História': [
                {
                    question: "1-Com o surgimento das primeiras cidades – que remontam 12 mil anos atrás – na convivência social e política, começaram a se destacar algumas pessoas, grupos ou famílias em cargos de liderança, surgindo as primeiras instituições políticas, religiosas e administrativas com a função de coordenar os estoques de alimentos, as práticas e cultos religiosos e a defesa da cidade. Com o passar dos anos, esta organização tornou-se mais complexa e assumiu diferentes formas de atuação e modelos políticos. Sobre as formas políticas desenvolvidas no Ocidente ao longo de sua história, assinale a alternativa CORRETA.",
                    options: ["a) O significado da palavra democracia atualmente é o mesmo desde a Grécia antiga;", "b) A democracia ateniense, diferente das democracias modernas, era excludente, pois, mestiços, escravos, mulheres e crianças não eram considerados cidadãos;", "c) A República romana se formou com a ascensão de Júlio Cesar ao cargo de imperador;", "d) A construção da modernidade envolveu mudanças na maneira de pensar as relações de poder e a política. As teorias de Bodin e Hobbes defendiam um governo democrático e participativo;"],
                    correctAnswer: 1,
                    justification: "A democracia escravista ateniense era excludente porque se baseava na cidadania como critério para a participação política na polis. Porém, poucos eram aqueles considerados cidadãos em Atenas: homens, maiores de 21 anos e atenienses natos. Logo, nascidos em outras cidades, filhos de nascidos em outras cidades, mulheres, escravos e crianças não eram cidadãos e não participavam da democracia."
                },
                {
                    question: "2- (UECE) Atente ao seguinte excerto: “Vivi a guerra inteira, tendo uma idade que me permitia formar meu próprio juízo, e segui-a atentamente, de modo a obter informações precisas. Atingiu-me também uma condenação ao exílio que me manteve longe de minha terra por vinte anos após o meu período de comando em Anfípolis e, diante de minha familiaridade com as atividades de ambos os lados, especialmente aquelas do Peloponeso, em consequência do meu banimento, graças ao meu ócio, pude acompanhar melhor o curso dos acontecimentos. Relatarei, então, as divergências surgidas após os dez anos, e o rompimento da trégua e as hostilidades supervenientes”.(TUCÍDIDES, História da Guerra do Peloponeso, V, 26). Sobre a Guerra do Peloponeso, registrada por Tucídides, é correto afirmar que:",
                    options: ["a) foi o conflito que ficou conhecido como Guerras Médicas.", "b) foi uma guerra entre Atenas e Esparta. ", "c) se trata de conflito armado entre gregos e troianos.", "d) não ocorreu propriamente: trata-se de uma ficção do mundo antigo."],
                    correctAnswer: 1,
                    justification: "A letra correta é B) foi uma guerra entre Atenas e Esparta."
                },
                {
                    question: "(Utfpr) No século V a.C., a vitória dos gregos sobre os persas nas Guerras Médicas assinalou o apogeu da Grécia Antiga. Atenas, sob o governo de Pericles, atingiu o apogeu da democracia ateniense e grande desenvolvimento econômico. Essa democracia beneficiava:",
                    options: ["a) a todos os habitantes da cidade de Atenas, mesmo que estrangeiros.", "b) apenas aos juízes do Supremo Tribunal que podiam julgar mais livremente.", "c) apenas aos políticos do partido democrático.", "d) a todos os considerados cidadãos atenienses."],
                    correctAnswer: 3,
                    justification: "A democracia ateniense era excludente em relação à participação política, uma vez que o direito de voto e participação nas decisões era reservado apenas para um grupo restrito de pessoas consideradas cidadãs. Portanto, a alternativa correta é a letra D). Para participar da democracia ateniense a pessoa deveria ser considerada  um cidadão de Atenas, o que implicava o cumprimento de certos requisitos específicos.Apenas homens com mais de 18 anos, sendo nascido em Atenas e de pais atenienses, que possuíam propriedades em Atenas, entre outros requisitos, poderiam ser considerados cidadãos e participar da democracia ateniense."
                },
                {
                    question: "É bastante difundida a ideia de que o berço da democracia foi a cidade de Atenas, da Antiga Grécia, onde os cidadãos alcançaram possibilidades de participar das discussões das questões públicas. Sabe-se, contudo, que havia exceções e graves problemas sociais, políticos e econômicos. Caracteriza uma dessas exceções:",
                    options: ["a) o fato de mulheres não possuírem direitos políticos, na medida em que a democracia ateniense era restrita aos homens adultos, considerados cidadãos", "b) a Eclésia, assembleia popular, com as reformas de Clístenes, que teve seus poderes ampliados, fortalecendo a prática democrática.", "c) o ostracismo (exílio por dez anos), que era um instrumento de defesa da democracia ateniense para quem a pusesse em perigo", "d) o fato de a democracia ateniense ter posto fim às brigas sociais, possibilitando aos camponeses o direito de voto."],
                    correctAnswer: 0,
                    justification: "Apesar das outras estarem corretas, a que se refere à exceção democrática é a letra b.Em Atenas, quem tinha o direto de participar da vida pública, o que eram considerados cidadãos eram os homens, com mais de 21 anos e filhos de atenienses.Mulheres, escravos, estrangeiros, comerciantes e artesãos não poderiam fazer parte das assembleias nem participar das decisões politicas que envolviam a comunidade.Assim, a democracia não tinha o mesmo cunho ideológico que a nossa democracia atualmente."
                },
                {
                    question: "(ufpr) Considerando os eventos da Reforma Protestante (iniciada em 1517) e seus desdobramentos na Idade Moderna, uma concepção religiosa reforçada pelos seguidores da Reforma em relação ao cristianismo vigente na época foi a: ",
                    options: ["a) exaltação da simonia, que almejava trazer os cristãos afastados para o cotidiano da igreja.", "b)	ênfase na justificação pela fé, que visava eliminar intermediários humanos na relação com a divindade. ", "c) importância do celibato, que intentava preservar o clero regular da corrupção de bens religiosos. ", "d) renovação das obras de caridade, que pretendia reforçar o engajamento dos cristãos na vida social. "],
                    correctAnswer: 1,
                    justification: "Alternativa B é a correta. adoção da peregrinação, que procurava aproximar os fiéis de diferentes partes da Europa. A Reforma Protestante foi um movimento de renovação da Igreja Católica que teve início na Europa Central no século XVI. O evento que marcou o início da Reforma foi a divulgação das 95 teses por Martinho Lutero na porta da igreja do Castelo em Wittenberg, na Alemanha, em 31 de outubro de 1517."
                },
                // Continue inserindo as perguntas e justificativas para História
            ],
            'Geografia': [
                {
                    question: "FENÔMENO EL NIÑO SE CONSOLIDA NO OCEANO PACÍFICO EQUATORIAL “O monitoramento das condições oceânicas nos últimos dias em agosto, indica a persistência de anomalias positivas de TSM (Temperatura da Superfície do Mar) na região do Pacífico Equatorial de até 4 ˚C, o que indica o pleno estabelecimento do fenômeno El Niño-Oscilação Sul (ENOS)”. Fonte: http://enos.cptec.inpe.br/ (acessado em 24/08/2015) O título e o parágrafo inicial do artigo do Instituto Nacional de Pesquisas Espaciais (INPE) abordam a consolidação do fenômeno El Niño. Sobre ele, assinale a alternativa correta.",
                    options: ["A-) consolidação do fenômeno El Niño e sua atuação até fins do verão 2015-2016 provocará no Brasil alterações no comportamento pluviométrico com ausência de chuvas nas regiões Norte, Nordeste, Sudeste, Sul e Centro-Oeste.", "B) Este é um fenômeno em que a interação atmosfera-oceano desaparece, proporcionando padrões normais da Temperatura da Superfície do Mar (TSM) e dos ventos alísios entre a costa brasileira e o litoral africano.", "C) El Niño representa um fenômeno oceânico-atmosférico que se caracteriza por um esfriamento anormal nas águas superficiais do Oceano Pacífico Tropical, com reflexos em várias regiões do mundo, impactadas com longas estiagens.", "D) El Niño é um fenômeno atmosférico-oceânico caracterizado por um aquecimento anormal das águas superficiais no oceano Pacífico Tropical que pode afetar o clima regional e global, mudando os padrões de vento em escala mundial e afetando, assim, os regimes de chuva em regiões tropicais e de latitudes médias."],
                    correctAnswer: 2,
                    justification: "Alternativa C -O El Niño é o aquecimento anormal das águas superficiais do Oceano Pacífico. Provoca aumento na incidência de furacões e de elevações da temperatura. No Brasil, os efeitos são: seca na Amazônia e Nordeste, além de chuvas excessivas no Sul."
                },
                {
                    question: "(ENEM/PPL - 2018) Os objetivos da ONU, de acordo com o disposto no capítulo primeiro de sua Carta, são quatro: 1) manter a paz e segurança internacionais; 2) desenvolver ações amistosas entre as nações, com base no respeito ao princípio de igualdade de direitos e de autodeterminação dos povos; 3) conseguir uma cooperação internacional para resolver os problemas internacionais de caráter econômico, social, cultural ou humanitário; 4) ser um centro destinado a harmonizar a ação das nações para a consecução desses objetivos comuns.GONÇALVES, W. Relações internacionais. Rio de Janeiro: Zahar, 2008 (adaptado). De acordo com os objetivos descritos, o papel do organismo internacional mencionado consiste em",
                    options: ["a) regular o sistema financeiro global.", "b) mediar conflitos de ordem geopolítica.", "c) legitimar ações de expansionismo territorial.", "d) promover a padronização de hábitos de consumo. "],
                    correctAnswer: 1,
                    justification: "Alternativa B- A ONU (Organização das Nações Unidas) foi criada a após a Segunda Guerra Mundial com o objetivo de promover a cooperação internacional e mediar conflitos entre os países. O Conselho de Segurança é uma das instâncias mais importantes, visto que pode definir sanções contra países que infringem a legislação internacional e o envio de tropas de paz para países em conflito. Agências especializadas cuidam da cooperação em setores como saúde (OMS), trabalho (OIT), agricultura (FAO) e educação (Unesco)."
                },
                {
                    question: "A Copa do Mundo de 2018 despertou a atenção para o país-sede, a Rússia, de dimensão continental e que apresenta inúmeros aspectos geográficos instigantes. Sobre a geografia russa e temas relacionados, analise as proposições abaixo: I. A Rússia é o maior país do mundo em dimensão territorial. Em função da área que abrange, apresenta diversos tipos de vegetação, tais como a tundra, a floresta boreal, as estepes, dentre outros. II. A ampla faixa latitudinal que a Rússia ocupa resulta em diferentes fusos horários, em que se considera uma hora a cada 15º de latitude. Dessa forma, enquanto são 8 horas da manhã em Moscou, no extremo norte serão 9 horas do mesmo dia. III. O Volga é um dos mais importantes rios da Rússia e, assim como outros sistemas fluviais do mundo, é utilizado para diversos fins tais como navegação, geração de energia elétrica e também sofre com diferentes tipos de impactos ambientais. IV. O extenso território da Rússia favorece a diversidade das atividades agropecuárias. No extremo norte do país, onde há a vegetação de tundra, ocorrem solos férteis em função do degelo e da presença de matéria orgânica decomposta, o que faz dessa região a principal produtora de grãos. V. A Rússia é um país que possui províncias ricas em petróleo e gás. A maior parte dos oleodutos e gasodutos estão na parte ocidental e abastecem a Rússia assim como outros países da Europa. Sobre os enunciados acima, assinale a alternativa que apresente os itens CORRETOS. ",
                    options: ["A) Estão corretas as alternativas I, III e V", "b) Estão corretas as alternativas III, e IV", "c) Estão corretas as alternativas I, II e III", "d) Estão corretas as alternativas I, II e V"],
                    correctAnswer: 0,
                    justification: "Estão corretas as afirmativa I, III e V.A afirmativa II está incorreta, uma vez que são os graus de longitude que contam os horários, e não os de latitude.A afirmativa IV está incorreta. Apesar de a Tundra estar localizada no extremo norte da Rússia como sugere o enunciado, seu território não favorece a atividade agropecuária. Na Tundra, a baixa temperatura e as pequenas estações de crescimento se tornam empecilhos para o desenvolvimento das espécies."
                },
                {
                    question: "(Enem/2019)O texto menciona que o problema da fome não é técnico, pois há alimentos suficientes para resolver a questão. A fome, na verdade, está associada a um fator de natureza política. Qual é o fator que contribui para esse problema?",
                    options: ["a) Escala de produtividade regional.", "b) Padrão de distribuição de renda.", "c) Dificuldade de armazenamento de grãos.", "d) Crescimento da população mundial."],
                    correctAnswer: 1,
                    justification: "Resposta: b) Padrão de distribuição de renda. A fome está relacionada à má distribuição de riqueza e renda. Mesmo que haja alimentos suficientes, populações de baixa renda não têm poder aquisitivo para comprá-los, resultando em insegurança alimentar."
                },
                {
                    question: "(Enem/2012)Um pequeno país com região plana, chuvosa e com ventos constantes, e poucos recursos hídricos, precisa definir sua matriz energética com menor impacto ambiental. Qual seria a melhor opção?",
                    options: ["a) Biocombustíveis.", "b) Energia solar.", "c) Energia nuclear.", "d) Energia eólica."],
                    correctAnswer: 3,
                    justification: "Resposta: e) Energia eólica. Em um país com ventos constantes e poucas opções hídricas, a energia eólica seria a escolha ideal, sendo uma fonte limpa, renovável e eficiente, especialmente em regiões planas e com boa circulação de ventos."
                },
                // Continue inserindo as perguntas e justificativas para Geografia
            ],
            'Filosofia': [
                {
                    question: "1. (Enem/2017) Uma conversação de tal natureza transforma o ouvinte; o contato de Sócrates paralisa e embaraça; leva a refletir sobre si mesmo, a imprimir à atenção uma direção incomum: os temperamentais, como Alcibíades sabem que encontrarão junto dele todo o bem de que são capazes, mas fogem porque receiam essa influência poderosa, que os leva a se censurarem. Sobretudo a esses jovens, muitos quase crianças, que ele tenta imprimir sua orientação.BREHIER, E. História da filosofia. São Paulo: Mestre Jou, 1977.O texto evidencia características do modo de vida socrático, que se baseava na",
                    options: ["a) Contemplação da tradição mítica.", "b) Sustentação do método dialético.", "c) Relativização do saber verdadeiro.", "d) Valorização da argumentação retórica."],
                    correctAnswer: 1,
                    justification: "Alternativa correta: b) Sustentação do método dialético.Sócrates foi um defensor da ignorância como o princípio básico para o conhecimento. Daí a importância da sua frase 'só sei que nada sei'. Para ele, é preferível não saber a julgar saber.Sendo assim, Sócrates construiu um método que, através do diálogo (método dialético), as falsas certezas e os pré-conceitos eram abandonados, o interlocutor assumia a sua ignorância. A partir daí, buscava o conhecimento verdadeiro. As outras alternativas estão erradas porque: a) Sócrates busca abandonar os mitos e as opiniões para a construção do conhecimento verdadeiro. c) Sócrates acreditava que existe um conhecimento verdadeiro e esse pode ser despertado através da razão. Teceu diversas críticas aos sofistas por esses assumirem uma perspetiva de relativização do saber. d) Os sofistas afirmavam que a verdade é um mero ponto de vista, estando baseada no argumento mais convincente. Para Sócrates, essa posição era contrária à essência do saber verdadeiro, próprio da alma humana. e) O filósofo dá início ao período antropológico da filosofia grega. As questões relativas à vida humana viram o centro das atenções, deixando de lado a busca sobre os fundamentos da natureza, própria do período pré-socrático."
                },
                {
                    question: "2. (Enem/2019) Em sentido geral e fundamental, Direito é a técnica da coexistência humana, isto é, a técnica voltada a tornar possível a coexistência dos homens. Como técnica, o Direito se concretiza em um conjunto de regras (que, nesse caso, são leis ou normas); e tais regras têm por objeto o comportamento intersubjetivo, isto é, o comportamento recíproco dos homens entre si.ABBAGNANO, N. Dicionário de Filosofia. São Paulo: Martins Fontes, 2007.O sentido geral e fundamental do Direito, conforme foi destacado, refere-se à",
                    options: ["a) aplicação de códigos legais.", "b) regulação do convívio social.", "c) legitimação de decisões políticas.", "d) mediação de conflitos econômicos."],
                    correctAnswer: 1,
                    justification: "Alternativa correta: b) regulação do convívio social.No texto, o Direito é compreendido como uma técnica que tem como objetivo possibilitar a 'coexistência dos homens' ('homens' aqui tomado como sinônimo de seres humanos).Assim, a formulação de um conjunto de regras busca a regulação do convívio social, possibilitando uma relação justa e recíproca entre os sujeitos. As outras alternativas estão erradas porque: a) A aplicação de códigos legais refere-se à forma pela qual o direito visa regular o convívio social, e não o seu fundamento. c) A legitimação de decisões políticas transcende o direito e, em Estados democráticos, fundamenta-se na vontade geral da população.d) A mediação de conflitos econômicos é apenas uma parte das disputas possíveis dentro da sociedade. Cabe ao direito atuar nessa área, mas não define a sua atividade. e) Já a representação da autoridade constituída, nas sociedades modernas, apresenta-se a partir da tri-partição do poder: executivo, legislativo e judiciário. Assim, o direito, inscrito no poder judiciário é uma parcela relevante, mas não é o todo da representação."
                },
                {
                    question: "(Enem/2017) Se, pois, para as coisas que fazemos existe um fim que desejamos por ele mesmo e tudo o mais é desejado no interesse desse fim; evidentemente tal fim será o bem, ou antes, o sumo bem. Mas não terá o conhecimento grande influência sobre essa vida? Se assim é esforcemo-nos por determinar, ainda que em linhas gerais apenas, o que seja ele e de qual das ciências ou faculdades constitui o objeto. Ninguém duvidará de que o seu estudo pertença à arte mais prestigiosa e que mais verdadeiramente se pode chamar a arte mestra. Ora, a política mostra ser dessa natureza, pois é ela que determina quais as ciências que devem ser estudadas num Estado, quais são as que cada cidadão deve aprender, e até que ponto; e vemos que até as faculdades tidas em maior apreço, como a estratégia, a economia e a retórica, estão sujeitas a ela. Ora, como a política utiliza as demais ciências e, por outro lado, legisla sobre o que devemos e o que não devemos fazer, a finalidade dessa ciência deve abranger as duas outras, de modo que essa finalidade será o bem humano.ARISTÓTELES, Ética a Nicômaco. In: Pensadores. São Paulo: Nova Cultural, 1991 (adaptado)Para Aristóteles, a relação entre o sumo bem e a organização da pólis pressupõe que: ",
                    options: ["a) O bem dos indivíduos consiste em cada um perseguir seus interesses.", "b) O sumo bem é dado pela fé de que os deuses são os portadores da verdade.", "c) A política é a ciência que precede todas as demais na organização da cidade.", "d) A educação visa formar a consciência de cada pessoa para agir corretamente."],
                    correctAnswer: 2,
                    justification: "Alternativa correta: c) A política é a ciência que precede todas as demais na organização da cidade.A questão trabalha com dois conceitos centrais em Aristóteles:O ser humano é um animal político (zoon politikon). Faz parte da natureza humana associar-se e viver em comunidade (pólis) sendo o que nos diferencia dos outros animais.O ser humano naturalmente busca a felicidade. A felicidade é o bem maior e somente por ignorância, por não compreender o bem, é que o ser humano pratica o mal.Sendo assim, a política é a ciência que precede todas as demais na organização da cidade, por ser a garantia da realização da natureza humana nas relações existentes na pólis e a organização de todos em direção à felicidade.As outras alternativas estão erradas porque:a) Para o filósofo, a natureza política dos seres humanos tende à definição dos interesses comuns.b) Aristóteles afirma que o sumo bem é a felicidade (eudaimonia) e os seres humanos realizam-se através da vida política.d) A filosofia aristotélica compreende o ser humano como essencialmente bom, não necessitando 'formar a consciência para agir corretamente'.e) Aristóteles era um defensor da política, mas não necessariamente da democracia. Para o filósofo, existe uma série de fatores que compõem um bom governo e esses fatores variam de acordo com os contextos, alterando também a melhor forma de governo."
                },
                {
                    question: "(UNICAMP /2023) Excerto 1Quase todos estão de acordo que a felicidade é o maior de todos os bens que se pode alcançar pela ação; diferem, porém, quanto ao que seja a felicidade. A julgar pela vida que os homens levam em geral, a maioria deles, e os homens de tipo mais vulgar, parecem identificar o bem ou a felicidade com o prazer, e por isso amam a vida dos gozos.(Adaptado de: Aristóteles. Ética a Nicomaco, Livro I, seções 4 e 5.)Excerto 2O conhecimento seguro dos desejos leva a direcionar toda a escolha e toda recusa para a saúde do corpo e para a serenidade do espírito, visto que essa é a finalidade da vida feliz. O prazer é o início e o fim de uma vida feliz. Embora o prazer seja nosso primeiro bem inato, nem por isso escolhemos qualquer prazer.(Adaptado de: Epicuro. Carta sobre a felicidade. São Paulo: Editora UNESP, p. 35-37, 2002.) Considerando os excertos dos filósofos gregos Aristóteles e Epicuro, ambos do século IV a.C., é possível afirmar que",
                    options: ["a)  Aristóteles e Epicuro sustentam a ideia de que há relação entre a felicidade e o prazer, pois ambos entendem que o prazer é o início e o fim de uma vida feliz.", "b) diferentemente de Aristóteles, Epicuro defende que a felicidade consiste na realização irrestrita dos nossos desejos, uma vez que o prazer é o início e o fim de uma vida feliz. ", "c) tanto Aristóteles quanto Epicuro – ainda que com concepções éticas distintas – entendem que não há uma identificação imediata entre felicidade e prazer.", "d) Aristóteles e Epicuro concordam entre si e discordam daqueles que pensam que a felicidade seja o maior dos bens que se possa alcançar pela ação."],
                    correctAnswer: 2,
                    justification: "Alternativa correta: c) tanto Aristóteles quanto Epicuro – ainda que com concepções éticas distintas – entendem que não há uma identificação imediata entre felicidade e prazer De fato, Aristóteles e Epicuro têm concepções éticas diferentes. A leitura atenta dos textos, diga-se de passagem, jä encaminharia os vestibulandos nesse sentido. No entanto, ezibora não comunguem exatamente das mesmas ideias, entendem que não há uma identificação imediata entre felicidade e prazer. A felicidade, poderiamos dizer, seja em Aristóteles, seja em Epicuro, é mediada pela virtude. No caso de Aristóteles, em uma virtude que se materializa em 'sabedoria prática', capaz de levar o cidadão a medidas equilibradas as melhores para a harmonia da cidade. No caso de Epicuro, por exemplo, a medida da temperança, importante para não nos 'perdermos nos prazeres inferiores'.As outras alternativas estão erradas porque:a) Incorreta. Aristóteles não sustenta que há relação entre felicidade e prazer, conforme menciona o item. O excerto de sua obra Ética a Nicomaco, utilizado na contextualização da questão, diz: 'os homens de tipo mais vulgar parecem identifica o bem ou a felicidade com o prazer'.b) Incorreta. A realização irrestrita de nossos desejos não pode nos conduzir à felicidade, mesmo para Epicuro. Não por acaso, é do autor a distinção de três tipos de prazeres, a saber: 1) os naturais e necessários; 2) os naturais e não necessários: 3) os não naturais e não necessários. Ademais, também é do autor as seguintes instruções; fartem-se dos primeiros, gozem dos segundos com moderação, evitem os terceiros. Ora, se a realização irrestrita dos nossos desejos nos conduzisse à felicidade, como escreve a alternativa, não teria motivo para Epicuro sugerir uma restrição de certos tipos de prazeres. Só o faz porque não é um mero hedonista como o item pode sugerir. d) Incorreta. A felicidade é o maior dos bens que se pode alcançar pela ação, exatamente o contrário do que diz a redação do item, irremediavelmente incorreta. Aristóteles, por exemplo, dizia ser esse o fundamento último de nossa vida coletiva, da busca pela virtude, fundamento último das amizades, da política, da justiça, do conhecimento ou de tudo o mais que o ser humano possa construir. Não à toa, a ética aristotélica também é chamada de ética eudemonista- 'ética da felicidade'."
                },
                {
                    question: "(Enem/2013) Nasce daqui uma questão: se vale mais ser amado que temido ou temido que amado. Responde-se que ambas as coisas seriam de desejar; mas porque é difícil juntá-las, é muito mais seguro ser temido que amado, quando haja de faltar uma das duas. Porque dos homens que se pode dizer, duma maneira geral, que são ingratos, volúveis, simuladores, covardes e ávidos de lucro, e enquanto lhes fazes bem são inteiramente teus, oferecem-te o sangue, os bens, a vida e os filhos, quando, como acima disse, o perigo está longe; mas quando ele chega, revoltam-se.MAQUIAVEL, N. O Príncipe. Rio de Janeiro: Bertrand, 1991.A partir da análise histórica do comportamento humano em suas relações sociais e políticas, Maquiavel define o homem como um ser",
                    options: ["a) munido de virtude, com disposição nata a praticar o bem a si e aos outros.", "b) possuidor de fortuna, valendo-se de riquezas para alcançar êxito na política.", "c) guiado por interesses, de modo que suas ações são imprevisíveis e inconstantes.", "d) naturalmente racional, vivendo em um estado pré-social e portando seus direitos naturais."],
                    correctAnswer: 0,
                    justification: "Alternativa correta: a). Alguns pré-julgamentos foram úteis para o desenvolvimento da humanidade. Foram responsáveis, por exemplo, para o ser humano ter cautela com toda sorte de infortúnios causados no momento e que poderiam ser motivo de dor no futuro. Isso não significa, contudo, que pré-julgamentos que sejam danosos e pejorativos contra os diferentes devam ser tolerados."
                },
                // Continue inserindo as perguntas e justificativas para Sociologia
            ],
            'Artes': [
    {
        question: "A Semana de Arte Moderna, realizada em 1922, marcou uma ruptura significativa com os padrões artísticos da época. Qual foi um dos principais objetivos desse movimento?",
        options: [
            "Valorizar o academicismo clássico",
            "Resgatar o estilo barroco",
            "Buscar uma identidade artística brasileira",
            "Introduzir o realismo francês no Brasil"
        ],
        correctAnswer: 2,
        justification: "A Semana de Arte Moderna teve como um de seus principais objetivos a busca por uma identidade artística genuinamente brasileira, rompendo com as influências europeias predominantes na época."
    },
    {
        question: "Qual movimento artístico utilizou figuras geométricas e formas abstratas como meio de expressar ideias e emoções?",
        options: [
            "Surrealismo",
            "Cubismo",
            "Impressionismo",
            "Renascimento"
        ],
        correctAnswer: 1,
        justification: "O cubismo, representado por artistas como Pablo Picasso e Georges Braque, utilizou figuras geométricas e formas abstratas para representar diferentes perspectivas simultâneas de objetos."
    },
    {
        question: "A técnica de 'sfumato', usada por Leonardo da Vinci, é caracterizada por:",
        options: [
            "Traços nítidos e bem definidos",
            "Cores intensas e contrastantes",
            "Contornos suaves e transições graduais de luz e sombra",
            "Linhas retas e formas geométricas precisas"
        ],
        correctAnswer: 2,
        justification: "O 'sfumato' é uma técnica que utiliza contornos suaves e transições graduais entre luz e sombra, criando um efeito esfumaçado, como visto na obra 'Mona Lisa'."
    },
    {
        question: "O uso de colagens, materiais não convencionais e elementos tridimensionais caracteriza qual dos movimentos artísticos abaixo?",
        options: [
            "Dadaísmo",
            "Impressionismo",
            "Barroco",
            "Neoclassicismo"
        ],
        correctAnswer: 0,
        justification: "O dadaísmo desafiou as convenções artísticas tradicionais, utilizando colagens e materiais não convencionais para provocar reflexões sobre a arte e a sociedade."
    },
    {
        question: "Na música, o termo 'polifonia' refere-se a:",
        options: [
            "A execução de várias melodias simultâneas",
            "O uso de apenas um instrumento em uma composição",
            "A técnica de improvisação com instrumentos de sopro",
            "A harmonia entre diferentes vozes em uma ópera"
        ],
        correctAnswer: 0,
        justification: "Polifonia é a sobreposição de várias melodias simultâneas, cada uma com sua linha independente, muito comum na música renascentista e barroca."
    }
                // Continue inserindo as perguntas e justificativas para Artes
            ],
            'Sociologia': [
                {
                    question: "1. (Enem/2017) Art. 231. São reconhecidos aos índios sua organização social, costumes, línguas, crenças e tradições, e os direitos originários sobre as terras que tradicionalmente ocupam, competindo à União demarcá-las, proteger e fazer respeitar todos os seus bens. A persistência das reivindicações relativas à aplicação desse preceito normativo tem em vista a vinculação histórica fundamental entre",
                    options: ["A) etnia e miscigenação racial.", "B) sociedade e igualdade jurídica.", "C) espaço e sobrevivência cultural.", "D) progresso e educação ambiental."],
                    correctAnswer: 2,
                    justification: "Alternativa correta: C) espaço e sobrevivência cultural.No trecho da Constituição, o direito ao território (espaço) é apresentado como sendo necessário para a sobrevivência cultural dos povos indígenas.A perda do direito ao território é compreendida como um risco para a “organização social, costumes, línguas, crenças e tradições” específicos dos distintos grupos.A proteção da cultura das diversas etnias exige a proteção de seu território. A extinção dos laços com a terra de origem pode causar a perda de costumes e traços que fundamentam a cultura desses grupos indígenas."  
                },
                {
                    question: "2. (Enem/2017) A participação da mulher no processo de decisão política ainda é extremamente limitada em praticamente todos os países, independentemente do regime econômico e social e da estrutura institucional vigente em cada um deles. É fato público e notório, além de empiricamente comprovado, que as mulheres estão em geral sub-representadas nos órgãos do poder, pois a proporção não corresponde jamais ao peso relativo dessa parte da população TABAK, F. Mulheres públicas: participação políticas e poder. Rio de Janeiro: Letra Capital, 2002.No âmbito do Poder Legislativo brasileiro, a tentativa de reverter esse quadro de sub-representação tem envolvido a implementação, pelo Estado, de",
                    options: ["A) leis de combate à violência doméstica.", "B) cotas de gênero nas candidaturas partidárias.", "C) programas de mobilização política nas escolas.", "D) propagandas de incentivo ao voto consciente."],
                    correctAnswer: 1,
                    justification: "Alternativa correta: b) cotas de gênero nas candidaturas partidárias.As cotas de gênero nas eleições são uma política compensatória que visa democratizar o acesso aos cargos tradicionalmente exercidos por homens."
                },
                {
                    question: "3. (Enem/2016) Quanto mais complicada se tornou a produção industrial, mais numerosos passaram a ser os elementos da indústria que exigiam garantia de fornecimento. Três deles eram de importância fundamental: o trabalho, a terra e o dinheiro. Numa sociedade comercial, esse fornecimento só poderia ser organizado de uma forma: tornando-os disponíveis à compra. Agora eles tinham que ser organizados para a venda no mercado. Isso estava de acordo com a exigência de um sistema de mercado. Sabemos que em um sistema como esse, os lucros só podem ser assegurados se se garante a autorregulação por meios de mercados competitivos interdependentes. A consequência do processo de transformação socioeconômica abordada no texto é a",
                    options: ["A) expansão das terras comunais.", "B) limitação do mercado como meio de especulação.", "C) consolidação da força de trabalho como mercadoria.", "D) diminuição do comércio como efeito da industrialização."],
                    correctAnswer: 2,
                    justification: "Alternativa correta: c) consolidação da força de trabalho como mercadoria.Com o processo de industrialização, todos os elementos da produção tornam-se propriedade e passam a ser precificados. Da mesma forma, a força de trabalho passa a ser compreendida e precificada de acordo com as regras do mercado, consolidando-se como mercadoria."
                },
                {
                    question: "(Enem/2016) A democracia deliberativa afirma que as partes do Conflito político devem deliberar entre si e, por meio de argumentação razoável, tentar chegar a um acordo sobre as políticas que seja satisfatório para todos. A democracia ativista desconfia das exortações à deliberação por acreditar que, no mundo real da política, onde as desigualdades estruturais influenciam procedimentos e resultados, processos democráticos que parecem cumprir as normas de deliberação geralmente tendem a beneficiar os agentes mais poderosos. Ela recomenda, portanto, que aqueles que se preocupam com a promoção de mais justiça devem realizar principalmente a atividade de oposição crítica, em vez de tentar chegar a um acordo com quem sustenta estruturas de poder existentes ou delas se beneficia.As concepções de democracia deliberativa e de democracia ativista apresentadas no texto tratam como imprescindíveis, respectivamente,",
                    options: ["A) a decisão da maioria e a uniformização de direitos.", "B) a organização de eleições e o movimento anarquista.", "C) a obtenção do consenso e a mobilização das minorias.", "D) a fragmentação da participação e a desobediência civil."],
                    correctAnswer: 2,
                    justification: "Alternativa correta: C) a obtenção do consenso e a mobilização das minorias.A obtenção do consenso parece ser o grande objetivo da democracia deliberativa. Entretanto, para Iris Marion Young, o consenso pode ser uma ferramenta de exclusão das minorias. O modo tradicional de perceber o consenso dentro das democracias tende a impossibilitar certas mudanças advindas das lutas de grupos minoritários."
                },
                {
                    question: "(Enem/2017) A moralidade, Bentham exortava, não é uma questão de agradar a Deus, muito menos de fidelidade a regras abstratas. A moralidade é a tentativa de criar a maior quantidade de felicidade possível neste mundo. Ao decidir o que fazer, deveríamos, portanto, perguntar qual curso de conduta promoveria a maior quantidade de felicidade para todos aqueles que serão afetados.Os parâmetros da ação indicados no texto estão em conformidade com uma",
                    options: ["A) fundamentação científica de viés positivista.", "B) convenção social de orientação normativa.", "C) transgressão comportamental religiosa.", "D) racionalidade de caráter pragmático."],
                    correctAnswer: 3,
                    justification: "Alternativa correta: D) racionalidade de caráter pragmático.Os ideais iluministas trazem consigo a racionalidade e a Razão como força revolucionária ou de negação à perspectiva medieval de submeter a razão à fé.O pensador inglês Jeremy Bentham (1748-1832), defensor do utilitarismo, propõe que a racionalidade esteja ancorada em sua relação com a prática e a utilidade, reforçando o caráter pragmático da razão."
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
