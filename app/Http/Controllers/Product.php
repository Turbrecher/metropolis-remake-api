<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomNotFoundException;
use App\Models\Product as ProductModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use TypeError;

use function Pest\Laravel\json;

class Product extends Controller
{

    //[GET]
    //Gets all products.
    public function retrieveAll(Request $request)
    {
        try {
            $products = ProductModel::all();

            return response()->json(
                $products,
                200
            );
        } catch (TypeError $typeError) {

            return response()->json(
                "You have to filter by id, which is a number",
                400
            );
        } catch (Exception $exception) {

            return response()->json(
                "An unexpected error ocurred",
                400
            );
        }
    }


    //[GET]
    //Gets selected product.
    public function retrieve(Request $request, string $id)
    {
        try {

            if (!is_numeric($id)) {
                throw new TypeError();
            }


            $product = ProductModel::find($id);

            return response()->json(
                $product,
                200
            );
        } catch (TypeError $typeError) {

            return response()->json(
                "You have to filter by id, which has to be a number",
                400
            );
        } catch (Exception $exception) {

            return response()->json(
                "An unexpected error ocurred",
                400
            );
        }
    }


    //[POST]
    //Creates a new product
    public function create(Request $request)
    {


        try {
            $validated = $request->validate([
                "name" => ["required"],
                "description" => ["required"],
                "price" => ["required"],
                "photo" => ["required"],

            ]);

            $product = new ProductModel();
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');


            if ($request->file('photo')) {
                $photo = $request->file('photo');
                $name = $request->file('photo')->hashName();
                Storage::disk('public')->put('products/' . $name, file_get_contents($photo));
                $product->photo = $name;
            }


            $product->save();


            return response()->json(
                [
                    "message" => "A product has been created",
                    "product" => $product
                ],
                200
            );
        } catch (Exception $exception) {

            return response()->json(
                "An unexpected error ocurred",
                400
            );
        }
    }
}
