<?php

namespace Tests\Unit\Factories;

use Tests\TestCase;
use App\Models\Account;
use App\Models\User;
use App\Models\Interview;
use App\Models\RatingMaster;
use App\Models\UserRating;
use Database\Factories\JapaneseFakerProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory;

class TestDataGenerationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $faker = Factory::create();
        $faker->addProvider(new JapaneseFakerProvider($faker));
        $this->app->instance(\Faker\Generator::class, $faker);
    }

    public function test_can_create_complete_test_data_set()
    {
        $account = Account::factory()->create();
        
        $user = User::factory()
            ->forAccount($account)
            ->withDepartmentHistory()
            ->withPositionHistory()
            ->create();
            
        $this->assertNotNull($user->account);
        $this->assertNotNull($user->currentDepartment);
        $this->assertNotNull($user->currentPosition);
        
        $interview = Interview::factory()
            ->forAccount($account)
            ->withAnswers()
            ->create([
                'interviewer_id' => $user->id,
                'interviewee_id' => $user->id,
            ]);
            
        $this->assertNotNull($interview->answers);
        $this->assertNotEmpty($interview->answers);
        
        $rating = UserRating::factory()
            ->forAccount($account)
            ->create([
                'user_id' => $user->id,
                'rating_master_id' => RatingMaster::factory()->forAccount($account)->create()->id,
            ]);
            
        $this->assertNotNull($rating->ratingMaster);
    }
}
