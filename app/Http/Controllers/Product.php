<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomNotFoundException;
use App\Models\Product as ProductModel;
use Exception;
use Illuminate\Http\Request;
use TypeError;

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
}
