<?php

namespace Tests\Integrated;

use App\Models\Affiliate;
use App\Models\Deal;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DealsTest extends TestCase
{
    Use RefreshDatabase, WithFaker;
    protected $affiliate;

    protected function setUp(): void
    {
        parent::setUp();
        $this->affiliate = factory(Affiliate::class)->create();
    }

    /*
     * This function test if an affiliate can add a deal and if a deal is being stored
     * in database perfectly
     */
    public function test_affiliate_can_add_deals()
    {

        $this->withoutExceptionHandling();
        $data = [
            'product_id' => factory(Product::class)->create()->id,
            'price' => $this->faker->randomNumber(),
            'begin_on' => $this->faker->dateTime,
            'end_at' => $this->faker->dateTime,
        ];
//
        $this->actingAs($this->affiliate, 'affiliate')->post(action('Affiliate\DealsController@store'), $data)
            ->assertRedirect()->assertSessionHasNoErrors();
        $this->assertDatabaseHas('deals', $data);
    }

    /*
     * This function tests if an affiliate can update a certain deal perfectly
     */
    public function test_affiliate_can_update_deals()
    {
        $deal = factory(Deal::class)->create();
        $data = [
            'product_id' => factory(Product::class)->create()->id,
            'price' => $this->faker->randomNumber(),
            'begin_on' => $this->faker->dateTime,
            'end_at' => $this->faker->dateTime,
        ];
        //assertredirect->checks the type of redirect can be return back or return view
        //assertSessionHasNoErrors->validation
        $this->actingAs($this->affiliate, 'affiliate')->post(action('Affiliate\DealsController@update', $deal->id), $data)
            ->assertRedirect()->assertSessionHasNoErrors();
        $deal = $deal->fresh();
        $this->assertEquals($deal->price, $data['price']);
    }

    /*
      * this function test if an affiliate can delete a deal perfectly
      */
    public function test_affiliate_can_delete_deal()
    {
        $deal = factory(Deal::class)->create();
        $this->actingAs($this->affiliate, 'affiliate')->get(action('Affiliate\DealsController@delete', $deal->id))
            ->assertSessionHasNoErrors()->assertRedirect();
        $deal = $deal->fresh();
        $this->assertEquals(0, $deal);
    }
}
