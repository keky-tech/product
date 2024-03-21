<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\OptionValue;
use App\Models\ProductOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Keky\Product\Models\Product;

class ProductController extends Controller
{
    /**
     * -------------------------------
     *  GESTION CRUD STORAGE SYSTEM
     * -------------------------------
     */
    //API endpoint to create option
    public function creatOption(Request $request)
    {
        try {
            $title = $request->title;
            //title
            $validatenom = Validator::make($request->All(), ['title' => 'required']);
            if ($validatenom->fails()) {
                //en case d'erreur ou serveur n'est pas disponible
                return response()->json(['statuscode' => '406',
                    'status' => false,
                    'message' => 'Veuillez préciser le titre',
                    'data' => '',
                    'error' => $validatenom->errors(),
                ], 406);
            }

            Option::firstOrCreate([
                'title' => $title,
            ]);

            return response()->json([
                'statuscode' => 200,
                'status' => true,
                'message' => 'option ajouté avec succès',
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'statuscode' => 500,
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }

    }

    //API endpoint to create option
    public function creatOption_value(Request $request)
    {
        try {
            $value = $request->value;
            $validatevalue = Validator::make($request->All(), ['value' => 'required']);
            if ($validatevalue->fails()) {
                //en case d'erreur ou serveur n'est pas disponible
                return response()->json(['statuscode' => '406',
                    'status' => false,
                    'message' => 'Veuillez préciser la valeur',
                    'data' => '',
                    'error' => $validatevalue->errors(),
                ], 406);
            }
            $option_id = $request->option_id;
            $validateoption_id = Validator::make($request->All(), ['option_id' => 'numeric|required']);
            if ($validateoption_id->fails()) {
                //en case d'erreur ou serveur n'est pas disponible
                return response()->json(['statuscode' => '406',
                    'status' => false,
                    'message' => "Veuillez préciser l'option de type number",
                    'data' => '',
                    'error' => $validateoption_id->errors(),
                ], 406);
            }
            $metadata = $request->metadata;
            $validatemetadata = Validator::make($request->All(), ['metadata' => 'required']);
            if ($validateoption_id->fails()) {
                //en case d'erreur ou serveur n'est pas disponible
                return response()->json(['statuscode' => '406',
                    'status' => false,
                    'message' => "Veuillez préciser l'option",
                    'data' => '',
                    'error' => $validateoption_id->errors(),
                ], 406);
            }
            $res = Option::firstWhere('id', $option_id);
            //  return $res;
            if ($res) {
                OptionValue::firstOrCreate([
                    'value' => $value,
                    'option_id' => $option_id,
                    'metadata' => $metadata,
                ]);

                return response()->json([
                    'statuscode' => 200,
                    'status' => true,
                    'message' => 'option ajouté avec succès',
                ], 200);
            } else {
                return response()->json([
                    'statuscode' => 406,
                    'status' => false,
                    'message' => "cette option n'existe pas",
                ], 406);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'statuscode' => 500,
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }

    }

    // API endpoint to attach one product to many options
    public function oneproduct_to_options(Request $request)
    {
        try {
            $product_id = $request->product_id;
            $option_id = $request->option_id;

            $validateproduct_id = Validator::make($request->All(), ['product_id' => 'numeric|required']);
            if ($validateproduct_id->fails()) {
                //en case d'erreur ou serveur n'est pas disponible
                return response()->json(['statuscode' => '406',
                    'status' => false,
                    'message' => "Veuillez préciser l'option de type number",
                    'data' => '',
                    'error' => $validateproduct_id->errors(),
                ], 406);
            }

            foreach ($option_id as $value) {
                ProductOption::firstOrCreate([
                    'product_id' => $product_id,
                    'option_id' => $value,
                ]);
            }

            return response()->json([
                'statuscode' => 200,
                'status' => true,
                'message' => 'liaison produit-option effectué avec succès',
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'statuscode' => 500,
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    //API endpoint to attach one option to many products
    public function oneOption_to_products(Request $request)
    {
        try {
            $product_id = $request->product_id;
            $option_id = $request->option_id;

            $validateoption_id = Validator::make($request->All(), ['option_id' => 'numeric|required']);
            if ($validateoption_id->fails()) {
                //en case d'erreur ou serveur n'est pas disponible
                return response()->json(['statuscode' => '406',
                    'status' => false,
                    'message' => "Veuillez préciser l'option de type number",
                    'data' => '',
                    'error' => $validateoption_id->errors(),
                ], 406);
            }

            $validateproduct_id = Validator::make($request->All(), ['product_id' => 'required']);
            if ($validateproduct_id->fails()) {
                //en case d'erreur ou serveur n'est pas disponible
                return response()->json(['statuscode' => '406',
                    'status' => false,
                    'message' => 'Veuillez préciser le produit de type number',
                    'data' => '',
                    'error' => $validateproduct_id->errors(),
                ], 406);
            }

            foreach ($product_id as $value) {
                ProductOption::firstOrCreate([
                    'product_id' => $value,
                    'option_id' => $option_id,
                ]);
            }

            return response()->json([
                'statuscode' => 200,
                'status' => true,
                'message' => 'liaison produit-option effectué avec succès',
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'statuscode' => 500,
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    //API endpoint to create product
    public function creatProduct(Request $request)
    {
        try {
            Product::firstOrCreate([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'description' => $request->description,
                'slug' => $request->slug,
                'status' => $request->status,
                'external_id' => $request->external_id,
                'thumbnail' => $request->thumbnail,
                'weight' => $request->weight,
                'height' => $request->height,
                'width' => $request->width,
                'type_id' => $request->type_id,
                'metadata' => $request->metadata,
            ]);

            return response()->json([
                'statuscode' => 200,
                'status' => true,
                'message' => 'produit ajouté avec succès',
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'statuscode' => 500,
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
