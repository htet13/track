<?php
  
namespace App\Enums;
use App\Traits\FooBar;

enum BonusTypeEnum:string {    
    use FooBar;

    case DRIVE_FEE = 'drive_fee';
    case MONTHLY = 'monthly';
    case OTHERS = 'others';
}