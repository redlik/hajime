<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Options extends Model
{
    use HasFactory;
    use SoftDeletes;

//    protected $option_name;
//    protected $option_value;

    protected $guarded = [];

    public function setOption($option_name, $option_value)
    {
        if(!Options::where('option_name',$option_name)->exists()){
            return $this->Options::create([
                'option_name' => $option_name,
                'option_value' => $option_value,
            ]);
        }
    }
}
