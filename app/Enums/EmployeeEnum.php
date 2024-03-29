<?php
  
namespace App\Enums;
use App\Traits\FooBar;

enum EmployeeEnum:string {    
    use FooBar;

    case NEW = 'new';
    case RESIGN = 'resign';
}