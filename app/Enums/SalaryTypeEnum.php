<?php
  
namespace App\Enums;
use App\Traits\FooBar;

enum SalaryTypeEnum:string {    
    use FooBar;

    case MONTHLY = 'monthly';
    case DRIVEFEE = 'drive_fee';
}