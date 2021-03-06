<?php

namespace Tests\Integrated;

use App\Models\Product;
use App\Models\User;
use App\Models\WishList;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishListTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /*
     * this function tests if a product is saved in the wish list
     */
    public function test_user_can_add_product_to_wishList()
    {

        $this->withExceptionHandling();
        $product = factory(Product::class)->create();

        $data = [
            'user_id' => $this->user->id,
            'product_id' => $product->id,

        ];
        $this->actingAs($this->user)->get(action('WishListController@add', $product->id), $data)
            ->assertRedirect()->assertSessionHasNoErrors();

        $this->assertDatabaseHas('wish_list', $data);

    }

    /*
     * this function tests if a product is deleting a product in wish list
     */

    public function test_user_can_delete_product_in_wishList()
    {

        $this->withExceptionHandling();
        $wishList = factory(WishList::class)->create();
        $this->actingAs($this->user)->get(action('WishListController@destroy', $wishList->id))
            ->assertSessionHasNoErrors()->assertRedirect();
        $wishList = $wishList->fresh();
        $this->assertEquals(0, $wishList);
    }

    /*
     * this function tests if a user can view his wish list products
     */

    public function test_user_can_view_wishList_products()
    {

        $this->withExceptionHandling();
        $wishList = factory(WishList::class)->create();
        $this->actingAs($this->user)->get(action('WishListController@index'))->assertSessionHasNoErrors()
            ->assertSuccessful()->assertSee($wishList->id);
    }

}
