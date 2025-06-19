<?php

namespace App\Http\Controllers\employee;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Stores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        if ($request->ajax()) {
            $coupons = Coupon::get();
            return response()->json($coupons);
        }
           // Get distinct store names only
           $couponstore = Coupon::with('user','store')->select('store_id')->distinct()->get();
           $selectedCoupon = $request->input('store_id');

           // Initialize query
           $productsQuery = Coupon::query();

           // Filter by selected store if any
           if ($selectedCoupon) {
               $productsQuery->where('store_id', $selectedCoupon);
           }

        $coupons = $productsQuery->with('store','user')->orderBy('store_id')
            ->orderByRaw('CAST(`order` AS SIGNED) ASC')
            ->orderBy('created_at', 'desc')
            ->limit(200)
            ->get();
            return view('employee.coupon.index', compact('coupons','couponstore','selectedCoupon'));
    }
    public function updateOrder(Request $request)
    {
        Log::info($request->order); // see what's coming in

        try {
            foreach ($request->order as $order) {
                $coupon = Coupon::find($order['id']);
                if ($coupon) {
                    $coupon->order = $order['position'];
                    $coupon->save();
                }
            }

            return response()->json(['status' => 'success', 'message' => 'Update Successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores = Stores::orderBy('created_at','desc')->get();

        return view('employee.coupon.create', compact('stores'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'code' => 'nullable|string|max:100',
            'ending_date' => 'nullable|date|after_or_equal:today',
            'status' => 'required|boolean',
            'authentication' => 'nullable|string',
            'authentication.*' => 'string',
            'store' => 'nullable|string|max:255',
            'top_coupons' => 'nullable|integer|min:0',

        ]);


        $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->description = $request->description;
        $coupon->code = $request->code;
        $coupon->store_id = $request->store_id;
        $coupon->ending_date = $request->ending_date;
        $coupon->status = $request->status;
        $coupon->top_coupons = $request->top_coupons;
        $coupon->authentication = $request->authentication;
        $coupon->user_id = Auth::id();
        $coupon->save();

        return redirect()->back()->withInput()->with('success', 'Coupon created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
            //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        $stores = Stores::orderBy('created_at','desc')->get();
        return view('employee.coupon.edit', compact('coupon', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'code' => 'nullable|string|max:100',
            'ending_date' => 'required|date|after_or_equal:today',
            'status' => 'required|boolean',
            'authentication' => 'nullable|string',
            'authentication.*' => 'nullable|string',
            'store_id' => 'nullable|exists:stores,id', // Added validation for store_id
        ]);

        try {
            // Update coupon fields
            $coupon->name = $request->name;
            $coupon->description = $request->description;
            $coupon->code = $request->code;
            $coupon->store_id = $request->store_id ?? $coupon->store_id;
            $coupon->ending_date = $request->ending_date;
            $coupon->status = $request->status;
            $coupon->top_coupons = $request->top_coupons;
            $coupon->authentication = $request->authentication;
            $coupon->save();

            // Get the store (either from updated store_id or existing)
            $store = Stores::find($coupon->store_id);

            if (!$store) {
                throw new \Exception('Associated store not found');
            }

            $couponName = $validated['name'] ?? 'Coupon';
            return redirect()->route('employee.store.show', ['slug' => Str::slug($store->slug)])
                ->with('success', "$couponName updated successfully");

        } catch (\Exception $e) {
            return redirect()->back()->withInput()
            ->with('error', 'Failed to update coupon: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
    $coupon->delete();

    return redirect()->back()->with('success', 'Coupon deleted successfully.');
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids) {
            Coupon::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', 'Coupons deleted successfully.');
            // return response()->json(['status' => 'success', 'message' => 'Coupons deleted successfully.']);
        }
       return redirect()->back()->with('error', 'No coupons selected for deletion.');
    }
    public function getStoreCoupons(Request $request)
    {
        $storeId = $request->input('store_id');
        $coupons = Coupon::where('store_id', $storeId)->get();
        return response()->json($coupons);
    }
}
