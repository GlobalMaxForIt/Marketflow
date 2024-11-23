<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\ProductDescriptionTranslation;
use App\Models\ProductsAmountTranslation;
use App\Models\ProductsCategories;
use App\Models\ProductsCategoriesTranslation;
use App\Models\ProductTranslations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\CityTranslations;
use Illuminate\Support\Facades\DB;


class TableTranslationController extends Controller
{

    public $title;
    public $current_page = 'settings';
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->title = $this->getTableTitle('Settings');
    }

    public function index()
    {
        return view('language.tables', [
            'current_page'=>$this->current_page,
            'title'=>$this->title
        ]);
    }

    public function show($type){
        $languages = Language::orderBy('id', 'ASC')->get();
        return view('language.table_lang', [
            'type'=>$type,
            'languages'=>$languages,
            'current_page'=>$this->current_page,
            'title'=>$this->title
        ]);
    }

    public function tableShow(Request $request ){
        $type=$request->type;
        $id=$request->language_id;
        $language = Language::findOrFail($id);
       // $lang_keys = Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'))->get();
        $sort_search = null;
        switch ($type){
            case 'city':
                $lang_keys = CityTranslations::where('lang', env('DEFAULT_LANGUAGE', 'uz'))->get();
                if ($request->has('search')) {
                    $sort_search = $request->search;
                    $lang_keys = $lang_keys->where('lang_key', request()->input('search'));
                }
                return view('language.table_show', [
                    'lang_keys'=>$lang_keys,
                    'language'=>$language ,
                    'sort_search' => $sort_search,
                    'type'=>$type,
                    'current_page'=>$this->current_page,
                    'title'=>$this->title
                ]);
                break;
            case 'product':
                $lang_keys = ProductTranslations::where('lang', env('DEFAULT_LANGUAGE', 'uz'))->get();
                if ($request->has('search')) {
                    $sort_search = $request->search;
                    $lang_keys = $lang_keys->where('lang_key', request()->input('search'));
                }
                return view('language.table_show', [
                    'lang_keys'=>$lang_keys,
                    'language'=>$language ,
                    'sort_search' => $sort_search,
                    'type'=>$type,
                    'current_page'=>$this->current_page,
                    'title'=>$this->title
                ]);
                break;
            case 'product_category':
                $lang_keys = ProductsCategoriesTranslation::where('lang', env('DEFAULT_LANGUAGE', 'uz'))->get();
                if ($request->has('search')) {
                    $sort_search = $request->search;
                    $lang_keys = $lang_keys->where('lang_key', request()->input('search'));
                }
                return view('language.table_show', [
                    'lang_keys'=>$lang_keys,
                    'language'=>$language ,
                    'sort_search' => $sort_search,
                    'type'=>$type,
                    'current_page'=>$this->current_page,
                    'title'=>$this->title
                ]);
                break;
            case 'product_description':
                $lang_keys = ProductDescriptionTranslation::where('lang', env('DEFAULT_LANGUAGE', 'uz'))->get();
                if ($request->has('search')) {
                    $sort_search = $request->search;
                    $lang_keys = $lang_keys->where('lang_key', request()->input('search'));
                }
                return view('language.table_show', [
                    'lang_keys'=>$lang_keys,
                    'language'=>$language ,
                    'sort_search' => $sort_search,
                    'type'=>$type,
                    'current_page'=>$this->current_page,
                    'title'=>$this->title
                ]);
                break;
            case 'product_amount':
                $lang_keys = ProductsAmountTranslation::where('lang', env('DEFAULT_LANGUAGE', 'uz'))->get();
                if ($request->has('search')) {
                    $sort_search = $request->search;
                    $lang_keys = $lang_keys->where('lang_key', request()->input('search'));
                }
                return view('language.table_show', [
                    'lang_keys'=>$lang_keys,
                    'language'=>$language ,
                    'sort_search' => $sort_search,
                    'type'=>$type,
                    'current_page'=>$this->current_page,
                    'title'=>$this->title
                ]);
                break;
            default:
        }
    }


    public function translation_save(Request $request)
    {
        switch ($request->type){
            case 'city':
                $language = Language::findOrFail($request->id);
                foreach ($request->values as $key => $value) {
                    $translation_def = CityTranslations::where('city_id', $key)->where('lang', $language->code)->first();
                    if ($translation_def) {
                        $translation_def->name = $value;
                        $translation_def->save();
                    }
                }
                return back();
                break;
            case 'product':
                $language = Language::findOrFail($request->id);
                foreach ($request->values as $key => $value) {
                    $translation_def = ProductTranslations::where('product_id', $key)->where('lang', $language->code)->first();
                    if ($translation_def) {
                        $translation_def->name = $value;
                        $translation_def->save();
                    }
                }
                return back();
                break;
            case 'product_category':
                $language = Language::findOrFail($request->id);
                foreach ($request->values as $key => $value) {
                    $translation_def = ProductsCategoriesTranslation::where('products_categories_id', $key)->where('lang', $language->code)->first();
                    if ($translation_def) {
                        $translation_def->name = $value;
                        $translation_def->save();
                    }
                }
                return back();
                break;
            case 'product_description':
                $language = Language::findOrFail($request->id);
                foreach ($request->values as $key => $value) {
                    $translation_def = ProductDescriptionTranslation::where('product_id', $key)->where('lang', $language->code)->first();
                    if ($translation_def) {
                        $translation_def->name = $value;
                        $translation_def->save();
                    }
                }
                return back();
                break;
            case 'product_amount':
                $language = Language::findOrFail($request->id);
                foreach ($request->values as $key => $value) {
                    $translation_def = ProductsAmountTranslation::where('product_id', $key)->where('lang', $language->code)->first();
                    if ($translation_def) {
                        $translation_def->name = $value;
                        $translation_def->save();
                    }
                }
                return back();
                break;
            case 'hall':
                $language = Language::findOrFail($request->id);
                foreach ($request->values as $key => $value) {
                    $translation_def = HallsTranslation::where('hall_id', $key)->where('lang', $language->code)->first();
                    if ($translation_def) {
                        $translation_def->name = $value;
                        $translation_def->save();
                    }
                }
                return back();
                break;
            case 'hall_description':
                $language = Language::findOrFail($request->id);
                foreach ($request->values as $key => $value) {
                    $translation_def = HallsDescriptionTranslation::where('hall_id', $key)->where('lang', $language->code)->first();
                    if ($translation_def) {
                        $translation_def->name = $value;
                        $translation_def->save();
                    }
                }
                return back();
                break;
            case 'stuff_category':
                $language = Language::findOrFail($request->id);
                foreach ($request->values as $key => $value) {
                    $translation_def = StuffsCategoriesTranslation::where('stuffs_categories_id', $key)->where('lang', $language->code)->first();
                    if ($translation_def) {
                        $translation_def->name = $value;
                        $translation_def->save();
                    }
                }
                return back();
                break;
            default:
        }

    }
}
