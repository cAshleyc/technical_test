<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceLines extends Model
{
    /**
     * @var string
     */
    protected $table = 'invoice_lines';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_header_id',
        'description',
        'value',
    ];

    /**
     * Invoice Headers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author AC
     */
    public function invoiceHeaders()
    {
        return $this->belongsTo(InvoiceHeaders::class);
    }
}
