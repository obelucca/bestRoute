***Best Route***

O best route é um projeto de estudo onde eu quis inserir alguns algoritmos e também testar alguns conhecimentos. 
Criado com o intuito de calcular a menor distancia entre endereços, e assim calcular melhores rotas entre varios endereços, tendo como objetivo passar por todos eles
e listar todos na ordem que devem ser visitados. 

**Algoritmo de Dijkstra:**

A base desse projeto gira em torno do algortimo de Dijkstra, 
O algoritmo de Dijkstra é um método para encontrar o caminho mais curto entre dois vértices em um grafo ponderado e não direcionado. Ele começa no vértice inicial, atribui a ele uma distância de 0 e a todas as outras vértices uma distância infinita. Em seguida, visita iterativamente o vértice com a menor distância não visitada, atualizando as distâncias dos seus vizinhos se um caminho mais curto for encontrado, até que todos os vértices tenham sido visitados.

**Algoritmo de Haversine:**

O algoritmo de Haversine calcula a distância entre dois pontos na superfície de uma esfera, dado suas latitudes e longitudes. Ele usa a fórmula:

𝑎
=
sin
⁡
2
(
Δ
𝜙
2
)
+
cos
⁡
(
𝜙
1
)
⋅
cos
⁡
(
𝜙
2
)
⋅
sin
⁡
2
(
Δ
𝜆
2
)
a=sin 
2
 ( 
2
Δϕ
​
 )+cos(ϕ 
1
​
 )⋅cos(ϕ 
2
​
 )⋅sin 
2
 ( 
2
Δλ
​
 )
𝑐
=
2
⋅
atan2
(
𝑎
,
1
−
𝑎
)
c=2⋅atan2( 
a
​
 , 
1−a
​
 )
𝑑
=
𝑅
⋅
𝑐
d=R⋅c

onde 
Δ
𝜙
Δϕ e 
Δ
𝜆
Δλ são as diferenças entre latitudes e longitudes dos pontos, 
𝜙
1
ϕ 
1
​
  e 
𝜙
2
ϕ 
2
​
  são as latitudes, e 
𝑅
R é o raio da Terra. A distância 
𝑑
d é calculada em unidades do raio 
𝑅
R (normalmente quilômetros).

## Projeto:

Agora falando em termos de programação e como isso foi aplicado, nesse projeto usei as ferramenta Flasky, para usar um servidor Python, Geopy para converter endereços em latitude
e longitude. Dentro do Geopy, usei a API do Google Maps para uma conversão mais acertiva desses dados, já que o Nomenatim me gerou alguns problemas com endereços menos convencionais.

É um projeto simples, porém incluir essas tecnologias me fez aprender um pouco mais. 


