<?php
 
use App\Models\Item;
use App\Models\Purchase;

class ShopSeeder extends Seeder {
 
    public function run()
    {
        Eloquent::unguard();
        DB::table('items')->delete();
        DB::table('purchases')->delete();
        DB::table('item_purchase')->delete();
        Item::create([
            'name'=>'Platinum 650',
            'desc'=>'Buys you 650 Platinum',
            'type'=>1,
            'plat'=>650,
            'cent'=>500,
        ]);
        Item::create([
            'name'=>'VIP Status',
            'desc'=>'VIP Status gives access to more homes, magic carpet, and a few other special benifits.',
            'type'=>2,
            'plat'=>500,
        ]);
        Item::create([
            'name'=>'5 Minute Ban',
            'desc'=>'You will be banned for 5 minutes upon purchase.',
            'type'=>3,
            'plat'=>100,
        ]);
        Item::create([
            'name'=>'Daimond Block',
            'desc'=>'A daimond block can be used for beacons or broken down into 9 daimonds.',
            'type' => 4,
            'silver'=>1000,
            'plat'=>300,
        ]);
        

        Purchase::create([
            'user_id'=>1
        ]);
        DB::table('item_purchase')->insert([
            [
            'purchase_id'=>1,
            'item_id'=>1
            ]
        ]);
        DB::table('types')->insert([
            ['name' => 'Monetary'],
            ['name' => 'Status'],
            ['name' => 'Services'],
            ['name' => 'Blocks'],
            ['name' => 'Items'],
        ]);
    }
 
}
