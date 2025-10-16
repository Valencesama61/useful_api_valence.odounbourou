<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\UserModule;

class ModuleController extends Controller
{
    use HttpResponses;
    //get all modules 
    public function index(){
        return response()->json(Module::all());
    }

    //activate specified module
    public function activate(Request $request, $id){
        $user = $request->user();
        if(!$user){
            return $this->error('', 'Sorry your are not allowed to activate this module', 403);
        }
        $module = Module::find($id);
        if(!$module) return $this->error('', 'module not found', 404);

        $exist = UserModule::where('user_id', $user->id)
                            ->where('module_id', $module->id)
                            ->exists();
        if(!$exist){
            UserModule::create([
                'user_id' => $user->id,
                'module_id' => $module->id,
                'active' => true,
            ]);
        }
        return $this->success([
            'module' => $module
        ], 'module activated');
    }

    //deactivate specified module
    public function deactivate(Request $request, $id){
        $user = $request->user();
        if(!$user){
            return $this->error('', 'Sorry your are not allowed to deactivate this module', 403);
        }
        $module = Module::find($id);
        if(!$module) return $this->error('', 'module not found', 404);
        
        $exist = UserModule::where('user_id', $user->id)
                            ->where('module_id', $module->id);
        
        if(!$exist) {
            return $this->error('', 'this module is not active so, impossible to desactive this', 403);
        }else{
            
            $exist->delete();
        }
        return $this->success([
            'module' => $module
        ], 'Module deactivated');
    }
}
