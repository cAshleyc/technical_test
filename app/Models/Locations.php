<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    /**
     * @var string
     */
    protected $table = 'locations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Invoice Headers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author AC
     */
    public function invoiceHeaders()
    {
        return $this->hasMany(InvoiceHeaders::class, 'location_id');
    }
}
