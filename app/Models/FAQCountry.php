<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQCountry extends Model
{
    use HasFactory;


    public function faq()
    {
        return $this->hasOne('App\Models\FAQ', 'id', 'faq_id');
    }

    public function faqCountries()
    {
        return $this->hasMany('App\Models\FAQCountry', 'faq_id', 'id');
    }

}
