<?php

namespace App\Http\Controllers;

use App\Mail\AssignmentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    public function index() {
        $asm_name = 'ออกแบบบ้าน';
        $asm_dueDate = '2020-04-04';
        $asm_dueTime = '11:59:00';
        Mail::to('kongmuang_j2@silpakorn.edu')
            ->send(new AssignmentMail($asm_name,$asm_dueDate,$asm_dueTime));
        return new AssignmentMail($asm_name,$asm_dueDate,$asm_dueTime);
    }
}
