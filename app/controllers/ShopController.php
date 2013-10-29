<?php
use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
class ShopController extends BaseController {
	
	public $restful = true;
	
	public function __construct(){
        $this->beforeFilter('auth');
    }

	public function getIndex(){
		$types = DB::table('types')->get();
		$items = DB::table('items')
			->join('types', 'items.type', '=', 'types.id')
			->orderBy('items.name', 'DESC')
			->select('items.id','items.name','items.desc', 'items.silver', 'items.plat', 'types.name as type_name','types.id as type_id')
			->get();
		
		return View::make('shop.index')			
			->with('title', 'Shop')
			->with('header', ['Nevermore Shop', 'Where you buy stuff'])
			->with('items', $items)
			->with('types', $types)
			->with('user',  User::find(Sentry::getUser()->id));
	}

	public function getCash(){
		$items = DB::table('items')
			->where('type', '=', 1)
			->orderBy('items.name', 'DESC')
			->select('items.id', 'items.name', 'items.desc', 'items.cent')
			->get();

		return View::make('shop.cash')
			->with('title', 'Shop')
			->with('header', ['Nevermore Shop', 'Where you buy stuff'])
			->with('items', $items)
			->with('user',  User::find(Sentry::getUser()->id));
	}

}