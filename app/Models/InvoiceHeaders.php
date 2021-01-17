<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceHeaders extends Model
{
    /**
     * @var string
     */
    protected $table = 'invoice_headers';

    // Get our Status' as set in the database - This would be better in its own database table for easier management
    const STATUS_DRAFT = 'draft';
    const STATUS_OPEN = 'open';
    const STATUS_PROCESSED = 'processed';
    const ALL_STATUSES = [self::STATUS_DRAFT, self::STATUS_OPEN, self::STATUS_PROCESSED];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'location_id',
        'date',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Invoice Lines
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @author AC
     */
    public function invoiceLines()
    {
        return $this->hasMany(InvoiceLines::class, 'invoice_header_id');
    }

    /**
     * Location
     *
     * @author AC
     */
    public function location()
    {
        return $this->belongsTo(Locations::class);
    }

    /**
     * Get Total
     *
     * @return int|mixed
     *
     * @author AC
     */
    public function getTotal()
    {
        return $this->invoiceLines()->sum('value');
    }
}
