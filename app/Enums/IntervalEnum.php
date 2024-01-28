<?php
  
namespace App\Enums;
use App\Traits\FooBar;

enum IntervalEnum:string {
    use FooBar;
    
    case WEEKLY = 'weekly';
    case MONTHLY = 'monthly';
    case YEARLY = 'yearly';
}