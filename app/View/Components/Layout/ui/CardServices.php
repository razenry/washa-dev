<?php

namespace App\View\Components\Layout\ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardServices extends Component
{
    public $title;
    public $description;
    public $price;
    public $features;
    public $link;

    public function __construct($title, $description, $price, $features = [], $link = '#')
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->features = $features;
        $this->link = $link;
    }
    public function render(): View|Closure|string
    {
        return view('components.layout.ui.card-services');
    }
}
