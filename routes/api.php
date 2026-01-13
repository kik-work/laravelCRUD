<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartphoneController;
use App\Models\Smartphone;

Route::prefix('smartphones')->group(function () {

    // API Resource
    Route::apiResource('', SmartphoneController::class);

    // Soft delete a smartphone
    Route::delete('/soft-delete/{id}', function ($id) {
        $phone = Smartphone::find($id);
        if ($phone) {
            $phone->delete();
            return response()->json(["message" => "Smartphone $id soft deleted"]);
        }
        return response()->json(["message" => "Smartphone $id not found"], 404);
    });

    // Restore a soft deleted smartphone
    Route::patch('/restore/{id}', function ($id) {
        $phone = Smartphone::withTrashed()->find($id);
        if ($phone) {
            $phone->restore();
            return response()->json(["message" => "Smartphone $id restored"]);
        }
        return response()->json(["message" => "Smartphone $id not found"], 404);
    });
    Route::get('/check-deleted', function () {
        return Smartphone::withTrashed()->get();
    });
});




Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::patch('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::get('/users/{user}/orders/{order}', function ($user, $order) {
    return response()->json(compact('user', 'order'));
});
Route::get('/greet/{name?}', function ($name = 'kakon') {
    return response()->json([
        'message' => "Hello $name"
    ]);
});
Route::get('/orders/{id}', function ($id) {
    return $id;
})->whereNumber('id');

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/users', function () {
            return 'Admin users';
        })->name('users.index');

        Route::get('/kik', function () {
            return 'khairul islam kakon';
        })->name('kik.index');

        Route::delete('/users/{id}', function ($id) {
            return "Deleted user $id";
        })->name('users.delete');
    });
Route::get('/test-route-name', function () {
    return route('admin.users.index');
});


Route::post ('/signup', [SignupController::class, 'register']);