<?php

namespace Modules\Cargo\Http\Helpers;

use Modules\Cargo\Entities\Mission;

class MissionActionHelper{

    private $actions;
	public function __construct() {
		$this->actions = array();
	}

    public function get($status,$type=null)
    {
        if($status == Mission::REQUESTED_STATUS){
            return $this->requested();
        }elseif($status == Mission::APPROVED_STATUS){
            return $this->accepted();
        }elseif($status == Mission::CLOSED_STATUS){
            return $this->closed();
        }elseif($status == Mission::RECIVED_STATUS){
            return $this->received();
        }elseif($status == Mission::DONE_STATUS){
            return $this->done();
        }else{
            return $this->default();
        }
    }
    static public function permission_info()
    {
        return [
            [
                "text"=> __('cargo::view.approve_assign_mission_action'),
                "permissions"=>1027,
            ],
            [
                "text"=> __('cargo::view.refuse_mission_action'),
                "permissions"=>1028,
            ],
            [
                "text"=> __('cargo::view.confirm_mission_done_action'),
                "permissions"=>1029,
            ],
            [
                "text"=> __('cargo::view.receive_mission_action'),
                "permissions"=>1030,
            ]
        ];  
    }

    
    private function requested()
    {
            $this->actions[count($this->actions)] = array();
            $this->actions[count($this->actions)-1]['title'] = __('cargo::view.approve_assign');
            $this->actions[count($this->actions)-1]['icon'] = 'fa fa-check';
            $this->actions[count($this->actions)-1]['url'] = route('admin.mission.action.approve',['to'=>Mission::APPROVED_STATUS]);
            $this->actions[count($this->actions)-1]['method'] = 'POST';
            $this->actions[count($this->actions)-1]['js_function_caller'] = 'openCaptainModel(this,event)';
            $this->actions[count($this->actions)-1]['type'] = 1; 
            $this->actions[count($this->actions)-1]['permission'] = 'approve-assign-mission-action'; 
            $this->actions[count($this->actions)-1]['user_role'] = [1,3]; 
            $this->actions[count($this->actions)-1]['index'] = true;
            
            $this->actions[count($this->actions)] = array();
            $this->actions[count($this->actions)-1]['title'] = __('cargo::view.close');
            $this->actions[count($this->actions)-1]['icon'] = 'fa fa-trash';
            $this->actions[count($this->actions)-1]['url'] = route('admin.missions.action',['to'=>Mission::CLOSED_STATUS]);
            $this->actions[count($this->actions)-1]['method'] = 'POST';
            $this->actions[count($this->actions)-1]['permission'] = 'closed-mission-action'; 
            $this->actions[count($this->actions)-1]['type'] = 1; 
            $this->actions[count($this->actions)-1]['user_role'] = [1,3]; 
            $this->actions[count($this->actions)-1]['index'] = true;

            return $this->actions;
    }

    private function requestedPickup()
    {

            $this->actions[count($this->actions)] = array();
            $this->actions[count($this->actions)-1]['title'] = __('cargo::view.approve');
            $this->actions[count($this->actions)-1]['icon'] = 'fa fa-check';
            $this->actions[count($this->actions)-1]['url'] = route('admin.missions.action',['to'=>Mission::APPROVED_STATUS]);
            $this->actions[count($this->actions)-1]['method'] = 'POST';
            $this->actions[count($this->actions)-1]['type'] = 1; 
            $this->actions[count($this->actions)-1]['user_role'] = [1,3];  
            $this->actions[count($this->actions)-1]['index'] = true;
            
            $this->actions[count($this->actions)] = array();
            $this->actions[count($this->actions)-1]['title'] = __('cargo::view.close');
            $this->actions[count($this->actions)-1]['icon'] = 'fa fa-trash';
            $this->actions[count($this->actions)-1]['url'] = route('admin.missions.action',['to'=>Mission::CLOSED_STATUS]);
            $this->actions[count($this->actions)-1]['method'] = 'POST';
            $this->actions[count($this->actions)-1]['permission'] = 'closed-mission-action';
            $this->actions[count($this->actions)-1]['type'] = 1; 
            $this->actions[count($this->actions)-1]['user_role'] = [1,3];  
            $this->actions[count($this->actions)-1]['index'] = true;

            

            return $this->actions;
    }

    private function done()
    {
            
            
            

            return $this->actions;
    }

    private function accepted()
    {
        $this->actions[count($this->actions)] = array();
        $this->actions[count($this->actions)-1]['title'] = __('cargo::view.receive');
        $this->actions[count($this->actions)-1]['icon'] = 'fa fa-trash';
        $this->actions[count($this->actions)-1]['url'] = route('admin.missions.action',['to'=>Mission::RECIVED_STATUS]);
        $this->actions[count($this->actions)-1]['method'] = 'POST';
        $this->actions[count($this->actions)-1]['permission'] = 'receive-mission-action'; 
        $this->actions[count($this->actions)-1]['type'] = 1; 
        $this->actions[count($this->actions)-1]['user_role'] = [1,3,5]; 
        $this->actions[count($this->actions)-1]['index'] = true;

        $this->actions[count($this->actions)] = array();
        $this->actions[count($this->actions)-1]['title'] = __('cargo::view.close');
        $this->actions[count($this->actions)-1]['icon'] = 'fa fa-trash';
        $this->actions[count($this->actions)-1]['url'] = route('admin.missions.action',['to'=>Mission::CLOSED_STATUS]);
        $this->actions[count($this->actions)-1]['method'] = 'POST';
        $this->actions[count($this->actions)-1]['permission'] = 'closed-mission-action'; 
        $this->actions[count($this->actions)-1]['type'] = 1; 
        $this->actions[count($this->actions)-1]['user_role'] = [1,3]; 
        $this->actions[count($this->actions)-1]['index'] = true;
            
            return $this->actions;
    }

    private function received()
    {
            
            return $this->actions;
    }

    private function closed()
    {
        return $this->actions;
    }

    private function default()
    {
           
            return $this->actions;
    }
}