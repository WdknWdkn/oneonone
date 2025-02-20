<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\User;
use App\Models\UserDepartment;
use App\Models\UserPosition;
use App\Models\RatingMaster;
use App\Models\UserRating;
use App\Models\Template;
use App\Models\Interview;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        $account = Account::factory()->create();
        
        // Create departments and positions
        $departments = UserDepartment::factory(3)->forAccount($account)->create();
        $positions = UserPosition::factory(4)->forAccount($account)->create();
        
        // Create rating masters
        $ratingMasters = RatingMaster::factory(4)->forAccount($account)->create();
        
        // Create users with histories
        $users = User::factory(10)
            ->forAccount($account)
            ->withDepartmentHistory()
            ->withPositionHistory()
            ->create();
            
        // Create templates with items
        $templates = Template::factory(3)
            ->forAccount($account)
            ->withItems(5)
            ->create();
            
        // Create interviews with answers
        foreach ($users as $user) {
            Interview::factory(2)
                ->forAccount($account)
                ->create([
                    'interviewer_id' => $users->random()->id,
                    'interviewee_id' => $user->id,
                ])
                ->each(fn ($interview) => $interview->withAnswers($templates->random()));
                
            // Create user ratings
            UserRating::factory(2)
                ->forAccount($account)
                ->create([
                    'user_id' => $user->id,
                    'rating_master_id' => $ratingMasters->random()->id,
                ]);
        }
    }
}
