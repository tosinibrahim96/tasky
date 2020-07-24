<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\PaymentRequestValidator;
use App\Http\Traits\ApiResponse;
use App\Payment;
use App\Project;

class PaymentController extends Controller
{

  use PaymentRequestValidator, ApiResponse;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Store a new payment record.
   * @param  \App\Project  $project_id
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $project_id)
  {

    $project = Project::find($project_id);
    if (!$project) {
      return $this->failureResponse(404, 'Project not found for payment update');
    }

    $validatedData = $this->validateCreatePayment($request);
    if (!$validatedData['status']) {
      $errors = $validatedData['data'];
      return $this->failureResponse(400, compact('errors'));
    }

    if ($request->amount_received > $project->amount_expected) {
      return $this->failureResponse(400, 'You can\'t receive more than project budget');
    }

    $payment = new Payment;

    $payment->updated_by = $request->updated_by;
    $payment->amount_received = $request->amount_received;
    $payment->project_id = $project_id;
    $payment->save();

    return $this->successResponseWithData($payment, 200, 'Project payment updated');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
