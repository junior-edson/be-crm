<?php

namespace App\States\Proposal;

use App\States\Accepted;
use App\States\Canceled;
use App\States\Draft;
use App\States\Rejected;
use App\States\Sent;
use Spatie\ModelStates\Exceptions\InvalidConfig;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class ProposalState extends State
{
    /**
     * @return StateConfig
     * @throws InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()
            ->allowTransition(Draft::class, Sent::class)
            ->allowTransition(Sent::class, Accepted::class)
            ->allowTransition(Sent::class, Rejected::class)
            ->allowTransition(Accepted::class, Canceled::class)
            ->allowTransition(Rejected::class, Canceled::class);
    }
}
