<?php
  
namespace App\Enums;
use App\Traits\FooBar;

enum MonthEnum:string {    
    use FooBar;

    case January = 1;
    case February = 2;
    case March = 3;
    case April = 4;
    case May = 5;
    case Jun = 6;
    case July = 7;
    case August = 8;
    case September = 9;
    case October = 10;
    case November = 11;
    case December = 12;
}