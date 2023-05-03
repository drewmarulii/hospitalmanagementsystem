<?php

use Dompdf\Dompdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PolyController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TreatmentItemController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\InvoiceItemController;
use App\Http\Controllers\ExportPDF;

Route::get('/', [LayoutController::class,'index'])->middleware('auth');
Route::get('/test', [LayoutController::class,'test'])->middleware('auth');
Route::get('/home', [LayoutController::class,'index'])->middleware('auth');

Route::controller(LoginController::class)->group(function() {
    Route::get('login','index')->name('login');
    Route::post('login', 'process');
    Route::get('logout','logout');
});

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::group(['middleware' => ['auth']], function() {
    Route::get('/myprofile', [UserController::class, 'myProfile']);
    Route::get('/myprofile/{userid}/changepassword', [UserController::class, 'changePassword']);
    Route::post('/myprofile/{userid}/changepassword', [UserController::class, 'updateNewPassword']);

    Route::group(['middleware' => ['checkUserLogin:R001']], function() {
        Route::get('/admin', [DashboardController::class, 'adminIndex']);
        //User Account
        Route::get('createaccount', [UserController::class, 'create']);
        Route::post('createaccount', [UserController::class, 'store']);
        Route::get('useraccount', [UserController::class, 'list']);
        Route::get('useraccount', [UserController::class, 'list']);
        Route::get('/user/{id}',[UserController::class, 'show']);
        Route::get('/user/{id}/edit',[UserController::class, 'edit']);
        Route::post('/updateuser/{id}',[UserController::class, 'update']);
        Route::get('/user/{id}/delete',[UserController::class, 'destroy']);

        //Role
        Route::get('role', [RoleController::class, 'index']);
        Route::get('role', [RoleController::class, 'list']);
        Route::get('addrole', [RoleController::class, 'create']);
        Route::post('createroles', [RoleController::class, 'store']);
        Route::post('/editrole/{roleID}', [RoleController::class, 'edit']);

        //Polyclinic
        Route::get('polyclinic', [PolyController::class, 'index']);
        Route::get('polyclinic', [PolyController::class, 'list']);
        Route::get('addpoly', [PolyController::class, 'create']);
        Route::post('createpoly', [PolyController::class, 'store']);
        Route::post('/editclinic/{polyID}', [PolyController::class, 'edit']);
    });
    Route::group(['middleware' => ['checkUserLogin:R002']], function() {
        Route::get('/receptionist', [DashboardController::class, 'receptionistIndex']);
        //Patient
        Route::get('patient', [PatientController::class, 'index']);
        Route::get('patient', [PatientController::class, 'list']);
        Route::get('addpatient', [PatientController::class, 'create']);
        Route::post('createform', [PatientController::class, 'store']);
        Route::get('/patient/{id}',[PatientController::class, 'show']);
        Route::get('/patient/{id}/edit',[PatientController::class, 'edit']);
        Route::post('/updatepatient/{id}',[PatientController::class, 'update']);
        Route::get('/patient/{id}/delete',[PatientController::class, 'destroy']);
        Route::get('/sendpatient/{id}', [PatientController::class, 'send']);
        Route::get('/patient/{patient}/medicalRecord/{medrec}', [PatientController::class, 'showMedrec']);
        //Appointment
        Route::get('appointment', [AppointmentController::class, 'index']);
        Route::get('addappointment', [AppointmentController::class, 'create']);
        Route::post('addappointment', [AppointmentController::class, 'store']);
            Route::get('getPhysician/{id}', function ($id) {
                $course = App\Models\User::where('polyid',$id)->get();
                return response()->json($course);
            });
        Route::get('appointment/{appID}/summary', [AppointmentController::class, 'appointmentCreated']);
        Route::get('sendpatient/{appID}/appointment', [AppointmentController::class, 'sendEmailToPatient']);
        Route::get('/patient/{id}/appointment',[AppointmentController::class, 'show']);
        Route::get('/patient/{id}/appointment/edit',[AppointmentController::class, 'edit']);
        Route::post('/updateappointment/{id}',[AppointmentController::class, 'update']);
        Route::get('/patient-app/{id}/delete',[AppointmentController::class, 'destroy']);
        //Physician
        Route::get('physician', [UserController::class, 'getPhysician']);
        Route::get('/physician/{id}', [UserController::class, 'showGetPhysician']);    
        
    });
    Route::group(['middleware' => ['checkUserLogin:R003']], function() {        
        Route::get('/doctor', [DashboardController::class, 'doctorIndex']);
        //Appointment
        Route::get('/myAppointment', [AppointmentController::class, 'phyIndex']);
        Route::get('/myQueue', [AppointmentController::class, 'phyQueue']);
        Route::get('getInstock/{id}', function ($id) {
            $course = App\Models\Medicine::where('MEDICINE_ID',$id)->first();
            return response()->json($course);
            });
        //MedicalRecord
        Route::get('/myMedicalRecord', [MedicalRecordController::class, 'list']);
        Route::get('/myMedicalRecord/{patientid}/{medrec}', [PatientController::class, 'showMedrec']);
        Route::get('/addMedicalRecord/{id}', [MedicalRecordController::class, 'index']);
        Route::post('medicaldone/{id}', [MedicalRecordController::class, 'store']);
        Route::get('medicalSummary/{id}',[MedicalRecordController::class,'summary']);
        Route::get('cancel/{id}',[MedicalRecordController::class,'cancel']);
    });
    Route::group(['middleware' => ['checkUserLogin:R004']], function() {
        Route::get('/pharmacy', [DashboardController::class, 'pharmacyIndex']);
        //MedicineOrder
        Route::get('/medOrder', [MedicineController::class, 'getOrder']);
        Route::get('/medOrderID/{recID}', [MedicineController::class, 'showOrder']);
        Route::get('/medOrderID/{recID}/preparing', [MedicineController::class, 'preparingOrder']);
        Route::post('/medOrderID/{recID}/{orderID}/booked', [MedicineController::class, 'bookedItem']);
        Route::get('/medOrderID/{recID}/release', [MedicineController::class, 'releaseOrder']);
        Route::get('/medOrderID/{recID}/ready', [MedicineController::class, 'medicineReady']);
        //MedicineInstock
        Route::get('/medInstock', [MedicineController::class, 'getMedicines']);
        Route::post('/createMedicine', [MedicineController::class, 'storeMedicine']);
        Route::post('/medInstock/{medID}/update',[MedicineController::class, 'updateMedicine']);
        Route::get('/medInstock/{medID}/delete',[MedicineController::class, 'deleteMedicine']);
        Route::get('/medInstock/{medID}/setActive',[MedicineController::class, 'setActive']);
    });
    Route::group(['middleware' => ['checkUserLogin:R005']], function() {
        Route::get('/finance', [DashboardController::class, 'financeIndex']);
        //MedicineOrder
        Route::get('/invoices', [InvoiceController::class, 'getTransaction']);
        Route::get('/createInvoice/{patient}/{medrec}', [InvoiceController::class, 'createInvoice']);
        Route::post('/invoices/{patient}/{medrec}/generate', [InvoiceController::class, 'generateInvoice']);
        Route::get('/showInvoice/{patient}/{medrec}/{invID}/generate', [InvoiceController::class, 'storeInvoice']);
        Route::get('/showInvoice/{patient}/{invID}/show', [InvoiceController::class, 'showInvoice']);
        Route::get('/mnginvoices', [InvoiceController::class, 'manageInvoice']);
        //Payment Record
        Route::get('/showInvoice/{patient}/{invID}/addPayment', [InvoiceController::class, 'addPayment']);
        Route::post('/showInvoice/{patient}/{invID}/paid', [InvoiceController::class, 'storePayment']);
        Route::post('/payment/{paymentID}/update', [InvoiceController::class, 'updatePayment']);
        //Treatment Item
        Route::get('/treatmentitem', [TreatmentItemController::class, 'index']);
        Route::post('/treatmentitem', [TreatmentItemController::class, 'store']);
        Route::post('/treatmentitem/{treatID}/update', [TreatmentItemController::class, 'update']);
        Route::get('/treatmentitem/{treatID}/inactivate', [TreatmentItemController::class, 'setInactive']);
        Route::get('/treatmentitem/{treatID}/setActive', [TreatmentItemController::class, 'setActive']);
        //InvoiceItem
        Route::get('/invoiceitem', [InvoiceItemController::class, 'index']);
        Route::post('/invoiceitem', [InvoiceItemController::class, 'store']);
        Route::post('/invoiceitem/{itemID}/update', [InvoiceItemController::class, 'update']);
        Route::get('/invoiceitem/{itemID}/inactivate', [InvoiceItemController::class, 'setInactive']);
        Route::get('/invoiceitem/{itemID}/setActive', [InvoiceItemController::class, 'setActive']);
    });

    //Export Medical Record
    Route::get('/MedicalRecord/{id}/PDF', [ExportPDF::class, 'medicalRecord']);
    //Export Medicine Prescription
    Route::get('MedicinePrescription/{id}/PDF', [ExportPDF::class, 'medicinePrescription']);
    //Export Invoice
    Route::get('Invoice/{id}/PDF', [ExportPDF::class, 'invoiceRecord']);
    //Export Receipt
    Route::get('Payment/{id}/PDF', [ExportPDF::class, 'paymentRecord']);
    //Export Appointment
    Route::get('Appointment/{id}/PDF', [ExportPDF::class, 'appointmentRecord']);
});

