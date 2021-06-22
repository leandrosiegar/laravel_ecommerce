<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function esSuyo(User $user, Order $order) {
        if ($order->user_id == $user->id) {
            return true;
        }
        else {
            return false;
        }
    }

    public function yaPagado(User $user, Order $order) {
        if ($order->status==2) {
            return false;
        }
        else {
            return true;
        }
    }
}
