<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employees;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TelephoneBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = 
        DB::select('SELECT u.empid, u.name,e.deptId, d.name AS Dept,e.sectnId,s.name AS Sectn, job, 
        CASE WHEN u.mobile THEN u.mobile WHEN u.mobile IS Null THEN "غير مسجل" END AS "Mobile", extn,u.avatar,active,u.email
        FROM empdept e INNER JOIN users u ON e.empId=u.empid INNER JOIN departments d ON e.deptId = d.id 
        INNER JOIN sections s ON e.sectnId = s.id Where active = 1 ORDER BY u.empid ');
        
        $departments = Department::get()->pluck('name', 'id');
        return view('TelephoneBook.books',compact('employees','departments'));
    }

    public function searchEmp(Request $request)
    {
        $item = $request->searchItem;
        $employees = DB::select('SELECT u.empid, u.name,e.deptId, d.name AS Dept,e.sectnId,s.name AS Sectn, job, 
        CASE WHEN u.mobile THEN u.mobile WHEN u.mobile IS Null THEN "غير مسجل" END AS "Mobile", extn,u.avatar,active,u.email
        FROM empdept e INNER JOIN users u ON e.empId=u.empid INNER JOIN departments d ON e.deptId = d.id 
        INNER JOIN sections s ON e.sectnId = s.id Where active = 1 ORDER BY u.empid ');

        /* الرقم الوظيفي */
        $employees0 = DB::select('SELECT u.empid, u.name,e.deptId, d.name AS Dept,e.sectnId,s.name AS Sectn, job, 
        CASE WHEN u.mobile THEN u.mobile WHEN u.mobile IS Null THEN "غير مسجل" END AS "Mobile", extn,u.avatar,active,u.email
        FROM empdept e INNER JOIN users u ON e.empId=u.empid INNER JOIN departments d ON e.deptId = d.id 
        INNER JOIN sections s ON e.sectnId = s.id WHERE active = 1 and u.empid = ? ORDER BY u.empid',[$item]);

        /* الادارة */
        $employees1 = DB::select('SELECT u.empid, u.name,e.deptId, d.name AS Dept,e.sectnId,s.name AS Sectn, job, 
        CASE WHEN u.mobile THEN u.mobile WHEN u.mobile IS Null THEN "غير مسجل" END AS "Mobile", extn,u.avatar,active,u.email
        FROM empdept e INNER JOIN users u ON e.empId=u.empid INNER JOIN departments d ON e.deptId = d.id 
        INNER JOIN sections s ON e.sectnId = s.id WHERE active = 1 and  d.name like ? ORDER BY u.empid',['%'.$item.'%']);

        /* القسم */
        $employees2 = DB::select('SELECT u.empid, u.name,e.deptId, d.name AS Dept,e.sectnId,s.name AS Sectn, job, 
        CASE WHEN u.mobile THEN u.mobile WHEN u.mobile IS Null THEN "غير مسجل" END AS "Mobile", extn,u.avatar,active,u.email
        FROM empdept e INNER JOIN users u ON e.empId=u.empid INNER JOIN departments d ON e.deptId = d.id 
        INNER JOIN sections s ON e.sectnId = s.id WHERE active = 1 and  s.name like ? ORDER BY u.empid',['%'.$item.'%']);

        /* الاسم */
        $employees3 = DB::select('SELECT u.empid, u.name,e.deptId, d.name AS Dept,e.sectnId,s.name AS Sectn, job, 
        CASE WHEN u.mobile THEN u.mobile WHEN u.mobile IS Null THEN "غير مسجل" END AS "Mobile", extn,u.avatar,active,u.email
        FROM empdept e INNER JOIN users u ON e.empId=u.empid INNER JOIN departments d ON e.deptId = d.id 
        INNER JOIN sections s ON e.sectnId = s.id WHERE active = 1 and  u.name like ? ORDER BY u.empid',['%'.$item.'%']);
        /* التحويلة */
        $employees4 = DB::select('SELECT u.empid, u.name,e.deptId, d.name AS Dept,e.sectnId,s.name AS Sectn, job, 
        CASE WHEN u.mobile THEN u.mobile WHEN u.mobile IS Null THEN "غير مسجل" END AS "Mobile", extn,u.avatar,active,u.email
        FROM empdept e INNER JOIN users u ON e.empId=u.empid INNER JOIN departments d ON e.deptId = d.id 
        INNER JOIN sections s ON e.sectnId = s.id WHERE active = 1 and  extn like ? ORDER BY u.empid',['%'.$item.'%']);
        

        if ($employees0) {
            $employees = $employees0;
            return view('TelephoneBook.books',compact('employees'));
        }elseif ($employees1) {
            $employees = $employees1;
            return view('TelephoneBook.books',compact('employees'));
        }elseif ($employees2) {
            $employees = $employees2;
            return view('TelephoneBook.books',compact('employees'));
        }elseif ($employees3) {
            $employees = $employees3;
            return view('TelephoneBook.books',compact('employees'));
        }elseif ($employees4) {
            $employees = $employees4;
            return view('TelephoneBook.books',compact('employees'));
        }else{
            return view('TelephoneBook.books',compact('employees'));
        }

        
        /* return $request->searchItem; */
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('empid')->get();
        $departments = Department::get()->pluck('name', 'id');
        
        $employees = DB::select('SELECT 
        u.empid, u.name,e.dept_id, d.name AS Dept,e.section_id,s.name AS Sectn,  job,
        CASE WHEN u.mobile THEN u.mobile WHEN u.mobile IS Null THEN "غير مسجل" END AS "Mobile",
        extn,u.avatar,active,u.email
        FROM employees e INNER JOIN users u ON e.emp_id=u.empid
        INNER JOIN departments d ON e.dept_id = d.id INNER JOIN sections s ON e.section_id = s.id');
        
        return view('TelephoneBook.index',compact('users','departments','employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section =  $request->section_id ? $request->section_id : 0;
        return $request;
        /* Employees::create([
            'emp_id' =>$request->empid,
            'name' =>$request->emp_name,
            'dept_id' =>$request->department_id,
            'section_id' => $section,
            'job'=> $request->job,
            'tel' => $request->mobile,
            'extn' => $request->extn,
            'active' =>$request->active
        ]); */
        return back();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
