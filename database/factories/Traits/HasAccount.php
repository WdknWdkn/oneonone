<?php

namespace Database\Factories\Traits;

use App\Models\Account;

trait HasAccount
{
    public function forAccount($account = null)
    {
        return $this->state(function (array $attributes) use ($account) {
            return [
                'account_id' => $account ? $account->id : Account::factory(),
            ];
        });
    }
}
