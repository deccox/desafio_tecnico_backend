# 🛠️ Relatório de Correção de Bug - Desafio 3

## 🐞 Descrição do Bug

Um usuário relatou dificuldades ao realizar o cadastro de uma nova categoria. Ao preencher os dados e apertar em "Salvar", mostra a mensagem de sucesso no entanto não é feito o cadastro. Realize uma correção nesse procedimento

---

## Causa Raiz

- O atributo `action` do formulário estava configurado corretamente, no entanto o action responsável por tratar as requisições da url era o `index` em vez do `store`, que é a responsável por processar o cadastro de novas categorias.
- Ao usar o GET, a requisição era enviada para uma rota que renderizava a view de listagem de categorias. O correto seria usar POST que a requisição seria enviada para a rota correta.

---

## Correção Implementada

- Atualizei o `method` no arquivo `resources/views/categorias/create.blade.php` para apontarem corretamente para o endpoint:
  - `/categorias/listar POST` → `CategoryController@store`
- Para testar a correção do desafio, basta rodar o teste unitário que verifica se a rota existe.
- Para testar a correção do desafio, basta rodar os testes unitários `test_successful_category_creation()`.
- Se o teste passar com sucesso, significa que o nome da categoria está sendo exibido corretamente na listagem de produtos.

```html
<!-- antigo -->
<form name="formCard" id="formCard" method="GET" action="{{url('categorias/listar')}}">

<!-- novo -->
<form name="formCard" id="formCard" method="POST" action="{{url('categorias/listar')}}">
```

## Observação

Embora na descrição do bug diga que uma mensagem de confirmação de cadastro era exibida, na função existente no controlador, nenhuma mensagem de confirmação é passada para a view. Além disso, não há nenhum método no layout ou na view de listagem que exiba uma mensagem de confirmação. Uma possível solução seria inserir uma mensagem no retorno do método `store` e configurar o layout ou a view de listagem para exibir essa mensagem.

## Observação Implementada

```php
//Antes
if($category){
	return redirect('categorias/listar');
}

//novo
if($category){
	return redirect('categorias/listar')->with('msg', 'Categoria cadastrada com sucesso');
}
```

```php
<!-- Novo -->
@if(session('msg'))
	<div class="alert alert-success text-center mx-auto" style="max-width: 400px;">
	{{session('msg')}}
	</div>
@endif
```
