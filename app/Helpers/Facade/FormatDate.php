<?php
namespace App\Helpers\Facade;
use Illuminate\Support\Facades\Facade;

class FormatDate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'FormatDateHelper';
    }
}
