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
            'Oral Care' => [
                'Tooth Paste & Powder',
                'Tooth Brush',
                'Mouth wash',
                'Mouth Fresheners'
            ],
            'Skin Care' => [
                'Skin Care',
                'Face wash & Cleansers',
                'Face wash & Cleansers',
                'Lotions & Sunscreens',
                'Talcum Powder',
                'Face wipes',
            ],
            'Hair Care' => [
                'Shampoos',
                'Conditioners',
                'Hair oils',
                'Hair colors',
                'Styling creams & gels',
                'Hair serums',
                'Hair spray',
            ],
            'Eye care' => [
                'Eye care',
                'Eyeliner',
                'Contact Lenses & solutions'
            ],
            'Lip care' => [],
            'Hand & Foot care' => [
                'Hand wash',
                'Hand Sanitizers',
                'Hand Creams',
                'Foot Creams',
                'Miscellaneous'
            ],
            'Feminine Hygiene' => [
                'Sanitary napkins',
                'Tampons & Menstrual cups',
                'Tampons & Menstrual cups',
                'Intimate Hygiene',
                'Hair Removal',
                'Others'
            ],
            'Bath & Shower' => [
                'Bathing  Soaps & Bar',
                'Shower gel',
                'Body wash'
            ],
            'Deodorants , Perfumes & Talcum' => [
                'Women',
                'Men',
                'Roll On & Stick Deos',
                'Talcum Powder',
                'Room Fresheners'
            ],
            'Hair Removal & Shaving' => [
                'Razors & Cartridges',
                'Hair Removing Cream & Wax',
                'After Shave',
                'Beard care'
            ],
            'Home Care' => [
                'Mosquito Repellent',
                'Rat Killer',
                'Toilet Cleaners/ Fresheners'
            ]
        ];
    }
   
    protected function getBabyCare()
    {
        return [
            'Baby Food' => [],
            'Skin care and Bath' => [
                'Face & Body Creams',
                'Lotions',
                'Hair Oils',
                'Massage Oils',
                'Shampoo, Body Wash & Soaps',
                'Baby Powder'
            ],
            'Diaper and Wipes' => [
                'Baby wipes',
                'Diapers',
                'Rash Cream',
            ],
            'Feeding Bottles ' => [],
            'Baby Accessories' => [
                'Teether',
                'Soother',
                'Gripe water',
                'Cleaner Brushes'
            ],
            'Gift Sets' => []
        ];
    }

    protected function getHealthSupplements()
    {
        return [
            'Health & Nutrition foods/drinks' => [],
            'Vitamins & Minerals' => [],
            'Protein supplements' => [
                'Kids',
                'Men',
                'Women',
            ],
            'Weight Management' => [
                'Weight loss',
                'Weight Gain',
            ],
            'Herbal Supplements' => []
        ];
    }

    protected function getDiabetic()
    {
        return [
            'Glucometers' => [],
            'Testing stips & lancets' => [],
            'Diabetic care' => [],
            'Ayurvedic Diabetic  Care' => [],
        ];
    }

    protected function getSexualWellness()
    {
        return [
            'Condoms' => [],
            'Lubricants & Massage Gel' => [],
            'Sexual health products' => [],
            'Pregnancy Test Kit' => [],
        ];
    }

    protected function getHealthcareDevices()
    {
        return [
            'BP Monitors' => [],
            'Body Massager' => [],
            'Nebulizer' => [],
            'Oximeters' => [],
            'Thermometers' => [],
            'Weighing scale' => [],
        ];
    }

    protected function getSurgicals()
    {
        return [
            'First Aid Kit' => [],
            'Masks & sanitizer' => [],
            'N-95 Face Mask' => [],
            'Orthopedics' => [],
            'Catheter & Sutures' => [],
            'Dressing & Cottons' => [],
            'Gloves' => [],
            'Bandage & Gauze' => [],
            'Adhesive & paper Tape' => [],
            'Stethoscope' => [],
            'Adult Diapers' => [],
        ];
    }

    protected function getPetCare()
    {
        return [
            'Pet Food' => [],
            'Pet care' => [],
            'Bones' => [],
            'Calcium' => [],
            'Biscuits' => [],
        ];
    }

    protected function getAllCategories()
    {
        return [
            'Medicines' => $this->getMedicines(),
            'Ayurveda' => $this->getAyurveda(),
            'Personal Care' => $this->getPersonalCare(),
            'Health Supplements' => $this->getHealthSupplements(),
            'Diabetic' => $this->getDiabetic(),
            'Sexual Wellness' => $this->getSexualWellness(),
            'Healthcare Devices' => $this->getHealthcareDevices(),
            'Surgicals' => $this->getSurgicals(),
            'Pat Care' => $this->getPetCare(),
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

            $last_category = Category::updateOrCreate(['name' => $category_name],$this->getColumnValues($category_name));

            foreach (array_keys($sub_category_value) as $subcategory_name) {

                $subcategory_data = array_merge($this->getColumnValues($subcategory_name),
                    ['category_id' => $last_category->id]);

                $last_subcategory = SubCategory::updateOrCreate(['name' => $subcategory_name],$subcategory_data);

                foreach ($categories[$category_name][$subcategory_name] as $sub_subcategory_name) {

                    $subcategory_data = array_merge($this->getColumnValues($sub_subcategory_name),
                        ['sub_category_id' => $last_subcategory->id]);

                    SubSubCategory::updateOrCreate(['name' => $sub_subcategory_name],$subcategory_data);
                }
            }
        }
    }

    protected function getColumnValues($name)
    {
        $name = trim($name);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'meta_title' => $name
        ];
    }
}
