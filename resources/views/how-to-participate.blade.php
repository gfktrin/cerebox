@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h2 class="text-center">Como Participar</h2>
                    <p>
                        Para participar dos concursos da Cerebox basta seguir alguns passos muito simples. Você poderá encontrar todas as informações necessárias aqui e dentro de pouquíssimo tempo já estará pronto para divulgar sua arte com a internet, amigos e nossos queridos usuários!
                    <p>
                    <h4><ins>1º PASSO:</ins></h4>
                    <p>
                        Todos os concursos realizados pela Cerebox utilizam a ferramenta &quot;Randomizador&quot;, que seleciona categorias e palavras aleatórias dentro de um banco de palavras (idioma português do Brasil). Desta forma, criaremos sempre competições únicas com temáticas totalmente aleatórias e diversificadas, jamais repetindo temas anteriores. Fique atento sempre ao número de participantes, vagas disponíveis e palavras-chave para escolher qual é o melhor tipo de concurso para você.
                    </p>
                    <h4><ins>2º PASSO:</ins></h4>
                    <p>
                        As palavras-chave geradas pelo “Randomizador” determinam alguns dos tópicos a serem abordados na arte feita para competição, independentes de como serão usados, tanto como parte do tema principal, elementos secundários ou complementos para enriquecer a tela. É importante que os elementos tenham ligações (conversem) entre si, pois o <strong>enredo</strong> e a <strong>criatividade</strong> serão critérios de julgamento, votados pelos usuários da nossa comunidade.
                    <p>
                    <h4><ins>3º PASSO:</ins></h4>
                    <p>
                        Todos os concursos possuem três fases principais e, ao final destas, os ganhadores são anunciados. Estas três etapas somarão 10 (dez) dias:
                        <br><br>

                        <span class="text-info">PRIMEIRA FASE</span> -&gt; início das inscrições, onde os usuários escolherão qual(is) concurso(s) desejam disputar, durará <span class="text-danger">3 (três) dias</span>.
                        <br>
                        <span class="text-info">SEGUNDA FASE</span> -&gt; tempo para que os artistas elaborem, criem suas artes e enviem para a plataforma após o log in, esta etapa durará <span class="text-danger">4 (quatro) dias</span>. As artes só serão aceitas até as 23:59h do sétimo dia do concurso (horário de Brasília).**
                        <br>
                        <span class="text-info">TERCEIRA FASE</span> -&gt; fase de votação, onde os usuários da plataforma avaliarão as artes enviadas, durará <span class="text-danger">3 (três) dias</span>.
                    </p>
                    <br>
                    <p class="text-center"><small><strong>**</strong>O concurso só poderá alcançar a FASE 2 caso, pelo menos, 50% do contingente esperado seja alcançado.</small></p>
                    <br>
                    <h4><ins>4º PASSO:</ins></h4>
                    <p>
                        Os ganhadores serão anunciados após o prazo de votação ser encerrado e, em um período de até 15 dias úteis após a divulgação da lista de vencedores será feito o depósito bancário na conta corrente cadastrada. Vale lembrar que o valor das premiações só poderá ser calculado após o encerramento da primeira fase, de acordo com o número de artistas inscritos.
                    </p>
                    <h4><ins>Votação:</ins></h4>
                    <p>
                        Cada arte será submetida a avaliação em quatro categorias:
                    </p>
                    <ul>
                        <li>Arte</li>
                        <li>Criatividade</li>
                        <li>Inovação</li>
                        <li>Interação</li>
                    </ul>
                    <p>
                        Dentro destas categorias, os usuários receberão 16 pontos para distribuir entre estas categorias, como por exemplo:
                    </p>
                    <p class="text-center">
                        Arte -&gt; 5 &nbsp;&nbsp; Criatividade -&gt; 4 &nbsp;&nbsp; Inovação -&gt; 4 &nbsp;&nbsp; Interação -&gt; 3
                    </p>
                    <p class="text-center">
                        Ou...
                    </p>
                    <p class="text-center">
                        Arte -&gt; 3 &nbsp;&nbsp; Criatividade -&gt; 3 &nbsp;&nbsp; Inovação -&gt; 5 &nbsp;&nbsp; Interação -&gt; 5
                    </p>
                    <p>
                        Dentre outras diversas combinações. Para evitar qualquer tipo de vantagem ou favoritismo para artistas que já tenham uma base de seguidores em redes sociais ou nomes midiáticos, implantamos um sistema especial de votação. Ao escolher alguma arte para votar o voto só será validado se o usuário escolher e votar em uma segunda arte, arte esta que será uma das três últimas colocadas. Desta forma, eliminamos a chance de algum candidato ser boicotado ou impulsionado de forma ilegal, e damos chance para todos os participantes do começo ao fim!
                    </p>
                    <h4><ins>Premiações:</ins></h4>
                    <div class="col-md-6 col-md-offset-3">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td rowspan="2">Nº de Inscritos</td>
                                <td colspan="3" class="text-center">Classificações</td>
                            </tr>
                            <tr>
                                <td class="text-center" style="color:#FED700;"><strong>1º</strong></td>
                                <td class="text-center" style="color:#CCCCCC;"><strong>2º</strong></td>
                                <td class="text-center" style="color: #CD7F32;"><strong>3º</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>20</td>
                                <td class="text-right">R$ 60,00</td>
                                <td class="text-right">R$ 42,00</td>
                                <td class="text-right">R$ 18,00</td>
                            </tr>
                            <tr>
                                <td>50</td>
                                <td class="text-right">R$ 150,00</td>
                                <td class="text-right">R$ 105,00</td>
                                <td class="text-right">R$ 45,00</td>
                            </tr>
                            <tr>
                                <td>100</td>
                                <td class="text-right">R$ 300,00</td>
                                <td class="text-right">R$ 210,00</td>
                                <td class="text-right">R$ 90,00</td>
                            </tr>
                            <tr>
                                <td>200</td>
                                <td class="text-right">R$ 600,00</td>
                                <td class="text-right">R$ 420,00</td>
                                <td class="text-right">R$ 180,00</td>
                            </tr>
                            <tr>
                                <td>250</td>
                                <td class="text-right">R$ 750,00</td>
                                <td class="text-right">R$ 525,00</td>
                                <td class="text-right">R$ 225,00</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop