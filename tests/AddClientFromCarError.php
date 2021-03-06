<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AddClientFromCarError extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testAddClientError()
    {
        $this->visit('/')
	     ->type('a@b.c', 'email')
             ->type ('panarama', 'password')
             ->press('Sign In')
             ->seePageIs('/')
             ->see('Cars')
             ->click('Cars')
             ->seePageIs('/cars')
             ->see('List of cars')
             ->click('Add client')
             ->see('Name:')
             ->type('Catalin', 'Name')
             ->type('Bradford BD50NQ Laisteridge Lane','Address')
             ->type('sss','PhoneNo')
             ->type('cata112233@gmail.com', 'Email')
             ->press('Add client')
             ->see('Error:');    
    }
}
