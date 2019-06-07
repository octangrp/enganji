<?php

namespace Tests\Feature\Affiliate;

use App\Affiliate;
use App\Conversation;
use App\Message;
use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChatTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected $user;
    protected $affiliate;
    protected $product;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->user = factory(User::class)->create();
        $this->affiliate = factory(Affiliate::class)->create();
        $this->product = factory(Product::class)->create(['affiliate_id' => $this->affiliate->id]);
    }

    public function test_affiliate_can_send_message()
    {
        $this->assertEquals(0, Conversation::count());
        $conversation = factory(Conversation::class)->create(['user_id' => $this->user->id, 'affiliate_id' => $this->affiliate->id]);
        $attributes = [
            'conversation_id' => $conversation->id,
            'body' => $this->faker->text,
        ];
        $this->assertEquals(1, Conversation::count());
        $this->actingAs($this->affiliate,'affiliate')->post(action('Affiliate\ChatsController@send'), $attributes)
            ->assertSessionHasNoErrors();


    }

    public function test_affiliate_can_fetch_messages(){
        $conversation=factory(Conversation::class)->create(['affiliate_id'=>$this->affiliate->id,'user_id'=>$this->user->id]);
        $message=factory(Message::class)->create(['conversation_id'=>$conversation->id]);
        $attributes=[
            'conversation_id' => $conversation->id,
        ];
        $this->actingAs($this->affiliate,'affiliate')->get(action('Affiliate\ChatsController@fetchMessages',$attributes))
            ->assertSuccessful()
            ->assertSee($message->body);

    }

}
