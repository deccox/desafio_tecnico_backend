<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriasTest extends TestCase
{
    
    use DatabaseTransactions;
    

    // problem 01
    public function test_it_should_be_return_200_status(){
            $response = $this->get('/categorias/listar');


            $response->assertStatus(200);            
    }
    
    // problem 01
    public function test_categorias_listing_returns_expected_data()
    {

        $categoria = new Category();
        $categoria->name = 'categoria01';
        $categoria->slug = 'categoria01';
        $categoria->description = 'Descrição da Categoria';
        $categoria->save();

        
        $response = $this->get('/categorias/listar');

     
        $response->assertStatus(200);  
        $response->assertSee('categoria01');  
        $response->assertSee('Descrição da Categoria');  
    }
    
     // problem 02
     public function test_successful_category_creation()
     {
         $response = $this->post('/categorias/listar', [
             'name' => 'CategoriaTeste',
             'description' => 'DescricaoTeste',
         ]);
 
         $response->assertRedirect('/categorias/listar');
         $this->assertDatabaseHas('categories', [
             'name' => 'CategoriaTeste'
         ]);
     }
 


   

}
