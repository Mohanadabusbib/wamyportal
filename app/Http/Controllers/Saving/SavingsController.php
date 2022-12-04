<?php

namespace App\Http\Controllers\Saving;

use App\Models\Saving\Savings;
use App\Models\User;
use App\Models\Saving\Savingsbkp;
use App\Models\Nomination;
use App\Models\Vote;
use App\Models\votes2;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\TransferData\empdata;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RegisterBox;
use Ramsey\Uuid\Type\Decimal;
use PDF;

class SavingsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $savings;
    protected $user;
    protected $nomination;
    protected $vote;
    protected $votes2;

    public function __construct(Savings $savings, User $user,Nomination $nomination,Vote $vote,votes2 $votes2)
    {
        $this->savings = $savings;
        $this->user = $user;
        $this->nomination = $nomination;
        $this->vote = $vote;
        $this->votes2 = $votes2;
        
    }

    public function index()
    {
        if (Auth()->user()->empid === 11829) {
            $empid = Auth()->user()->empid;
            /* $empid = 11964 */;
            $savings = $this->savings::whereEmpid($empid)->get();
            $result = count($savings);
            if (count($savings) == 1) {                
                $data = empdata::where('emp_no',$empid)->get();
                return view('savings.regform', compact('savings','data'));
            } else {
                
                return view('savings.index', compact('result'));
            }
        } else {
            $savings = $this->savings::whereEmpid(Auth()->user()->empid)->get();
            $result = count($savings);
            if (count($savings) == 1) {
                $empid = Auth()->user()->empid;
                $data = empdata::where('emp_no',$empid)->get();
                return view('savings.regform', compact('savings','data'));
            } else {
                
                return view('savings.index', compact('result'));
            }
        }
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            if (Auth()->user()->empid === 11829) {
                $empid = Auth()->user()->empid; 
                /* $empid = 11976; */
                $data = empdata::where('emp_no',$empid)->get();
                $savings = $this->savings::whereEmpid($empid)->get();
                /* return $savings; */
                return view('savings.regform', compact('data','savings'));
            } else {
                $empid = Auth()->user()->empid; 
                $data = empdata::where('emp_no',$empid)->get();
                $savings = $this->savings::whereEmpid($empid)->get();
                return view('savings.regform', compact('data','savings'));
            }
           
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
    /* public function newCreate()
    {
        try
        {
            $empid = Auth()->user()->empid;
            $data = empdata::where('emp_no',$empid)->get();
            
            return view('savings.newRegform', compact('data'));
        } 
        catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    } */
    public function getDownload($filename)
    {
        $file = public_path() . "/assets/download/" . $filename;
        return response()->download($file);
    }

    public function open_file($filename)
    {
        $file = public_path() . "/assets/download/" . $filename;
        return response()->file($file);
    }

    public function open_cv($filename)
    {
        $file = public_path() . "/storage/CV/" . $filename;
        return response()->file($file);
    }
    

    public function openreports()
    {
        /* $data = empdata::where('emp_no',)->get(); */
        $data = empdata::all();
        /* $savings = $this->savings->orderBy('empid', 'asc')->get(); */
        $savings = DB::select('SELECT s.id,empid,name,salary,newpremium,previouspremium,s.updated_at,contribute,d.total_sal FROM savings s JOIN empdatas d ON s.empid = d.emp_no ');
        /* return $savings; */
        return view('savings.report',compact('savings'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'signature' => 'mimes:jpeg,png,jpg',
        ], [
            'signature.mimes' => 'صيغة المرفق يجب ان تكون    jpeg , png , jpg',
        ]);
        
        if ($request->hasFile('signature')) {
            $filename = time() . '-' . $request->signature->getClientOriginalName();
            $request->signature->storeAs('Signature', $filename, 'public');
            $this->savings::create([
                'empid' => Auth()->user()->empid,
                'name' => $request->name,
                'participationType' => $request->participationType,
                'datePremium' => $request->datePremium,
                'newpremium' => $request->newpremium,
                'contribute' => $request->contribute,
                'salary' => $request->salary,
                'dateOfAppointment' => $request->dateOfAppointment,
                'signature' => $filename,
                'agree' => 1
            ]);
        } else {
            $this->savings::create([
                'empid' => Auth()->user()->empid,
                'name' => $request->name,
                'participationType' => $request->participationType,
                'datePremium' => $request->datePremium,
                'newpremium' => $request->newpremium,
                'contribute' => $request->contribute,
                'salary' => $request->salary,
                'dateOfAppointment' => $request->dateOfAppointment,
                'signature' => "defualt.png",
                'agree' => 1
            ]);
            
        }
        $user = $this->user::whereIn ('empid',['11829','11547'])->get();
        $savings = $this->savings::latest()->first();
        Notification::send($user, new RegisterBox($savings));
        Alert::success('حفظ البيانات', 'تم حفظ البيانات بنجاح');
        return redirect('savings/' . auth()->user()->empid);
    }

    public function update(Request $request, $empid)
    {
        try {
                $this->validate($request, [
                    'signature' => 'mimes:jpeg,png,jpg',
                    
                ], [
                    'signature.mimes' => 'صيغة المرفق يجب ان تكون    jpeg , png , jpg',
                    
            ]);
            if ($request->contributeselect == 2) {
                if ($request->contribute > 4999) {
                    $contribute = $request->contribute;    
                }else{
                    Alert::error('خطأ', 'عفوا لا يمكن المساهمة بهذا المبلغ');
                    return back();
                }
                
            } else {
                $contribute = null;
                
            }
            $previouspremium = $this->savings::where('empid', $empid)->pluck('newpremium');
            /* return $previouspremium[0]; */
            
            
            if ($request->hasFile('signature')) {
                $filename = time() . '-' . $request->signature->getClientOriginalName();
                $request->signature->storeAs('Signature', $filename, 'public');
                
                $this->savings::where('empid', $empid)->update([
                    'newpremium' => $request->newpremium,
                    'previouspremium' => $previouspremium[0],
                    'contribute' => $contribute,
                    'signature' => $filename,
                ]);
            } else {
                $this->savings::where('empid', $empid)->update([
                    'newpremium' => $request->newpremium,
                    'previouspremium' => $previouspremium[0],
                    'contribute' => $contribute,
                ]);
                
            }       
                $user = $this->user::whereIn ('empid',['11829','11547'])->get();
                $savings = $this->savings::latest()->first();
                Notification ::send($user, new RegisterBox($savings));

                Alert::success('حفظ البيانات', 'تم تعديل البيانات بنجاح');
                return redirect('savings/' . $empid);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Savings  $savings
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $savings = $this->savings::where('empid', $id)->get();
            $file = $this->savings::where('empid', $id)->pluck('file');
            $user = User::where('empid', $id)->get();
            foreach ($savings as $value) {
                if (isset($value->file)) {
                    $file = public_path() . "/storage/Contracts/" . $value->file;
                    return response()->file($file);
                } else {
                    return view('savings.contract', compact('savings', 'user'));
                }
            }
    }
    public function showAll()
    {
            
        $savings = $this->savings::all();
        $user = User::all();
        return view('savings.contractAll', compact('savings', 'user',));

        
        // share data to view
        /* view()->share('savings',$savings);
        $pdf = PDF::loadView('savings.contractAll',$savings);

        // download PDF file with download method
        return $pdf->download('pdf_file.pdf'); */
            
    }
    public function getContract()
    {
        
    }
    public function nomination()
    {
        $empid = Auth()->user()->empid;
        $savings = $this->savings::where('empid',$empid)->first();
        $nomination = $this->nomination::where('empid',$empid)->first();
        $data = empdata::where('emp_no',$empid)->get();/*  Http::post("http://127.0.0.1:8000/api-v01/Get-Employees/$empid")->json(); */
        $avatar = User::where('empid',$empid)->pluck('avatar')->first();
        if($savings){
            return view('savings.nominationbox', compact('data','nomination','avatar'));
        }else{
            Alert::error('خطأ', 'عفواً الترشح للمشتركين في الصندوق فقط ');
            return redirect('home');
        }
        
    }
    public function storenomination(Request $request)
    {
        
        $this->validate($request, [

            'file' => 'mimes:pdf',
            'candidateposition' => 'required'

        ], [
            'file.mimes' => 'صيغة المرفق يجب ان تكون    pdf',
            'candidateposition.required' => 'لابد من إختيار منصب الترشح'
        ]);
        if ($request->candidateposition == 0) {
            Alert::error('خطأ', 'لابد من إختيار منصب الترشح');
            return back();
        } else {
            if ($request->hasFile('file')) {
                $filename = time() . '-' . $request->file->getClientOriginalName();
                $request->file->storeAs('CV', $filename, 'public');
                $this->nomination::create([
                    'empid' => Auth()->user()->empid,
                    'name' => $request->name,
                    'mobile' => $request->mobile,
                    'avatar' => $request->avatar,
                    'dept' => $request->dept,
                    'sectn' => $request->sectn,
                    'job' => $request->job,
                    'qualification' => $request->qualification,
                    'candidateposition' => $request->candidateposition,
                    'file' =>$filename
                ]);
                Alert::success('حفظ البيانات', 'تم حفظ البيانات بنجاح');
            } else {
                $this->nomination::create([
                    'empid' => Auth()->user()->empid,
                    'name' => $request->name,
                    'mobile' => $request->mobile,
                    'avatar' => $request->avatar,
                    'dept' => $request->dept,
                    'sectn' => $request->sectn,
                    'job' => $request->job,
                    'qualification' => $request->qualification,
                    'candidateposition' => $request->candidateposition,
                ]);
                Alert::success('حفظ البيانات', 'تم حفظ البيانات بنجاح');
            }
        }
        return redirect('home');
    }

    public function displaynomination()
    {
        $nomination = $this->nomination::all();
        /* return $nomination; */
        return view('savings.displaynominations', compact('nomination'));
    }
    public function edit($savings)
    {
        $voter = DB::select('SELECT DISTINCT v.empid,u.name,v.approval FROM votes AS v LEFT JOIN users AS u ON v.empid = u.empid ORDER BY 1 ');
        /* return count($voter); */
        $voter2 = DB::select('SELECT DISTINCT v.empid,u.name,v.approval FROM votes2s AS v LEFT JOIN users AS u ON v.empid = u.empid ORDER BY 1 ');
        return view('savings.approval',compact('voter','voter2'));
    }
    public function approvalvote(Request $request)
    {  
        
        $cont = count($request->aproval);
        for ($i=0; $i < $cont; $i++) {  
            $this->vote::where('empid', $request->aproval[$i])->update([
                'approval' => 1,
            ]);
        } 
        Alert::success("إعتماد التصويت", "تم الإعتماد بنجاح");
        return back();         
    }
    public function approvalvote2(Request $request)
    {  
        $cont = count($request->aproval);
        for ($i=0; $i < $cont; $i++) {  
            $this->votes2::where('empid', $request->aproval[$i])->update([
                'approval' => 1,
            ]);
        } 
        Alert::success("إعتماد التصويت", "تم الإعتماد بنجاح");
        return back();         
    }

    public function resualt()
    {
        $countsaving = $this->savings::count();
        $countvote = DB::select('SELECT COUNT(DISTINCT empid) As votes FROM `votes`');
        $test = DB::select('SELECT `candidatePerson`,u.name,`candidatePosition`, COUNT(`candidatePerson`) AS vote
        FROM votes AS v LEFT JOIN users AS u ON v.candidatePerson = u.empid where v.approval = 1  GROUP BY u.name,`candidatePerson`,`candidatePosition`
        ORDER BY 4 desc');

        $test2 = DB::select('SELECT `candidatePerson`,u.name,`candidatePosition`, COUNT(`candidatePerson`) AS vote
        FROM votes2s AS v LEFT JOIN users AS u ON v.candidatePerson = u.empid where v.approval = 1 GROUP BY u.name,`candidatePerson`,`candidatePosition`
        ORDER BY 4 desc');

        $countNewvoter = $this->votes2::where('approval',1)->count();

        $totleote = DB::select('SELECT candidatePosition, COUNT(candidatePerson) AS vote
        FROM votes AS v LEFT JOIN users AS u ON v.candidatePerson = u.empid where v.approval =1 GROUP BY candidatePosition ORDER BY 2');

        $approval =DB::select('SELECT `candidatePerson`,u.name,`candidatePosition`, COUNT(`candidatePerson`) AS vote
        FROM votes AS v LEFT JOIN users AS u ON v.candidatePerson = u.empid where v.approval =1 GROUP BY u.name,`candidatePerson`,`candidatePosition`
        ORDER BY 4 desc');
        return view('savings.resualt',compact('test','approval','test2','countNewvoter','countsaving','countvote','totleote'));    
    }
    public function vote()
    {
        $votes = $this->vote::where(['empid'=> auth()->user()->empid])->get();
        $votes2 = $this->votes2::where(['empid'=> auth()->user()->empid])->get();
        $vote1 = $this->vote::where(['empid'=> auth()->user()->empid,'candidateposition'=>1])->get();
        $vote2 = $this->vote::where(['empid'=> auth()->user()->empid,'candidateposition'=>2])->get();
        $vote3 = $this->vote::where(['empid'=> auth()->user()->empid,'candidateposition'=>3])->get();
        $vote4 = $this->vote::where(['empid'=> auth()->user()->empid,'candidateposition'=>4])->get();
        /* ->where('candidatePerson','') */
        /* $v1 =   $this->nomination::where('candidateposition',1)->get(); */
        $v1 =   $this->user::where('empid',11373)->get();
        $v2 =   $this->nomination::where('candidateposition',2)->get();
        $v3 =   $this->nomination::where('candidateposition',3)->get();

        $v4 =   $this->nomination::whereIn('empid',[11383,11547])->get();
        

        $user = $this->savings::where('empid',auth()->user()->empid)->get();
        $userNo = $this->user::whereIN('empid',[11002,11768,11935,11829])->pluck('empid')->all();
      /*   foreach ($userNo as $value) {
            $value->empid;
        } */
        if ($userNo === auth()->user()->empid) {
            return back();
        } else {
            if (count($user)) {
                return view('savings.test',compact('v1','v2','v3','v4','vote1','vote2','vote3','vote4','votes','votes2'));    
            } else {
                Alert::error("خطأ", "عفواً لا يحق التصويت الا للمشتركين بالصندوق");
                return back();
            }
        }
        
        
        
        
        /* return count($vote4); */
        
    }
    public function savevote(Request $request)
    {
        /* return $request->all(); */
        /* vote 2 */
        
        $vote2 = $this->votes2::where('empid',Auth()->user()->empid)->get();
            if (count($vote2)) {
                Alert::error("خطأ", "عفواً لا يحق لك التصويت");
                return back();
            }else{
                $name = $this->user::where('empid',$request->candidatePerson)->pluck('name')->first();
                votes2::create([
                    'empid' => Auth()->user()->empid,
                    'candidatePosition' => 4,
                    'candidatePerson' => $request->candidatePerson,
                    'persoName' => $name,
                ]);                
                Alert::success("التصويت", "تم التصويت بنجاح");
                return back();
            }
        /* vote 2 */
        /* vote 1 */
        /* $this->validate($request, [
            'candidatePerson1' => 'required',
            'candidatePerson2' => 'required',
            'candidatePerson3' => 'required',
            'candidatePerson' => 'required',
        ], [
            'candidatePerson1.required' => 'لابد من التصويت لرئيس الجمعية العمومية',
            'candidatePerson2.required' => 'لابد من التصويت لرئيس مجلس إدارة الصندوق',
            'candidatePerson3.required' => 'لابد من التصويت لنائب رئيس مجلس إدارة الصندوق',
            'candidatePerson.required' => 'لابد من التصويت لإعضاء مجلس إدارة الصندوق',
        ]);
        if (count($request->candidatePerson) < 3) {
            Alert::error("خطأ", "نأمل التأكد من إختيار ثلاثة إعضاء");
            return back();
        } else {
            $vote = $this->vote::where('empid',Auth()->user()->empid)->get();
            if (count($vote)) {
                Alert::error("خطأ", "عفواً لا يحق لك التصويت");
                return back();
            }else{
                Vote::create([
                    'empid' => Auth()->user()->empid,
                    'candidatePosition' => 1,
                    'candidatePerson' => $request->candidatePerson1,
                    'persoName' => $request->persoName1,
                ]);
                Vote::create([
                    'empid' => Auth()->user()->empid,
                    'candidatePosition' => 2,
                    'candidatePerson' => $request->candidatePerson2,
                    'persoName' => $request->persoName2,
                    
                ]);
                Vote::create([
                    'empid' => Auth()->user()->empid,
                    'candidatePosition' => 3,
                    'candidatePerson' => $request->candidatePerson3,
                    'persoName' => $request->persoName3,
                ]);
                for ($i=0; $i < 3 ; $i++) {
                    $name = $this->user::where('empid',$request->candidatePerson[$i])->pluck('name')->first();
                    Vote::create([
                        'empid' => Auth()->user()->empid,
                        'candidatePosition' => 4,
                        'candidatePerson' => $request->candidatePerson[$i],
                        'persoName' => $name,
                    ]);
                }
                
                Alert::success("التصويت", "تم التصويت بنجاح");
                return back();
            }
        }     */
    }
    public function resualtAllData()
    {
        $vote = DB::select('SELECT u.empid empid,u.name name,candidatePosition,persoName FROM votes AS v LEFT JOIN users AS u 
        ON v.empid = u.empid where v.empid IN(11002,11935,11768) ORDER BY 1,3');
        return view('savings.resualtAllData',compact('vote'));   
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Savings  $savings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $savings = $this->savings::findOrFail($request->id);
        $savings->delete();
        Savingsbkp::create([
            'empid' => $request->empid ,
            'emp_name' => $request->emp_name,
            'salary' => $request->salary ,
            'newpremium' => $request->newpremium ,
            'contribute' => $request->contribute ,
            'userdeleted' => Auth()->user()->name
        ]);
        Alert::error("إلغاء إشتراك", "تم إلغاء إشتراك $request->emp_name بنجاح");
        return back();
    }
}

