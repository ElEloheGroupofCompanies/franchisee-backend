<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\PurchaseOrderForm;
use App\Http\Resources\PurchaseOrderFormResource;



class PurchaseOrderFormController extends Controller
{
    function getPurchaseOrders(Request $request) {
        $purchaseOrders= PurchaseOrderForm::all()->paginate(10);
        return response()->json($purchaseOrderForms, 200, [], JSON_PRETTY_PRINT);
    }
    
    function getPurchaseOrderForms(Request $request) {
        $purchaseOrderForms = PurchaseOrderForm::where("user_id", auth()->user()->id)
            ->orderBy('date_purchased', 'desc') 
            ->paginate(5);
            
        return response()->json($purchaseOrderForms, 200, [], JSON_PRETTY_PRINT);
    }


    function getPurchaseOrderForm($id) {
        $purchaseOrderForm = PurchaseOrderForm::where("id", $id)->first();
        return response()->json($purchaseOrderForm, 200, [], JSON_PRETTY_PRINT);
    }


    function setPurchaseOrderForm(Request $request) {
        $fields = $request->validate([
            "date_purchased" => "required",
            "time_purchased" => "required",
            "ordered_by" => "required",
            "business_name" => "required",
            "outlet" => "required",
            "address" => "required",
            "fc_without_breading" => "nullable|in:Class A (Large),Class B (Medium),Class C (Small)",
            "fc_quantity" => "nullable|string",
            "with_spicy_flavor" => "nullable|in:Class A (Large),Class B (Medium),Class C (Small)",
            "with_spicy_flavor_quantity" => "nullable|string",
            "hot_and_spicy" => "nullable|in:Class A (Large),Class B (Medium),Class C (Small)",
            "hot_and_spicy_quantity" => "nullable|string",
            "malunggay" => "nullable|in:Class A (Large),Class B (Medium),Class C (Small)",
            "malunggay_quantity" => "nullable|string",
            "image" => "nullable|image",
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            $fields['image'] = $imagePath;
        }
    
        $purchaseOrderForm = PurchaseOrderForm::create([
            "date_purchased" => $fields["date_purchased"],
            "time_purchased" => $fields["time_purchased"],
            "ordered_by" => $fields["ordered_by"],
            "business_name" => $fields["business_name"],
            "outlet" => $fields["outlet"],
            "address" => $fields["address"],
            "fc_without_breading" => $fields["fc_without_breading"],
            "fc_quantity" => $fields["fc_quantity"],
            "with_spicy_flavor" => $fields["with_spicy_flavor"],
            "with_spicy_flavor_quantity" => $fields["with_spicy_flavor_quantity"],
            "hot_and_spicy" => $fields["hot_and_spicy"],
            "hot_and_spicy_quantity" => $fields["hot_and_spicy_quantity"],
            "malunggay" => $fields["malunggay"],
            "malunggay_quantity" => $fields["malunggay_quantity"],
            "image" => $fields["image"] ?? null,
            "user_id" => auth()->user()->id
        ]);
    
        return response()->json([
            "message" => "Purchase order has been ordered successfully",
            "data" => $purchaseOrderForm
        ], 201, [], JSON_PRETTY_PRINT);
    }
    
    function updatePurchaseOrderForm(Request $request, $id) {
        $purchaseOrderForm = PurchaseOrderForm::find($id);
    
        if (!$purchaseOrderForm) {
            return response()->json([
                "message" => "Purchase order not found"
            ], 404, [], JSON_PRETTY_PRINT);
        }
    
        $fields = $request->validate([
            "date_purchased" => "nullable|date",
            "time_purchased" => "nullable",
            "ordered_by" => "nullable",
            "business_name" => "nullable|string|max:255",
            "outlet" => "nullable|string|max:255",
            "address" => "nullable|string|max:255",
            "image" => "nullable|image",
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            $fields['image'] = $imagePath;
        }


        $purchaseOrderForm->date_purchased = $fields["date_purchased"]?? null;
        $purchaseOrderForm->time_purchased = $fields["time_purchased"]?? null;
        $purchaseOrderForm->ordered_by = $fields["ordered_by"]?? null;
        $purchaseOrderForm->business_name = $fields["business_name"]?? null;
        $purchaseOrderForm->outlet = $fields["outlet"]?? null;
        $purchaseOrderForm->address = $fields["address"]?? null;
        $purchaseOrderForm->image = $fields["image"];


        foreach ($fields as $key => $value) {
            if (isset($value)) {
                $purchaseOrderForm->$key = $value;
            }
        }
    
        $purchaseOrderForm->save();
    
        return response()->json([
            "message" => "Purchase order has been updated successfully",
            "data" => $purchaseOrderForm
        ], 200, [], JSON_PRETTY_PRINT);
    }


    function deletePurchaseOrderForm($id) {
        $purchaseOrderForm = PurchaseOrderForm::where("id", $id)->first();


        if (!$purchaseOrderForm) {
            return response()->json([
                "message" => "Purchase order not found"
            ], 404, [], JSON_PRETTY_PRINT);
        }


        $purchaseOrderForm->delete();


        return response()->json([
            "message" => "Purchase order has been deleted successfully"
        ], 200, [], JSON_PRETTY_PRINT);
    }
}


