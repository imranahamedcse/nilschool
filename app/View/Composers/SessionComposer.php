<?php

namespace App\View\Composers;

use App\Http\Interfaces\Settings\SessionInterface;
use Illuminate\View\View;
use App\Models\Language;

class SessionComposer
{
    /**
     * The user Interface implementation.
     *
     * @var \App\Http\Interfaces\Settings\SessionInterface
     */
    protected $session;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Http\Repositories\SessionInterface  $language
     * @return void
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $session['sessions']  = $this->session->all();
        $session['session']   = $this->session->show(setting('session'));

        $view->with('session', $session);
    }
}
