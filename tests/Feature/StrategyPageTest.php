<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Strategy;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StrategyPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_strategy_page_shows_strategies(): void
    {
        //tässä tehdään 5 strategiaa 
        $strategies = Strategy::factory()->count(5)->create();

        //ukk sivulla on strategia näkyvissä, siksi reitti on /ukk
        $response = $this->get('/ukk');

       //testaa että pyyntö onnistuu
        $response->assertStatus(200);

        //katsotaan näkyykö strategiat
        foreach ($strategies as $strategy) {
            $response->assertSeeText($strategy->feedback->aihe);
        }
    }
}
