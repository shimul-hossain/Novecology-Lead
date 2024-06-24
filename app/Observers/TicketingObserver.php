<?php

namespace App\Observers;

use App\Models\CRM\Ticketing;

class TicketingObserver
{
    /**
     * Handle the Ticketing "created" event.
     *
     * @param  \App\Models\CRM\Ticketing  $ticketing
     * @return void
     */
    public function created(Ticketing $ticketing)
    {
        $ticketing->ticket_number = '#' . sprintf('%05d', $ticketing->id);
        $ticketing->save();
    }

    /**
     * Handle the Ticketing "updated" event.
     *
     * @param  \App\Models\CRM\Ticketing  $ticketing
     * @return void
     */
    public function updated(Ticketing $ticketing)
    {
        //
    }

    /**
     * Handle the Ticketing "deleted" event.
     *
     * @param  \App\Models\CRM\Ticketing  $ticketing
     * @return void
     */
    public function deleted(Ticketing $ticketing)
    {
        //
    }

    /**
     * Handle the Ticketing "restored" event.
     *
     * @param  \App\Models\CRM\Ticketing  $ticketing
     * @return void
     */
    public function restored(Ticketing $ticketing)
    {
        //
    }

    /**
     * Handle the Ticketing "force deleted" event.
     *
     * @param  \App\Models\CRM\Ticketing  $ticketing
     * @return void
     */
    public function forceDeleted(Ticketing $ticketing)
    {
        //
    }
}
