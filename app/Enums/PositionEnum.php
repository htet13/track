<?php
  
namespace App\Enums;
use App\Traits\FooBar;

enum PositionEnum:string {    
    use FooBar;

    case DRIVER = 'driver';
    case SPARE = 'spare';
}