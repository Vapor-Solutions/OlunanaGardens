<?php

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/callback/mpesa', function () {

    Log::info('mpesa callback hit');

    $data = file_get_contents('php://input');
    $data = json_decode($data, true);

    Log::info("data", [$data]);

    # Extract data from the decoded JSON
    $MerchantRequestID = $data['Body']['stkCallback']['MerchantRequestID'];
    $CheckoutRequestID = $data['Body']['stkCallback']['CheckoutRequestID'];
    $ResultCode = $data['Body']['stkCallback']['ResultCode'];
    $ResponseDescription = $data['Body']['stkCallback']['ResultDesc'];
    $callbackMetadata = $data['Body']['stkCallback']['CallbackMetadata']['Item'];
    $amount = null;
    $mpesaReceiptNumber = null;
    $transactionDate = null;
    $phoneNumber = null;
    $balance = null;

    # Loop through callback metadata to extract necessary fields
    foreach ($callbackMetadata as $item) {
        switch ($item['Name']) {
            case 'Amount':
                $amount = $item['Value'];
                break;
            case 'MpesaReceiptNumber':
                $mpesaReceiptNumber = $item['Value'];
                break;
            case 'TransactionDate':
                $transactionDate = $item['Value'];
                break;
            case 'PhoneNumber':
                $phoneNumber = $item['Value'];
                break;
            case 'Balance':
                $balance = $item['Value'];
                break;
        }
    }

    # get the transaction from db
    $updatePayment = Payment::where('MerchantRequestID', $CheckoutRequestID)->first();


    # Check if the transaction was successful
    if ($ResultCode == 0) {
        # update transaction response to db status as success
        $updatePayment->update([
            'MerchantRequestID' => $MerchantRequestID,
            'CheckoutRequestID' =>  $CheckoutRequestID,
            'status' => 'success',
            'resultDesc' => $ResponseDescription,
            'phoneNumber' => $phoneNumber,
            'transactionDate' => $transactionDate,
            'amount' => $amount,
            'reference_code' => $mpesaReceiptNumber,
        ]);
    } else {
        # update transaction response to db status as failed

        $updatePayment->update([
            'MerchantRequestID' => $MerchantRequestID,
            'CheckoutRequestID' =>  $CheckoutRequestID,
            'status' => 'failed',
            'resultDesc' => $ResponseDescription,
            'phoneNumber' => $phoneNumber,
            'transactionDate' => $transactionDate,
            'amount' => $amount,
            'reference_code' => $mpesaReceiptNumber,
        ]);
    }

    # other logic
});
