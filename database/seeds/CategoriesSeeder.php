<?php

use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    protected function getMedicines()
    {
        return [
            'All Medicines' => [],
            'OTC (Over the Counter)' => [
                'Analgesics and Cold tablets',
                'Antiseptic Cream and Liquids',
                'Balm or Rubs',
                'Digestive/Antacid',
                'Digestive/Antacid',
                'Skin treatments',
                'Laxatives',
                'Miscellaneous'
            ]
        ];
    }

    protected function getAyurveda()
    {
        return [
            'Health Conditions' => [
                'Immunity Boosters',
                'Cold & cough',
                'Pain Relief',
                'Body care',
                'Skin Care',
                'Child Care',
                'Constipation',
                'Dental Care',
                'Dental Care',
                'Digestive/ Gastro',
                'Ear & Eye Care',
                'Liver Care',
                'Kidney Care',
                'Hair Care',
                'Respiratory Care',
                'Herbal Drinks',
                'Joint & Bones',
                'Men’s Healthcare',
                'Obesity & Slimming',
                'Piles care',
                'Women Healthcare',
                'Stress Relief'
            ],
            'Unani Medicine' => [
                'Hamdard',
                'Rex Remedies'
            ],
            'Homeopathey' => [
                'Dr. Reckeweg',
                'Dr. willmar schwabe',
                'SBL',
            ]
        ];
    }
    protected function getPersonalCare()
    {
        return [

        ];
    }

    protected function getAllCategories()
    {
        return [
            'Medicines' => $this->getMedicines(),
            'Ayurveda' => $this->getAyurveda(),
            'Personal Care'=>$this->getPersonalCare()
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = $this->getAllCategories();

        foreach ($categories as $category_name => $sub_category_value) {

            $last_category = Category::create($this->getColumnValues($category_name));

            foreach (array_keys($sub_category_value) as $subcategory_name) {

                $subcategory_data = array_merge($this->getColumnValues($subcategory_name),
                    ['category_id' => $last_category->id]);

                $last_subcategory = SubCategory::create($subcategory_data);

                foreach ($categories[$category_name][$subcategory_name] as $sub_subcategory_name) {

                    $subcategory_data = array_merge($this->getColumnValues($sub_subcategory_name),
                        ['sub_category_id' => $last_subcategory->id]);

                    SubSubCategory::create($subcategory_data);
                }
            }
        }
    }

    protected function getColumnValues($name)
    {
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'meta_title' => $name
        ];
    }
}
