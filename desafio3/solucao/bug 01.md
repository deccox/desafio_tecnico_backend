# 🛠️ Relatório de Correção de Bug - Desafio 3

## 🐞 Descrição do Bug

Ao clicar nos links de navegação para **"Produtos"** e **"Categorias"** na página inicial, a aplicação retornava um erro **404 - Página não encontrada**. Esse problema impossibilitava o acesso às listas de produtos e categorias, impactando a navegação.

---

## Causa Raiz

- Após revisar o arquivo de configuração de rotas e o código da view `welcome.blade.php`, identifiquei que os links estavam apontando para rotas inexistentes. A sintaxe utilizada não correspondia aos endpoints corretos definidos no projeto.

## Observação

- O método `index()` do **CategoryController** estava retornando uma view inexistente e utilizando uma variável não definida corretamente.
- No **ProductController**, o método `index()` estava correto, mas a rota `/produtos/listar` estava apontando para um método duplicado `listar()`, gerando inconsistência.
- Identifiquei métodos duplicados no **ProductController** (`index()` e `listar()`). Seguindo boas práticas da comunidade `laravel`, mantive apenas o método `index()` para simplificar

---

## Correção Implementada

- Atualizei os links no arquivo **resources/views/welcome.blade.php** para apontarem corretamente para os endpoints:
  - `/produtos/listar` → `ProductController@index`
  - `/categorias/listar` → `CategoryController@index`
- Removi o método duplicado `listar()` no **ProductController** e ajustei a rota no arquivo de rotas.
- Para testar a correção do desafio, basta rodar os testes unitários `test_product_listing_returns_expected_data()` e  `test_category_listing_returns_expected_data()` `test_it_should_be_return_200_status()`.
- Se o teste passar com sucesso, significa que o nome da categoria está sendo exibido corretamente na listagem de produtos.

```php
//antigo
Route::get('/produtos/listar', 'ProductController@listar');

//Novo
Route::get('/produtos/listar', 'ProductController@index');

...

//antigo
Route::get('/categorias/listar', 'CategoryController@listar');

//Novo
Route::get('/categorias/listar', 'CategoryController@index);
```

```html
<!-- antigo -->
<div class="links">
<a href="{{ url('/produtos') }}">Produtos</a>
<a href="{{ url('/categorias') }}">Categorias</a>
</div>


<!-- novo -->
<div class="links">
<a href="{{ url('/produtos/listar') }}">Produtos</a>
<a href="{{ url('/categorias/listar') }}">Categorias</a>
</div>
```
