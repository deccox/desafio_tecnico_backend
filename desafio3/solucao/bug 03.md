# 🛠️ Relatório de Correção de Bug - Desafio 3

## 🐞 Descrição do Bug

Na página de listagem de Produtos, usuários identificaram que não está sendo exibido o nome da Categoria relacionada. Realize uma correção para exibir o nome correto da categoria vinculada ao produto.

---

## Causa Raiz

- A action usada para renderizar a view de listagem de produtos, captura todos os dados do banco de produtos, no entanto, nao realiza inner join para capturar o nome das categorias.
- Na view `produtos.blade.php` é usado `produto->category_id`, logo, o valor exibido vai ser o id de referencia da categoria.

---

## Correção Implementada

- Foi realizada a implementação do `INNER JOIN` na query para retornar o nome da categoria de acordo com seu ID.
- Antes, a view utilizava `produto->category_id` para exibir a categoria, mas agora usamos `produto->category_name`, que é mais descritivo e correto.
- A correção pode ser testada através do teste unitário `test_product_listing_displays_category_name()`.
- Se o teste passar com sucesso, significa que o nome da categoria está sendo exibido corretamente na listagem de produtos.

```php
//antigo 
public function index()
{
$produtos = \App\Models\Product::all();
return view('produtos', ['produtos' => $produtos] );
}

// novo 
public function index()
{
$produtos = \App\Models\Product::
	select('products.*', 'categories.name as category_name')
	->join('categories', 'categories.id', 'products.category_id')
	->get();
return view('produtos', ['produtos' => $produtos] );
}
```

```html
<!-- Antigo --> 
<td scope="row">
   	{{$produto->category_id}}
</td>

<!-- Novo -->
<td scope="row">
   	{{$produto->category_name}}
</td>
```
