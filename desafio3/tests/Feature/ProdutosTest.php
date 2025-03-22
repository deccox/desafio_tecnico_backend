<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProdutosTest extends TestCase
{

    use DatabaseTransactions;
    

    public function test_it_should_be_return_200_status(){
            $response = $this->get('/produtos/listar');


            $response->assertStatus(200);            
    }


    public function test_product_listing_returns_expected_data()
    {
        
        $produto = new Product();
        $produto->name = 'Produto01';
        $produto->slug = 'produto01';
        $produto->description = 'Descrição do Produto';
        $produto->price = 100;
        $produto->category_id = 1;
        $produto->save();

        
        $response = $this->get('/produtos/listar');

     
        $response->assertStatus(200);  
        $response->assertSee('Produto01');  
        $response->assertSee('Descrição do Produto');  
        $response->assertSee('100'); 
    }




    public function test_product_listing_displays_category_name()
    {
        $category = new Category();
        $category->name = 'Categoria Teste';
        $category->save();


        $produto = new Product();
        $produto->name = 'Produto01';
        $produto->slug = 'produto01';
        $produto->description = 'Descrição do Produto';
        $produto->price = 100;
        $produto->category_id = $category->id;
        $produto->save();


        $response = $this->get('/produtos/listar');

        
        $response->assertStatus(200);
        $response->assertSee('Categoria Teste');
    }

}
