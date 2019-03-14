<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subcategory_id' => 'required',
            'currency_id' => 'required',
            'brand_id' => 'required',
            'condition_id' => 'required',
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'color' => 'nullable|string',
            'size' => 'nullable|string',
            'description' => 'required|string',
        ];
    }

    public function createProduct()
    {
        $product = new Product();
        $product->affiliate_id = Auth::guard('affiliate')->user()->id;
        return $this->store($product);

    }
    public function update($id){
        $product = Product::findOrFail($id);
        return $this->store($product);
    }

    protected function store(Product $product)
    {
        $product->affiliate_id;
        $product->subcategory_id = $this->subcategory_id;
        $product->currency_id = $this->currency_id;
        $product->brand_id = $this->brand_id;
        $product->condition_id = $this->condition_id;
        $product->name = $this->name;
        $product->quantity = $this->quantity;
        $product->price = $this->price;
        $product->color = $this->color;
        $product->size = $this->size;
        $product->description = $this->description;
        $product->save();

        return true;
    }


}
