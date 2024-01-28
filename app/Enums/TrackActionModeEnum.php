<?php
  
namespace App\Enums;
use App\Traits\FooBar;

enum TrackActionModeEnum:string {
    use FooBar;
    
    case ON = 'on';
    case OFF = 'off';
}