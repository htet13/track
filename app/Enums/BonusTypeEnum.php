<?php
  
namespace App\Enums;
use App\Traits\FooBar;

enum BonusTypeEnum:string {    
    use FooBar;

    case THIDINGYUT = 'thidingyut';
    case THINGYAN = 'thingyan';
    case OTHERS = 'others';
}