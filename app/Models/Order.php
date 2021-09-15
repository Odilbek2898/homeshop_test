<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['phone', 'name', 'address', 'address_rayon', 'address_dom', 'address_kv', 'status', 'user_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function calculateFullSum()
    {

        $sum = 0;
        foreach($this->products()->withTrashed()->get() as $product){
           $sum += $product->getPriceForCount();
       }
       return $sum;
    }

    public static function eraseOrderSum()
    {
        session()->forget('full_order_sum');
    }

    public static function changeFullSum($changeSum)
    {
        $sum = self::getFullSum() + $changeSum;
        session(['full_order_sum'=> $sum]);
    }

    public static function getFullSum()
    {
       return session('full_order_sum', 0);
    }

    public function saveOrder($name, $phone, $address, $address_rayon, $address_dom, $address_kv)
    {
        if($this->status == 0){
            $this->name = $name;
            $this->phone = $phone;
            $this->address = $address;
            $this->address_rayon = $address_rayon;
            $this->address_dom = $address_dom;
            $this->address_kv = $address_kv;
            $this->status = 1;
            $this->save();
            session()->forget('orderId');
            return true;
        }else{
            return false;
        }
    }
}
