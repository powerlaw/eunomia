<?php namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Request;
use Rees\Sanitizer\Facade as Sanitizer;

class VideoFavorRequest extends Request {

    protected function getRules()
    {
        list(,$action) = explode('@',$this->route()->getActionName());
        switch($action)
        {
            case 'index':
            default:
                $santizeRules = [
                    'sort'=>'sqlorderby',
                ];
                $this->replace(Sanitizer::sanitize($santizeRules, $this->all()));
                $rules = [
                ];
                $validator = Validator::make($this->route()->parameters(),$rules);
                $this->messages = array_merge($this->messages,$validator->errors()->getMessages());
                return [
                    'offset'=>'sometimes|integer|min:0',
                    'limit'=>'sometimes|integer|min:1',
                    'updown'=>'sometimes|integer|in:1,-1',
                    'fields'=>['sometimes','regex:/^\w+(,\w+)*$/']
                ];
            case 'show':
                $santizeRules = [
                ];
                $this->replace(Sanitizer::sanitize($santizeRules, $this->all()));

                $rules = [
                    'video_id'=>'required|integer|min:1',
                ];
                $validator = Validator::make($this->route()->parameters(),$rules);
                $this->messages = array_merge($this->messages,$validator->errors()->getMessages());
                return [
                    'fields'=>['sometimes','regex:/^\w+(,\w+)*$/']
                ];
        }
    }

    protected function deleteRules()
    {
        list(,$action) = explode('@',$this->route()->getActionName());
        switch($action)
        {
            case 'destroy':
            default:
                $santizeRules = [
                ];
                $this->replace(Sanitizer::sanitize($santizeRules, $this->all()));

                $rules = [
                    'video_id'=>'required|integer|min:1',
                ];
                $validator = Validator::make($this->route()->parameters(),$rules);
                $this->messages = array_merge($this->messages,$validator->errors()->getMessages());

                return [
                    'user_id'=>'required|integer|min:1',
                    'fields'=>['sometimes','regex:/^\w+(,\w+)*$/']
                ];
        }
    }

    protected function postRules()
    {
        list(,$action) = explode('@',$this->route()->getActionName());
        switch($action)
        {
            case 'store':
            default:
                $santizeRules = [
                ];
                $this->replace(Sanitizer::sanitize($santizeRules, $this->all()));

                $rules = [
                    'video_id'=>'required|integer|min:1',
                ];
                $validator = Validator::make($this->route()->parameters(),$rules);
                $this->messages = array_merge($this->messages,$validator->errors()->getMessages());
                return [
                    'user_id'=>'required|integer|min:1',
                    'fields'=>['sometimes','regex:/^\w+(,\w+)*$/']
                ];
        }
    }


}
