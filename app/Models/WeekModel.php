<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class WeekModel extends Model
{
    protected $table = 'week';

    static public function getSingle($id)
    {
        return self::find($id);  
    }

    static public function getRecord()
    {
        return self::get();  
    }

    

}
