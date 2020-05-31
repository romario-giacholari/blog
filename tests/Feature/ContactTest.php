<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Mail\ContactMe;
use Illuminate\Support\Facades\Mail;

class ContactTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Mail::fake();
    }

    public function test_it_sends_a_contact_me_email()
    {
        $endpoint = route('contact.store');
        $request = [
            'name' => 'John Doe',
            'email' => 'johnDoe@example.com',
            'subject' => 'Hello',
            'message' => 'World',
            'answer' => 4
        ];
        $response = $this->json('POST', $endpoint, $request);
        
        $response->assertStatus(200);
        $response->assertJson(['isSuccess' => true]);

        Mail::assertSent(ContactMe::class, function ($mail) use ($request) {
            return $request['name'] === $mail->name;
        });
    }
}
