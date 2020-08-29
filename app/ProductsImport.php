<?php

namespace App;

use App\Product;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

use Auth;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation, WithChunkReading, WithBatchInserts
{
    public function model(array $row)
    {
      \Log::info("Hello");

    try{
     $data =   new Product([
           'name'     => $row['name'],
           'composition' => $row['composition'],
           'added_by'    => Auth::user()->user_type == 'seller' ? 'seller' : 'admin',
           'user_id'    => Auth::user()->user_type == 'seller' ? Auth::user()->id : User::where('user_type', 'admin')->first()->id,
           'category_id'    => $row['category_id'],
           'subcategory_id'    => $row['subcategory_id'],
           'subsubcategory_id'    => $row['subsubcategory_id'],
           'brand_id'    => $row['brand_id'],
           'prescription' => $row['prescription'],
           'ayurvedic_ingredients' => $row['ayurvedic_ingredients'],
           'expert_advice' => $row['expert_advice'],
           'video_provider'    => $row['video_provider'],
           'video_link'    => $row['video_link'],
           'unit_price'    => $row['unit_price'],
           'purchase_price'    => $row['purchase_price'],
           'unit'    => $row['unit'],
           'current_stock' => $row['current_stock'],
           'meta_title' => $row['meta_title'],
           'meta_description' => $row['meta_description'],
           'colors' => json_encode(array()),
           'choice_options' => json_encode(array()),
           'variations' => json_encode(array()),
           'photos' => json_encode($row['photos']),
           'thumbnail_img' => $row['thumbnail_img'],
           'featured_img' => $row['featured_img'],
           'flash_deal_img' => $row['flash_deal_img'],
           'slug' => preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $row['slug'])).'-'.str_random(5),
        ]);
     }
     catch(\Exception $e){
      \Log::info($e);

      return false;
     }

     return $data;
    }

    public function rules(): array
    {
        return [
             // Can also use callback validation rules
             'unit_price' => function($attribute, $value, $onFailure) {
                  if (!is_numeric($value)) {
                       $onFailure('Unit price is not numeric');
                  }
              }
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
