<?php

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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('login',[LoginController::class,'index'])->name('login');

Route::get('/', [LayoutController::class,'index'])->middleware('auth');
Route::get('/test', [LayoutController::class,'test'])->middleware('auth');
Route::get('/home', [LayoutController::class,'index'])->middleware('auth');

Route::controller(LoginController::class)->group(function() {
    Route::get('login','index')->name('login');
    Route::post('login/process', 'process');
    Route::get('logout','logout');
});


Route::group(['middleware' => ['auth']], function() {
    //ADMIN PRIVILEGES
    Route::group(['middleware' => ['checkUserLogin:R001']], function() {
        //User Account
        Route::get('adduseraccount', [UserController::class, 'create']);
        Route::post('createaccount', [UserController::class, 'store']);
        Route::get('createaccount', [UserController::class, 'store']);
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

        //Polyclinic
        Route::get('polyclinic', [PolyController::class, 'index']);
        Route::get('polyclinic', [PolyController::class, 'list']);
        Route::get('addpoly', [PolyController::class, 'create']);
        Route::post('createpoly', [PolyController::class, 'store']);
    });

    //RECEPTIONIST PRIVILEGES
    Route::group(['middleware' => ['checkUserLogin:R002']], function() {
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
        // Route::get('appointment', [AppointmentController::class, 'index']);
        Route::get('appointment', [AppointmentController::class, 'index']);
        Route::get('addappointment', [AppointmentController::class, 'create']);
        Route::post('addappointment', [AppointmentController::class, 'store']);
        Route::get('/patient/{id}/appointment',[AppointmentController::class, 'show']);
        Route::get('/patient/{id}/appointment/edit',[AppointmentController::class, 'edit']);
        Route::post('/updateappointment/{id}',[AppointmentController::class, 'update']);
        Route::get('/patient-app/{id}/delete',[AppointmentController::class, 'destroy']);
        //Physician
        Route::get('physician', [UserController::class, 'getPhysician']);
        Route::get('/physician/{id}', [UserController::class, 'showGetPhysician']);
        
    });

    //PHYSICIAN PRIVILEGES
    Route::group(['middleware' => ['checkUserLogin:R003']], function() {        //Appointment
        Route::get('/myAppointment', [AppointmentController::class, 'phyIndex']);
        Route::get('/myQueue', [AppointmentController::class, 'phyQueue']);
        //MedicalRecord
        Route::get('/myMedicalRecord', [MedicalRecordController::class, 'list']);
        Route::get('/myMedicalRecord/{patientid}/{medrec}', [PatientController::class, 'showMedrec']);
        Route::get('/addMedicalRecord/{id}', [MedicalRecordController::class, 'index']);
        Route::post('medicaldone/{id}', [MedicalRecordController::class, 'store']);
        Route::get('medicalSummary/{id}',[MedicalRecordController::class,'summary']);
        Route::get('cancel/{id}',[MedicalRecordController::class,'cancel']);
    });

    //PHARMACY PRIVILEGES
    Route::group(['middleware' => ['checkUserLogin:R004']], function() {
        //MedicineOrder
        Route::get('/medOrder', [MedicineController::class, 'getOrder']);
        Route::get('/medOrderID/{recID}', [MedicineController::class, 'showOrder']);
        Route::get('/medOrderID/{recID}/preparing', [MedicineController::class, 'preparingOrder']);
        Route::post('/medOrderID/{recID}/{orderID}/booked', [MedicineController::class, 'bookedItem']);
        Route::get('/medOrderID/{recID}/release', [MedicineController::class, 'releaseOrder']);
        //MedicineInstock
        Route::get('/medInstock', [MedicineController::class, 'getMedicines']);
        Route::post('/createMedicine', [MedicineController::class, 'storeMedicine']);
        Route::post('/medInstock/{medID}/update',[MedicineController::class, 'updateMedicine']);
        Route::get('/medInstock/{medID}/delete',[MedicineController::class, 'deleteMedicine']);
    });
    
    //FINANCE PRIVILEGES
    Route::group(['middleware' => ['checkUserLogin:R005']], function() {
        //MedicineOrder
        Route::get('/invoices', [InvoiceController::class, 'getTransaction']);
        Route::get('/createInvoice/{patient}/{medrec}', [InvoiceController::class, 'createInvoice']);
        Route::post('/invoices/{patient}/{medrec}/generate', [InvoiceController::class, 'generateInvoice']);
        Route::get('/showInvoice/{patient}/{medrec}/{invID}/generate', [InvoiceController::class, 'storeInvoice']);
        Route::get('/showInvoice/{patient}/{invID}/show', [InvoiceController::class, 'showInvoice']);
        Route::get('/mnginvoices', [InvoiceController::class, 'manageInvoice']);
        Route::get('/showInvoice/{patient}/{invID}/addPayment', [InvoiceController::class, 'addPayment']);
        Route::post('/showInvoice/{patient}/{invID}/store', [InvoiceController::class, 'storePayment']);
        //Payment Record
    });
});

