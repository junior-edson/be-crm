<?php

namespace App\States\Invoice;

use App\States\Canceled;
use App\States\Draft;
use App\States\Overdue;
use App\States\Paid;
use App\States\Sent;
use Spatie\ModelStates\Exceptions\InvalidConfig;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class InvoiceState extends State
{
    /**
     * @return StateConfig
     * @throws InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()
            ->allowTransition(Draft::class, Sent::class)
            ->allowTransition(Sent::class, Paid::class)
            ->allowTransition(Sent::class, Canceled::class)
            ->allowTransition(Sent::class, Overdue::class)
            ->allowTransition(Overdue::class, Sent::class);
    }
}
