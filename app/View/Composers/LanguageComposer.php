<?php

namespace App\View\Composers;

use App\Http\Interfaces\LanguageInterface;
use Illuminate\View\View;
use App\Models\Language;

class LanguageComposer
{
    /**
     * The user Interface implementation.
     *
     * @var \App\Http\Interfaces\LanguageInterface
     */
    protected $language;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Http\Repositories\LanguageInterface  $language
     * @return void
     */
    public function __construct(LanguageInterface $language)
    {
        $this->language = $language;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $language['languages']  = $this->language->all();
        $language['language'] = Language::where('code', \Session::get('locale'))->first();
        $view->with('language', $language);
    }
}
