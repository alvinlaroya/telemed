<?php

use App\Service;
use App\Package;
use App\Specialization;
use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{

    public function run()
    {

        // Insert Follow Up in services table
        if(Schema::hasTable('services')) {
            $followUpService = Service::where('name', 'LIKE', '%Follow Up%')->first();

            if(!$followUpService) {
                $followUpService = Service::create([
                    'name' => 'Follow Up',
                    'product_code' => 'follow-up',
                    'description' => 'This is the follow up service.',
                    'category_id' => 1,
                    'price' => 0,
                    'eligible' => 1,
                    'status' => 1
                ]);
            }
        }

        // Insert packages
        if(Schema::hasTable('packages')) {
            DB::table('packages')->truncate();

            $dengueNS1 = Service::where('name', 'LIKE', '%DENGUE NS 1%')->first();
            $covid19test = Service::where('name', 'LIKE', '%COVID 19 TEST%')->first();
            $followUpService = Service::where('name', 'LIKE', '%Follow Up%')->first();

            $primaryPackage = Package::create([
                'name' => 'Primary Package',
                'price' => 3200
            ]);

            $secondaryPackage = Package::create([
                'name' => 'Secondary Package',
                'price' => 2500
            ]);

            $dengueNS1->packages()->attach([$primaryPackage->id, $secondaryPackage->id]);
            $covid19test->packages()->attach([$primaryPackage->id, $secondaryPackage->id]);
            $followUpService->packages()->attach([$primaryPackage->id]);
            
        }


    }

}
