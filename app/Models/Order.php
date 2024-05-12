<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\EmbedsMany;

class Order extends Model
{
    use HasFactory;

    protected $collection = 'orders';

    protected $fillable = ['code', 'products', 'status'];

    public function products(): EmbedsMany
    {
        return $this->embedsMany(Product::class);
    }

}
