<?php

namespace App\Imports;

use App\Models\Brand;
use App\Models\CRM\BaremeTravauxTag;
use App\Models\CRM\Product;
use App\Models\CRM\ProductTag;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        // dd($row);
        $product = new Product();
        $marque = Brand::where('description', $row['marque'])->first();
        $product->marque_id = $marque->id ?? 0;
        $product->installation_mode = 'Soufflé';
        $product->activate = 'on';
        $product->reference = $row['reference'];
        $product->designation = $row['designation']; 
        $product->save();
        $baremes = explode('/', $row['baremes_concernes']);
        // dd($baremes);
        if(count($baremes) > 0){
            foreach($baremes as $bareme){
                $tag_item = BaremeTravauxTag::where('bareme', trim($bareme))->first();
                ProductTag::create([
                    'product_id' => $product->id,
                    'tag_id' => $tag_item->id ?? 0,
                ]);
            }
        } 

        return $product;
    }
}
















